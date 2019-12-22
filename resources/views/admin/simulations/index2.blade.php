@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div>
            <a href="{{ route('admin.simulate.data', $product->id) }}" class="btn btn-success mb-2">Empezar Simulacion</a>
            <a href="#" class="export-pdf btn btn-info mb-2">Descargar Graficos</a>
        </div>
        <div class="canvas-graphics">
            <div class="row">
                <div class="col-lg-6">
                    @include('admin.simulations.demands')
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Demandas <a href="#" class="export-demands btn btn-info pull-right">Descargar PDF</a>
                            <div class="card-header-actions"></div>
                        </div>
                        <div class="card-body chart-demand">
                            <div class="c-chart-wrapper">
                                <canvas id="canvas-1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    @include('admin.simulations.sales')
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Precios de venta <a href="#" class="export-sales btn btn-info pull-right">Descargar PDF</a>
                            <div class="card-header-actions"></div>
                        </div>
                        <div class="card-body chart-sale">
                            <div class="c-chart-wrapper">
                                <canvas id="canvas-sales"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    @include('admin.simulations.purchases')
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Precios de compra  <a href="#" class="export-purchases btn btn-info pull-right">Descargar PDF</a>
                            <div class="card-header-actions"></div>
                        </div>
                        <div class="card-body chart-purchase">
                            <div class="c-chart-wrapper">
                                <canvas id="canvas-purchases"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.demands.create', [ 'item' => $product ])
@include('admin.sales_price.create', [ 'item' => $product ])
@include('admin.purchases_price.create', [ 'item' => $product ])

@if ($errors->has('sold_units') > 0)
    <script>
        $( document ).ready(function() {
            $('#modalNuevaDemanda').modal('show');
        });
    </script>
@endif

@if ($errors->has('sales_price') > 0)
    <script>
        $( document ).ready(function() {
            $('#modalNuevaDemanda').modal('show');
        });
    </script>
@endif

@if ($errors->has('purchases_price') > 0)
    <script>
        $( document ).ready(function() {
            $('#modalNuevoPurchase').modal('show');
        });
    </script>
@endif

@endsection

@section('scripts')
    <script>
        var backgroundColors = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ]
        var borderColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ]
        var chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        };

        const loadDemands = () => {
            var demands = @json($demands);
            var product = @json($product);
            
            var values = []
            var days = []

            demands.forEach((element, index) => {
                if (index < 10) {
                    values.push(element.sold_units)
                    days.push(element.number_days)
                }
            });
            //const random = () => Math.round(Math.random() * 100)
            const lineChart = new Chart(document.getElementById('canvas-1'), {
                type: 'line',
                data: {
                    labels : days,
                    datasets : [
                        {
                            label: `${ product.name } - Nro dias vs Demands`,
                            backgroundColor : [
                                chartColors.red,
                                chartColors.blue,
                                chartColors.yellow
                            ],
                            borderColor : borderColors,
                            pointBackgroundColor : 'rgba(151, 187, 205, 1)',
                            pointBorderColor : '#000',
                            data : values
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Unidades vendidas'
                            }
                        }],
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Nro dias'
                            }
                        }]
                    } 
                }
            })
        }

        const loadSalesPrice = () => {
            var sales = @json($sales);
            var product = @json($product);
            
            var values = []
            var days = []

            sales.forEach((element, index) => {
                if (index < 10) {
                    values.push(element.sales_price)
                    days.push(element.number_days)
                }
            });
            //const random = () => Math.round(Math.random() * 100)
            const lineChart = new Chart(document.getElementById('canvas-sales'), {
                type: 'line',
                data: {
                    labels : days,
                    datasets : [
                    {
                        label: `${ product.name } - Nro dias vs Precio de venta`,
                        backgroundColor : 'rgba(151, 187, 205, 0.2)',
                        borderColor : 'rgba(151, 187, 205, 1)',
                        pointBackgroundColor : 'rgba(151, 187, 205, 1)',
                        pointBorderColor : '#fff',
                        data : values
                    }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Precio de venta'
                            }
                        }],
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Nro dias'
                            }
                        }]
                    }
                }
            })
        }

        const loadPurchasesPrice = () => {
            var purchases = @json($purchases);
            var product = @json($product);
            
            var values = []
            var days = []

            purchases.forEach((element, index) => {
                if (index < 10) {
                    values.push(element.purchases_price)
                    days.push(element.number_days)
                }
            });
            //const random = () => Math.round(Math.random() * 100)
            const lineChart = new Chart(document.getElementById('canvas-purchases'), {
                type: 'line',
                data: {
                    labels : days,
                    datasets : [
                    {
                        label: `${ product.name } + Precio de Compra`,
                        backgroundColor : backgroundColors,
                        borderColor : borderColors,
                        pointBackgroundColor : 'rgba(151, 187, 205, 1)',
                        pointBorderColor : '#fff',
                        data : values
                    }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Precio compra'
                            }
                        }],
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Nro dias'
                            }
                        }]
                    }
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
            pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);

            // download the pdf
            pdf.save('graficos.pdf');
        }

        loadDemands()
        loadSalesPrice()
        loadPurchasesPrice()

        $(".export-pdf").click(function() {
            // get size of report page
            var reportPageHeight = $('.canvas-graphics').innerHeight();
            var reportPageWidth = $('.canvas-graphics').innerWidth();
            
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
            $("canvas").each(function(index) {
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
            var pdf = new jsPDF('r', 'pt', [reportPageWidth, reportPageHeight]);
            pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
            
            // download the pdf
            pdf.save('graficos.pdf');
      });

      $('.export-demands').click(function () {
          getGraphic('.chart-demand', '#canvas-1')
      })

      $('.export-purchases').click(function () {
          getGraphic('.chart-purchase', '#canvas-purchases')
      })

      $('.export-sales').click(function () {
          getGraphic('.chart-sale', '#canvas-sales')
      })
    </script>
@endsection