@extends('layouts.app', ['page' => 'Despacho', 'pageSlug' => 'dispatch', 'section' => 'dispatch'])

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                            <div class="col-8">
                                <h3 class="mb-0">Listado de despachos </h3>
                            </div>

                                <div class="form-group"> 
                                    <label class="control-label" for="date">Fecha inicial</label>
                                    <input class="form-control" id="fechaInicial" name="fechaInicial"  placeholder="AA/MM/DD" value="" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="date">Fecha De Expiracion</label>
                                    <input class="form-control" id="fechaFinal" name="fechaFinal" placeholder="AA/MM/DD" value="" type="text"/>
                                </div>  
                     </div>
                </div>
                
                <div class="card-body">
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th>Nombre</th>
                                <!-- <th>Email</th> -->
                                <th>Telefono</th>
                                <th>Detalle</th>
                                <!-- <th>Dirección</th> -->
                                <th>Fecha estimada</th>  
                            </thead>
                            <body>
                                @foreach($date as $clients)
                                <tr>
                                    <td>{{ $clients->name}}</td>
                                    <!-- <td>{{ $clients->email}}</td> -->
                                    <td>{{ $clients->phone}}</td>
                                     <td></td>
                                    <!-- <td>{{ $clients->address}}</td> -->
                                    <td>{{ $clients->date_of_delivery}}</td>
                                    <td class="td-actions text-right">
                        
                                        
                                    <a href="{{ route('dispatch.show', $clients->name) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Ver mas detalle">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                             
                                           
                                    </td>
                                   
                                </tr>

                                @endforeach
                            </body>
                           
                        </table>
                    </div>
                </div>

                
                
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="..."></nav>
                </div>
                
            </div>
        </div>
    </div>
@endsection