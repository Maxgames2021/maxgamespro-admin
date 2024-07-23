@extends('layouts.master')

@section('title')
    Max Games | Games
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
      <form class="form" action="/game/getgamedetail" method="POST">
      {{ csrf_field() }}
        <select name="selectedMarket" class="form-control">
          @isset($markets)
          @foreach($markets as $market)
            <option value="{{ $market['id'] }}">{{ $market['name'] }}</option>
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
          <h2 class="content-header-title">Update Game</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Game
              </li>
              </li>
              <li class="breadcrumb-item active">Update Game
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
                          <h4 class="card-title">Registered Games</h4>
                          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                          <div class="heading-elements">
                              <ul class="list-inline mb-0">
                                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                  <li><a href="{{url('game/updategameform')}}"><i class="icon-cross2"></i></a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="card-body collapse in">
                          <div class="card-block card-dashboard">
                              <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th style="display:none;">Id</th>
                                          <th>Name</th>
                                          <th>Ratio</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if(isset($gameDetails))
                                      @foreach($gameDetails['games'] as $game)
                                      <tr>
                                          <td style="display:none;">{{ $game['id'] }}</td>
                                          <td>{{ $game['name'] }}</td>
                                          <form action="/game/updategamerequest/{{ $game['id'] }}" method="POST">
                                          {{ csrf_field() }}
                                          <td>
                                            <input type="hidden" name="marketId" value="{{ $gameDetails['marketId'] }}">
                                            <input required type="text" name="gameRatio" value="{{ $game['ratio'] }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                          </td>
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