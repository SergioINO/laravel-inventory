@extends('layouts.app', ['page' => 'Lista de productos', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Productos</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Nuevo producto</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Especie</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Espesor</th>
                                <th scope="col">Ancho</th>
                                <th scope="col">Largo</th>
                                <th scope="col">M2</th>
                                <th scope="col">M3</th>
                                <th scope="col">N piezas</th>
                                <th scope="col">N piezas Defectuosas</th>
                                <th scope="col">Precio Venta</th>
                                <th scope="col">Total vendido</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td><a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->thickness }}</td>
                                        <td>{{ $product->width}}</td>
                                        <td>{{ $product->length}}</td>
                                        <td>{{ $product->m2}}</td>
                                        <td>{{ $product->m3}}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->stock_defective }}</td>
                                        <td>{{ format_money($product->selling_price) }}</td>
                                        <td>{{ $product->solds->sum('qty') }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('products.show', $product) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Detalles">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar ">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="confirm('¿Está seguro de que quiere eliminar este producto? Los registros que lo contienen seguirán existiendo.') ? this.parentElement.submit() : ''">
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
                    <nav class="d-flex justify-content-end">
                        {{ $products->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
