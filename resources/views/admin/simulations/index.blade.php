@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="card">
            <div class="card-body text-center">
                <div class="btn btn-primary mb-2" onclick="openModalSimulate({{$product}})">Simular</div>
                <div class="btn btn-primary mb-2" onclick="openModalSimulateTheBest({{$product}})">Mejor Opcion</div>
            </div>
        </div>
        @if (count($data) > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Datos de la simulacion
                            <a class="btn btn-outline-success float-right" href="{{ route('admin.simulation.print') }}">Exportar PDF</a>
                        </div>
                        <div class="card-body">
                            <div style="position: relative; height: 200px; overflow: auto; display: block">
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
                </div>
                <!-- /.col-->
            </div>
            <div class="card">
                <div class="card-body">
                    <span>Los resultados de la simulacion indican que la desición de realizar un pedido de </span>
                    {{-- <span>Max {{ $max }}</span> --}}
                    <span><b> Unidades {{ $results['num'] }}</b> tiene un beneficio maximo de {{ $results['max'] }} con una media de {{ $results['min'] }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Beneficio Esperado
                            <a class="export-pdf btn btn-success float-right" href="#">Exportar PDF</a>
                            <div class="card-header-actions"></div>
                        </div>
                        <div class="card-body">
                            <div class="c-chart-wrapper export-benefits">
                                <canvas id="canvas-espected-benefit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Beneficios
                            <a class="export-pdf-line btn btn-success float-right" href="#">Exportar PDF</a>
                            <div class="card-header-actions"></div>
                        </div>
                        <div class="card-body">
                            <div class="c-chart-wrapper export-benefits-line">
                                <canvas id="canvas-benefits-line"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@include('admin.simulations.modal_simulate', [ 'item' => $product])
@include('admin.simulations.moda_default_simulate', [ 'item' => $product])

@endsection

@section('scripts')
    <script>
        const openModalSimulate = (product) => {
            $('#modalNuevaSimulacion').modal('show')
        }

        const openModalSimulateTheBest = (product) => {
            $('#modalNuevaSimulacionDefecto').modal('show')
        }

        const getDatasets = () => {

        }

        const loadgraphicData = () => {
            var data = @json($data);
            var product = @json($product);
            var results = @json($results);

            var costs = []
            var benefitsLabels = []
            var days = []

            const lineChart2 = new Chart(document.getElementById('canvas-benefits-line'), {
                type: 'line',
                data: {
                    labels : [results.min, results.max],
                    datasets : [
                    {
                        label: `${ product.name } - Cost`,
                        backgroundColor : 'rgba(151, 187, 205, .5)',
                        borderColor : 'rgba(151, 187, 205, 1)',
                        pointBackgroundColor : 'rgba(151, 187, 205, 1)',
                        pointBorderColor : '#000',
                        data : [18, 24, 28, 32, 36]
                    }
                    ]
                },
                options: {
                    responsive: true
                }
            })

            const barChar =  new Chart(document.getElementById('canvas-espected-benefit'), {
                type: 'bar',
                data: {
                    labels : [results.num],
                    datasets : [
                        {
                            label: "Beneficio maximo",
                            backgroundColor : 'rgba(10, 20, 220, 0.5)',
                            borderColor : 'rgba(220, 220, 220, 0.8)',
                            highlightFill: 'rgba(220, 220, 220, 0.75)',
                            highlightStroke: 'rgba(220, 220, 220, 1)',
                            data : [results.max]
                        },
                        {
                            label: "Beneficio medio",
                            backgroundColor : 'rgba(50, 187, 205, 0.5)',
                            borderColor : 'rgba(151, 187, 205, 0.8)',
                            highlightFill : 'rgba(151, 187, 205, 0.75)',
                            highlightStroke : 'rgba(151, 187, 205, 1)',
                            data : [results.min]
                        }
                    ]
                },
                options: {
                    responsive: true
                }
            })
        }

        const getGraphic = (className, graphic) => {
            // get size of report page
            var reportPageHeight = $(className).innerHeight();
            var reportPageWidth = $(className).innerWidth();
            
            // create a new canvas object that we will populate with all other canvas objects
            var pdfCanvas = $('<canvas />').attr({
                id: "canvaspdf",
                width: reportPageWidth,
                height: reportPageHeight
            });

            // keep track canvas position
            var pdfctx = $(pdfCanvas)[0].getContext('2d');
            var pdfctxX = 0;
            var pdfctxY = 0;
            var buffer = 100;
            
            // for each chart.js chart
            $(graphic).each(function(index) {
                // get the chart height/width
                var canvasHeight = $(this).innerHeight();
                var canvasWidth = $(this).innerWidth();

                // draw the chart into the new canvas
                pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
                pdfctxX += canvasWidth + buffer;
                
                // our report page is in a grid pattern so replicate that in the new canvas
                if (index % 2 === 1) {
                    pdfctxX = 0;
                    pdfctxY += canvasHeight + buffer;
                }
            });
            
            // create new pdf and add our new canvas as an image
            var pdf = new jsPDF();
            pdf.addImage($(pdfCanvas)[0], 'JPEG', 0, 0);
            //pdf.addImage(pdfCanvas.toDataURL("image/jpeg",1), 'JPEG', 10, 10, 190, 277);

            // download the pdf
            pdf.save('graficos.pdf');
        }

        loadgraphicData()

        $('.export-pdf').click(function () {
            getGraphic('.export-benefits', '#canvas-espected-benefit')
        })
        
        $('.export-pdf-line').click(function () {
            getGraphic('.export-benefits-line', '#canvas-benefits-line')
        })
    </script>
@endsection