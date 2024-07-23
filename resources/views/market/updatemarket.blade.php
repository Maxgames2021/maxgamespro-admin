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
      <form class="form" action="/market/getmarketdetail" method="POST">
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
          <h2 class="content-header-title">Update Market</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Market
              </li>
              </li>
              <li class="breadcrumb-item active">Update Market
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-body">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title" id="basic-layout-form">Market Info</h4>
              <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                </ul>
              </div>
            </div>
          <div class="card-body collapse in">
            <div class="card-block">
            <form class="form" action="/market/updatemarketrequest" method="POST">
              {{ csrf_field() }}
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="marketId">
                        <input type="hidden" name="isNGType">
                        <div class="form-group">
                        <label>Market Name</label>
                        <input type="text" readonly required name="marketName" class="form-control" placeholder="Market Name">
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Set Market Active</label>
                          <div>
                            <input id="isActive" name="isActive" value="1" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger"> 
                            <span style="color:red;">
                            <div>InActive/Active Changes will take effect from next day. It is highly advised to change this setting between 12 am - 3 am only.
                            </div>
                            </span>
                         
                          </div>
                          
                        </div>
                    </div>
                  </div>

                  <div><label><strong><u>Monday - Friday Timing</u></strong></label></div>
                  <div class="row">
                    <div class="col-md-6">
                      <div>
                        <label><strong>Result Timing</strong></label>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput3">Open Time</label>
                            <input required type="time" name="weekdayResultOpenTime" value="09:00" class="form-control" placeholder="open time"  >
                          </div>
                        </div>
                        <div id="weekDayResultCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input required type="time" name="weekdayResultCloseTime" value="11:00" class="form-control" placeholder="close time"  >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div>
                        <label><strong>Bet Timing</strong></label>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput3">Open Time</label>
                            <input required type="time" name="weekdayBetOpenTime" value="08:50" class="form-control" placeholder="open time"  >
                          </div>
                        </div>
                        <div id="weekDayBetCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input required type="time" name="weekdayBetCloseTime" value="10:50" class="form-control" placeholder="close time"  >
                          </div>	
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group"><input id="satTimingRadio" name="satTimingRadio" type="radio"><strong> <u>Saturday Timing</u></strong></input></div>
                  <div id="satTimingDiv" class="row">
                    <div class="col-md-6">
                      <div>
                        <label><strong>Result Timing</strong></label>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput3">Open Time</label>
                            <input type="time" id="satResultOpenTime" name="satResultOpenTime" value="09:00" class="form-control" placeholder="open time"  >
                          </div>
                        </div>
                        <div id="satResultCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input type="time" id="satResultCloseTime" name="satResultCloseTime" value="11:00" class="form-control" placeholder="close time"  >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div>
                        <label><strong>Bet Timing</strong></label>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput3">Open Time</label>
                            <input type="time" id="satBetOpenTime" name="satBetOpenTime" value="08:50" class="form-control" placeholder="open time"  >
                          </div>
                        </div>
                        <div id="satBetCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input type="time" id="satBetCloseTime" name="satBetCloseTime" value="10:50" class="form-control" placeholder="close time"  >
                          </div>	
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group"><input id="sunTimingRadio" name="sunTimingRadio" type="radio"><strong> <u>Sunday Timing</u></strong></input></div>
                  <div id="sunTimingDiv" class="row">
                    <div class="col-md-6">
                      <div>
                        <label><strong>Result Timing</strong></label>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput3">Open Time</label>
                            <input type="time" id="sunResultOpenTime" name="sunResultOpenTime" value="09:00" class="form-control" placeholder="open time"  >
                          </div>
                        </div>
                        <div id="sunResultCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input type="time" id="sunResultCloseTime" name="sunResultCloseTime" value="11:00" class="form-control" placeholder="close time"  >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div>
                        <label><strong>Bet Timing</strong></label>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput3">Open Time</label>
                            <input type="time" id="sunBetOpenTime" name="sunBetOpenTime" value="08:50" class="form-control" placeholder="open time"  >
                          </div>
                        </div>
                        <div id="sunBetCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input type="time" id="sunBetCloseTime" name="sunBetCloseTime" value="10:50" class="form-control" placeholder="close time"  >
                          </div>	
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-actions">
                  <button onclick="window.location='{{url('market/updatemarketform')}}'" type="button" class="btn btn-warning mr-1">
                    <i class="icon-cross2"></i> Cancel
                  </button>
                  <button type="submit" class="btn btn-primary">
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
  @if(isset($markets) && !isset($marketDetails))
    $('#marketSelectModal').modal('show');
  @endif
  @if(isset($marketDetails))
    setFields();
  @endif
  if ($("#satTimingRadio").is(':checked')) {
    $("#satTimingRadio").val('satActive');
    $("#satTimingDiv").show();
    $('#satResultOpenTime').prop('required',true);
    $('#satResultCloseTime').prop('required',true);
    $('#satBetOpenTime').prop('required',true);
    $('#satBetCloseTime').prop('required',true);
  }
  else{
    $("#satTimingRadio").val('');
    $("#satTimingDiv").hide();
    $('#satResultOpenTime').prop('required',false);
    $('#satResultCloseTime').prop('required',false);
    $('#satBetOpenTime').prop('required',false);
    $('#satBetCloseTime').prop('required',false);
  }
  if ($("#sunTimingRadio").is(':checked')) {
    $("#sunTimingRadio").val('sunActive');
    $("#sunTimingDiv").show();
    $('#sunResultOpenTime').prop('required',true);
    $('#sunResultCloseTime').prop('required',true);
    $('#sunBetOpenTime').prop('required',true);
    $('#sunBetCloseTime').prop('required',true);
  }
  else{
    $("#sunTimingRadio").val('');
    $("#sunTimingDiv").hide();
    $('#sunResultOpenTime').prop('required',false);
    $('#sunResultCloseTime').prop('required',false);
    $('#sunBetOpenTime').prop('required',false);
    $('#sunBetCloseTime').prop('required',false);
  }  
});

$(document).on("click", "[id=satTimingRadio]", function(){
  thisRadio = $(this);
  if (thisRadio.hasClass("imChecked")) {
      thisRadio.removeClass("imChecked");
      thisRadio.prop('checked', false);
      thisRadio.val('');
      document.getElementById("satTimingDiv").style.display = "none";
      $('#satResultOpenTime').prop('required',false);
      $('#satResultCloseTime').prop('required',false);
      $('#satBetOpenTime').prop('required',false);
      $('#satBetCloseTime').prop('required',false);
  } else { 
      thisRadio.prop('checked', true);
      thisRadio.addClass("imChecked");
      thisRadio.val('satActive');
      document.getElementById("satTimingDiv").style.display = "block";
      $('#satResultOpenTime').prop('required',true);
      $('#satResultCloseTime').prop('required',true);
      $('#satBetOpenTime').prop('required',true);
      $('#satBetCloseTime').prop('required',true);
  };
});

$(document).on("click", "[id=sunTimingRadio]", function(){
  thisRadio = $(this);
  if (thisRadio.hasClass("imChecked")) {
      thisRadio.removeClass("imChecked");
      thisRadio.prop('checked', false);
      thisRadio.val('');
      document.getElementById("sunTimingDiv").style.display = "none";
      $('#sunResultOpenTime').prop('required',false);
      $('#sunResultCloseTime').prop('required',false);
      $('#sunBetOpenTime').prop('required',false);
      $('#sunBetCloseTime').prop('required',false);

  } else { 
      thisRadio.prop('checked', true);
      thisRadio.addClass("imChecked");
      thisRadio.val('sunActive');
      document.getElementById("sunTimingDiv").style.display = "block";
      $('#sunResultOpenTime').prop('required',true);
      $('#sunResultCloseTime').prop('required',true);
      $('#sunBetOpenTime').prop('required',true);
      $('#sunBetCloseTime').prop('required',true);
  };
});

function setFields()
{
  @isset($marketDetails)
      document.getElementsByName("marketId")[0].value='{{$marketDetails['id']}}';
      document.getElementsByName("isNGType")[0].value='{{$marketDetails['isNGType']}}';
      document.getElementsByName("marketName")[0].value='{{$marketDetails['name']}}';
      //weekday timings
      document.getElementsByName("weekdayResultOpenTime")[0].value='{{$marketDetails['weekdayResultOpen']}}';
      document.getElementsByName("weekdayResultCloseTime")[0].value='{{$marketDetails['weekdayResultClose']}}';
      document.getElementsByName("weekdayBetOpenTime")[0].value='{{$marketDetails['weekdayBetOpen']}}';
      document.getElementsByName("weekdayBetCloseTime")[0].value='{{$marketDetails['weekdayBetClose']}}';

      if("{{$marketDetails['satResultOpen']}}"!='' && "{{$marketDetails['satResultClose']}}"!='' 
          && "{{$marketDetails['satBetOpen']}}"!='' && "{{$marketDetails['satBetClose']}}"!=''){

          //saturday timings
          $('#satTimingRadio').prop('checked', true);
          $('#satTimingRadio').addClass("imChecked");
          $('#satTimingRadio').val('satActive');
          document.getElementById("satTimingDiv").style.display = "block";
          $('#satResultOpenTime').prop('required',true);
          $('#satResultCloseTime').prop('required',true);
          $('#satBetOpenTime').prop('required',true);
          $('#satBetCloseTime').prop('required',true);

          document.getElementsByName("satResultOpenTime")[0].value='{{$marketDetails['satResultOpen']}}';
          document.getElementsByName("satResultCloseTime")[0].value='{{$marketDetails['satResultClose']}}';
          document.getElementsByName("satBetOpenTime")[0].value='{{$marketDetails['satBetOpen']}}';
          document.getElementsByName("satBetCloseTime")[0].value='{{$marketDetails['satBetClose']}}';
      }

      if("{{$marketDetails['sunResultOpen']}}"!='' && "{{$marketDetails['sunResultClose']}}"!='' 
          && "{{$marketDetails['sunBetOpen']}}"!='' && "{{$marketDetails['sunBetClose']}}"!=''){

          //sunday timings
          $('#sunTimingRadio').prop('checked', true);
          $('#sunTimingRadio').addClass("imChecked");
          $('#sunTimingRadio').val('sunActive');
          document.getElementById("sunTimingDiv").style.display = "block";
          $('#sunResultOpenTime').prop('required',true);
          $('#sunResultCloseTime').prop('required',true);
          $('#sunBetOpenTime').prop('required',true);
          $('#sunBetCloseTime').prop('required',true);

          document.getElementsByName("sunResultOpenTime")[0].value='{{$marketDetails['sunResultOpen']}}';
          document.getElementsByName("sunResultCloseTime")[0].value='{{$marketDetails['sunResultClose']}}';
          document.getElementsByName("sunBetOpenTime")[0].value='{{$marketDetails['sunBetOpen']}}';
          document.getElementsByName("sunBetCloseTime")[0].value='{{$marketDetails['sunBetClose']}}';
      }
      if('{{$marketDetails['isActive']}}'==1)
      {
        $('#isActive').prop("checked",true).change();
      }
      else
      {
        $('#isActive').prop("checked",false).change();
      }

      if('{{$marketDetails['isNGType']}}'==1)
      {
        $('#weekDayResultCloseDiv').toggle('slow', function() {});
        $('#weekDayBetCloseDiv').toggle('slow', function() {});
        $('#satResultCloseDiv').toggle('slow', function() {});
        $('#satBetCloseDiv').toggle('slow', function() {});
        $('#sunResultCloseDiv').toggle('slow', function() {});
        $('#sunBetCloseDiv').toggle('slow', function() {});
      }
      
  @endisset
}
</script>
@if(Session::has('status'))
    @if(Session::get('status'))
      <script>alert('data updated!')</script>
    @else <script>alert('failed to update data!')</script>
    @endif
  @endif
@endsection