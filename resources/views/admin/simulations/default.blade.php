@extends('admin.layouts.app')

@section('content')
@php
//dd($results);
$i = 18;
$max = -1;
$units = -1;
    foreach ($results as $key => $value) {
        if ($key == 'max_'.$i) {
            if ($max<$value) {
                $max = $value;
                $units = $i;
            }
            $i++;
        }
    }
@endphp
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
                            <a class="btn btn-success float-right" href="{{ route('admin.simulation.print') }}">Exportar PDF</a>
                        </div>
                        <div class="card-body">
                            <div id="table-export-pdf" style="position: relative; height: 200px; overflow: auto; display: block">
                                <table class="table table-responsive-sm table-bordered table-striped table-sm" id="table-data-simulate">
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
                                            <td>{{ $item->excess_cost_18 }}</td>
                                            <td>{{ $item->benefits_18 }}</td>
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
                    <span>Los resultados de la simulacion indican que la desicion que maximiza el beneficio es realizar un pedido de </span>
                    {{-- <span>Max {{ $max }}</span> --}}
                    <span><b> Unidades {{ $units }}</b></span>
                </div>
            </div>
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
            <div class="card">
                <div class="card-header">Costos
                    <a class="export-costs-pdf btn btn-success float-right" href="#">Exportar PDF</a>
                    <div class="card-header-actions"></div>
                </div>
                <div class="card-body">
                    <div class="c-chart-wrapper export-costs">
                        <canvas id="canvas-espected-costs"></canvas>
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
            console.log(results);
            var costs = []
            var benefitsLabels = []
            var days = []

            const barChar =  new Chart(document.getElementById('canvas-espected-benefit'), {
                type: 'bar',
                data: {
                    labels : [18, 19, 20, 21, 22, 23, 24, 25, 26],
                    datasets : [
                        {
                            label: "Beneficio maximo",
                            backgroundColor : 'rgba(10, 20, 220, 0.5)',
                            borderColor : 'rgba(220, 220, 220, 0.8)',
                            highlightFill: 'rgba(220, 220, 220, 0.75)',
                            highlightStroke: 'rgba(220, 220, 220, 1)',
                            data : [
                                results.max_18, 
                                results.max_19, 
                                results.max_20, 
                                results.max_21, 
                                results.max_22,
                                results.max_23,
                                results.max_24,
                                results.max_25,
                                results.max_26,
                            ]
                        },
                        {
                            label: "Beneficio medio",
                            backgroundColor : 'rgba(50, 187, 205, 0.5)',
                            borderColor : 'rgba(151, 187, 205, 0.8)',
                            highlightFill : 'rgba(151, 187, 205, 0.75)',
                            highlightStroke : 'rgba(151, 187, 205, 1)',
                            data : [
                                results.min_18, 
                                results.min_19, 
                                results.min_20, 
                                results.min_21, 
                                results.min_22,
                                results.min_23,
                                results.min_24,
                                results.min_25,
                                results.min_26,
                            ]
                        }
                    ]
                },
                options: {
                    responsive: true
                }
            })

            const barCharCost =  new Chart(document.getElementById('canvas-espected-costs'), {
                type: 'bar',
                data: {
                    labels : [18, 19, 20, 21, 22, 23, 24, 25, 26],
                    datasets : [
                        {
                            label: "Costo maximo",
                            backgroundColor : 'rgba(10, 20, 220, 0.5)',
                            borderColor : 'rgba(220, 220, 220, 0.8)',
                            highlightFill: 'rgba(220, 220, 220, 0.75)',
                            highlightStroke: 'rgba(220, 220, 220, 1)',
                            data : [
                                results.costmax_18, 
                                results.costmax_19, 
                                results.costmax_20, 
                                results.costmax_21, 
                                results.costmax_22,
                                results.costmax_23,
                                results.costmax_24,
                                results.costmax_25,
                                results.costmax_26,
                            ]
                        },
                        {
                            label: "Costo medio",
                            backgroundColor : 'rgba(50, 187, 205, 0.5)',
                            borderColor : 'rgba(151, 187, 205, 0.8)',
                            highlightFill : 'rgba(151, 187, 205, 0.75)',
                            highlightStroke : 'rgba(151, 187, 205, 1)',
                            data : [
                                results.costmin_18, 
                                results.costmin_19, 
                                results.costmin_20, 
                                results.costmin_21, 
                                results.costmin_22,
                                results.costmin_23,
                                results.costmin_24,
                                results.costmin_25,
                                results.costmin_26,
                            ]
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
            var reportPageWidth = 15000;
            
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
                pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, 700, canvasHeight);
                pdfctxX += 700 + buffer;
                
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

        $('.export-costs-pdf').click(function () {
            getGraphic('.export-costs', '#canvas-espected-costs')
        })
    </script>
@endsection