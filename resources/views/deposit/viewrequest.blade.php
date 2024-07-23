@extends('layouts.master')

@section('title')
    Max Games | Deposit Requests
@endsection

@section('content')

<!-- Small modal -->
<div id="transactionDateSelectModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" >
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Select Date</h5>
        </div>
        <div class="modal-body">
        <form class="form" action="/deposit/viewdepositrequestdetails" method="GET">
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
          <h2 class="content-header-title">Deposit Requests</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Deposits
              </li>
              </li>
              <li class="breadcrumb-item active">View Deposits
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
                          <h4 id="cardHeading" class="card-title">Deposits
                            @isset($transactionData['transactionDate'])
                            <label>(</label>
                            <label id="dateLabel">{{ $transactionData['transactionDate'] }}</label>
                            <label>)</label>
                            @endisset
                          </h4>
                          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                          <div class="heading-elements">
                              <ul class="list-inline mb-0">
                                  @isset($transactionData['deposits'])
                                  <li><h6>Records Fetched: </h6></li>
                                  <li><h6 id="rowsCount">{{count($transactionData['deposits'])}}</h6></li>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <li><button id="loadMoreBtn" class="btn btn-primary btn-sm" onclick="LoadMoreData();">Load More</button></li>&nbsp;&nbsp;
                                  @endisset
                                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="card-body collapse in">
                          <div class="card-block card-dashboard">
                              <div class="table-responsive">
                                <table id="tableDesposits" class="table table-striped table-bordered" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>Id</th>
                                          <th>Username</th>
                                          <th>Amount</th>
                                          <th>Status</th>
                                          <th>Initiated By</th>
                                          <th>Request Time</th>
                                          <th>Processed By</th>
                                          <th>Processed Time</th>
                                          <th>Payment Mode</th>
                                          <th>UPI Transaction Id</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @isset($transactionData['deposits'])
                                    @foreach($transactionData['deposits'] as $deposit)
                                    <tr>
                                      <td>{{ $deposit['id'] }}</td>
                                        <td>{{ $deposit['username'] }}</td>
                                        <td>{{ $deposit['amount'] }}</td>
                                        <td>{{ $deposit['status'] }}</td>
                                        <td>{{ $deposit['depositedBy'] }}</td>
                                        <td>{{ $deposit['requestTime'] }}</td>
                                        <td>{{ $deposit['processedBy'] }}</td>
                                        <td>{{ $deposit['processedTime'] }}</td>
                                        <td>{{ $deposit['paymentMode'] }}</td>
                                        <td>{{ $deposit['modeTransactionId'] }}</td>
                                    </tr>
                                    @endforeach
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
      $('#tableDesposits').DataTable({
        "aLengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, "All"]],
        "iDisplayLength": 100,
        "order": [[ 0, "desc" ]]
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

    var tableDesposits = $('#tableDesposits').DataTable();

    $.ajax({
      type: "GET",
      url: '/deposit/viewdepositrequest/'+offset+"?date="+date
      }).done(function( data ) {
        for (var i=0; i<data.length; i++) {

          tableDesposits.row.add( [
                                  data[i]['id'],
                                  data[i]['username'],
                                  data[i]['amount'],
                                  data[i]['status'],
                                  data[i]['depositedBy'],
                                  data[i]['requestTime'],
                                  data[i]['processedBy'],
                                  data[i]['processedTime'],
                                  data[i]['paymentMode'],
                                  data[i]['modeTransactionId']
                                ] );
        }
        tableDesposits.draw();
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
