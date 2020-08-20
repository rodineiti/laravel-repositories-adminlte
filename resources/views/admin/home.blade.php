@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('title', 'Admin - Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-md-9">
            <h1>Dashboard</h1>
        </div>
        <div class="col-md-3">
            <form action="{{route('admin.home')}}" method="get">
                <select id="lastDays" name="lastDays" class="form-control">
                    <option value="30" {{isset($lastDays) && $lastDays === "30" ? "selected" : ""}}>Últimos 30 dias</option>
                    <option value="60" {{isset($lastDays) && $lastDays === "60" ? "selected" : ""}}>Últimos 60 dias</option>
                    <option value="90" {{isset($lastDays) && $lastDays === "90" ? "selected" : ""}}>Últimos 90 dias</option>
                </select>
            </form>
        </div>
    </div>
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Visitantes</span>
                        <span class="info-box-number">{{$countVisits}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Usuários Online</span>
                        <span class="info-box-number">{{$countOnline}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Páginas</span>
                        <span class="info-box-number">{{$countPages}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Usuários</span>
                        <span class="info-box-number">{{$countUsers}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Páginas mais visitadas</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="pagePie" style="height: 180px; width: 703px;" height="180" width="703"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Páginas mais visitadas</strong>
                                </p>

                                <div class="progress-group">
                                    <span class="progress-text">Add Products to Cart</span>
                                    <span class="progress-number"><b>160</b></span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Complete Purchase</span>
                                    <span class="progress-number"><b>310</b></span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Visit Premium Page</span>
                                    <span class="progress-number"><b>480</b></span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Send Inquiries</span>
                                    <span class="progress-number"><b>250</b></span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </div>
@stop

@section('js')
    <script>
        window.onload = function () {
            let lastDays = document.getElementById("lastDays");
            if(lastDays) {
                lastDays.addEventListener("change", function () {
                    this.form.submit();
                });
            }

            let ctx = document.getElementById("pagePie").getContext("2d");
            window.pagePie = new Chart(ctx, {
                type: "pie",
                data: {
                    datasets: [{
                        data: [{{implode(", ", array_values($pagePie))}}],
                        backgroundColor: "#0000FF",
                    }],
                    labels: [{!! "'".implode("','",array_keys($pagePie)) . "'" !!}]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true
                    }
                }
            });
        }
    </script>
@endsection
