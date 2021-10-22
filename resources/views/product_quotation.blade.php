<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cotizacion Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .table td, .table th {
        font-size: 9px;
        margin: auto;
        }

        p {
        font-size: 13px;
        }

        @page {
            margin: 0cm 0cm;
            font-size: 1em
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
            height: 5cm;
            background-color: #ffffff;
            text-align: center;
        }

    </style>
</head>

<body>

    <header>
            <img style=" margin: 0px 0 5px 40px;  float: left; width: 200px;" src="{{ storage_path('app/public/PACFOR.png') }} ">
            <div style=" padding: 5px;  margin: 5px; border: 1px solid black; float: left; width: 480px; border-radius: 15px;">
                <h5 ><strong>Comercializadora Forestal SPA<strong></h5><br>
                <font  size="12px";class="text-center">Av. Bernardo O'Higgins 77, Depto.1205, Concepción, Región del Bio Bio, Chile</font><br><br>
                <font  size="12px";class="text-center">+56-412185630    +56-412185631</font><br><br>
                <font  size="12px";class="text-center">Concepción, Chile</font>
            </div><br><br><br><br><br><br><br><br><br><br><br><br>
            
                <div style=" float: left; margin: 2em 0 10px 10px;"> 
                    <font  size="15px";> <strong> COTIZACIÓN: PF-{{ $sale->id }} </strong> </font> 
                </div>
    
                <div style="float: right; margin: 2em 80px 10px 400px;"> 
                    <font  size="15px";> <strong> FECHA EMISIÓN: {{ date('d-m-Y') }} </strong> </font> 
                </div>

            
    </header> 

        <div style="margin:auto; border: 0.5px solid rgb(53, 53, 53); border-radius: 15px;float: center; width: 660px;">
            <p style="display: inline; ">&nbsp;&nbsp;Señores: {{ $cliente->name }} </p>  <br>                     
            <p style="display: inline;" >&nbsp;&nbsp;Rut: {{ $cliente->document_id }} </p><br>
            <p style="display: inline;">&nbsp;&nbsp;Dirección: {{ $cliente->address }} </p><br>
            <p style="display: inline;">&nbsp;&nbsp;Telefono : {{ $cliente->phone }} </p> 
            <p style="display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;Email : {{ $cliente->email }} </p> 
        </div><br>

    <main><br><br><br><br>
            
            <font  size="15px";align="left";>Producto a Cotizar: </font>
            <table class="table users table-hover table-bordered">
                <thead>
                    <tr> 
                        <th scope="col">PRODUCTO</th>
                        <th scope="col">ESPESOR</th>
                        <th scope="col">ANCHO</th>
                        <th scope="col">LARGO</th>
                        <th scope="col">U.MEDIDA</th>
                        <th scope="col">CANTIDAD</th>
                        <th scope="col">PRECIO</th>
                        <th scope="col">TOTAL</th> 
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
                            <td> ${{ number_format( $product->price , 0 , ",", ".") }} </td>
                            <td> ${{ number_format( $product->total_amount, 0 , ",", ".") }} </td>
                            </tr>
                        @endforeach
                    
                </tbody>
            </table>
            
            <div align="right"> 
                <font  size="16px";>Total Productos a Cotizar:${{ number_format( $total_products_amount , 0 , ",", ".") }} </font> <hr>
            </div>
            
            <font  size="15px";align="left";>&nbsp;&nbsp;Observaciones de calidad</font> <br>


        <div style=" margin: 1em auto; border: 0.5px solid rgb(53, 53, 53); float: left; width: 660px; border-radius: 15px;">
            @foreach ($productos as $product)
            <font  size="13px">&nbsp; {{ $product->observations }}</font> <br>
            @endforeach    
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
            {{-- <hr style="margin:10px ;width: 25%"> --}}
            <p><strong>Misael Burgos Alarcon</strong></p>
            <p style="margin-bottom: 10px"><strong>+56977993047</strong></p> <hr>
        
    </footer>
</body>
</html>
