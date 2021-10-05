<?php

namespace App\Exports;
use DB;
use Carbon\Carbon;
use Session;
use App\Sales;
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
            'A' => 10,
            'B' => 25,
            'C' => 35, 
            'D' => 20, 
            'E' => 35, 
            'F' => 25, 
            'G' => 20, 
            'H' => 20, 
            'I' => 30, 
            'J' => 20, 
            'K' => 20, 
            'L' => 20, 
            'M' => 20, 
            'N' => 20, 
            'O' => 30,
            
        ];
    }

    public function collection()
    {
        // return Equipment::all();
        $sales = DB::connection(session()->get('database'))
                        ->table('sales')
                        ->select(
                            'equipment.id','units.unit','responsability_centers.center','equipment.code','equipment.equipment',
                            'equipment_ratings.equipment_rating','equipment.inventory','equipment_groups.equipment_group',
                            'equipment_sub_groups.equipment_subgroup', 'equipment_states.equipment_state',
                            'equipment_properties.equipment_property',
                            'equipment.serie','equipment.location','equipment.warranty', 'equipment.provenance', 'equipment.commentary',
                            'equipment.manufacturing_at','equipment.reception_at','equipment.installation_at',
                            'marks.mark','patterns.pattern','providers.provider'
                        )
                        ->join("units","units.id", "equipment.unit_id")                    
                        ->join("equipment_groups", "equipment_groups.id", "equipment.group_id")   
                        ->join("equipment_sub_groups", "equipment_sub_groups.id", "equipment.subgroup_id") 
                        ->join("equipment_states", "equipment_states.id", "equipment.state_id")
                        ->join("equipment_properties", "equipment_properties.id", "equipment.property_id")                
                        ->join("responsability_centers", "responsability_centers.id", "equipment.cr_id")
                        ->join("equipment_ratings", "equipment_ratings.id", "equipment.rating_id")
                        ->join("marks", "marks.id", "equipment.mark_id")
                        ->join("patterns", "patterns.id", "equipment.pattern_id")
                        ->join("providers", "providers.id", "equipment.provider_id")
                        ->get();

        $collectionTable = collect();

        foreach ($sales as $key => $value) {
            
            if($value->manufacturing_at == NULL){

                $manufacturing_at = '';
            }else{
                $manufacturing_at = Carbon::createFromFormat('Y-m-d H:i:s', $value-> manufacturing_at)->format('d-m-Y');
            }

            if($value->reception_at == NULL){
                $reception_at = '';
            }else{
                $reception_at = Carbon::createFromFormat('Y-m-d H:i:s', $value-> reception_at)->format('d-m-Y');
            }

            if($value->installation_at == NULL){
                $installation_at = '';
            }else{
                $installation_at = Carbon::createFromFormat('Y-m-d H:i:s', $value-> installation_at)->format('d-m-Y');
            }
            
            $collectionTable->push((object)[
                'CLIENTE'                        => $key+1,
                'FECHA'                    => $value->unit,
                'PRODUCTO' => $value->center,
                'ESPESOR'                      => $value->code,
                'ANCHO'                    => $value->equipment,
                'LARGO'                     => $value->equipment_group,
                'CANTIDAD'                  => $value->equipment_subgroup,
                'VOLUMEN'             => $value->inventory,
                'UN.MEDIDA'                  => $value->serie,
                'PRECIO UNITARIO'                     => $value->mark,
                'TOTAL NETO'                    => $value->pattern,
                'IVA'             => $value->equipment_rating,
                'TOTAL'                    => $value->equipment_state,
                'ORIGEN CLIENTE'                 => $value->equipment_property,
                'ESTATUS CLIENTE'                 => $value->location,
                'LUGAR DE PROCEDENCIA'         => $manufacturing_at,
                
                
            ]);
        } 

        return $collectionTable;
    }


    public function headings(): array
    {
        
        return [
            [
                'A1' => ' ',
                'B1' => ' ',
                'C1' => 'EXPORTACIÓN MASIVA DE EQUIPOS',
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
                'ESTATUS CLIENTE'       ,
                'LUGAR DE PROCEDENCIA'  ,
            ],

        ];
    }
}
