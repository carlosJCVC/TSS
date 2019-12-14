<!--Inicio del modal agregar/actualizar-->
<div class="modal fade" id="modalNuevaDemanda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar demanda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('admin.demands.store', $item->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                
                <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Unidades Vendidas</label>
                    <div class="col-md-9">
                        <input type="text" id="sold_units" name="sold_units" class="form-control {{ $errors->has('sold_units')? 'is-invalid' : ''}} " placeholder="Unidades Vendidas">
                        <div class="invalid-feedback {{ $errors->has('sold_units')? 'd-block' : '' }}">
                            {{ $errors->has('sold_units')? $errors->first('sold_units') : 'El campo de unidades es requerido'  }}
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="email-input">Nro. dias</label>
                    <div class="col-md-9">
                        <input type="text" id="number_days" name="number_days" class="form-control {{ $errors->has('number_days')? 'is-invalid' : ''}}" placeholder="Nro de dias">
                        <div class="invalid-feedback {{ $errors->has('number_days')? 'd-block' : '' }}">
                            {{ $errors->has('number_days')? $errors->first('number_days') : 'El campo de unidades es requerido'  }}
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success">Guardar</button>
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