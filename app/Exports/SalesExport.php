<?php

namespace App\Exports;
use DB;
use Carbon\Carbon;
use Session;
use App\Sales;
use App\Client;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class SalesExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function styles(Worksheet $sheet)
    {

        return [
            1    => ['font' => ['bold' => true]],
            2    => ['font' => ['bold' => true]],
            3    => ['font' => ['bold' => true]],
            4    => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20, 
            'D' => 20, 
            'E' => 20, 
            'F' => 20, 
            'G' => 20, 
            'H' => 20, 
            'I' => 20, 
            'J' => 20, 
            'K' => 20, 
            'L' => 20, 
            'M' => 20, 
            'N' => 20, 
            'O' => 20,
            'Q' => 20,
            'R' => 20,
            'S' => 20,
            'T' => 20,
        ];
    }

    public function collection()
    {
        // return Equipment::all();
        $sales = DB::connection(session()->get('database'))
                        ->table('sales')
                        ->get();
        // dd($sales);
        
        $collectionTable = collect();

        foreach ($sales as $key => $value) {
            $client = Client::on(session()->get('database'))->find($value->client_id);
            $products = DB::connection(session()->get('database'))
                        ->table('sales')
                        ->join('sold_products', 'sales.id', '=', 'sold_products.sale_id')
                        ->join('products', 'sold_products.product_id', '=', 'products.id')
                        ->select('products.name','products.thickness','products.width','products.length',
                                    'products.type_measure','products.purchase_price','sold_products.qty',
                                    'sold_products.price','sold_products.total_amount')
                        ->where('sales.id', $value->id)
                        ->get();

            foreach ($products as $key => $valueproduct) {
                
                // dd($client,$valueproduct,$value);
                            
                $collectionTable->push((object)[

                    'CLIENTE'          => $client->name,
                    'FECHA'            => $value->finalized_at,
                    'PRODUCTO'         => $valueproduct->name,
                    'ESPESOR'          => $valueproduct->thickness,
                    'ANCHO'            => $valueproduct->width,
                    'LARGO'            => $valueproduct->length,
                    'CANTIDAD'         => $valueproduct->qty,
                    'VOLUMEN'          => $valueproduct->qty,
                    'UN.MEDIDA'        => $valueproduct->type_measure,
                    'PRECIO UNITARIO'  => $valueproduct->price,
                    'TOTAL NETO'       => ($valueproduct->price)*($valueproduct->qty),
                    'IVA'              => (($valueproduct->price)*($valueproduct->qty))* 0.19,
                    'TOTAL'            => $value->total_amount,
                    'ORIGEN CLIENTE'   => $client->address,
                    'P.COMPRA'         => $valueproduct->purchase_price,
                    'MGN'              => (($valueproduct->price - $valueproduct->purchase_price) / $valueproduct->purchase_price)* 100 .' %' ,
                    'TOTAL COSTO'      => ($valueproduct->purchase_price) * ($valueproduct->qty) ,
                    'UTILIDAD'         => (($valueproduct->price)*($valueproduct->qty)) - (($valueproduct->purchase_price) * ($valueproduct->qty)),
                    // 'ESTATUS CLIENTE'      => $value->location,
                    // 'LUGAR DE PROCEDENCIA' => $manufacturing_at,
                    
                ]);
            }
            
        } 

        return $collectionTable;
    }


    public function headings(): array
    {
        
        return [
            [
                'A1' => ' ',
                'B1' => ' ',
                'C1' => 'EXPORTACIÓN RESUMEN VENTAS',
                'D1' => ' ',
                'E1' => ' ',
                'F1' => 'FECHA: ',
                'G1' => Carbon::now('America/Santiago')->format('H:i  d/m/Y'),
            
            ],
            
            [
                'A2' => ' ',
                
            ],
            [
                'CLIENTE'               ,
                'FECHA'                 ,
                'PRODUCTO'              ,
                'ESPESOR'               ,
                'ANCHO'                 ,
                'LARGO'                 ,
                'CANTIDAD'              ,
                'VOLUMEN'               ,
                'UN.MEDIDA'             ,
                'PRECIO UNITARIO'       ,
                'TOTAL NETO'            ,
                'IVA'                   ,
                'TOTAL'                 ,
                'ORIGEN CLIENTE'        ,
                'P.COMPRA',
                'MGN',
                'TOTAL COSTO',
                'UTILIDAD',
                // 'ESTATUS CLIENTE'       ,
                // 'LUGAR DE PROCEDENCIA'  ,
            ],

        ];
    }
}
