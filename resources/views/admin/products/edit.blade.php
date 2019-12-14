<!--Inicio del modal agregar/actualizar-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="edit-product-modal" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="id-product" id="product-id">
                {{ method_field('PUT')}}
                {{ csrf_field() }}
                
                <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" id="edit-name" name="name" class="form-control" placeholder="Nombre">
                        <div class="invalid-feedback {{ $errors->has('name')? 'd-block' : '' }}">
                            {{ $errors->has('name')? $errors->first('name') : 'El campo de Nombre es requerido'  }}
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" id="edit-product-button" class="btn btn-outline-success">Actualizar</button>
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