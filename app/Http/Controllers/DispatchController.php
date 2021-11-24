<?php
namespace App\Http\Controllers;

use App\dispatch\ver;
use App\Sale;
use App\Client;
use App\Transaction;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;



class DispatchController extends Controller
{
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
                    ->select('clients.name','clients.email','clients.phone','clients.address','sales.date_of_delivery','sales.id as sale')
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
                ->select('products.category_product','products.name','sold_products.qty','sold_products.price','sold_products.total_amount','sales.date_of_delivery')
                ->where('sales.date_of_delivery','<>', '00-00-0000')
                ->where('sales.id',$sale)
                ->where('sales.date_of_delivery', '>=', Carbon::now())
                ->get();

                //->orderBy('sales.date_of_delivery', 'DESC')->take(1)->get();
                //dd($watch);
        return view('dispatch.ver', compact('watch','client'));
    }

    

    

} 