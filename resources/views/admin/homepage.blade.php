@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">
      <div class="fade-in">
        <div class="row">
          
          <div class="col-sm-6 col-lg-3">
            <div class="card text-white" style="background: linear-gradient(45deg,#321fdb 0%,#1f1498 100%); box-shadow: 0 16px 8px 0 rgba(0,0,0,0.2) ;transition: 0.3s;">
              <div class="card-body pb-0">
                <div class="btn-group float-right">
                  <button class="btn btn-transparent text-white dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-user"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                </div>
                <div style="font-size: 1.3125rem; font-weight: 600;">{{ $values['users_count'] }}</div>
                <div>Usuarios</div>
              </div>
              <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart1" height="70"></canvas>
              </div>
            </div>
          </div>
          <!-- /.col-->

          <div class="col-sm-6 col-lg-3">
            <div class="card text-white shadow-lg" style="background: linear-gradient(45deg,#39f 0%,#2982cc 100%);">
              <div class="card-body pb-0">
                <div class="btn-group float-right">
                  <button class="btn btn-transparent text-white dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-settings"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                </div>
                <div style="font-size: 1.3125rem; font-weight: 600;">{{ $values['products'] }}</div>
                <div>Productos</div>
              </div>
              <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart2" height="70"></canvas>
              </div>
            </div>
          </div>
          <!-- /.col-->

          <div class="col-sm-6 col-lg-3">
            <div class="card text-white shadow-lg" style="background: linear-gradient(45deg,#f9b115 0%,#f6960b 100%);">
              <div class="card-body pb-0">
                <div class="btn-group float-right">
                  <button class="btn btn-transparent text-white dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-settings"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                </div>
                <div style="font-size: 1.3125rem; font-weight: 600;">{{ $values['sale_price_max'] }} $us</div>
                <div>Precio de Venta mayor</div>
              </div>
              <div class="c-chart-wrapper mt-3" style="height:70px;">
                <canvas class="chart" id="card-chart3" height="70"></canvas>
              </div>
            </div>
          </div>
          <!-- /.col-->
          
          <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-danger">
              <div class="card-body pb-0">
                <div class="btn-group float-right">
                  <button class="btn btn-transparent text-white dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-money"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                </div>
                <div style="font-size: 1.3125rem; font-weight: 600;">{{ $values['purchase_price_min'] }} $us</div>
                <div>Precio de Compra menor</div>
              </div>
              <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart4" height="70"></canvas>
              </div>
            </div>
          </div>
          <!-- /.col-->
        </div>
        <!-- /.row-->
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-5">
                <h4 class="card-title mb-0">Traffic</h4>
                <div class="small text-muted">September 2019</div>
              </div>
              <!-- /.col-->

            <!-- /.row-->
            <div class="c-chart-wrapper w-100">
              <canvas class="chart" id="main-chart" height="300"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="row text-center">
              <div class="col-sm-12 col-md mb-sm-2 mb-0">
                <div class="text-muted">Visits</div><strong>29.703 Users (40%)</strong>
                <div class="progress progress-xs mt-2">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="col-sm-12 col-md mb-sm-2 mb-0">
                <div class="text-muted">Unique</div><strong>24.093 Users (20%)</strong>
                <div class="progress progress-xs mt-2">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="col-sm-12 col-md mb-sm-2 mb-0">
                <div class="text-muted">Pageviews</div><strong>78.706 Views (60%)</strong>
                <div class="progress progress-xs mt-2">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="col-sm-12 col-md mb-sm-2 mb-0">
                <div class="text-muted">New Users</div><strong>22.123 Users (80%)</strong>
                <div class="progress progress-xs mt-2">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="col-sm-12 col-md mb-sm-2 mb-0">
                <div class="text-muted">Bounce Rate</div><strong>40.15%</strong>
                <div class="progress progress-xs mt-2">
                  <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-->
        
      </div>
    </div>

@endsection

@section('scripts')
    <script>
      /* eslint-disable no-magic-numbers */
      // Disable the on-canvas tooltip
      Chart.defaults.global.pointHitDetectionRadius = 1
      Chart.defaults.global.tooltips.enabled = false
      Chart.defaults.global.tooltips.mode = 'index'
      Chart.defaults.global.tooltips.position = 'nearest'

      // eslint-disable-next-line no-unused-vars
      const cardChart1 = new Chart(document.getElementById('card-chart1'), {
        type: 'line',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [
            {
              label: 'My First dataset',
              backgroundColor: 'transparent',
              borderColor: 'rgba(255,255,255,.55)',
              data: [65, 59, 84, 84, 51, 55, 40]
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              gridLines: {
                color: 'transparent',
                zeroLineColor: 'transparent'
              },
              ticks: {
                fontSize: 2,
                fontColor: 'transparent'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                display: false,
                min: 35,
                max: 89
              }
            }]
          },
          elements: {
            line: {
              borderWidth: 1
            },
            point: {
              radius: 4,
              hitRadius: 10,
              hoverRadius: 4
            }
          }
        }
      })

      // eslint-disable-next-line no-unused-vars
      const cardChart2 = new Chart(document.getElementById('card-chart2'), {
        type: 'line',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [
            {
              label: 'My First dataset',
              backgroundColor: 'transparent',
              borderColor: 'rgba(255,255,255,.55)',
              data: [1, 18, 9, 17, 34, 22, 11]
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              gridLines: {
                color: 'transparent',
                zeroLineColor: 'transparent'
              },
              ticks: {
                fontSize: 2,
                fontColor: 'transparent'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                display: false,
                min: -4,
                max: 39
              }
            }]
          },
          elements: {
            line: {
              tension: 0.00001,
              borderWidth: 1
            },
            point: {
              radius: 4,
              hitRadius: 10,
              hoverRadius: 4
            }
          }
        }
      })

      // eslint-disable-next-line no-unused-vars
      const cardChart3 = new Chart(document.getElementById('card-chart3'), {
        type: 'line',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [
            {
              label: 'My First dataset',
              backgroundColor: 'rgba(255,255,255,.2)',
              borderColor: 'rgba(255,255,255,.55)',
              data: [78, 81, 80, 45, 34, 12, 40]
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              display: false
            }],
            yAxes: [{
              display: false
            }]
          },
          elements: {
            line: {
              borderWidth: 2
            },
            point: {
              radius: 0,
              hitRadius: 10,
              hoverRadius: 4
            }
          }
        }
      })

      // eslint-disable-next-line no-unused-vars
      const cardChart4 = new Chart(document.getElementById('card-chart4'), {
        type: 'bar',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February', 'March', 'April'],
          datasets: [
            {
              label: 'My First dataset',
              backgroundColor: 'rgba(255,255,255,.2)',
              borderColor: 'rgba(255,255,255,.55)',
              data: [78, 81, 80, 45, 34, 12, 40, 85, 65, 23, 12, 98, 34, 84, 67, 82]
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              display: false,
              barPercentage: 0.6
            }],
            yAxes: [{
              display: false
            }]
          }
        }
      })

      const mainChart = new Chart(document.getElementById('main-chart'), {
        type: 'line',
        data: {
          labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S'],
          datasets: [
            {
              label: 'My First dataset',
              backgroundColor: 'rgba(1,1,1,.1)',
              borderColor: '#17a2b8',
              pointHoverBackgroundColor: '#fff',
              borderWidth: 2,
              data: [165, 180, 70, 69, 77, 57, 125, 165, 172, 91, 173, 138, 155, 89, 50, 161, 65, 163, 160, 103, 114, 185, 125, 196, 183, 64, 137, 95, 112, 175]
            },
            {
              label: 'My Second dataset',
              backgroundColor: 'transparent',
              borderColor: '#28a745',
              pointHoverBackgroundColor: '#fff',
              borderWidth: 2,
              data: [92, 97, 80, 100, 86, 97, 83, 98, 87, 98, 93, 83, 87, 98, 96, 84, 91, 97, 88, 86, 94, 86, 95, 91, 98, 91, 92, 80, 83, 82]
            },
            {
              label: 'My Third dataset',
              backgroundColor: 'transparent',
              borderColor: '#dc3545',
              pointHoverBackgroundColor: '#fff',
              borderWidth: 1,
              borderDash: [8, 5],
              data: [65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65]
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              gridLines: {
                drawOnChartArea: false
              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true,
                maxTicksLimit: 5,
                stepSize: Math.ceil(250 / 5),
                max: 250
              }
            }]
          },
          elements: {
            point: {
              radius: 0,
              hitRadius: 10,
              hoverRadius: 4,
              hoverBorderWidth: 3
            }
          }
        }
      })
    </script>
@endsection