@extends('layouts.master')

@section('title')
    Max Games | Withdrawals
@endsection

@section('content')


<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">Create Withdrawals</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Withdrawals
              </li>
              </li>
              <li class="breadcrumb-item active">Create
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
                          <h4 class="card-title">Registered Users</h4>
                          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                          <div class="heading-elements">
                              <ul class="list-inline mb-0">
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
                                          <th>Balance</th>
                                          <th>Add Amount</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($users as $user)
                                      @if($user['isAdmin']==0)
                                      <tr>
                                        <td>{{ $user['id'] }}</td>
                                          <td>{{$user['username']}}</td>
                                          <td>{{$user['contactNo']}}</td>
                                          <td>{{$user['balance']}}</td>
                                          <td>
                                            <input required type="text" id="withdrawalAmount{{ $user['id'] }}" name="withdrawalAmount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                          </td>
                                          <td style='text-align:center;'>
                                          <button style="bg-color:blue" class="btn btn-primary" onClick="withdrawal(event,{{ $user['id'] }});">update</button></td>
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
      $('#example').DataTable();
  } );

  function withdrawal(e, userid)
  {
    e.preventDefault(); // prevent normal onClick flow
    var withdrawalAmount = $('#withdrawalAmount'+userid).val();
    
    data = { 
              withdrawalAmount: withdrawalAmount
            };

    $.ajax({
            url: '/withdrawal/createwithdrawalrequest/'+userid,
            type: 'POST',
            data: data,
            dataType: 'JSON',
            headers: {
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data) {
            alert("Withdrawal Request Created");
            $('#withdrawalAmount'+userid).val('');
        }).fail(function() {
            alert('failed!');
            $('#withdrawalAmount'+userid).val('');
        });
  }
</script>
@if(Session::has('status'))
    @if(Session::get('status'))
      <script>alert('data updated!')</script>
    @else <script>alert('failed to update data!')</script>
    @endif
  @endif
@endsection
