@extends('layouts.app', ['page' => 'Ingresos', 'pageSlug' => 'incomes', 'section' => 'transactions'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Ingresos</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('transactions.create', ['type' => 'income']) }}" class="btn btn-sm btn-primary">Registrar Ingreso</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Fecha</th>
                                <th scope="col">Título</th>
                                <th scope="col">Método</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Referencia</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td> {{ date('d-m-y', strtotime($transaction->created_at)) }}</td>
                                        <td> {{ $transaction->title }}</td>
                                        <td><a href="{{ route('methods.show', $transaction->method) }}">{{ $transaction->method->name }}</a></td>
                                        <td>{{ format_money($transaction->amount) }}</td>
                                        <td>{{ $transaction->reference }}</td>
                                        <td></td>
                                        <td class="td-actions text-right">
                                            @if ($transaction->sale_id)
                                                <a href="{{ route('sales.show', $transaction->sale_id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Mas detalles">
                                                    <i class="tim-icons icon-zoom-split"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                                    <i class="tim-icons icon-pencil"></i>
                                                </a>
                                                <form action="{{ route('transactions.destroy', $transaction) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="confirm('¿Estás seguro de que quieres borrar esta entrada? No quedará ningún registro.') ? this.parentElement.submit() : ''">
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
@endsection
