@extends('layouts.app', ['page' => 'Editar Producto', 'pageSlug' => 'sales', 'section' => 'transactions'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Editar Producto</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-primary">Atrás</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('sales.product.update', ['sale' => $sale, 'soldproduct' => $soldproduct]) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <div class="pl-lg-4">
                                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-product">Producto</label>
                                    <select name="product_id" id="input-product" class="form-select form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" required>
                                        @foreach ($products as $product)
                                            @if($product->type_measure == 'M2' || $product->type_measure == 'M3')  
                                            
                                                @if($product['id'] == old('product_id'))
                                                    <option value="{{$product['id']}}" selected>[{{ $product->category->name }}] {{ $product->name }} |
                                                                        Precio Venta: ${{ $product->selling_price }} | M2: {{ $product->m2 }} |
                                                                        M2 TOTAL: {{ $product->m2_total }} | M3: {{ $product->m3 }} |
                                                                        M3 TOTAL: {{ $product->m3_total }} | Stock: {{ $product->stock }}</option>
                                                @else
                                                    <option value="{{$product['id']}}">[{{ $product->category->name }}] {{ $product->name }} |
                                                                        Precio Venta: ${{ $product->selling_price }} | M2: {{ $product->m2 }} |
                                                                        M2 TOTAL: {{ $product->m2_total }} | M3: {{ $product->m3 }} |
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

                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>

                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-price">Precio por unidad</label>
                                    <input type="number" name="price" id="input-price" step=".01" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="{{ old('price', $soldproduct->price) }}" required>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>

                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-qty">Cantidad</label>
                                    <input type="number" name="qty" id="input-qty" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="{{ old('qty', $soldproduct->qty) }}" required>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>

                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-total">Cantidad Total</label>
                                    <input type="text" name="total_amount" id="input-total" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="{{ old('total_amount', $soldproduct->total_amount) }}" disabled>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>

                                <div class="form-group{{ $errors->has('observations') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-observations">Observaciones</label>
                                    {{-- <input type="text" name="observations" id="input-observations" class="form-control form-control-alternative" placeholder="Observations" value="{{ old('observations') }}"> --}}
                                    <textarea  id="input-observations" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" name="observations" rows="10" cols="40" value="{{ old('observations', $soldproduct->observations) }}">{{ old('observations', $soldproduct->observations) }}</textarea>
                                    @include('alerts.feedback', ['field' => 'observations'])
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