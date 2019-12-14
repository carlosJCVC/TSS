@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="card">
            <div class="card-body text-center">
                <div class="btn btn-primary mb-2" onclick="openModalSimulate({{$product}})">Simular</div>
            </div>
        </div>
        @if (count($data) > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i> Datos de la simulacion</div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Demanda</th>
                                <th>Precio Venta</th>
                                <th>Precio Compra</th>
                                <th>Coste Compra</th>
                                <th>Coste Exceso</th>
                                <th>Coste Beneficios</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->demand }}</td>
                                    <td>{{ $item->sale_price }}</td>
                                    <td>{{ $item->purchase_price }}</td>
                                    <td>{{ $item->purchase_cost }}</td>
                                    <td>{{ $item->excess_cost }}</td>
                                    <td>{{ $item->benefits }}</td>
                                    </tr>
                                @empty
                                Vacio
                                @endforelse
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Costo en exceso
                            <div class="card-header-actions"></div>
                        </div>
                        <div class="card-body">
                            <div class="c-chart-wrapper">
                                <canvas id="canvas-cost"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Beneficios
                            <div class="card-header-actions"></div>
                        </div>
                        <div class="card-body">
                            <div class="c-chart-wrapper">
                                <canvas id="canvas-benefits"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@include('admin.simulations.modal_simulate', [ 'item' => $product])

@endsection

@section('scripts')
    <script>
        const openModalSimulate = (product) => {
            $('#modalNuevaSimulacion').modal('show')
        }

        const getDatasets = () => {

        }

        const loadgraphicData = () => {
            var data = @json($data);
            var product = @json($product);

            //console.log(data)

            var costs = []
            var benefitsLabels = []
            var days = []

            data.forEach((element, index) => {
                //var i = index+18
                //const { benefits_+i } = element
                console.log(element)
                if (benefitsLabels.includes(element.benefits)) {
                    benefitsLabels.push(element.benefits)
                }
                //costs.push(element.benefits)
                //benefits.push(`${element.benefits}`)
                //days.push(element.number_days)  
            });


            const lineChart = new Chart(document.getElementById('canvas-cost'), {
                type: 'line',
                data: {
                    labels : [10,20],
                    datasets : [
                        {
                            label: `${ product.name } - Cost`,
                            backgroundColor : 'rgba(151, 187, 205, .5)',
                            borderColor : 'rgba(151, 187, 205, 1)',
                            pointBackgroundColor : 'rgba(151, 187, 205, 1)',
                            pointBorderColor : '#000',
                            data : [10, 5,2,7, 8]
                        },
                    {
                        label: `${ product.name } - Cost`,
                        backgroundColor : 'rgba(151, 187, 205, .5)',
                        borderColor : 'rgba(151, 187, 205, 1)',
                        pointBackgroundColor : 'rgba(151, 187, 205, 1)',
                        pointBorderColor : '#000',
                        data : [15, 20,25,20]
                    }
                    ]
                },
                options: {
                    responsive: true
                }
            })

            const lineChart2 = new Chart(document.getElementById('canvas-benefits'), {
                type: 'line',
                data: {
                    labels : [18, 19, 20, 21, 22, 23, 24, 25, 26],
                    datasets : [
                    {
                        label: `${ product.name } - Cost`,
                        backgroundColor : 'rgba(151, 187, 205, .5)',
                        borderColor : 'rgba(151, 187, 205, 1)',
                        pointBackgroundColor : 'rgba(151, 187, 205, 1)',
                        pointBorderColor : '#000',
                        data : [10,20,30]
                    }
                    ]
                },
                options: {
                    responsive: true
                }
            })
        }

        loadgraphicData()
    </script>
@endsection