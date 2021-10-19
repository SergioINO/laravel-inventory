<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cotizacion Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @page {
            margin: 0cm 0cm;
            font-size: 1em}
        body {
            margin: 5cm 2cm 2cm;}
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 5cm;
            background-color: #ffffff;
            text-align: center;
            line-height: 10px;}
         footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 5cm;
            background-color: #ffffff;
            text-align: center;
            line-height: 10px;}
    </style>
</head>
<body>
    <header>
            <img style="  margin: 45px;  float: left; width: 100px;" src="{{ storage_path('app/public/PACFOR.jpg') }} ">
            <div style=" padding: 5px;  margin: 2px; border: 1px solid black; float: left; width: 540px; border-radius: 10px;">
                <h5 ><strong>Comercializadora Forestal SPA<strong></h5><br>
                <font  size="12px";class="text-center">Av. Bernardo O'Higgins 77, Depto.1205, Concepción, Región del Bio Bio, Chile</font><br><br>
                <font  size="12px";class="text-center">+56-412185630    +56-412185631</font><br><br>
                <font  size="12px";class="text-center">Concepción, Chile</font>
            </div>
            <!-- <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha {{ $sale->created_at}}</p>  -->
        </header> 
                <div style="border: 1px solid black; border-radius: 10px;float: center; width: 680px;">
                    <p style="display: inline; ">&nbsp;&nbsp;Señores: {{ $cliente->name }} </p>  <br>                     
                    <p style="display: inline;" >&nbsp;&nbsp;Rut: {{ $cliente->document_id }} </p><br>
                    <p style="display: inline;">&nbsp;&nbsp;Dirección: {{ $cliente->address }} </p><br>
                    <p style="display: inline;">&nbsp;&nbsp;Telefono : {{ $cliente->phone }} </p> 
                    <p style="display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;Email : {{ $cliente->email }} </p> 
                 </div><br>
                 <main><br><br><br><br>
          
                     <!-- <div>
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
                        </div> -->
            <font  size="16px";align="left";>Producto a Cotizar </font>
            <table class="table users table-hover table-bordered">
                <thead>
                    <tr> 
                        <th scope="col">Producto</th>
                        <th scope="col">Espesor</th>
                        <th scope="col">Ancho</th>
                        <th scope="col">Largo</th>
                        <th scope="col">U.medida</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th> 
                    </tr>
                </thead>
                <tbody>
                        @foreach ($productos as $product)
                        <tr>
                            <td> {{ $product->name }} </td>
                            <td> {{ $product->thickness }} </td>
                            <td> {{ $product->width }} </td>
                            <td> {{ $product->length }} </td>
                            <td> {{ $product->type_measure }} </td>
                            <td> {{ $product->qty }} </td>
                            <td> ${{ $product->price }} </td>
                            <td> ${{ $product->total_amount }} </td>
                            </tr>
                        @endforeach
                    
                </tbody>
            </table>
            <font  size="16px";>&nbsp;Total Productos a Cotizar:${{ $total_products_amount }} </font> <hr>
            
            <!-- <table class="table table-striped text-center">
                <thead>
                    <tr style="page-break-after: always;">
                        <th scope="col">Total</th>
                        <td> ${{ $total_products_amount }} </td>
                    </tr>
                </thead>
            </table> -->
            <font  size="15px";align="left";>&nbsp;&nbsp;Observaciones de calidad</font> <br>


        <div style=" margin: 10px; border: 1px solid black; float: left; width: 670px; border-radius: 10px;">
        
        <font  size="13px">&nbsp; {{ $product->name }}</font> <br>
        <font  size="12px">&nbsp;&nbsp;&nbsp; {{ $product->qty }} Piezas de {{ $product->thickness }}*{{ $product->width }}*{{ $product->length }}</font> <br>


  

       









        <font  size="13px";align="left";>&nbsp;Datos de Transferencia: </font> <br>
        <font  size="12px";align="left";>&nbsp;&nbsp;&nbsp;-Nombre del Banco: Banco de Chile. </font> <br>
        <font  size="12px";align="left";>&nbsp;&nbsp;&nbsp;-Tipo de Cuenta: Cuenta corriente. </font> <br>
        <font  size="12px";align="left";>&nbsp;&nbsp;&nbsp;-Número de cuenta: 225-37638-05 </font> <br>
        <font  size="12px";align="left";>&nbsp;&nbsp;&nbsp;-Titular de la cuenta: Comercializadora Forestal SPA. </font> <br>
        <font  size="12px";align="left";>&nbsp;&nbsp;&nbsp;-Rut: 76.399.165-2 </font> <br>
        <font  size="12px";>&nbsp;&nbsp;&nbsp;-Correo: misael.burgos@pacificforest.cl </font> <br>
            <!-- <p style="display: inline; "> &nbsp;&nbsp;Nombre del Banco: Banco de Chile.</p> <br>
            <p style="display: inline; "> &nbsp;&nbsp;Tipo de Cuenta: Cuenta corriente.</p> <br>
            <p style="display: inline; "> &nbsp;&nbsp;Número de cuenta: 225-37638-05</p> <br>
            <p style="display: inline; "> &nbsp;&nbsp;Titular de la cuenta: Comercializadora Forestal SPA.</p> <br>
            <p style="display: inline; "> &nbsp;&nbsp;Rut: 76.399.165-2</p> <br>
            <p style="display: inline; "> &nbsp;&nbsp;Correo: misael.burgos@pacificforest.cl</p> -->  
        </div>
        </main>   

   <!--  <footer>
        <p><strong>Fecha {{ $sale->created_at}}</strong></p>
        <p><strong>Pacific Forest - Comercializadora Forestal</strong></p>
    </footer>
     -->

     <footer>
        <img  src="{{ storage_path('app/public/firmamisael.jpg')}} ">
        <p><strong>Misael Burgos Alarcon</strong></p>
        <p><strong>+56977993047</strong></p>
    </footer>
</body>
</html>