<!--Inicio del modal agregar/actualizar-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar demanda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="edit-demand-modal" method="post" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="id-demand" id="demand-id">
                {{ method_field('PUT')}}
                {{ csrf_field() }}
                
                <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Unidades Vendidas</label>
                    <div class="col-md-9">
                        <input type="text" id="edit-sold-units" name="sold_units" class="form-control" placeholder="Unidades Vendidas">
                        <span class="help-block">(*) Ingrese unidades vendidas</span>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="email-input">Nro. dias</label>
                    <div class="col-md-9">
                        <input type="text" id="edit-number-days" name="number_days" class="form-control" placeholder="Nro de dias">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" id="edit-demand-button" class="btn btn-outline-success">Guardar</button>
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