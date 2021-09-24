<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TABLA DE PRODUCTOS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @page {
            margin: 0cm 0cm;
            font-size: 1em;
        }
        body {
            margin: 3cm 2cm 2cm;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #46C66B;
            color: white;
            text-align: center;
            line-height: 30px;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #46C66B;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>
<body>
    <header>
        <br>
        <p><strong>Pacific Forest</strong></p>
    </header>
    <main>
        <div class="container">
            <h5 style="text-align: center"><strong>Probando Cliente Cotizacion </strong></h5>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        
                        <th scope="col">Nombre</th>
                        <th scope="col">Rut</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <tr>
                            <td><{{ $cliente->name }}</td>
                            <td><{{ $cliente->document_id }}</td>
                            <td><{{ $cliente->address }}</td>
                            <td><{{ $cliente->phone }}</td>
                            <td><{{ $cliente->email }}</td>
                        </tr>
                    
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p><strong>Pacific Forest - Comercializadora Forestal</strong></p>
    </footer>
</body>
</html>