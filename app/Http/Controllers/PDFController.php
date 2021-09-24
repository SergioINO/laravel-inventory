<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Client;
use App\Sale;


class PDFController extends Controller
{
    public function PDF(Sale $sale){
        
        $cliente = Client::on(session()->get('database'))->find($sale->client_id);
        // dd($cliente);
        
        $pdf = PDF::loadView('product_quotation', compact('cliente'));

        return $pdf->download('cotizacion_productos.pdf');
    }

}
