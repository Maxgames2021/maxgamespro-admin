@extends('layouts.master')

@section('title')
    Max Games | View Stats
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
          <h2 class="content-header-title">View Stats</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Management
            </li>
            <li class="breadcrumb-item active">View Stats
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
                          <h4 class="card-title">Statistics</h4>
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
                                          <th>Date</th>
                                          <th>Deposits</th>
                                          <th>Withdrawals</th>
                                          <th>Bet Amount</th>
                                          <th>Win Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @isset($stats)
                                    @foreach($stats as $stat)
                                      <tr>
                                          <td>{{$stat['statDate']}}</td>
                                          <td>{{$stat['deposits']}}</td>
                                          <td>{{$stat['withdrawals']}}</td>
                                          <td>{{$stat['betAmount']}}</td>
                                          <td>{{$stat['winAmount']}}</td>
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
      $('#example').DataTable({
        "aLengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
        "iDisplayLength": 50,
        "order": [[ 0, "desc" ]]
    });
  } );
</script>
@endsection
