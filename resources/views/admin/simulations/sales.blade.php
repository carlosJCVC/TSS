<div class="card">
    <div class="card-header">
        <i class="fa fa-align-justify"></i> Precio de Ventas
        <a class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevaVenta">
            <i class="icon-plus"></i>&nbsp;Nuevo
        </a>
    </div>
    <div class="card-body">
        <div style="position: relative; height: 220px; overflow: auto; display: block">
            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Precio de Venta</th>
                        <th>Nro. de dias</th>
                        <th>Probabilidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $item)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $item->sales_price }}</td>
                            <td>{{ $item->number_days }}</td>
                            <td>{{ $item->probability }}</td>
                            <td>
                                <form action="{{ route('admin.sales_price.destroy', $item->id) }}"
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
</div>