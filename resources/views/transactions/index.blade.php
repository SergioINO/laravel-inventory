@extends('layouts.app', ['page' => 'Transacciones', 'pageSlug' => 'transactions', 'section' => 'transactions'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Transacciones</h4>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#transactionModal">
                                Nueva Transacción
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Título</th>
                                <th>Método</th>
                                <th>Cantidad</th>
                                <th>Referencia</th>
                                <th>Cliente</th>
                                <th>Proveedor</th>
                                <th>Transferencia</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ date('d-m-y', strtotime($transaction->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('transactions.type', ['type' => $transaction->type]) }}">{{ $transactionname[$transaction->type] }}</a>
                                        </td>
                                        <td style="max-width:150px">{{ $transaction->title }}</td>
                                        <td><a href="{{ route('methods.show', $transaction->method) }}">{{ $transaction->method->name }}</a></td>
                                        <td>{{ format_money($transaction->amount) }}</td>
                                        <td>{{ $transaction->reference }}</td>
                                        <td>
                                            @if ($transaction->client)
                                                <a href="{{ route('clients.show', $transaction->client) }}">{{ $transaction->client->name }}<br>{{ $transaction->client->document_type }}-{{ $transaction->client->document_id }}</a>
                                            @else
                                                No aplica
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->provider)
                                                <a href="{{ route('providers.show', $transaction->provider) }}">{{ $transaction->provider->name }}</a>
                                            @else
                                                No aplica
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->transfer)
                                                <a href="{{ route('transfer.show', $transaction->transfer) }}">ID {{ $transaction->transfer->id }}</a>
                                            @else
                                                No aplica
                                            @endif
                                        </td>
                                        <td class="td-actions text-right">
                                            @if ($transaction->sale_id)
                                                <a href="{{ route('sales.show', $transaction->sale) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Detalles">
                                                    <i class="tim-icons icon-zoom-split"></i>
                                                </a>
                                            @elseif ($transaction->transfer_id)
                                                <a href="{{ route('transfer.show', $transaction->transfer) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Mas detalles">
                                                    <i class="tim-icons icon-zoom-split"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                                    <i class="tim-icons icon-pencil"></i>
                                                </a>
                                                <form action="{{ route('transactions.destroy', $transaction) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="confirm('¿Está seguro de que quiere eliminar esta transacción?') ? this.parentElement.submit() : ''">
                                                        <i class="tim-icons icon-simple-remove"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $transactions->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva transacción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('transactions.create', ['type' => 'payment']) }}" class="btn btn-sm btn-primary">Pago</a>
                        <a href="{{ route('transactions.create', ['type' => 'income']) }}" class="btn btn-sm btn-primary">Ingreso</a>
                        <a href="{{ route('transactions.create', ['type' => 'expense']) }}" class="btn btn-sm btn-primary">Gasto</a>
                        <a href="{{ route('sales.create') }}" class="btn btn-sm btn-primary">Venta</a>
                        <a href="{{ route('transfer.create') }}" class="btn btn-sm btn-primary">Transferencia</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
