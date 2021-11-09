<?php
namespace App\Http\Controllers;

use App\dispatch\ver;
use App\Sale;
use App\Client;
use App\Transaction;
use Illuminate\Http\Request;
use DB;



class DispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = DB::connection(session()->get('database'))
            ->table('sales')
            ->join('clients', 'sales.client_id', '=', 'clients.id')
            // ->join('products','sales.client_id','=','products.id')
            ->select('clients.name','clients.email','clients.phone','clients.address','sales.date_of_delivery', 'clients.id')
            ->get();

        return view('dispatch.index', compact('date'));
    }
  
    public function show(){
      
        //dd($client);
        // $client = DB::connection(session()->get('database'))
        //     ->table('clients')
        //     ->select('clients.name','clients.document_id','clients.phone','clients.email','clients.address')
        //     ->get();
        //     return view('dispatch.ver',compact('client'));



            $watch = DB::connection(session()->get('database'))
                    ->table('sold_products')
                    ->join('clients', 'sold_products.id', '=', 'clients.id')
                    ->join('products','sold_products.product_id','=','products.id')
                    ->select('products.category_product','products.name','sold_products.qty','sold_products.price','sold_products.total_amount')
                    ->get();
    
            return view('dispatch.ver', compact('watch',));
         }

    

    

} 