@extends('layouts.app', ['page' => 'detalle', 'pageSlug' => 'dispatch', 'section' => 'dispatch'])

@section('content')

<div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                            <h3 class="mb-0">Detalle cliente </h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary">Atrás </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <table class="table">
                        <thead>
                           
                            <th>Nombre</th>
                            <th>Rut</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            
                        </thead>
                        <tbody>
                        @foreach($client as $clients)
                                <tr>
                                     <td>{{ $clients->name}}</td>
                                     <td>{{ $clients->document_id}}</td>
                                     <td>{{ $clients->phone}}</td>
                                     <td>{{ $clients->email}}</td>
                                     <td>{{ $clients->address}}</td>
                                     </td>
                                   
                                </tr>

                                @endforeach
                            
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Detalle venta </h3>
                         
                    </div>
                    <div class="card-body">
                    
                    <table class="table">
                        <thead>
                            <th>Categoría</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio C/U</th>
                            <th>Total + IVA</th>
                            <!-- <th>fecha de entrega</th> -->
                        </thead>
                        <tbody>
                        @foreach($watch as $watch)
                                <tr>
                                     <td>{{ $watch->category_product}}</td>
                                     <td>{{ $watch->name}}</td>
                                     <td>{{ $watch->qty}}</td>
                                     <td>{{ $watch->price}}</td>
                                     <td>{{ $watch->total_amount}}</td>
                                     <!-- <td>{{ $watch->date_of_delivery}}</td> -->
                                   
                                </tr>

                                @endforeach
                      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Observaciones </h3>

                                <div class="card-body">
                                    <label class="form-control-label" for="input-reference">Observaciones</label>
                                    <input type="text" name="reference" id="input-reference" class="form-control form-control-alternative">

                                </div>
                         
                            </div>   
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
