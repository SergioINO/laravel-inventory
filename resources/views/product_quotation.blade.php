<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabla de Cotizaciones</title>
</head>
    <body>
        <div class="container">
            <h1>Probando Informacion de los Clientes</h1>
        </div>
        <div class="card-body">
            <div class="">
                <table style='page-break-after:always; border-collapse:unset;' class="table">
                    <thead>
                        <th>Cliente</th>
                        <th>Rut</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($cliente as $client)
                            <tr>
                                <td><{{ $client->name }}</td>
                                <td><{{ $client->document_id }}</td>
                                <td><{{ $client->address }}</td>
                                <td><{{ $client->phone }}</td>
                                <td><{{ $client->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>