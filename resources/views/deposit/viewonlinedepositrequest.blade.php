@extends('layouts.master')

@section('title')
    Max Games | Online Deposit Requests
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
        <form class="form" action="/deposit/viewonlinedepositrequestdetails" method="GET">
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
          <h2 class="content-header-title">Online Deposit Requests</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Deposits
              </li>
              </li>
              <li class="breadcrumb-item active">View Online Deposits
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-body">
        <div class="form-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                  <input class="form-control" type="text" id="merchantCode" placeholder="Enter Merchant Code"/>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select class="form-control" id="paymentStatus">
                  <option value="0">All</option>
                  <option value="1">Pending</option>
                  <option value="2">Completed</option>
                  <option value="3">Cancelled</option>
                  <option value="4">Failed</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <button class="btn btn-primary" id="filterDeposits">Apply Filter</button>
              </div>
            </div>
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
                            <div class="content-body">
                                <div class="table-responsive">
                                  <table id="tableDesposits" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                          <th>SrNo</th>
                                          <th>Username</th>
                                          <th>Contact No</th>
                                          <th>Amount</th>
                                          <th>Request Time</th>
                                          <th>Processed Time</th>
                                          <th>Status</th>
                                          <th>Merchant Code</th>
                                          <th>Payment Mode</th>
                                          <th>UPI Transaction Ref Id</th>
                                          <th>UPI Transaction Id</th>
                                          <th>Processed By</th>
                                          <th>Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @isset($transactionData['deposits'])
                                      @foreach($transactionData['deposits'] as $deposit)
                                      <tr>
                                        <td>{{ $deposit['srNo'] }}</td>
                                        <td>{{ $deposit['username'] }}</td>
                                        <td>{{ $deposit['contactNo'] }}</td>
                                        <td>{{ $deposit['amount'] }}</td>
                                        <td>{{ $deposit['requestTime'] }}</td>
                                        <td>{{ $deposit['processedTime'] }}</td>
                                        <td>{{ $deposit['status'] }}</td>
                                        <td>{{ $deposit['merchantCode'] }}</td>
                                        <td>{{ $deposit['paymentMode'] }}</td>
                                        <td>{{ $deposit['transactionRefId'] }}</td>
                                        <td>{{ $deposit['modeTransactionId'] }}</td>
                                        <td>{{ $deposit['processedBy'] }}</td>
                                        <td>{{ $deposit['id'] }}</td>
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

    var paymentStatus = $("select#paymentStatus option").filter(":selected").val();
    var merchantCode = $("#merchantCode").val();
    var date = document.getElementById("dateLabel").innerHTML;

    var url = '/deposit/viewonlinedepositrequest/'+offset+"?date="+date+"&paymentStatus="+paymentStatus;
    if(merchantCode != '')
    {
      url = '/deposit/viewonlinedepositrequest/'+offset+"?date="+date+"&paymentStatus="+paymentStatus+"&merchantCode="+merchantCode;
    }

    var tableDesposits = $('#tableDesposits').DataTable();

    $.ajax({
      type: "GET",
      url: url
      }).done(function( data ) {
        for (var i=0; i<data.length; i++) {

          tableDesposits.row.add( [
                                  data[i]['srNo'],
                                  data[i]['username'],
                                  data[i]['contactNo'],
                                  data[i]['amount'],
                                  data[i]['requestTime'],
                                  data[i]['processedTime'],
                                  data[i]['status'],
                                  data[i]['merchantCode'],
                                  data[i]['paymentMode'],
                                  data[i]['transactionRefId'],
                                  data[i]['modeTransactionId'],
                                  data[i]['processedBy'],
                                  data[i]['id']
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

  $('#filterDeposits').click(function(){
    var paymentStatus = $("select#paymentStatus option").filter(":selected").val();
    var merchantCode = $("#merchantCode").val();
    var date = document.getElementById("dateLabel").innerHTML;

    var url = '/deposit/viewonlinedepositrequest/0'+"?date="+date+"&paymentStatus="+paymentStatus;
    if(merchantCode != '')
    {
      url = '/deposit/viewonlinedepositrequest/0'+"?date="+date+"&paymentStatus="+paymentStatus+"&merchantCode="+merchantCode;
    }

    var tableDesposits = $('#tableDesposits').DataTable();
    
    $.ajax({
      type: "GET",
      url: url
      }).done(function( data ) {
        tableDesposits.clear();
        for (var i=0; i<data.length; i++) {
          tableDesposits.row.add( [
                                  data[i]['srNo'],
                                  data[i]['username'],
                                  data[i]['contactNo'],
                                  data[i]['amount'],
                                  data[i]['requestTime'],
                                  data[i]['processedTime'],
                                  data[i]['status'],
                                  data[i]['merchantCode'],
                                  data[i]['paymentMode'],
                                  data[i]['transactionRefId'],
                                  data[i]['modeTransactionId'],
                                  data[i]['processedBy'],
                                  data[i]['id']
                                ] );
        }
        tableDesposits.draw();
        $('#rowsCount').text(data.length);
      }).fail(function() {
          alert('failed to load data!');
      });
  });
</script>
@endsection
