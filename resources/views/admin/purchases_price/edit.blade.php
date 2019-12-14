<!--Inicio del modal agregar/actualizar-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Precio de Compra</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="edit-purchase-modal" method="post" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="id-purchase" id="purchase-id">
                {{ method_field('PUT')}}
                {{ csrf_field() }}
                
                <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Precio de Compra</label>
                    <div class="col-md-9">
                        <input type="text" id="edit-purchase-price" name="purchases_price" class="form-control"  value="">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="email-input">Nro. dias</label>
                    <div class="col-md-9">
                        <input type="text" id="edit-number-days" name="number_days" class="form-control" placeholder="Nro de dias">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" id="edit-purchase-button" class="btn btn-outline-success">Guardar</button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Fin del modal-->