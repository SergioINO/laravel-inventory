@extends('layouts.app', ['page' => 'Gestión de la venta', 'pageSlug' => 'sales', 'section' => 'transactions'])

@section('content')
    @include('alerts.success')
    @include('alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Resumen de la venta</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('sales.index') }}" class="btn btn-sm btn-primary">Atrás</a>
                        </div>
                        @if (!$sale->finalized_at)
                            <div class="col text-right">
                                @if ($sale->products->count() == 0)
                                    <form action="{{ route('sales.destroy', $sale) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Eliminar Ventas
                                        </button>
                                    </form>
                                @else
                                    
                                    <button type="button" class="btn btn-sm btn-primary" 
                                            onclick="confirm('ATENCIÓN: Las transacciones de esta venta no podran ser modificados, ¿quieres finalizarla? Sus registros no podrán ser modificados a partir de ahora.') ? window.location.replace('{{ route('sales.index', $sale) }}') : ''">
                                            Por Finalizar
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary" 
                                            onclick="confirm('ATENCIÓN: Las transacciones de esta venta no podran ser modificados, ¿quieres finalizarla? Sus registros no podrán ser modificados a partir de ahora.') ? window.location.replace('{{ route('sales.confirm', $sale) }}') : ''">
                                            Confirmado
                                    </button>

                                            <!-- <button type="button" class="btn btn-sm btn-primary" 
                                    onclick="confirm('ATENCIÓN: Las transacciones de esta venta no podran ser modificados, ¿quieres finalizarla? Sus registros no podrán ser modificados a partir de ahora.') ? window.location.replace('{{ route('sales.finalize', $sale) }}') : ''"> -->
                                    
                                            
                                            
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">Finalizar</button>
                                             <! - Caja modal ->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="exampleModalLabel">Fecha estimada de entrega</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                                    <div id="response"></div>
                                                                    <div class="form-group">
                                                                        <h5 align="center"> Seleccione Fecha:<br></h5>
                                                                        <form action="{{ route('sales.finalize', $sale) }}" method="post" class="d-inline">
                                                                                        @csrf
                                                                        <div class="form-group row">
                                                                            <label for="example-date-input" class="col-3 col-form-label">Fecha:</label>
                                                                            <div class="col-9">
                                                                                <input class="form-control datepicker" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" type="date" id="date_of_delivery" name="date_of_delivery" required>
                                                                            </div>

                                                                                <div style="width:60%; height:100%">
                                                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                                                        ACEPTAR
                                                                                    </button>
                                                                                </div>
                                                                            
                                                                        </form>
                                                                     </div>
                                                                    </div>
                                                                    <h5 align="center">  ATENCIÓN:</h5>
                                                                    <h6 align="center">
                                                                        Las transacciones de esta venta no podran ser modificados.
                                                                        ¿quieres finalizarla?<br>
                                                                        Sus registros no podrán ser modificados a partir de ahora.
                                                                    </h6>
                                                                        
                                                                 </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </button>
                                                         
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Cliente</th>
                            <th>Productos</th>
                            <th>Total Cantidad</th>
                            <th>Costo total</th>
                            <th>Estado</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td>
                                <td>{{ $sale->user->name }}</td>
                                <td><a href="{{ route('clients.show', $sale->client) }}">{{ $sale->client->name }}<br>{{ $sale->client->document_type }}-{{ $sale->client->document_id }}</a></td>
                                <td>{{ $sale->products->count() }}</td>
                                <td>{{ $sale->products->sum('qty') }}</td>
                                <td>{{ format_money($sale->products->sum('total_amount')) }}</td>
                                <td>{!! $sale->finalized_at ? 'Finalizado el <br>'.date('d-m-y', strtotime($sale->finalized_at)) : (($sale->products->count() > 0) ? 'PARA FINALIZAR' : 'EN ESPERA') !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Productos:</h4>
                            {{-- <h4 class="card-title">Productos: {{ $sale->products->sum('qty') }}</h4> --}}
                        </div>
                        @if (!$sale->finalized_at)
                            <div class="col-4 text-right">
                                <a href="{{ route('sales.product.add', ['sale' => $sale->id]) }}" class="btn btn-sm btn-primary">Agregar</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Categoría</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio C/U</th>
                            <th>Total + IVA</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($sale->products as $sold_product)
                                <tr>
                                    <td>{{ $sold_product->product->id }}</td>
                                    <td><a href="{{ route('categories.show', $sold_product->product->category) }}">{{ $sold_product->product->category->name }}</a></td>
                                    <td><a href="{{ route('products.show', $sold_product->product) }}">{{ $sold_product->product->name }}</a></td>
                                    <td>{{ $sold_product->qty }}  {{$sold_product->product->type_measure}}</td>
                                    <td>{{ format_money($sold_product->price) }}</td>
                                    <td>{{ format_money($sold_product->total_amount) }}</td>
                                    <td class="td-actions text-right">
                                        @if(!$sale->finalized_at)



                                            <a href="{{ route('sales.product.edit', ['sale' => $sale, 'soldproduct' => $sold_product]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar Pedido">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>




                                            <form action="{{ route('sales.product.destroy', ['sale' => $sale, 'soldproduct' => $sold_product]) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Eliminar Pedido" onclick="confirm('Estás seguro que quieres eliminar este pedido de producto/s? Su registro será eliminado de esta venta.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="{{ asset('assets') }}/js/sweetalerts2.js"></script>

<script>
    $('.datepicker').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true
    });
</script>
@endpush