<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use App\Sale;
use App\Client;
use Illuminate\Http\Request;


class PDFController extends Controller
{
    public function PDF(Sale $sale){
        // dd( $sale);
        // INFORMACION CLIENTE
        $cliente = Client::on(session()->get('database'))->find($sale->client_id);
        // dd($cliente);
        // INFORMACION PRODUCTO A COTIZAR
        $productos = DB::connection(session()->get('database'))
                        ->table('sales')
                        ->join('sold_products', 'sales.id', '=', 'sold_products.sale_id')
                        ->join('products', 'sold_products.product_id', '=', 'products.id')
                        ->select('products.name','products.thickness','products.width','products.length', 'sold_products.qty',
                                    'sold_products.price','sold_products.total_amount')
                        ->where('sales.id', $sale->id)
                        ->get();

        // dd( $sale, $productos );
        $total_products_amount = 0;
        foreach ($productos as $product) {
            $total_products_amount += $product->total_amount;

        }
        // dd($total_products_amount);
        $pdf = PDF::loadView('product_quotation', compact('sale','cliente','productos','total_products_amount'));

        return $pdf->download('cotizacion_productos.pdf');
    }

}
