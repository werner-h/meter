@extends('meter::layout.layout')

@section('content')

    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-item nav-link active" data-toggle="tab" href="#graph">
                <i class="fa fa-bar-chart"></i> Graph
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item nav-link" data-toggle="tab" href="#index">
                <i class="fa fa-table"></i> Queries
            </a>
        </li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane fade show active" role="tabpanel" id="graph">
            <div class="section">
                @include('meter::layout.filters', ['route' => 'meter_queries'])

                <div class="text-center text-primary"><strong>Query Times</strong></div>
                <div>{!! $chart->container() !!}</div>
            </div>
        </div>

        <div class="tab-pane fade" role="tabpanel" id="index">
            <div class="section">
                @include('meter::layout.filters', ['route' => 'meter_queries'])

                <div class="table-responsive-sm">
                    <table class="meter_table table table-hover mx-auto w-100">
                        <thead>
                        <tr>
                            <th>Happened</th>
                            <th>Query</th>
                            <th>Time</th>
                            <th>Slow</th>
                            <th>More</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    {!! $chart->script() !!}

    <script>

        meterTable('.table', '{{ route('meter_queries_table') }}', 25, [
            {data: 'Happened'},
            {data: 'Query'},
            {data: 'Time'},
            {data: 'Slow'},
            {data: 'More'}
        ], {
            "columnDefs": [
                {"width": "10%", "targets": 0},
                {"width": "5%", "targets": -1},
                {"width": "10%", "targets": -2},
                {"width": "10%", "targets": -3}
            ]
        }, {
            {{request()->has('days') ? 'days : ' . request()->days : ''}}
            {{request()->has('slow') ? 'slow : 1' : ''}}
            {{request()->has('all') ? 'all : 1' : ''}}
        });

    </script>
@endpush
