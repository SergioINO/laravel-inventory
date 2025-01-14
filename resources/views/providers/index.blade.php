@extends('layouts.app', ['page' => 'Lista de Proveedores', 'pageSlug' => 'providers', 'section' => 'providers'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Proveedores</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('providers.create') }}" class="btn btn-sm btn-primary">Nuevo proveedor</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Email</th>
                                <th scope="col">País</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Pagos realizados</th>
                                <th scope="col">Pago total</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($providers as $provider)
                                    <tr>
                                        <td>{{ $provider->name }}</td>
                                        <td>{{ $provider->description }}</td>

                                        <td>
                                            <a href="mailto:{{ $provider->email }}">{{ $provider->email }}</a>
                                        </td>
                                        <td>{{ $provider->country }}</td>
                                        <td>{{ $provider->phone }}</td>
                                        <td>{{ $provider->transactions->count() }}</td>
                                        <td>{{ format_money(abs($provider->transactions->sum('amount'))) }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('providers.show', $provider) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Detalles">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('providers.edit', $provider) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('providers.destroy', $provider) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="confirm('¿Está seguro de que quiere eliminar a este proveedor? Los registros de los pagos realizados a él no se eliminarán.') ? this.parentElement.submit() : ''">
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
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $providers->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
