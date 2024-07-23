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

<!-- Small modal -->
<div id="transactionDateSelectModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" >
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Select Date</h5>
        </div>
        <div class="modal-body">
        <form class="form" action="/gametransaction/viewgametransactiondetails" method="GET">
        {{ csrf_field() }}
          <input required type="date" name="dateInput" id="dateInput"/>
        </div>
        <div class="modal-footer">
          <div class="form-actions">
            <button type="button" onclick="window.location='{{url('home')}}'" class="btn btn-warning mr-1">Close</button>
            <button type="submit" id="dateFormBtn" class="btn btn-primary">Go</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- modal end -->

<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">View Bettings</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Bet Details
              </li>
              <li class="breadcrumb-item active">View Bettings
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-body">
          <!-- Basic Tables start -->
          <div class="row">
              <div class="col-xs-12">
                  <div class="card">
                      <div class="card-header">
                          <h4 id="cardHeading" class="card-title">Betting Transactions
                            @isset($transactionData['transactionDate'])
                            <label>(</label>
                            <label id="dateLabel">{{ $transactionData['transactionDate'] }}</label>
                            <label>)</label>
                            @endisset
                          </h4>

                          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                          <div class="heading-elements">
                              <ul class="list-inline mb-0">
                              @isset($transactionData['gameTransactions'])
                                  <li><h6>Records Fetched: </h6></li>
                                  <li><h6 id="rowsCount">{{count($transactionData['gameTransactions'])}}</h6></li>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <li><button id="loadMoreBtn" class="btn btn-primary btn-sm" onclick="LoadMoreData();">Load More</button></li>&nbsp;&nbsp;
                                  @endisset
                                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="card-body collapse in">
                          <div class="card-block card-dashboard">
                              <div class="table-responsive">
                                <table id="tableGameTransactions" class="table table-striped table-bordered" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>Game</th>
                                          <th>Username</th>
                                          <th>Bet Number</th>
                                          <th>Bet Date</th>
                                          <th>Bet Time</th>
                                          <th>Bet Amount</th>
                                          <th>Winner</th>
                                          <th>Winning Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @isset($transactionData['gameTransactions'])
                                    @if(count($transactionData['gameTransactions']) != 0)
                                    @foreach($transactionData['gameTransactions'] as $transaction)
                                      <tr>
                                          <td>{{$transaction['gameName']}}</td>
                                          <td>{{$transaction['userName']}}</td>
                                          <td>{{$transaction['betNumber']}}</td>
                                          <td>{{$transaction['betDate']}}</td>
                                          <td>{{$transaction['betTime']}}</td>
                                          <td>{{$transaction['betAmount']}}</td>
                                          @if($transaction['isWinner']==1)
                                          <td>Yes</td>
                                          @else
                                          <td>No</td>
                                          @endif
                                          <td>{{$transaction['winningAmount']}}</td>
                                      </tr>
                                      @endforeach
                                      @endif
                                      @endisset
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
<script src="/app-assets/js/core/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#tableGameTransactions').DataTable({
        "aLengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, "All"]],
        "iDisplayLength": 100
    });

    @if(!isset($transactionData))
    $('#transactionDateSelectModal').modal('show');
    @endif
  } );
</script>

<script type="text/javascript">
  function LoadMoreData()
  {
    var offset = parseInt($('#rowsCount').text());
    var expectedRowCount = offset+2000;
    var date = document.getElementById("dateLabel").innerHTML;

    var tableGameTransactions = $('#tableGameTransactions').DataTable();

    $.ajax({
      type: "GET",
      url: '/gametransaction/viewgametransaction/'+offset+"?date="+date
      }).done(function( data ) {
        for (var i=0; i<data.length; i++) {
          var isWinner="No";
          if(data[i]['isWinner']==1)
           isWinner="Yes";
          tableGameTransactions.row.add( [
                                  data[i]['gameName'],
                                  data[i]['userName'],
                                  data[i]['betNumber'],
                                  data[i]['betDate'],
                                  data[i]['betTime'],
                                  data[i]['betAmount'],
                                  isWinner,
                                  data[i]['winningAmount']
                                ] );
        }
        tableGameTransactions.draw();
        var actualRowCount = offset + data.length;
        if(actualRowCount!=expectedRowCount)
          $("#loadMoreBtn").prop("disabled", true);

        $('#rowsCount').text(actualRowCount);
      }).fail(function() {
          alert('failed to load data!');
      });
  }
</script>
@endsection
