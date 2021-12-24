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
                                
                                <form action="{{ route('dispatch.index')}}" method="get" >
                                    @csrf
                                        <div class="row">
                                                <div class="col-xs-6">
                                                <label>Fecha inicial</label>
                                                    <input class="form-control datepicker" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" type="date" name="fecha_inicial"  type="text" value={{$fecha_inicial}} >
                                                 </div>

                                                 <div class="col-xs-6">
                                                 <label>Fecha final</label>
                                                    <input class="form-control datepicker" min="{{Carbon\Carbon::now()->format('Y-m-d')}}"  type="date" name="fecha_final"  type="text" value={{$fecha_final}}>
                                                    <input class="btn btn-outline-light my-5 my-sm-0 " type="submit" value="Buscar" ></input>

                                                </div>
                                </form>
                        </div> 
                </div> 

                

            
            
                <div class="card-body">
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th>Nombre</th>
                                <!-- <th>Email</th> -->
                                <th>Telefono</th>
                                <th></th>
                                <!-- <th>Detalle</th> -->
                                <!-- <th>Dirección</th> -->
                                <th>Fecha estimada</th>  
                            </thead>
                            <body>

                                @if(count($date)<= 0)
                                    <tr>
                                        <td colspan ="4">No hay resultados</td>
                                    </tr>
                                @else
                                
                                    @foreach($date as $clients)
                                        <tr>
                                            <td>{{ $clients->name}}</td>
                                            <!-- <td>{{ $clients->email}}</td> -->
                                            <td>{{ $clients->phone}}</td>
                                            <td></td>
                                            <!-- <td>{{ $clients->address}}</td> -->
                                            <td>{{ $clients->date_of_delivery}}</td>
                                            <td class="td-actions text-right">                                             
                                                <a href="{{ route('dispatch.show', $clients->sale) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Ver mas detalle">
                                                    <i class="tim-icons icon-zoom-split"></i>
                                                </a>                                    
                                                <!-- <a href="#updateUser {{$clients->sale}}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Modificar fecha">
                                                    <i class="tim-icons icon-pencil"></i><h1>{{$clients->sale}}</h1>
                                                </a>                                            -->
                                                <a data-toggle="modal" data-target="#exampleModalEdit_{{$clients->sale}}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Modificar fecha de entrega">
                                                    <i class="tim-icons icon-pencil"></i> <h1>{{$clients->sale}}</h1></a>
                                            </td>
                                            <!-- Modal -->
                                            <!-- <div class="modal fade" id="exampleModalEdit_{{$clients->sale}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelEdit" aria-hidden="true"> -->
                                            <div class="modal fade" id="exampleModalEdit_{{$clients->sale}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalEdit" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="exampleModalLabel">Fecha estimada de entrega</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                            <div id="response"></div>
                                                            <div class="form-group">
                                                                <h5 align="center"> Seleccione Fecha:<br></h5>
                                                                <form action="" method="post" class="d-inline">
                                                                                @csrf
                                                                    <div class="form-group row">
                                                                        <label for="example-date-input" class="col-3 col-form-label">
                                                                            Fecha:
                                                                        </label>
                                                                        <div class="col-9">
                                                                            <input class="form-control datepicker" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" type="date" id="date_of_delivery" name="date_of_delivery" required>
                                                                        </div>

                                                                        <h5 align="center">  ATENCIÓN:</h5>
                                                                            <h6 align="center"><br><br>
                                                                            ¿Desea modificara la fecha de entrega.?<br><br>
                                                                            </h6>    

                                                                        <div  style="text-align: center; width:60%; height:100%">
                                                              
                                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                                                    ACEPTAR
                                                                            </button>
                                                                            <!-- <h1>{{$clients->sale}}</h1> -->
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            </div>
                                                                                                                                
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
               
                                    @endforeach
                                @endif
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
