@extends('layouts.master')

@section('title')
    Max Games | Management
@endsection

@section('content')
<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">Payment Modes</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Management
              </li>
              </li>
              <li class="breadcrumb-item active">Payment Modes
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
                          <h4 class="card-title">Available Payment Modes</h4>
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
                                          <th>Name</th>
                                          <th>Is Active</th>
                                          <th>Max Android Version</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if(isset($paymentmodes))
                                      @foreach($paymentmodes as $paymentmode)
                                      <tr>
                                          <td>{{ $paymentmode['id'] }}</td>
                                          <td>{{ $paymentmode['name'] }}</td>
                                          <form action="/paymentmode/{{ $paymentmode['id'] }}" method="POST">
                                          {{ csrf_field() }}
                                          <td>
                                            <select name="isActive">
                                              @if($paymentmode['isActive']==0)
                                              <option value="0" selected="selected">No</option>
                                              <option value="1">Yes</option>
                                              @else
                                              <option value="0">No</option>
                                              <option value="1" selected="selected">Yes</option>
                                              @endif
                                            </select>
                                          </td>
                                          <td><input type="text" name="maxAndroidVersion" value="{{ $paymentmode['maxAndroidVersion'] }}"></td>
                                          <td style='text-align:center;'>
                                          <button type="submit" style="bg-color:blue" class="btn btn-primary">update</button>                                          
                                          </td>
                                          </form>
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
<script src="/app-assets/js/core/bootstrap-toggle.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript">
$( document ).ready(function() {
  $('#example').DataTable({"iDisplayLength": 25});
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