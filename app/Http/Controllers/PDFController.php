<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Client;
use App\Sale;


class PDFController extends Controller
{
    public function PDF(Sale $sale){
        // dd($sale);
        $cliente = Client::all();
        
        $pdf = PDF::loadView('product_quotation', compact('cliente'))->setPaper('a4');

        return $pdf->download('cotizacion_productos.pdf');
    }

}
