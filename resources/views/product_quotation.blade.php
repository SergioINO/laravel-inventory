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
            <img style="  margin: 10px;  float: left; width: 160px;" src="{{ storage_path('app/public/PACFOR.jpg') }} ">
            <div style=" padding: 5px;  margin: 2px; border: 1px solid black; float: left; width: 540px; border-radius: 10px;">
                <h5 ><strong>Comercializadora Forestal SPA<strong></h5><br>
                <font  size="12px";class="text-center">Av. Bernardo O'Higgins 77, Depto.1205, Concepción, Región del Bio Bio, Chile</font><br><br>
                <font  size="12px";class="text-center">+56-412185630    +56-412185631</font><br><br>
                <font  size="12px";class="text-center">Concepción, Chile</font>
            </div><br><br><br><br><br><br><br><br><br><br><br>
    
                    <div style="margin: 10px 0 10px 540px;"> 
                <font  size="12px";>Fecha Emisión:{{ date('d-m-Y') }}</font> 
            </div>
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
                            <!-- <td> ${{ $product->price }} </td> -->
                            <td> {{ number_format( $product->price , 0 , ",", ".") }} </td>
                            <!-- <td> ${{ $product->total_amount }} </td> -->
                            <td> {{ number_format( $product->total_amount, 0 , ",", ".") }} </td>
                        </tr>
                        @endforeach
                    
                </tbody>
            </table>
            
            <div align="right"> 
                <font  size="16px";>Total Productos a Cotizar:${{ number_format( $total_products_amount , 0 , ",", ".") }} </font> <hr> 
            </div>
            
            <font  size="15px";align="left";>&nbsp;&nbsp;Observaciones de calidad</font> <br>

            <!-- @foreach ($productos as $obs)
        <tr><td><font  size="13px">&nbsp;{{ $obs->observations}}</font> <br></td></tr>
        @endforeach -->
        <!-- <tr><td><font  size="13px">&nbsp;${{ $sale->observations }}</font> <br></td></tr>  -->


        <div style=" margin: 10px; border: 1px solid black; float: left; width: 670px; border-radius: 10px;">
        <font  size="13px">&nbsp;{{ $product->observations}}</font> <br>
        <!-- <font  size="13px">&nbsp; {{ $product->name }}</font> <br>
        <font  size="12px">&nbsp;&nbsp;&nbsp; {{ $product->qty }} Piezas de {{ $product->thickness }}*{{ $product->width }}*{{ $product->length }}</font> <br> -->
        <font  size="13px";align="left";>&nbsp;Datos de Transferencia: </font> <br>
        <font  size="12px";align="left";>&nbsp;&nbsp;&nbsp;-Nombre del Banco: Banco de Chile. </font> <br>
        <font  size="12px";align="left";>&nbsp;&nbsp;&nbsp;-Tipo de Cuenta: Cuenta corriente. </font> <br>
        <font  size="12px";align="left";>&nbsp;&nbsp;&nbsp;-Número de cuenta: 225-37638-05 </font> <br>
        <font  size="12px";align="left";>&nbsp;&nbsp;&nbsp;-Titular de la cuenta: Comercializadora Forestal SPA. </font> <br>
        <font  size="12px";align="left";>&nbsp;&nbsp;&nbsp;-Rut: 76.399.165-2 </font> <br>
        <font  size="12px";>&nbsp;&nbsp;&nbsp;-Correo: misael.burgos@pacificforest.cl </font> <br>
        </div>
        
        </main>   
     <footer>
        <img  src="{{ storage_path('app/public/firmamisael.jpg')}} ">
        <p><strong>Misael Burgos Alarcon</strong></p>
        <p><strong>+56977993047</strong></p>
    </footer>
</body>
</html>