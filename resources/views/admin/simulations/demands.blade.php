<div class="card">
    <div class="card-header">
        <i class="fa fa-align-justify"></i> Demandas
        <a class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevaDemanda">
            <i class="icon-plus"></i>&nbsp;Nuevo
        </a>
    </div>
    <div class="card-body">
        <table id="datatable-demands" class="table table-responsive-sm table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Unidades Vendidas</th>
                <th>Nro. de dias</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($demands as $item)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $item->sold_units }}</td>
                    <td>{{ $item->number_days }}</td>
                    <td>
                        <form action="{{ route('admin.demands.destroy', $item->id) }}"
                                style="display:inline-block;"
                                method="POST">

                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="button" class="btn btn-outline-danger"
                                    onclick="delete_action(event);">
                                    Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
            Vacio
            @endforelse
        </tbody>
        </table>
    </div>
</div>