@extends('layouts.master')

@section('title')
    Max Games | Bet Details
@endsection

@section('content')
<!-- Small modal -->
<div id="marketSelectModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" >
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Select Market</h5>
      </div>
      <div class="modal-body">
      <form class="form" action="/gametransaction/getcurrentgametransaction" method="POST">
      {{ csrf_field() }}
        <select name="selectedMarket" class="form-control">
          @isset($markets)
          @foreach($markets as $market)
          @if($market['isActive']==1)
            <option value="{{ $market['id'] }}">{{ $market['name'] }}</option>
          @endif
          @endforeach
          @endisset
        </select>
      </div>
      <div class="modal-footer">
        <div class="form-actions">
          <button type="button" onclick="window.location='{{url('home')}}'" class="btn btn-warning mr-1">Close</button>
          <button type="submit" class="btn btn-primary">Go</button>
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
              </li>
              <li class="breadcrumb-item active">View Current Bettings
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
                          <h4 class="card-title">Current Bettings</h4>
                          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                          <div class="heading-elements">
                              <ul class="list-inline mb-0">
                              @isset($gameTransactionsDetail['totalBetAmount'])
                                  <li><h3>Total Bet Amount: {{$gameTransactionsDetail['totalBetAmount']}}</h3></li>&nbsp;&nbsp;&nbsp;&nbsp;
                              @endisset
                                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                  <li><a href="{{url('gametransaction/viewcurrentgametransaction')}}"><i class="icon-cross2"></i></a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="card-body collapse in">
                          <div class="card-block card-dashboard">
                              <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>Game</th>
                                          <th>User</th>
                                          <th>Bet Number</th>
                                          <th>Bet Time</th>
                                          <th>Bet Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if(isset($gameTransactionsDetail['gameTransactions']))
                                      @if(count($gameTransactionsDetail['gameTransactions']) != 0)
                                      @foreach($gameTransactionsDetail['gameTransactions'] as $transaction)
                                      <tr>
                                          <td>{{$transaction['name']}}</td>
                                          <td>{{$transaction['userName']}}</td>
                                          <td>{{$transaction['betNumber']}}</td>
                                          <td>{{$transaction['betTime']}}</td>
                                          <td>{{$transaction['betAmount']}}</td>
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
<script src="/app-assets/js/core/bootstrap-toggle.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript">
$( document ).ready(function() {
  $('#example').DataTable({
        "aLengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, "All"]],
        "iDisplayLength": 100
    });
  @if(isset($markets) && !isset($marketDetails))
    $('#marketSelectModal').modal('show');
  @endif
});
</script>
@if(Session::has('status'))
    @if(Session::get('status'))
      <script>alert('data updated!')</script>
    @else <script>alert('failed to update data!')</script>
    @endif
  @endif
@endsection