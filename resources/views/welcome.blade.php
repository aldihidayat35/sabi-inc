@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dashboard Overview</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!--begin::Widget-->
            <div class="col-md-4">
                <div class="card bg-light-primary">
                    <div class="card-body">
                        <h4 class="text-primary">Users</h4>
                        <p class="fs-2 fw-bold">1,245</p>
                    </div>
                </div>
            </div>
            <!--end::Widget-->

            <!--begin::Widget-->
            <div class="col-md-4">
                <div class="card bg-light-success">
                    <div class="card-body">
                        <h4 class="text-success">Revenue</h4>
                        <p class="fs-2 fw-bold">$12,345</p>
                    </div>
                </div>
            </div>
            <!--end::Widget-->

            <!--begin::Widget-->
            <div class="col-md-4">
                <div class="card bg-light-danger">
                    <div class="card-body">
                        <h4 class="text-danger">Issues</h4>
                        <p class="fs-2 fw-bold">23</p>
                    </div>
                </div>
            </div>
            <!--end::Widget-->
        </div>

        <div class="row mt-5">
            <!--begin::Chart-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Monthly Performance</h3>
                    </div>
                    <div class="card-body">
                        <div id="chart-container" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
            <!--end::Chart-->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Sample chart using amCharts
    am5.ready(function() {
        var root = am5.Root.new("chart-container");
        var chart = root.container.children.push(am5xy.XYChart.new(root, {}));
        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            categoryField: "month",
            renderer: am5xy.AxisRendererX.new(root, {})
        }));
        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {})
        }));
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            name: "Performance",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "value",
            categoryXField: "month"
        }));
        series.data.setAll([
            { month: "Jan", value: 50 },
            { month: "Feb", value: 80 },
            { month: "Mar", value: 65 },
            { month: "Apr", value: 90 },
            { month: "May", value: 75 },
            { month: "Jun", value: 100 }
        ]);
    });
</script>
@endsection
