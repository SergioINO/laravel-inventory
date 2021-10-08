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
        
            <img style=" padding: 10px; margin: 50px;  float: left; width: 150px;" src="{{ storage_path('app/public/PACFOR.jpg') }} ">

            <div style=" padding: 20px; margin: 5px; border: 2px solid black; float: left; width: 300px; border-radius: 10px;">
                <h6 style="display: inline;"><strong>Comercializadora Forestal SPA<strong></h6><br><br>
                 <p class="text-center">Av. Bernardo O'Higgins 77, Depto.1205</p>
                 <P class="text-center">Concepción, Región del Bio Bio, CHILE</P>  
                 <p class="text-center">+56-412185630    +56-412185631</p>
            </div>
        </header>
    <div style="  border: 2px solid black; border-radius: 10px;float: center; width: 600px;">
                    <p style="display: inline; ">Señor/Señora : {{ $cliente->name }} </p><br>
                    <p style="display: inline;" >RUT : {{ $cliente->document_id }} </p><br>
                    <p style="display: inline;">Dirección : {{ $cliente->address }} </p><br>
                    <p style="display: inline;">Telefono : {{ $cliente->phone }} </p><br>
                    <p style="display: inline;">Email : {{ $cliente->email }} </p>
              
                 </div>

                 <br><br><br>
                 
                 
                 
                 <main>
                 <br><br><br>
                     <div>
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
                            /*******************Tabla de Datos personales******** */
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
                        <td> ${{ $total_products_amount }} </td>
                    </tr>
                </thead>
                
            </table>
     
    
        <div style=" margin: 10px; border: 1px solid black; float: left; width: 500px; border-radius: 10px;">
        
            <p style="center; ">DATOS DE TRANSFERENCIA:</p>     

            <p style="display: inline; "> Nombre del Banco: Banco de Chile.</p> <br>
            <p style="display: inline; "> Número de cuenta: 225-37638-05</p> <br>
            <p style="display: inline; "> Titular de la cuenta: Comercializadora Forestal SPA.</p> <br>
            <p style="display: inline; "> Rut: 76.399.165-2</p> <br>
            <p style="display: inline; "> Correo: misael.burgos@pacificforest.cl</p>
        
        </div>
        <br><br><br>
        <br><br><br>
        <br><br>

        <div  style="  text-align: center;" >
        
        <img  src="{{ storage_path('app/public/firmamisael.jpg') }} ">
    
        </div>   






            <p style=" text-align: center; ">Misael Burgos Alarcon</p>  
            <p style=" text-align: center; ">+56977993047</p>




    </main>
    <footer>
        <p><strong>Fecha {{ $sale->created_at}}</strong></p>
        <p><strong>Pacific Forest - Comercializadora Forestal</strong></p>
    </footer>
</body>
</html>