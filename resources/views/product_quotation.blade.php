<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cotizacion Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @page {
            margin: 0cm 0cm;
            font-size: 1em;
        }
        body {
            margin: 5cm 2cm 2cm;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 5cm;
            background-color: #ffffff;
            text-align: center;
            line-height: 10px;
        }
        
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #ffffff;
            text-align: center;
            line-height: 25px;
        }

    </style>
</head>
<body>
    <header>
        <div >
            <img style=" text-align: left; display: inline-flex; margin:15px 12px" src="{{ storage_path('app/public/PACFOR.jpg') }} "> 
            <h3 style="display: inline;"><strong>Comercializadora Forestal SPA<strong></h3>
        
            <p class="text-center">Av. Bernardo O'Higgins 77, Depto.1205., Concepción, Región del Bio Bio, CHILE</p>
            <p class="text-center">+56-412185630    +56-412185631</p>
            <p class="text-center">CONCEPCIÓN, CHILE </p>
        </div>

        <br>
        
    </header>
    <main>
        <br>
        <div>
            <h5 style="text-align: center"><strong>Cliente Cotización </strong></h5>
            
            <p style=" text-align: left; display: inline-flex;">Señor/Señora : {{ $cliente->name }} </p>
            <p style="display: inline;" >RUT : {{ $cliente->document_id }} </p>
            <p class="text-left">Dirección : {{ $cliente->address }} </p>
            <p class="text-left">Telefono : {{ $cliente->phone }} </p>
            <p class="text-left">Email : {{ $cliente->email }} </p>
            {{-- <table class="table table-striped text-center">
                <thead>
                    <tr style="page-break-after: always;">
                        <th scope="col">Rut</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                        
                        <tr>
                            <td> {{ $cliente->document_id }} </td>
                            <td> {{ $cliente->name }} </td>
                            <td> {{ $cliente->address }} </td>
                            <td> {{ $cliente->phone }} </td>
                            <td> {{ $cliente->email }} </td>
                        </tr>
                        
                    
                </tbody>
            </table> --}}
        </div>
        <br><br>

            <h5 style="text-align: center"><strong>Producto a Cotizar </strong></h5>
            <table class="table table-striped text-center">
                <thead>
                    <tr style="page-break-after: always;">
                        <th scope="col">Producto</th>
                        <th scope="col">Espesor</th>
                        <th scope="col">Ancho</th>
                        <th scope="col">Largo</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total c/p + IVA</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($productos as $product)
                        <tr>
                            <td> {{ $product->name }} </td>
                            <td> {{ $product->thickness }} </td>
                            <td> {{ $product->width }} </td>
                            <td> {{ $product->length }} </td>
                            <td> {{ $product->qty }} </td>
                            <td> ${{ $product->price }} </td>
                            <td> ${{ $product->total_amount }} </td>
                            
                        </tr>
                        @endforeach
                    
                </tbody>
            </table>

            <h5 style="text-align: center"><strong>Total Productos a Cotizar </strong></h5>
            <table class="table table-striped text-center">
                <thead>
                    <tr style="page-break-after: always;">
                        
                        <th scope="col">Total + IVA</th>
                    </tr>
                </thead>
                <tbody>
                        
                        <tr>
                            <td> ${{ $total_products_amount }} </td>
                        </tr>
                    
                </tbody>
            </table>
        <br><br><br><br><br><br><br><br>
        <br><br><br>

        <h5>DATOS DE TRANSFERENCIA:</h3>     

        <p> Nombre del Banco: Banco de Chile.</p> 
        <p> Número de cuenta: 225-37638-05</p> 
        <p> Titular de la cuenta: Comercializadora Forestal SPA.</p> 
        <p> Rut: 76.399.165-2</p> 
        <p> Correo: misael.burgos@pacificforest.cl</p> 

        <img style=" text-align: left; display: inline-flex; margin:15px 12px" src="{{ storage_path('app/public/firmamisael.jpg') }} "> 
            <h5 style=" text-align: left; "><strong>Misael Burgos Alarcon<strong></h3>
            <h5 style=" text-align: left; "><strong>+56977993047<strong></h3>

    </main>
    <footer>
        <p><strong>Fecha {{ $sale->created_at}}</strong></p>
        <p><strong>Pacific Forest - Comercializadora Forestal</strong></p>
    </footer>
</body>
</html>