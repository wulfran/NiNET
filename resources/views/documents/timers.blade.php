<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<div class="header">
    <div class="info">
        <p class="name">NiNet Piotr Nikonowicz</p>
        <p class="address">Chorzemin 45a</p>
        <p class="address">64-200 Wolsztyn</p>
    </div>
    <div class="clearfix"></div>
    <h1>
        Work time calculation between {{ request()->input('start') }} and {{ request()->input('end') }}
    </h1>
</div>

<div class="content">
    <table>
        <thead>
        <tr>
        <th style="width: 25px; text-align: left">LP</th>
        <th style="width: 55px;">Minutes</th>
        <th style="width: 85px;">Date</th>
        <th style="text-align: center">Notes</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logs as $log)
            <tr class="@if($loop->iteration%2 == 0) even @endif">
                <td>{{ $loop->iteration }}</td>
                <td style="text-align:center;">{{ $log->minutes }}</td>
                <td style="text-align:center;">{{ $log->date->format('Y-m-d') }}</td>
                <td>{{ $log->notes }}</td>
            </tr>
        @endforeach
        <tr>
            <td style="font-weight: bold; text-align: center">Sum</td>
            <td style="font-weight: bold; text-align: center">{{ $logs->sum('minutes') }}</td>
        </tr>
        </tbody>
    </table>
</div>


<style>
    .info{
        float:left;
        width: 50%;
    }
    .name{
        font-weight: bold
    }
    .clearfix{
        clear: both;
    }
    h1{
        font-size: 24px;
    }
    table {
        width: 100%;
    }
    .even{
        background-color: #d3d3d3;
    }
    th, td{
        padding: 10px 5px 10px 5px;
    }
</style>