@extends('layouts.master')

@section('title')
    Max Games | Markets
@endsection

@section('content')

<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">Create Market</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Market
              </li>
              </li>
              <li class="breadcrumb-item active">Create Market
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
            <form class="form" action="/market/createmarketrequest" method="POST">
              {{ csrf_field() }}
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Market Name</label>
                        <input type="text" required name="marketName" class="form-control" placeholder="Market Name" name="fname">
                      </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Is North Game</label>
                          <div>
                            <input id="isNGType" onchange="toggleCloseTime(this)" name="isNGType" value="1" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger"> 
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
                            <input required type="time" name="weekdayResultOpenTime" value="09:00" class="form-control" placeholder="open time" name="email">
                          </div>
                        </div>
                        <div id="weekDayResultCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input required type="time" name="weekdayResultCloseTime" value="11:00" class="form-control" placeholder="close time" name="email">
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
                            <input required type="time" name="weekdayBetOpenTime" value="08:50" class="form-control" placeholder="open time" name="email">
                          </div>
                        </div>
                        <div id="weekDayBetCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input required type="time" name="weekdayBetCloseTime" value="10:50" class="form-control" placeholder="close time" name="email">
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
                            <input type="time" id="satResultOpenTime" name="satResultOpenTime" value="09:00" class="form-control" placeholder="open time" name="email">
                          </div>
                        </div>
                        <div id="satResultCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input type="time" id="satResultCloseTime" name="satResultCloseTime" value="11:00" class="form-control" placeholder="close time" name="email">
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
                            <input type="time" id="satBetOpenTime" name="satBetOpenTime" value="08:50" class="form-control" placeholder="open time" name="email">
                          </div>
                        </div>
                        <div id="satBetCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input type="time" id="satBetCloseTime" name="satBetCloseTime" value="10:50" class="form-control" placeholder="close time" name="email">
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
                            <input type="time" id="sunResultOpenTime" name="sunResultOpenTime" value="09:00" class="form-control" placeholder="open time" name="email">
                          </div>
                        </div>
                        <div id="sunResultCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input type="time" id="sunResultCloseTime" name="sunResultCloseTime" value="11:00" class="form-control" placeholder="close time" name="email">
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
                            <input type="time" id="sunBetOpenTime" name="sunBetOpenTime" value="08:50" class="form-control" placeholder="open time" name="email">
                          </div>
                        </div>
                        <div id="sunBetCloseDiv" class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput4">Close Time</label>
                            <input type="time" id="sunBetCloseTime" name="sunBetCloseTime" value="10:50" class="form-control" placeholder="close time" name="email">
                          </div>	
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-actions">
                  <button onclick="window.location='{{url('market/createmarketform')}}'" type="button" class="btn btn-warning mr-1">
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

function refreshPage(){
    window.location.reload();
}

function toggleCloseTime(checkboxElem) {
  if (checkboxElem.checked) {
    $('#weekDayResultCloseDiv').toggle('slow', function() {});
    $('#weekDayBetCloseDiv').toggle('slow', function() {});
    $('#satResultCloseDiv').toggle('slow', function() {});
    $('#satBetCloseDiv').toggle('slow', function() {});
    $('#sunResultCloseDiv').toggle('slow', function() {});
    $('#sunBetCloseDiv').toggle('slow', function() {});
  } else {
    $('#weekDayResultCloseDiv').toggle('slow', function() {});
    $('#weekDayBetCloseDiv').toggle('slow', function() {});
    $('#satResultCloseDiv').toggle('slow', function() {});
    $('#satBetCloseDiv').toggle('slow', function() {});
    $('#sunResultCloseDiv').toggle('slow', function() {});
    $('#sunBetCloseDiv').toggle('slow', function() {});
  }
}
</script>
@if(Session::has('status'))
    @if(Session::get('status'))
      <script>alert('market created!')</script>
    @else <script>alert('failed to create market!')</script>
    @endif
  @endif
@endsection