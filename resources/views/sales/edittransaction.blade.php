@extends('layouts.app', ['page' => 'Editar ingresos', 'pageSlug' => 'sales', 'section' => 'transactions'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Editar transacción</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-primary">Volver a la venta</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('sales.transaction.update', ['sale' => $sale, 'transaction' => $transaction]) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                            <input type="hidden" name="client_id" value="{{ $sale->client_id }}">
                            <input type="hidden" name="user_id" value="{{ $sale->user_id }}">

                            <h6 class="heading-small text-muted mb-4">Información de la transacción</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-method">Tipo de transacción</label>
                                    <select name="type" id="input-method" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                        @foreach (['income' => 'Payment Received', 'expense' => 'Returned Paid'] as $type => $title)
                                            @if($type == old('type') or $type == $transaction->type)
                                                <option value="{{$type}}" selected>{{ $title }}</option>
                                            @else
                                                <option value="{{$type}}">{{ $title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'payment_method_id'])
                                </div>
                                <div class="form-group{{ $errors->has('payment_method_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-method">Método de pago</label>
                                    <select name="payment_method_id" id="input-method" class="form-select form-control-alternative{{ $errors->has('payment_method_id') ? ' is-invalid' : '' }}" required>
                                        @foreach ($payment_methods as $payment_method)
                                            @if($payment_method['id'] == old('payment_method_id') or $payment_method['id'] == $transaction->payment_method_id)
                                                <option value="{{$payment_method['id']}}" selected>{{$payment_method['name']}}</option>
                                            @else
                                                <option value="{{$payment_method['id']}}">{{$payment_method['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'payment_method_id'])
                                </div>

                                <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount">Cantidad</label>
                                    <input type="number" step=".01" name="amount" id="input-amount" class="form-control form-control-alternative" placeholder="Amount" value="{{ old('amount', abs($transaction->amount) ) }}" min="0" required>
                                    @include('alerts.feedback', ['field' => 'amount'])

                                </div>

                                <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-reference">Referencia</label>
                                    <input type="text" name="reference" id="input-reference" class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="Reference" value="{{ old('reference', $transaction->reference) }}">
                                    @include('alerts.feedback', ['field' => 'reference'])
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
@endpush('js')