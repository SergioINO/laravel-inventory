@extends('layouts.app', ['page' => 'Estadísticas del inventario', 'pageSlug' => 'istats', 'section' => 'inventory'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Estadísticas por cantidad (TOP 15)</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Categoría</th>
                            <th>Nombre</th>
                            <th>Stock</th>
                            <th>Ventas anuales</th>
                            <th>Precio medio</th>
                            <th>Ingresos anuales</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($soldproductsbystock as $soldproduct)
                                <tr>
                                    <td><a href="{{ route('products.show', $soldproduct->product) }}">{{ $soldproduct->product_id }}</a></td>
                                    <td><a href="{{ route('categories.show', $soldproduct->product->category) }}">{{ $soldproduct->product->category->name }}</a></td>
                                    <td>{{ $soldproduct->product->name }}</td>
                                    <td>{{ $soldproduct->product->stock }}</td>
                                    <td>{{ $soldproduct->total_qty }}</td>
                                    <td>{{ format_money(round($soldproduct->avg_price, 2)) }}</td>
                                    <td>{{ format_money($soldproduct->incomes) }}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('products.show', $soldproduct->product) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Detalles">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-tasks">
                <div class="card-header">
                    <h4 class="card-title">Estadísticas por ingresos (TOP 15)</h4>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Vendido</th>
                                <th>Ingresos</th>
                            </thead>
                            <tbody>
                                @foreach ($soldproductsbyincomes as $soldproduct)
                                    <tr>
                                        <td>{{ $soldproduct->product_id }}</td>
                                        <td><a href="{{ route('categories.show', $soldproduct->product->category) }}">{{ $soldproduct->product->category->name }}</a></td>
                                        <td><a href="{{ route('products.show', $soldproduct->product) }}">{{ $soldproduct->product->name }}</a></td>
                                        <td>{{ $soldproduct->total_qty }}</td>
                                        <td>{{ format_money($soldproduct->incomes) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-tasks">
                <div class="card-header">
                    <h4 class="card-title">Estadísticas por precio medio (TOP 15)</h4>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Vendido</th>
                                <th>Precio medio</th>
                            </thead>
                            <tbody>
                                @foreach ($soldproductsbyavgprice as $soldproduct)
                                    <tr>
                                        <td>{{ $soldproduct->product_id }}</td>
                                        <td><a href="{{ route('categories.show', $soldproduct->product->category) }}">{{ $soldproduct->product->category->name }}</a></td>
                                        <td><a href="{{ route('products.show', $soldproduct->product) }}">{{ $soldproduct->product->name }}</a></td>
                                        <td>{{ $soldproduct->total_qty }}</td>
                                        <td>{{ format_money(round($soldproduct->avg_price, 2)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection