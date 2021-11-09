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
                                <a href="{{ route('dispatch.index') }}" class="btn btn-sm btn-primary">Atrás </a>
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
                        <tr>
                                    
                                    </td>
                                   
                                </tr>
                           
                            
                        
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
                            <th></th>
                        </thead>
                        <tbody>
                      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
