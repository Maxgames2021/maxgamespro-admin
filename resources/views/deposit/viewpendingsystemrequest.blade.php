@extends('layouts.master')

@section('title')
    Max Games | Deposit Requests
@endsection

@section('content')

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
              <li class="breadcrumb-item active">System Deposits
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
                          <h4 class="card-title">System Deposits</h4>
                          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                          <div class="heading-elements">
                              <ul class="list-inline mb-0">
                              @isset($pendingDepositsDetail['totalDeposits'])
                                  <li><h3>Total Deposits: {{$pendingDepositsDetail['totalDeposits']}}</h3></li>&nbsp;&nbsp;&nbsp;&nbsp;
                              @endisset
                                  <li><a href="{{ url('deposit/approvependingsystemdepositrequest') }}" class="btn btn-success">Approve All</a></li>
                                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="card-body collapse in">
                          <div class="card-block card-dashboard">
                              <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                  <thead>
                                      <tr>
                                        <th>Id</th>
                                          <th>Username</th>
                                          <th>Contact No.</th>
                                          <th>Amount</th>
                                          <th>Initiated By</th>
                                          <th>Request Time</th>
                                          <th>Payment Mode</th>
                                          <th>Transaction Id</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($pendingDepositsDetail['pendingdeposits'] as $pendingdeposit)
                                      @if($pendingdeposit['isSystemTransaction']==1)
                                      <tr>
                                        <td>{{ $pendingdeposit['id'] }}</td>
                                          <td>{{ $pendingdeposit['name'] }}</td>
                                          <td>{{ $pendingdeposit['contactNo'] }}</td>
                                          <td>{{ $pendingdeposit['amount'] }}</td>
                                          <td>{{ $pendingdeposit['depositedBy'] }}</td>
                                          <td>{{ $pendingdeposit['requestTime'] }}</td>
                                          <form action="/deposit/updatependingsystemdepositrequest/{{ $pendingdeposit['id'] }}" method="POST">
                                          {{ csrf_field() }}
                                          <td>
                                            <select name="paymentmode">
                                              <option value="1">N.A.</option>
                                              <option value="2">PayTM</option>
                                              <option value="3">PhonePay</option>
                                              <option value="4">Gpay</option>
                                              <option value="5">Amazon</option>
                                              <option value="6">BHIM</option>
                                            </select>
                                          </td>
                                          <td>
                                            <input required type="text" name="transactionId">
                                          </td>
                                          <td style='text-align:center;'>
                                            <button name="submit" value="2" type="submit" style='font-size:18px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; color: green;'>
                                              <i class='icon-check' title='Approve Request'></i>
                                            </button>
                                            <button name="submit" value="3" type="submit" style='font-size:18px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; color: red;'>
                                              <i class='icon-times' title='Cancel Request'></i>
                                            </button>
                                          </td>
                                          </form>
                                      </tr>
                                      @endif
                                      @endforeach
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
      $('#example').DataTable({
        "aLengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, "All"]],
        "iDisplayLength": 100,
        "order": [[ 0, "desc" ]]

    });
  } );
  </script>
  @if(Session::has('status'))
    @if(Session::get('status'))
      <script>alert('data updated!')</script>
    @else <script>alert('failed to update data!')</script>
    @endif
  @endif
@endsection
