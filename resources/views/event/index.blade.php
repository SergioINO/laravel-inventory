@extends('layouts.app', ['page' => 'Evento Calendario', 'pageSlug' => 'event', 'section' => 'event'])
@section('content')
    <div class="container">
        <div id= "calendar">

        </div>
    </div>

        <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#event">
        Launch demo modal
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Despacho Programado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">

                    <div class="form-group">
                        <label for="id">Cliente</label>
                        <input type="text" class="form-control" name="client" id="client" aria-describedby="" placeholder="Nombre Cliente">
                        
                    </div>

                    <div class="form-group">
                        <label for="detail_product">Detalle del Producto</label>
                        <input type="text" class="form-control" name="detail_product" id="detail_product" aria-describedby="" placeholder="Detalle del Producto">
                        
                    </div>

                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" name="address" id="address" aria-describedby="" placeholder="Dirección">
                        
                    </div>

                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="number" class="form-control" name="phone" id="phone" aria-describedby="" placeholder="Teléfono">
                        
                    </div>

            

                </form>

            </div>
            <div class="modal-footer">

            <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
            <button type="button" class="btn btn-warning" id="btnModificar">Modificar</button>
            <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            

            </div>
        </div>
        </div>
    </div>

@endsection