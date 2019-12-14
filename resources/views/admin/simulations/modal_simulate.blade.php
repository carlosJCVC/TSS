<!--Inicio del modal agregar/actualizar-->
<div class="modal fade" id="modalNuevaSimulacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Datos para Simular</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('admin.simulate.data.store', $item->id) }}" method="get" class="form-horizontal">
                
                <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Numero de corridas</label>
                    <div class="col-md-9">
                        <input type="text" name="number_runs" class="form-control {{ $errors->has('number_runs')? 'is-invalid' : ''}} " placeholder="NUmero de corridas">
                        <div class="invalid-feedback {{ $errors->has('number_runs')? 'd-block' : '' }}">
                            {{ $errors->has('number_runs')? $errors->first('number_runs') : 'El campo de numero de corridas es requerido'  }}
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="email-input">Cantidad a pedir</label>
                    <div class="col-md-9">
                        <input type="text" name="compare_value" class="form-control {{ $errors->has('compare_value')? 'is-invalid' : ''}}" placeholder="Cantidad">
                        <div class="invalid-feedback {{ $errors->has('compare_value')? 'd-block' : '' }}">
                            {{ $errors->has('compare_value')? $errors->first('compare_value') : 'El campo de unidades es requerido'  }}
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success">Empezar a Simular</button>
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