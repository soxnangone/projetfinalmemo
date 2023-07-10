@section('head')
    <!-- bootstrap-daterangepicker -->
    <link href="{{ url('assets/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endsection
@extends('layouts.master')
@section('foot')
    <!-- Chart.js -->
    <script src="{{ url('assets/gentelella/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- jQuery Sparklines -->
    <script src="{{ url('assets/gentelella/vendors/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- Flot -->
    <script src="{{ url('assets/gentelella/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ url('assets/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ url('assets/gentelella/vendors/DateJS/build/date.js') }}"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="{{ url('assets/gentelella/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

@endsection

@section('content')
    <div class="">
        <div class="row top_tiles">
            <h2>MARIAGES</h2>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-pencil-square-o"></i></div>
                    <br/>  <br/>
                    <div class="count">{{$count}}</div>
                    <h3>Totals Declarations</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-check"></i></div>
                    <br/>  <br/>
                    <div class="count">{{$count2}}</div>
                    <h3> VALIDE</h3>

                </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-spinner"></i></div>
                    <br/>   <br/>
                    <div class="count">{{$count3}}</div>
                    <h3>En cours</h3>
           <span></span>
                </div>
            </div>
        </div>
<br/><br/><br/>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> Statistiques</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                    <div class="x_content">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div id="mon-chart" style="..." ></div>
                        </div>
                        @if(Auth::user()->poste=="OFFICIER")
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="mon-chart1" style="..." ></div>
                                </div>
                        @endif
                        @if(Auth::user()->poste=="ADMIN")
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="mon-chart2" style="..." ></div>
                                </div>
                        @endif
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>






    </div>
    <script src="{{ url('/js/gstatic.js') }}"></script>
    <script src="{{ url('/js/diagram.js') }}"></script>


    <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
        
            var options = {//
                title: 'Proportion des Mariages par Type',// Le titre
                is3D : true // En 3D
            };
            // On crée le chart en indiquant l'élément où le placer "#mon-chart"
            var chart = new google.visualization.PieChart(document.getElementById('mon-chart'));

            // On désine le chart avec les données et les options
            chart.draw(data, options);

        }
    </script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

    var data = google.visualization.arrayToDataTable([
    ['username', 'mariages'],
    @foreach ($mariageByUser as $mariagebyuser) // On parcourt les catégories
    [ "{{ $mariagebyuser->username }}", {{  $mariagebyuser->total}} ], // Proportion des produits de la catégorie
    @endforeach
    ]);

    var options = {//
        title: 'Proportion des Declarations par utilisateurs',// Le titre
    is3D : true // En 3D
    };

    // On crée le chart en indiquant l'élément où le placer "#mon-chart"
    var chart = new google.visualization.PieChart(document.getElementById('mon-chart1'));

    // On désine le chart avec les données et les options
    chart.draw(data, options);
    }
</script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Statut', 'utilisateur'],
                @foreach ($userActive as $user) // On parcourt les catégories
                [ "{{ $user->Statut }}", {{  $user->total}} ], // Proportion des produits de la catégorie
                @endforeach
            ]);

            var options = {//
                title: 'Proportion des Statut des utilisateurs',// Le titre
                is3D : true // En 3D
            };

            // On crée le chart en indiquant l'élément où le placer "#mon-chart"
            var chart = new google.visualization.PieChart(document.getElementById('mon-chart2'));

            // On désine le chart avec les données et les options
            chart.draw(data, options);
        }
    </script>
@endsection
