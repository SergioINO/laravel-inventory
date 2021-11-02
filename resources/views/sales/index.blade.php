@extends('layouts.app', ['page' => 'Ventas', 'pageSlug' => 'sales', 'section' => 'transactions'])
@section('css')
<style>

.switch {
    position: relative;
    display: inline-block;
    width: 130px;
    height: 36px;
}

.switch input {display:none;}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ca2222;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked + .slider {
    background-color: #2ab934;
}

input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
    -webkit-transform: translateX(95px);
    -ms-transform: translateX(95px);
    transform: translateX(95px);
}

/*------ ADDED CSS ---------*/
.on
{
    display: none;
}

.on, .off
{
    color: white;
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    font-size: 10px;
    font-family: Verdana, sans-serif;
}

input:checked+ .slider .on
{display: block;}

input:checked + .slider .off
{display: none;}

/*--------- END --------*/

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
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
                                <th>Confirmado</th>
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
                                            @if ($sale->finalized_at)
                                                <span class="text-danger">Finalizado</span>
                                            @elseif ($sale->confirm_at)
                                                <span class="text-danger">Confirmado</span>
                                            @else
                                                <span class="text-success">Por Finalizar</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($sale->confirm_at && !$sale->finalized_at)
                                                <label class="switch">
                                                    <input checked type="checkbox" id="togBtn" disabled>
                                                    <div class="slider round">
                                                    <!--ADDED HTML -->
                                                    <span class="on">RESERVADO</span>
                                                    <span class="off">DESPACHADO</span>
                                                    <!--END-->
                                                    </div>
                                                </label>
                                            @elseif($sale->confirm_at == NULL && $sale->finalized_at == NULL)
                                                <span class="text-danger">COTIZACION</span>
                                            @else
                                                <label class="switch">
                                                    <input  type="checkbox" id="togBtn" disabled>
                                                    <div class="slider round">
                                                    <!--ADDED HTML -->
                                                    <span class="on">RESERVADO</span>
                                                    <span class="off">DESPACHADO</span>
                                                    <!--END-->
                                                    </div>
                                                </label>
                                            @endif
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
        
