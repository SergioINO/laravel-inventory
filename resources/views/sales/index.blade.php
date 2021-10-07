@extends('layouts.app', ['page' => 'Ventas', 'pageSlug' => 'sales', 'section' => 'transactions'])
@section('css')
<style>
    .switchBtn {
        position: relative;
        display: inline-block;
        width: 110px;
        height: 34px;
    }
    .switchBtn input {display:none;}
    .slide {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        padding: 8px;
        color: #fff;
    }
    .slide:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 78px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }
    input:checked + .slide {
        background-color: #8CE196;
        padding-left: 40px;
    }
    input:focus + .slide {
        box-shadow: 0 0 1px #01aeed;
    }
    input:checked + .slide:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
        left: -20px;
    }

    .slide.round {
        border-radius: 34px;
    }
    .slide.round:before {
        border-radius: 50%;
    }
</style>
@endsection
@section('content')
    @include('alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4">
                            <h4 class="card-title">Ventas</h4>
                        </div>
                        <div class="col-4" >
                            <form method="GET" action="{{route('export_excel')}}">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-download mr-2"></i> Exportar Resumen Ventas
                                </button>
                            </form>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('sales.create') }}" class="btn btn-sm btn-primary">Registrar Venta</a>
                        </div>
                        
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Usuario</th>
                                <th>Productos</th>
                                <th>Total Stock</th>
                                <th>Cantidad Total</th>
                                <th>Estado</th>
                                <th>Reserva</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td>
                                        <td><a href="{{ route('clients.show', $sale->client) }}">{{ $sale->client->name }}<br>{{ $sale->client->document_type }}-{{ $sale->client->document_id }}</a></td>
                                        <td>{{ $sale->user->name }}</td>
                                        <td>{{ $sale->products->count() }}</td>
                                        <td>{{ $sale->products->sum('qty') }}</td>
                                        <td>{{ format_money($sale->products->sum('total_amount')) }}</td>
                                        <td>
                                            @if (!$sale->finalized_at)
                                                <span class="text-danger">Por Finalizar</span>
                                            @else
                                                <span class="text-success">Finalizado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <label class="switchBtn">
                                                <input type="checkbox">
                                                <div class="slide round">Reservado</div>
                                            </label>
                                        </td>
                                        <td class="td-actions text-right">
                                            @if (!$sale->finalized_at)
                                                <a href="{{ route('sales.show', ['sale' => $sale] )}}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                                    <i class="tim-icons icon-pencil"></i>
                                                </a>
                                                <a href="{{ route('descargarPDF', ['sale' => $sale] )}}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Imprimir PDF" ">
                                                    <i class="tim-icons icon-attach-87"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('sales.show', ['sale' => $sale] )}}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Ver Venta">
                                                    <i class="tim-icons icon-zoom-split"></i>
                                                </a>
                                                <a href="{{ route('descargarPDF', ['sale' => $sale] )}}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Imprimir PDF" ">
                                                    <i class="tim-icons icon-attach-87"></i>
                                                </a>
                                            @endif
                                            <form action="{{ route('sales.destroy', $sale) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="confirm('¿Está seguro de que desea eliminar esta venta? Todos sus registros serán eliminados permanentemente.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $sales->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    
@endsection
        
