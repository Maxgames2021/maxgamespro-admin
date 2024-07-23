@extends('layouts.master')

@section('title')
    Max Games | Bet Details
@endsection

@section('content')
<!-- content-header -->

<!--<div class="content-header row">
  <div class="content-header-left col-md-6 col-xs-12 mb-1">
    <h2 class="content-header-title">Dashboard</h2>
  </div>
  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
    <div class="breadcrumb-wrapper col-xs-12">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="#">Page Layouts</a>
        </li>
        <li class="breadcrumb-item active">Boxed Layout
        </li>
      </ol>
    </div>
  </div>     
</div>-->

<!-- content-header -->

<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">View Betting Stats</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Bet Details
              </li>
              <li class="breadcrumb-item active">View Betting Stats
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-body">
          <!-- Basic Tables start -->
          <div class="row">
              <div class="col-xs-12">
                  <div class="card xs">
                        <div class="card-header">
                          <h4 class="card-title">Betting Stats</h4>
                          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                          <div class="heading-elements">
                              <ul class="list-inline mb-0">
                                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                              </ul>
                          </div>
                        </div>
                      <canvas id="densityChart" width="50" height="30"></canvas> 
                  </div>
              </div>
          </div>
          <!-- Basic Tables end -->
      </div>
</div>
<!-- main-content -->
@endsection

@section('scripts')
<script src="/app-assets/js/core/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/Chart.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $.ajax({
      type: "GET",
      url: '/gametransaction/betstats'
      }).done(function( data ) {
        plotChart(data);
      }).fail(function() {
          alert('failed to load data!');
      });
  } );
function plotChart(data)
{
  var marketName=[]
  var betAmount=[];
  var winAmount=[];
  var betCount=[];
  var winCount=[];
  for (var i=0; i<data.length; i++) 
  {
    marketName.push(data[i]['name']);
    betAmount.push(data[i]['betAmount']);
    winAmount.push(data[i]['winningAmount']);
    betCount.push(data[i]['betCount']);
    winCount.push(data[i]['winnerCount']);
  }
  var densityCanvas = document.getElementById("densityChart");

  Chart.defaults.global.defaultFontFamily = "Lato";
  Chart.defaults.global.defaultFontSize = 14;

  var betAmountData = {
    label: 'Total bet amount',
    data: betAmount,
    backgroundColor: 'rgba(0, 99, 132, 0.6)',
    borderWidth: 0,
    yAxisID: "y-axis-betamount"
  };

  var winAmountData = {
    label: 'Total wining amount',
    data: winAmount,
    backgroundColor: 'rgba(99, 132, 0, 0.6)',
    borderWidth: 0,
    yAxisID: "y-axis-winamount"
  };

  var betCountData = {
    label: 'Total Bets',
    data: betCount,
    backgroundColor: 'rgba(7, 247, 115, 0.6)',
    borderWidth: 0,
    yAxisID: "y-axis-count"
  };

  var winCountData = {
    label: 'Total bets won',
    data: winCount,
    backgroundColor: 'rgba(245, 132, 66, 0.6)',
    borderWidth: 0,
    yAxisID: "y-axis-count"
  };

  var planetData = {
    labels: marketName,
    datasets: [betAmountData, winAmountData, betCountData, winCountData]
  };

  var chartOptions = {
    scales: {
      xAxes: [{
        barPercentage: 1,
        categoryPercentage: 0.5
      }],
      yAxes: [{
        id: "y-axis-betamount",
        display: false,
        ticks: {
              min: 0
          }
      }, {
        id: "y-axis-winamount",
        display: false,
        ticks: {
              min: 0
          }
      },
      {
        id: "y-axis-count",
        display: false,
        ticks: {
              min: 0
          }
      }, 
      {
        id: "y-axis-count",
        display: false,
        ticks: {
              min: 0
          }
      }]
    }
  };

  var barChart = new Chart(densityCanvas, {
    type: 'bar',
    data: planetData,
    options: chartOptions
  });
}
</script>
@endsection