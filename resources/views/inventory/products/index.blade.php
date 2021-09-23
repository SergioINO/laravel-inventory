@extends('layouts.app', ['page' => 'Lista de productos', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')

    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Buscar producto</h3>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route('searching_product')}}">
                        @csrf
                        <input class="form-control mr-sm-2" name="searching_product"  type="search" placeholder="Buscar Productos" required>
                        {{-- <input  name="id_products"  hidden value="{{ $products->id }}"> --}}
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                    <br>
                
                    {{-- @php
                        dd($products_search_pulg, $products_search_m);
                    @endphp --}}

                    @if (!empty($products_search_pulg) && count($products_search_pulg) > 0 )
                        @if ($products_search_pulg != NULL)
                            <table class="table tablesorter " id="">
                                <thead class=" text-primary">
                                    <th scope="col">Especie</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Espesor</th>
                                    <th scope="col">Ancho</th>
                                    <th scope="col">Largo</th>
                                    <th scope="col">PULG</th>
                                    <th scope="col">PULG TOTAL</th>
                                    <th scope="col">N piezas</th>
                                    <th scope="col">N piezas Defectuosas</th>
                                    <th scope="col">Precio Venta</th>
                                    <th scope="col"></th>
                                </thead>
                                <tbody>
                                    @foreach ($products_search_pulg as $product_search_pulg)
                                            <tr>
                                                <td><a href="{{ route('categories.show', $product_search_pulg->category) }}">{{ $product_search_pulg->category->name }}</a></td>
                                                <td>{{ $product_search_pulg->name }}</td>
                                                <td>{{ $product_search_pulg->thickness }}</td>
                                                <td>{{ $product_search_pulg->width}}</td>
                                                <td>{{ $product_search_pulg->length}}</td>
                                                <td>{{ $product_search_pulg->pulg}}</td>
                                                <td>{{ $product_search_pulg->pulg_total}}</td>
                                                <td>{{ $product_search_pulg->stock }}</td>
                                                <td>{{ $product_search_pulg->stock_defective }}</td>
                                                <td>{{ format_money($product_search_pulg->selling_price) }}</td>
                                                
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h3 class="mb-0">Buscar producto</h3>
                        @endif
                    @endif

                    @if (!empty($products_search_m) && count($products_search_m) > 0 )
                        @if ($products_search_m != NULL)
                            <table class="table tablesorter " id="">
                                <thead class=" text-primary">
                                    <th scope="col">Especie</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Espesor</th>
                                    <th scope="col">Ancho</th>
                                    <th scope="col">Largo</th>
                                    <th scope="col">M2</th>
                                    <th scope="col">M2 TOTAL</th>
                                    <th scope="col">M3</th>
                                    <th scope="col">M3 TOTAL</th>
                                    <th scope="col">N piezas</th>
                                    <th scope="col">N piezas Defectuosas</th>
                                    <th scope="col">Precio Venta</th>
                                    <th scope="col"></th>
                                </thead>
                                <tbody>
                                    @foreach ($products_search_m as $product_search_m)
                                            <tr>
                                                <td><a href="{{ route('categories.show', $product_search_m->category) }}">{{ $product_search_m->category->name }}</a></td>
                                                <td>{{ $product_search_m->name }}</td>
                                                <td>{{ $product_search_m->thickness }}</td>
                                                <td>{{ $product_search_m->width}}</td>
                                                <td>{{ $product_search_m->length}}</td>
                                                <td>{{ $product_search_m->m2}}</td>
                                                <td>{{ $product_search_m->m2_total}}</td>
                                                <td>{{ $product_search_m->m3}}</td>
                                                <td>{{ $product_search_m->m3_total}}</td>
                                                <td>{{ $product_search_m->stock }}</td>
                                                <td>{{ $product_search_m->stock_defective }}</td>
                                                <td>{{ format_money($product_search_m->selling_price) }}</td>
                                                
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h3 class="mb-0">Buscar producto</h3>
                        @endif
                    @endif
                    
                </div>
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Productos Terminados</h4>
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
                                    @if ($product->category_product == 'Producto Terminado')
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end">
                        {{-- {{ $products->links() }} --}}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Madera en Bruto</h4>
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
                                <th scope="col">Volumen Pulg</th>
                                <th scope="col">Volumen Pulg Total</th>
                                <th scope="col">N piezas</th>
                                <th scope="col">Precio Venta</th>
                                <th scope="col">Total vendido</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    @if ($product->category_product == 'Madera en Bruto')
                                        <tr>
                                            <td><a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a></td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->thickness }}</td>
                                            <td>{{ $product->width}}</td>
                                            <td>{{ $product->length}}</td>
                                            <td>{{ $product->pulg}}</td>
                                            <td>{{ $product->pulg_total}}</td>
                                            <td>{{ $product->stock }}</td>
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end">
                        {{-- {{ $products->links() }} --}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
