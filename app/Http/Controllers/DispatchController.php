<?php
namespace App\Http\Controllers;

// MATWEBSITE
use Response;
use DataTables;
use Excel;
use App\Exports\DispatchExcel;


use DB;
use App\dispatch\ver;
use App\Sale;
use App\Client;
use App\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;



class DispatchController extends Controller
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

    public function dispatchexcel() 
    {
        return Excel::download(new DispatchExcel, 'Exportacion listado de despachos '.Carbon::now()->format('dmY').'.xlsx');
        
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fecha_inicial= trim($request->get('fecha_inicial'));
        $fecha_final=trim($request->get('fecha_final'));
        $date = DB::connection(session()->get('database'))
                ->table('sales')
                    ->join('clients', 'sales.client_id', '=', 'clients.id')
                    ->select('clients.name','clients.email','clients.phone','clients.address','sales.date_of_delivery','sales.id as sale', 'clients.id as cliente')
                    ->where('sales.date_of_delivery','>', '00-00-0000') 
                    ->whereBetween('sales.date_of_delivery',[$fecha_inicial,$fecha_final])
                    ->orderBy('sales.date_of_delivery','ASC')
                    //->groupBy('clients.id')->distinct()
                    ->get();

        return view('dispatch.index', compact('date','fecha_inicial','fecha_final'));
    }
    public function show($sale){
        $client =DB::connection(session()->get('database'))
                ->table('clients')
                ->join('sales','clients.id','=', 'sales.client_id')
                ->select('clients.name','clients.document_id','clients.phone','clients.email','clients.address')
                ->where('sales.id',$sale)
                ->get();
        
        $watch = DB::connection(session()->get('database'))
                ->table('sold_products')
                ->join('products','sold_products.product_id','=','products.id')
                ->join('sales','sold_products.sale_id','sales.id')
                ->join('clients', 'sales.client_id', '=', 'clients.id')
                ->select('products.category_product','products.name','sold_products.qty','sold_products.price','sold_products.total_amount','sales.date_of_delivery','sales.observations')
                ->where('sales.date_of_delivery','<>', '00-00-0000')
                ->where('sales.id',$sale)
                ->where('sales.date_of_delivery', '>=', Carbon::now())
                ->get();


        $observations = DB::connection(session()->get('database'))
        
                ->table('sold_products')
                ->join('products','sold_products.product_id','=','products.id')
                ->join('sales','sold_products.sale_id','sales.id')
                ->join('clients', 'sales.client_id', '=', 'clients.id')
                ->select('sales.id as sale','sales.observations')
                ->where('sales.id',$sale)
                ->get();
                
                
        // $observations = Sale::find($sale);
        // $observations->observations = $request->observations;
        // $observations->save();
                //->orderBy('sales.date_of_delivery', 'DESC')->take(1)->get();
                //dd($watch);
        return view('dispatch.ver', compact('watch','client','observations'));
    }

    public function edit (Request $request, $id)
    {
        $sale = Sale::find($id);
        $sale->date_of_delivery = $request->date_of_delivery;
        $sale->save();
        return back()->withStatus('Fecha modificada.');
    }

    public function observations($sale,Request $request)
    {

        $observations = Sale::find($sale);
        $observations->observations = $request->observations;
        $observations->save();

        return back();
    }
    

} 