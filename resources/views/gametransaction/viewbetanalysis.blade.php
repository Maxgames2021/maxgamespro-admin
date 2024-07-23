@extends('layouts.master')

@section('title')
    Max Games | Bet Details
@endsection

@section('content')
<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">Bet Analysis</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Bet Details
              </li>
              <li class="breadcrumb-item active">Analysis
              </li>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-body">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title" id="basic-layout-form">Select Game</h4>
            </div>
          <div class="card-body collapse in">
            <div class="card-block">
                  <div class="form-body">
                      <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Date</label>
                              {{-- as per logic of AdjustCurrentDate function from DB --}}
                                <input class="form-control" type="date" name="dateInput" id="dateInput" max="{{ date('Y-m-d', strtotime(date("Y-m-d h:i:sa")) - 60*30) }}"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label>Market</label>
                                <select name="selectedMarket" class="form-control" onchange="LoadGame(this.value)">
                                <option value="">--select--</option>
                                @isset($markets)
                                @foreach($markets as $market)
                                @if($market['isActive']==1)
                                  <option value="{{ $market['id'] }}">{{ $market['name'] }}</option>
                                @endif
                                @endforeach
                                @endisset
                              </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div id="divGameSelect" class="form-group">
                            <label>Game</label>
                              <select id="gameSelect" name="selectedGame" class="form-control" onchange="LoadBettings(this.value)">
                              <option value="">--select--</option>
                              </select>
                          </div>
                        </div>
                      </div>
                  </div>
            </div>
          </div>
        </div>
      </div>

      <div id="divBettings" class="content-body" style="display:none">
          <!-- Basic Tables start -->
          <div class="row">
              <div class="col-xs-12">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Bettings</h4>
                          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                          <div class="heading-elements">
                              <ul class="list-inline mb-0">
                                  <li><h3 id="totalBetAmount"></h3></li>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                  <li><a href="{{url('gametransaction/viewbetanalysis')}}"><i class="icon-cross2"></i></a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="card-body collapse in">
                          <div class="card-block card-dashboard">
                              <div class="table-responsive">
                                <table id="tableBettings" class="table table-striped table-bordered" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>Bet Number</th>
                                          <th>Bet Count</th>
                                          <th>Bet Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Basic Tables end -->
      </div>
</div>
<!-- main-content -->
@endsection

@section('scripts')
<script src="/app-assets/js/core/bootstrap-toggle.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript">
$( document ).ready(function() {
  $('#tableBettings').DataTable({"iDisplayLength": 100} );
});
</script>
<script type="text/javascript">
  function LoadGame(period) {
    if(period!="")
    {
      var sel = $("#gameSelect");
      $.ajax({
      type: "GET",
      url: '/game/getgames/'+period
      }).done(function( data ) {
        $("#divBettings").hide();
        sel.empty();
        sel.append('<option value="">--select--</option>');
        for (var i=0; i<data.length; i++) {
          sel.append('<option value="' + data[i]['id'] + '">' + data[i]['name'] + '</option>');
        }
      }).fail(function() {
          alert('failed to load data!');
      });
    }
    else
    {
        var sel = $("#gameSelect");
        sel.empty();
        sel.append('<option value="">--select--</option>');
        $("#divBettings").hide();
    }
}
</script>
<script type="text/javascript">
function LoadBettings(period) {
    if(period!="")
    {
      var date = document.getElementById("dateInput").value;
      $.ajax({
      type: "GET",
      url: '/gametransaction/loadbetanalysis/'+period+"?date="+date
      }).done(function( data ) {
          $("#tableBettings").DataTable().clear();
          $("#tableBettings").DataTable().destroy();
          var totalAmt = 0;
          for (var i=0; i<data.length; i++) {
          $("#tableBettings").find('tbody').append('<tr><td>'+data[i]['betNumber']+'</td><td>'+data[i]['betsMade']+'</td><td>'+data[i]['betAmount']+'</td></tr>');
          totalAmt = totalAmt + parseFloat(data[i]['betAmount']);
        }
          $('#tableBettings').DataTable({"iDisplayLength": 100}).draw();
          $("#divBettings").show();
          document.getElementById("totalBetAmount").innerHTML = "Total Bet Amount: "+totalAmt;
      }).fail(function() {
          alert('failed to load data!');
      });
    }
    else
    {
      $("#divBettings").hide();
    }
}
</script>
@endsection
