@extends('layouts.app', ['page' => 'Agregar producto', 'pageSlug' => 'sales', 'section' => 'transactions'])

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
                        <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route('searching')}}">
                            @csrf
                            <input class="form-control mr-sm-2" name="searching"  type="search" placeholder="Buscar Productos" required>
                            <input  name="id_sale"  hidden value="{{ $sale->id }}">
                            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
                        </form>
                        <br>
                    
                        @php
                            // dd(count($products_search));
                        @endphp

                        @if (!empty($products_search) && count($products_search) > 0 )
                            @if ($products_search != NULL)
                            <table class="table tablesorter " id="">
                                <thead class=" text-primary">
                                    <th scope="col">Especie</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Espesor</th>
                                    <th scope="col">Ancho</th>
                                    <th scope="col">Largo</th>
                                    <th scope="col">M2</th>
                                    <th scope="col">M3</th>
                                    <th scope="col">PULG</th>
                                    <th scope="col">N piezas</th>
                                    <th scope="col">N piezas Defectuosas</th>
                                    <th scope="col">Precio Venta</th>
                                    <th scope="col"></th>
                                </thead>
                                <tbody>
                                    @foreach ($products_search as $product_search)
                                            <tr>
                                                <td><a href="{{ route('categories.show', $product_search->category) }}">{{ $product_search->category->name }}</a></td>
                                                <td>{{ $product_search->name }}</td>
                                                <td>{{ $product_search->thickness }}</td>
                                                <td>{{ $product_search->width}}</td>
                                                <td>{{ $product_search->length}}</td>
                                                <td>{{ $product_search->m2}}</td>
                                                <td>{{ $product_search->m3}}</td>
                                                <td>{{ $product_search->pulg}}</td>
                                                <td>{{ $product_search->stock }}</td>
                                                <td>{{ $product_search->stock_defective }}</td>
                                                <td>{{ format_money($product_search->selling_price) }}</td>
                                                
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
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Agregar producto</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('sales.show', [$sale->id]) }}" class="btn btn-sm btn-primary">Atrás</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('sales.product.store', $sale) }}" autocomplete="off">
                            @csrf

                            <div class="pl-lg-4">
                                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-product">Producto</label>
                                    <select name="product_id" id="input-product" class="form-select form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" required>
                                        @foreach ($products as $product)
                                                    
                                            @if($product['id'] == old('product_id'))
                                                
                                                
                                                <option value="{{$product['id']}}" selected>[{{ $product->category->name }}] {{ $product->name }} |
                                                                    Precio Venta: ${{ $product->selling_price }} | M2: {{ $product->m2 }} |
                                                                    Stock: {{ $product->stock }}</option>
                                            @else
                                                <option value="{{$product['id']}}">[{{ $product->category->name }}] {{ $product->name }} |
                                                                    Precio Venta: ${{ $product->selling_price }} | M2: {{ $product->m2 }} |
                                                                    Stock: {{ $product->stock }}</option>
                                                
                                            @endif
                                            
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>

                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-price">Precio</label>
                                    <input type="number" name="price" id="input-price" step=".01" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="0" required>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>

                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-qty">Cantidad</label>
                                    <input type="number" name="qty" id="input-qty" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="0" required>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>

                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-total">Cantidad Total</label>
                                    <input type="text" name="total_amount" id="input-total" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="0$" disabled>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Continuar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        });
    </script>
    <script>
        let input_qty = document.getElementById('input-qty');
        let input_price = document.getElementById('input-price');
        let input_total = document.getElementById('input-total');
        input_qty.addEventListener('input', updateTotal);
        input_price.addEventListener('input', updateTotal);
        function updateTotal () {
            input_total.value = (parseInt(input_qty.value) * parseFloat(input_price.value))+"$";
        }
    </script>
@endpush