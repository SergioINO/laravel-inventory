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
                    
                        {{-- @php
                            // dd($products_search_pulg, $products_search_m);
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
                                            @if($product->type_measure == 'M2' )  
                                            
                                                @if($product['id'] == old('product_id'))
                                                    <option value="{{$product['id']}}" selected>[{{ $product->category->name }}] {{ $product->name }} |
                                                                        Precio Venta: ${{ $product->selling_price }} | M2: {{ $product->m2 }} |
                                                                        M2 TOTAL: {{ $product->m2_total }} | Stock: {{ $product->stock }}</option>
                                                                        
                                                @else
                                                    <option value="{{$product['id']}}">[{{ $product->category->name }}] {{ $product->name }} |
                                                                        Precio Venta: ${{ $product->selling_price }} | M2: {{ $product->m2 }} |
                                                                        M2 TOTAL: {{ $product->m2_total }} | Stock: {{ $product->stock }}</option>
                                                    
                                                @endif

                                            @endif

                                            @if($product->type_measure == 'M3' )  
                                            
                                                @if($product['id'] == old('product_id'))
                                                    <option value="{{$product['id']}}" selected>[{{ $product->category->name }}] {{ $product->name }} |
                                                                        Precio Venta: ${{ $product->selling_price }} | M3: {{ $product->m3 }} |
                                                                        M3 TOTAL: {{ $product->m3_total }} | Stock: {{ $product->stock }}</option>
                                                                        
                                                @else
                                                    <option value="{{$product['id']}}">[{{ $product->category->name }}] {{ $product->name }} |
                                                                        Precio Venta: ${{ $product->selling_price }}  | M3: {{ $product->m3 }} |
                                                                        M3 TOTAL: {{ $product->m3_total }} | Stock: {{ $product->stock }}</option>
                                                    
                                                @endif

                                            @endif

                                            @if($product->type_measure == 'PULG')  
                                            
                                                @if($product['id'] == old('product_id'))
                                                    <option value="{{$product['id']}}" selected>[{{ $product->category->name }}] {{ $product->name }} |
                                                                        Precio Venta: ${{ $product->selling_price }} | PULG: {{ $product->pulg }} |
                                                                        PULG TOTAL: {{ $product->pulg_total }} |  Stock: {{ $product->stock }}</option>
                                                @else
                                                    <option value="{{$product['id']}}">[{{ $product->category->name }}] {{ $product->name }} |
                                                                        Precio Venta: ${{ $product->selling_price }} | PULG: {{ $product->pulg }} |
                                                                        PULG TOTAL: {{ $product->pulg_total }} |  Stock: {{ $product->stock }}</option>
                                                    
                                                @endif

                                            @endif

                                            @if($product->type_measure == 'PIEZA')  
                                            
                                                @if($product['id'] == old('product_id'))
                                                    <option value="{{$product['id']}}" selected>[{{ $product->category->name }}] {{ $product->name }} | Espesor: {{ $product->thickness }}(mm) |
                                                                        Precio Venta: ${{ $product->selling_price }} |  Stock: {{ $product->stock }}</option>
                                                @else
                                                    <option value="{{$product['id']}}">[{{ $product->category->name }}] {{ $product->name }} | Espesor: {{ $product->thickness }}(mm) |
                                                                        Precio Venta: ${{ $product->selling_price }} |  Stock: {{ $product->stock }}</option>
                                                    
                                                @endif

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
                                    <input type="number" step="0.001" name="qty" id="input-qty" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="0" required>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>

                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-total">Precio Total + IVA</label>
                                    <input  placeholder= "0" readonly= "readonly" type="number" step="0.001" name="total_amount" id="input-total" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="0$" >
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

            let total;
            let IVA;

            total = (parseFloat(input_qty.value) * parseFloat(input_price.value));
            
            IVA = total * 0.19;
            
            input_total.value = total + IVA ;

            // input_total.value = (parseFloat(input_total.valueiva) + parseFloat(input_total.value)) + "$";
        }
    </script>
@endpush