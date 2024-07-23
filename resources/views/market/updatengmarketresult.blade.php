@extends('layouts.master')

@section('title')
    Max Games | Markets
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
      <form class="form" action="/market/getngmarketresultdetail" method="POST">
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
          <h2 class="content-header-title">Declare NG Result</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Declare NG Result
              </li>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-body">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title" id="basic-layout-form">Market Result - (Consolidate or Refresh Result From Result Pool view)</h4>
              <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                </ul>
              </div>
            </div>
          <div class="card-body collapse in">
            <div class="card-block">
              <form class="form" method="POST" onSubmit="return Confirmation(event);">
                    {{ csrf_field() }}
                  <div class="form-body">
                      <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="marketId">
                            <div class="form-group">
                            <label>Market Name</label>
                            <input type="text" readonly required id="marketName" name="marketName" class="form-control" placeholder="Market Name">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-7">
                          <div class="row">
                            <div class="col-md-2">
                              <div class="form-group">
                                <label>Open</label>
                                <input type="text" required name="open" id="open" class="form-control" placeholder="open" maxlength="1" minlength="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label>Close</label>
                                <input type="text" required name="close" id="close" class="form-control" placeholder="close" maxlength="1" minlength="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="form-actions">
                    <button onclick="window.location='{{url('market/updatengmarketresultform')}}'" type="button" class="btn btn-warning mr-1">
                      <i class="icon-cross2"></i> Cancel
                    </button>
                    <button type="submit" name="save" class="btn btn-primary" formaction="/market/updatengmarketresultrequest">
                                    <i class="icon-check2"></i> Save
                    </button>
                  </div>
              </form>
            </div>
          </div>
        </div>
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
  @if(isset($markets) && !isset($marketResult))
    $('#marketSelectModal').modal('show');
  @endif

  @if(isset($marketResult))
    document.getElementsByName("marketId")[0].value='{{$marketResult['id']}}';
    document.getElementsByName("marketName")[0].value='{{$marketResult['name']}}';
    document.getElementsByName("open")[0].value='{{$marketResult['openResult']}}';
    document.getElementsByName("close")[0].value='{{$marketResult['closeResult']}}';
  @endif
});
</script>
<script type="text/javascript">
function Confirmation(e)
{
  var marketName = document.getElementById('marketName').value;
  var open = document.getElementById('open').value;
  var close = document.getElementById('close').value ;
  var result = open+close;
  return confirm("Declaring result '"+ result +"' for '"+marketName+"'. Press Ok to continue.");
}
</script>
@if(Session::has('status'))
    @if(Session::get('status'))
      <script>alert('data updated!')</script>
    @else <script>alert('failed to update data!')</script>
    @endif
  @endif
@endsection
