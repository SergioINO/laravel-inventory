@extends('layouts.app', ['page' => 'Editar Cliente', 'pageSlug' => 'clients', 'section' => 'clients'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Administración Cliente') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('clients.index') }}" class="btn btn-sm btn-primary">{{ __('Atrás') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- FORMULARIO EDITAR CLIENTE --}}
                        <form method="post" action="{{ route('clients.update', $client) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Información Cliente') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nombre') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $client->name) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <label class="form-control-label" for="input-document_type">{{ __('Tipo') }}</label>
                                        <select name="document_type" id="input-document_type" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" >
                                            @foreach (['V', 'E', 'P'] as $document_type)
                                                @if($document_type == old('document') or $document_type == $client->document_type)
                                                    <option value="{{$document_type}}" selected>{{$document_type}}</option>
                                                @else
                                                    <option value="{{$document_type}}">{{$document_type}}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="form-control-label" for="input-document_id">{{ __('Rut') }}</label>
                                        <input type="text" name="document_id" id="input-document_id" class="form-control form-control-alternative{{ $errors->has('document_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Document Number') }}" value="{{ old('document_id', $client->document_id) }}" >
                                        @include('alerts.feedback', ['field' => 'document_id'])

                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('giro') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-giro">{{ __('Giro') }}</label>
                                    <input type="text" name="giro" id="input-giro" class="form-control form-control-alternative{{ $errors->has('giro') ? ' is-invalid' : '' }}" placeholder="{{ __('Giro') }}" value="{{ old('giro', $client->giro) }}" >
                                    @include('alerts.feedback', ['field' => 'giro'])
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $client->email) }}" >
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">{{ __('Teléfono') }}</label>
                                    <input type="text" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone') }}" value="{{ old('phone', $client->phone) }}" >
                                    @include('alerts.feedback', ['field' => 'phone'])
                                </div>

                                <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-address">{{ __('Dirección') }}</label>
                                    <input type="text" name="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Address') }}" value="{{ old('address', $client->address) }}">
                                    @include('alerts.feedback', ['field' => 'address'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Guardar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
