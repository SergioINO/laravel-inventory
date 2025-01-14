<?php

namespace App\Http\Controllers;

// MATWEBSITE
use Response;
use DataTables;
use Excel;
use App\Exports\SalesExport;

use DB;
use App\Client;
use App\Sale;
use App\Product;
use Carbon\Carbon;
use App\SoldProduct;
use App\Transaction;
use App\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Auth;
Use Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class SaleController extends Controller
{

    private $excel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Excel $excel)
    {
        $this->middleware('auth');
        $this->excel = $excel;
    }

    public function exportExcel() 
    {
        return Excel::download(new SalesExport, 'Exportacion Resumen Ventas '.Carbon::now()->format('dmY').'.xlsx');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::latest()->paginate(25);

        return view('sales.index', compact('sales'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();

        return view('sales.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sale $model)
    {
        $existent = Sale::where('client_id', $request->get('client_id'))->where('finalized_at', null)->get();

        if($existent->count()) {
            return back()->withError('Ya existe una venta inacabada perteneciente a este cliente. <a href="'.route('sales.show', $existent->first()).'">Haga clic aquí para ir a ella</a>');
        }

        $sale = $model->create($request->all());
        
        return redirect()
            ->route('sales.show', ['sale' => $sale->id])
            ->withStatus('Venta registrada con éxito, puede empezar a registrar productos y transacciones.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        // dd($sale);
        return view('sales.show', ['sale' => $sale]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        // HAGO EL DESCUENTO DE LA RESERVA EN CASO QUE EL  ESTADO SEA CONFIRMADO
        foreach ($sale->products as $sold_product) {

            // dd($sold_product);

            if ($sold_product->product->type_measure == 'PIEZA') {
                $sold_product->product->PT -= $sold_product->qty;
                $sold_product->product->save();
            }

            if ($sold_product->product->type_measure == 'PULG') {
                $sold_product->product->PT -= $sold_product->qty;
                $sold_product->product->save();
            }

            if ($sold_product->product->type_measure == 'M2') {
                $sold_product->product->PT -= $sold_product->qty;
                $sold_product->product->save();
            }

            if ($sold_product->product->type_measure == 'M3') {
                $sold_product->product->PT -= $sold_product->qty;
                $sold_product->product->save();
            }

            
        }
        
        $sale->delete();

        return redirect()
            ->route('sales.index')
            ->withStatus('El registro de venta ha sido eliminado con éxito!.');
    }


    public function confirm(Sale $sale)
    {
        // dd($sale);

        $sale->total_amount = $sale->products->sum('total_amount');

        // CONFIRMO SI EXISTE SUFICIENTE STOCK DISPONIBLE
        foreach ($sale->products as $sold_product) {
            $product_name = $sold_product->product->name;

            if ($sold_product->product->type_measure == 'PIEZA') {
                $product_stock = $sold_product->product->stock;
                if($sold_product->qty > $product_stock) return back()->withError("El producto '$product_name' no tiene suficiente stock. Sólo tiene $product_stock unidades.");
            }

            if ($sold_product->product->type_measure == 'PULG') {
                $product_stock = $sold_product->product->pulg_total;
                if($sold_product->qty > $product_stock) return back()->withError("El producto '$product_name' no tiene suficiente stock. Sólo tiene $product_stock unidades.");
            }

            if ($sold_product->product->type_measure == 'M2') {
                $product_stock = $sold_product->product->m2_total;
                if($sold_product->qty > $product_stock) return back()->withError("El producto '$product_name' no tiene suficiente stock. Sólo tiene $product_stock unidades.");
            }

            if ($sold_product->product->type_measure == 'M3') {
                $product_stock = $sold_product->product->m3_total;
                if($sold_product->qty > $product_stock) return back()->withError("El producto '$product_name' no tiene suficiente stock. Sólo tiene $product_stock unidades.");
            }
        }

        // dd($sale->products);
        // HAGO LA RESERVA DEL STOCK
        foreach ($sale->products as $sold_product) {

            // dd($sold_product);

            if ($sold_product->product->type_measure == 'PIEZA') {
                $sold_product->product->PT += $sold_product->qty;
                $sold_product->product->stock = $sold_product->product->stock;
                $sold_product->product->save();
            }

            if ($sold_product->product->type_measure == 'PULG') {
                $sold_product->product->PT += $sold_product->qty;
                $sold_product->product->stock = $sold_product->product->pulg_total / $sold_product->product->pulg;
                $sold_product->product->save();
            }

            if ($sold_product->product->type_measure == 'M2') {
                $sold_product->product->PT += $sold_product->qty;
                $sold_product->product->stock = $sold_product->product->m2_total / $sold_product->product->m2;
                $sold_product->product->save();
            }

            if ($sold_product->product->type_measure == 'M3') {
                $sold_product->product->PT += $sold_product->qty;
                $sold_product->product->stock = $sold_product->product->m3_total / $sold_product->product->m3;
                $sold_product->product->save();
            }

            
        }

        $sale->confirm_at = Carbon::now()->toDateTimeString();
        $sale->client->balance -= $sale->total_amount;
        $sale->save();
        $sale->client->save();

        return back()->withStatus('La venta se ha completado con éxito!.');
        // return view('sales.index')->withStatus('La venta se ha completado con éxito!.');
    }

    public function finalize(Sale $sale, Request $request)
    {
        
        // dd($sale);

        $sale->total_amount = $sale->products->sum('total_amount');

        // CONFIRMO SI EXISTE SUFICIENTE STOCK DISPONIBLE
           foreach ($sale->products as $sold_product) {
           $product_name = $sold_product->product->name;

            if ($sold_product->product->type_measure == 'PIEZA') {
                $product_stock = $sold_product->product->stock;
                if($sold_product->qty > $product_stock) return back()->withError("El producto '$product_name' no tiene suficiente stock. Sólo tiene $product_stock unidades.");
            }

            if ($sold_product->product->type_measure == 'PULG') {
                $product_stock = $sold_product->product->pulg_total;
                if($sold_product->qty > $product_stock) return back()->withError("El producto '$product_name' no tiene suficiente stock. Sólo tiene $product_stock unidades.");
            }

            if ($sold_product->product->type_measure == 'M2') {
                $product_stock = $sold_product->product->m2_total;
                if($sold_product->qty > $product_stock) return back()->withError("El producto '$product_name' no tiene suficiente stock. Sólo tiene $product_stock unidades.");
            }

            if ($sold_product->product->type_measure == 'M3') {
                $product_stock = $sold_product->product->m3_total;
                if($sold_product->qty > $product_stock) return back()->withError("El producto '$product_name' no tiene suficiente stock. Sólo tiene $product_stock unidades.");
            }
       }

        //DESCUENTO STOCK
        foreach ($sale->products as $sold_product) {

            if ($sold_product->product->type_measure == 'PIEZA') {
                $sold_product->product->PT -= $sold_product->qty;
                $sold_product->product->stock -= $sold_product->qty;
                $sold_product->product->stock = $sold_product->product->stock;
                $sold_product->product->save();
            }

            if ($sold_product->product->type_measure == 'PULG') {
                $sold_product->product->PT -= $sold_product->qty;
                $sold_product->product->pulg_total -= $sold_product->qty;
                $sold_product->product->stock = $sold_product->product->pulg_total / $sold_product->product->pulg;
                $sold_product->product->save();
            }

            if ($sold_product->product->type_measure == 'M2') {
                $sold_product->product->PT -= $sold_product->qty;
                $sold_product->product->m2_total -= $sold_product->qty;
                $sold_product->product->stock = $sold_product->product->m2_total / $sold_product->product->m2;
                $sold_product->product->save();
            }

            if ($sold_product->product->type_measure == 'M3') {
                $sold_product->product->PT -= $sold_product->qty;
                $sold_product->product->m3_total -= $sold_product->qty;
                $sold_product->product->stock = $sold_product->product->m3_total / $sold_product->product->m3;
                $sold_product->product->save();
            }

            
        }


        $request->all();
        $sale->date_of_delivery = $request->date_of_delivery;
        $sale->finalized_at = Carbon::now()->toDateTimeString();
        $sale->client->balance -= $sale->total_amount;
        $sale->save();
        $sale->client->save();

        return back()->withStatus('La venta se ha completado con éxito!.');
    }
    
    
    // public function finalize2(Request $request, Sale $sale )
    // {
        
    //     $request->all();
    //     $sale->date_of_delivery = $request->date_of_delivery;
    //     $sale->save();
    //     return back()->withStatus('La venta se ha completado con éxito!.');
    // }

    

    public function addproduct(Sale $sale)
    {
        // dd($sale);
        $products = Product::all();

        return view('sales.addproduct', compact('sale', 'products'));
    }

    public function storeproduct(Request $request, Sale $sale, SoldProduct $soldProduct)
    {
        // dd($request, $sale, $soldProduct);

        $rules = [
            'qyt' => 'required|numeric',
            'price' => 'required|numeric',
            
        ];
        
        try {

            $store = new SoldProduct;
            $store->setConnection(session()->get('database'));
                $store->sale_id = $request->sale_id;
                $store->product_id =  $request->product_id;
                $store->qty = $request->qty;
                $store->price = $request->price;
                $store->total_amount = $request->total_amount;
                $store->observations = $request->observations;
            // $this->validate($request, $rules);
            // dd($request, $sale, $soldProduct);
            $request->merge(['total_amount' => $request->get('price') * $request->get('qty')]);

            $store->save();

            DB::connection(session()->get('database'))->commit();

            return redirect()
            ->route('sales.show', ['sale' => $sale])
            ->withStatus('Producto registrado con éxito!.');

        }catch (ValidationException $exception) {
            
            DB::connection(session()->get('database'))->rollback();
            return response()->json(['errors' => $exception->errors()], 422);
        }

        
    }

    public function editproduct(Sale $sale, SoldProduct $soldproduct)
    {
        
        $products = Product::all();
        
        // dd($sale, $soldproduct , $products);
        return view('sales.editproduct', compact('sale', 'soldproduct', 'products'));
    }

    public function updateproduct(Request $request, Sale $sale, SoldProduct $soldproduct)
    {
        $request->merge(['total_amount' => $request->get('price') * $request->get('qty')]);

        $soldproduct->update($request->all());

        return redirect()->route('sales.show', $sale)->withStatus('Producto modificado con éxito!.');
    }

    public function destroyproduct(Sale $sale, SoldProduct $soldproduct)
    {
        $soldproduct->delete();

        return back()->withStatus('El producto ha sido eliminado con éxito!.');
    }

    public function addtransaction(Sale $sale)
    {
        $payment_methods = PaymentMethod::all();

        return view('sales.addtransaction', compact('sale', 'payment_methods'));
    }

    public function storetransaction(Request $request, Sale $sale, Transaction $transaction)
    {
        switch($request->all()['type']) {
            case 'income':
                $request->merge(['title' => 'Pago recibido de la identificación de la venta: ' . $request->get('sale_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'ID de pago de la devolución de la venta: ' . $request->all('sale_id')]);

                if($request->get('amount') > 0) {
                    $request->merge(['amount' => (float) $request->get('amount') * (-1) ]);
                }
                break;
        }

        $transaction->create($request->all());

        return redirect()
            ->route('sales.show', compact('sale'))
            ->withStatus('Transacción registrada con éxito!.');
    }

    public function edittransaction(Sale $sale, Transaction $transaction)
    {
        $payment_methods = PaymentMethod::all();

        return view('sales.edittransaction', compact('sale', 'transaction', 'payment_methods'));
    }

    public function updatetransaction(Request $request, Sale $sale, Transaction $transaction)
    {
        switch($request->get('type')) {
            case 'income':
                $request->merge(['title' => 'Pago recibido de la identificación de la venta: '. $request->get('sale_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'ID de pago de devolución de la venta: '. $request->get('sale_id')]);

                if($request->get('amount') > 0) {
                    $request->merge(['amount' => (float) $request->get('amount') * (-1)]);
                }
                break;
        }
        $transaction->update($request->all());

        return redirect()
            ->route('sales.show', compact('sale'))
            ->withStatus('Transacción modificada con éxito!.');
    }

    public function destroytransaction(Sale $sale, Transaction $transaction)
    {
        $transaction->delete();

        return back()->withStatus('Transacción eliminada con éxito!.');
    }
}