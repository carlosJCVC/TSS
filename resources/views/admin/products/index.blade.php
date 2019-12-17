@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Productos
                        <a class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </a>
                    </div>
                    <div class="card-body">
                        <div style="position: relative; height: 450px; overflow: auto; display: block">
                            <table id="datatable-products" class="table table-responsive-sm table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre de Producto</th>
                                        <th>Fecha Creada</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a class="btn btn-outline-primary" onclick="openEditModal({{ $item->id }})"><i class="icon-pencil"></i></a>
                                            <a href="{{ route('admin.products.simulate.index', $item->id) }}" class="btn btn-outline-primary">DEMANDAS</i></a>
                                            <form action="{{ route('admin.products.destroy', $item->id) }}"
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

                        @if (count($errors) > 0)
                            <script>
                                $( document ).ready(function() {
                                    $('#modalNuevo').modal('show');
                                });
                            </script>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
    </div>
</div>

@include('admin.products.create')
@include('admin.products.edit')

@endsection

@section('scripts')
    <script>

        const openEditModal = (id) => {
            var url = '{!! route("admin.products.show", ":id") !!}'
            url = url.replace(':id', id)
            $.ajax({
              url: url,
            }).done(function(data) {
                setDataModal(data)
            });
        }

        const setDataModal = (product) => {
            $('#product-id').val(product.id)
            $('#edit-name').val(product.name)

            $('#modalEdit').modal('show')
        }

        $('#edit-product-button').on('click', function() {
            var url = '{!! route("admin.products.update", ":id") !!}'
            url = url.replace(':id', $('#product-id').val())
            
            $('#edit-product-modal').attr('action', url).submit();
        })

    </script>
@endsection