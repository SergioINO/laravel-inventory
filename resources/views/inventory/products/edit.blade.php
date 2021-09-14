@extends('layouts.app', ['page' => 'Editar Producto', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Editar Producto</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Atrás</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('products.update', $product) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">Información del producto</h6>

                            
                            <div class="pl-lg-4">

                                <div class="row">
                                    <div class="col">
                                        <label class="form-control-label" for="input-category_product">Categoria</label>
                                        <select name="category_product" id="input-category_product" class="form-control form-control-alternative{{ $errors->has('type_measure') ? ' is-invalid' : '' }}" required>
                                            @foreach (['Producto Terminado', 'Madera en Bruto'] as $category_product)
                                                @if($category_product == old('category_product'))
                                                    <option value="{{$category_product}}" selected>{{$category_product}}</option>
                                                @else
                                                    <option value="{{$category_product}}">{{$category_product}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nombre') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $product->name) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="form-group{{ $errors->has('product_category_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Categoría</label>
                                    <select name="product_category_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                        @foreach ($categories as $category)
                                            @if($category['id'] == old('document') or $category['id'] == $product->product_category_id)
                                                <option value="{{$category['id']}}" selected>{{$category['name']}}</option>
                                            @else
                                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'product_category_id'])
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group{{ $errors->has('thickness') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-thickness">{{ __('Espesor') }}</label>
                                            <input type="text" name="thickness" id="input-thickness" class="form-control form-control-alternative{{ $errors->has('thickness') ? ' is-invalid' : '' }}" placeholder="{{ __('Thickness') }}" value="{{ old('thickness', $product->thickness) }}" required autofocus>
                                            @include('alerts.feedback', ['field' => 'thickness'])
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group{{ $errors->has('width') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-width">{{ __('Ancho') }}</label>
                                            <input type="text" name="width" id="input-width" class="form-control form-control-alternative{{ $errors->has('width') ? ' is-invalid' : '' }}" placeholder="{{ __('Width') }}" value="{{ old('width', $product->width) }}" required autofocus>
                                            @include('alerts.feedback', ['field' => 'width'])
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group{{ $errors->has('length') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-length">{{ __('Largo') }}</label>
                                            <input type="text" name="length" id="input-length" class="form-control form-control-alternative{{ $errors->has('length') ? ' is-invalid' : '' }}" placeholder="{{ __('Length') }}" value="{{ old('length', $product->length) }}" required autofocus>
                                            @include('alerts.feedback', ['field' => 'length'])
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label class="form-control-label" for="input-type_measure">{{ __('Tipo') }}</label>
                                        <select name="type_measure" id="input-type_measure" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                            @foreach (['M2','M3', 'PULG','PIEZA'] as $type_measure)
                                                @if($type_measure == old('type_measure') or $type_measure == $product->type_measure)
                                                    <option value="{{$type_measure}}" selected>{{$type_measure}}</option>
                                                @else
                                                    <option value="{{$type_measure}}">{{$type_measure}}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>

                                </div> 
                                
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-stock">{{ __('N piezas') }}</label>
                                            <input type="number" name="stock" id="input-stock" class="form-control form-control-alternative{{ $errors->has('stock') ? ' is-invalid' : '' }}" placeholder="{{ __('N piezas') }}" value="{{ old('stock', $product->stock) }}" required autofocus>
                                            @include('alerts.feedback', ['field' => 'stock'])
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group{{ $errors->has('stock_defective') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-stock_defective">{{ __('N piezas defectuosas') }}</label>
                                            <input type="number" name="stock_defective" id="input-stock_defective" class="form-control form-control-alternative{{ $errors->has('stock_defective') ? ' is-invalid' : '' }}" placeholder="{{ __('N piezas defectuosas') }}" value="{{ old('stock_defective', $product->stock_defective) }}" required autofocus>
                                            @include('alerts.feedback', ['field' => 'stock_defective'])
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group{{ $errors->has('purchase_price') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-purchase_price">{{ __('Precio Compra') }}</label>
                                            <input type="number" name="purchase_price" id="input-purchase_price" class="form-control form-control-alternative{{ $errors->has('purchase_price') ? ' is-invalid' : '' }}" placeholder="{{ __('Precio Compra') }}" value="{{ old('purchase_price', $product->purchase_price) }}" required autofocus>
                                            @include('alerts.feedback', ['field' => 'purchase_price'])
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group{{ $errors->has('selling_price') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-selling_price">{{ __('Precio Venta') }}</label>
                                            <input type="number" name="selling_price" id="input-selling_price" class="form-control form-control-alternative{{ $errors->has('selling_price') ? ' is-invalid' : '' }}" placeholder="{{ __('Precio Venta') }}" value="{{ old('selling_price', $product->selling_price) }}" required autofocus>
                                            @include('alerts.feedback', ['field' => 'selling_price'])
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Descripcion') }}</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Descripcion') }}" value="{{ old('description', $product->description) }}" >
                                    @include('alerts.feedback', ['field' => 'description'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
    </script>
@endpush