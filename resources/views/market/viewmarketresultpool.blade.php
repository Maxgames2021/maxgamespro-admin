@extends('layouts.master')

@section('title')
    Max Games | Markets
@endsection

@section('content')

<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">Market Result Pool</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Markets
              </li>
              </li>
              <li class="breadcrumb-item active">Market Result Pool
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
                          <h4 class="card-title">Market Result Data</h4>
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
                                          <th>SrNo</th>
                                          <th>MarketName</th>
                                          <th>Result</th>
                                          <th>Consolidated</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($marketresultspool as $poolData)
                                      @if($poolData['isOpenResultType'] == 1)
                                      <tr style="background-color:#FFC300">
                                      @elseif(strlen($poolData['result'])==2)
                                      <tr style="background-color:#E7FF33">
                                      @elseif($poolData['result'] == '-----' || $poolData['result'] == '-')
                                      <tr style="background-color:#FF3333">
                                      @else
                                      <tr style="background-color:#33FF7F">
                                      @endif
                                        <td>{{ $poolData['srNo'] }}</td>
                                        @if($poolData['isOpenResultType'] == 1)
                                          <td>{{ $poolData['marketName'] }} - OPEN</td>
                                        @elseif(strlen($poolData['result'])==2 || $poolData['result'] == '-----' || $poolData['result'] == '-')
                                        <td>{{ $poolData['marketName'] }}</td>
                                        @else
                                          <td>{{ $poolData['marketName'] }} - CLOSE</td>
                                        @endif
                                        <td>{{ $poolData['result'] }}</td>
                                        @if($poolData['isConsolidated'] == 1)
                                        <td>YES</td>
                                        <td style='text-align:center;'>
                                          
                                        </td>
                                        @else
                                        <td>NO</td>
                                        <td style='text-align:center;'>
                                          <button onClick="ConsolidateResult({{ $poolData['poolId'] }});" style='float:left; font-size:18px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; color: green;'>
                                            <i class='icon-check' title='Consolidate Result'></i>
                                          </button>
                                          <button onClick="RefreshResult({{ $poolData['marketId'] }});" style='float:right; font-size:18px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; color: red;'>
                                            <i class='icon-times' title='Delete Result'></i>
                                          </button>
                                        </td>
                                        @endif
                                      </tr>
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
        "iDisplayLength": 100
    });
  } );

  function ConsolidateResult(poolId)
  {
    alert(poolId);
    // $.ajax({
    //   type: "GET",
    //   url: '/market/marketresultconsolidate/'+poolId
    //   }).done(function( data ) {
    //       alert("Result Consolidated");
    //     }
    //   }).fail(function() {
    //       alert('failed to consolidate result!');
    // });
  }

  // function RefreshResult(marketId)
  // {
  //   alert(marketId);
  //   // $.ajax({
  //   //   type: "GET",
  //   //   url: '/market/marketresultrefresh/'+marketId
  //   //   }).done(function( data ) {
  //   //       alert("Result Refreshed");
  //   //     }
  //   //   }).fail(function() {
  //   //       alert('failed to refresh result!');
  //   // });
  // }
  </script>

  <script type="text/javascript">
    function RefreshResult(marketId)
    {
      $.ajax({
        type: "GET",
        url: '/market/marketresultrefresh/'+marketId
        }).done(function( data ) {
            location.reload();
            alert("Result Refreshed");
            
        }).fail(function() {
            alert('failed to refresh result!');
      });
    }

    function ConsolidateResult(poolId)
    {
      $.ajax({
        type: "GET",
        url: '/market/marketresultconsolidate/'+poolId
        }).done(function( data ) {
            location.reload();
            alert("Result Consolidated");
        }).fail(function() {
            alert('failed to consolidate result!');
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
