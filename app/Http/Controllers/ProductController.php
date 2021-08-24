<?php

namespace App\Http\Controllers;
use DB;
use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(25);

        return view('inventory.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();

        return view('inventory.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProductRequest  $request
     * @param  App\Product  $model
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Product $product)
    {

        // dd($request);
        $rules = [
            'name' => 'required|string',
            'thickness' => 'required|numeric',
            'width'     => 'required|numeric',
            'length'    => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_defective' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'description' => 'nullable|string',
        ];

        try {
        
            $this->validate($request, $rules);

            DB::connection(session()->get('database'))->beginTransaction();
            
            $store = new Product;
            $store->setConnection(session()->get('database'));
                $store->name        = $request->name;
                $store->product_category_id = $request->product_category_id;
                $store->stock       = $request->stock;
                $store->stock_defective = $request->stock_defective;
                $store->purchase_price = $request->purchase_price;
                $store->selling_price = $request->selling_price;
                $store->description = $request->description;
                if ($request->type_measure = 'mm') {
                    $store->thickness        = $request->thickness;
                    $store->width       = $request->width;
                    $store->length = $request->length;
                    // obtengo m2 de cada producto
                    $store->m2 = ($request->width * $request->length)/1000;  
                    // obtengo m3 de cada producto
                    $store->m3 = ($request->thickness * $request->width * $request->length)/1000; 
                    // $store->PT = falta hacer formula  
                    // $store->TOTAL_PT = falta hacer formula 
                }
                if ($request->type_measure = 'pulg') {
                    $store->thickness        = $request->thickness;
                    $store->width       = $request->width;
                    $store->length = $request->length;
                    // $store->m2 = falta hacer formula  
                    // $store->m3 = falta hacer formula  
                    // $store->PT = falta hacer formula  
                    // $store->TOTAL_PT = falta hacer formula 
                }

            $store->save();
                
            DB::connection(session()->get('database'))->commit();

            return redirect()
            ->route('products.index')
            ->withStatus('Producto registrado con éxito!.');

        }catch (ValidationException $exception) {
            
            DB::connection(session()->get('database'))->rollback();
            return response()->json(['errors' => $exception->errors()], 422);
        }
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $solds = $product->solds()->latest()->limit(25)->get();

        $receiveds = $product->receiveds()->latest()->limit(25)->get();

        return view('inventory.products.show', compact('product', 'solds', 'receiveds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product = Product::on(session()->get('database'))->find($product->id);

        if ($product) {
            $categories = ProductCategory::all();
            return view('inventory.products.edit', compact('product', 'categories'));
            
        }

        return response()->json([ 'success' => false, 'error' => 'Not unit'], 500);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {

        // dd($request);
        $rules = [
            'name' => 'required|string',
            'thickness' => 'required|numeric',
            'width'     => 'required|numeric',
            'length'    => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_defective' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'description' => 'nullable|string',
        ];

        try {
        
            $this->validate($request, $rules);

            DB::connection(session()->get('database'))->beginTransaction();

            $store = Product::on(session()->get('database'))->find($product->id);
            $store->setConnection(session()->get('database'));
                $store->name        = $request->name;
                $store->product_category_id = $request->product_category_id;
                $store->stock       = $request->stock;
                $store->stock_defective = $request->stock_defective;
                $store->purchase_price = $request->purchase_price;
                $store->selling_price = $request->selling_price;
                $store->description = $request->description;
                if ($request->type_measure = 'mm') {
                    $store->thickness        = $request->thickness;
                    $store->width       = $request->width;
                    $store->length = $request->length;
                    // obtengo m2 de cada producto
                    $store->m2 = ($request->width/1000) * ($request->length*304.8/1000);  
                    // obtengo m3 de cada producto
                    $store->m3 = ($request->thickness/1000) * ($request->width/1000) * ($request->length*304.8/1000); 
                    // $store->PT = falta hacer formula  
                    // $store->TOTAL_PT = falta hacer formula 
                }
                if ($request->type_measure = 'pulg') {
                    $store->thickness        = $request->thickness;
                    $store->width       = $request->width;
                    $store->length = $request->length;
                    // $store->m2 = falta hacer formula  
                    // $store->m3 = falta hacer formula  
                    // $store->PT = falta hacer formula  
                    // $store->TOTAL_PT = falta hacer formula 
                }

            $store->save();
                
            DB::connection(session()->get('database'))->commit();

            return redirect()
            ->route('products.index')
            ->withStatus('Producto actualizado con éxito!.');

        }catch (ValidationException $exception) {
            
            DB::connection(session()->get('database'))->rollback();
            return response()->json(['errors' => $exception->errors()], 422);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->withStatus('Producto retirado con éxito!.');
    }
}
