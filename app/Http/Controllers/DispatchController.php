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
            ->select('clients.name','clients.email','clients.phone','clients.address','sales.date_of_delivery')
            ->get();

        return view('dispatch.index', compact('date'));
    }
  
    public function show(){

        return view('dispatch.ver');
    }


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('clients.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \App\Http\Request\ClientRequest  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(ClientRequest $request, Client $client)
    // {
    //     $client->create($request->all());
        
    //     return redirect()->route('clients.index')->withStatus('Cliente registrado exitosamente!');
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Client $client)
    // {
    //     return view('clients.show', compact('client'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Client $client)
    // {
    //     return view('clients.edit', compact('client'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \App\Http\Request\ClientRequest  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(ClientRequest $request, Client $client)
    // {
    //     $client->update($request->all());

    //     return redirect()
    //         ->route('clients.index')
    //         ->withStatus('Cliente modificado exitosamente.');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Client $client)
    // {
    //     $client->delete();

    //     return redirect()
    //         ->route('clients.index')
    //         ->withStatus('Cliente removido exitosamente!.');
    // }

    // public function addtransaction(Client $client)
    // {
    //     $payment_methods = PaymentMethod::all();

    //     return view('clients.transactions.add', compact('client','payment_methods'));
    // }
} 