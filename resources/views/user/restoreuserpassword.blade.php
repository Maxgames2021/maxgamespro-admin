@extends('layouts.master')

@section('title')
    Max Games | Restore Password
@endsection

@section('content')

<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">Restore User Password</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Management
              </li>
              <li class="breadcrumb-item active">Restore Password
              </li>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-body">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title" id="basic-layout-form">User Info</h4>
              <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                </ul>
              </div>
            </div>
          <div class="card-body collapse in">
            <div class="card-block">
            <form class="form" action="/user/restoreuserpasswordrequest" method="POST">
              {{ csrf_field() }}
                <div class="form-body">
                  <div class="row">
                  <div class="col-sm-2">
                    <div id="selectDiv" class="form-group">
                      <label for="projectinput1">Select User</label>
                      <select id="selectUser" name="selectUser" required class="selectpicker form-control" data-live-search="true">
                      </select>
                    </div>
                  </div>
                  </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="projectinput1">Password</label>
                          <input type="password" id="password" required name="password" class="form-control" placeholder="enter password">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="projectinput1">Confirm Password</label>
                          <input type="password" id="confirmPassword" required name="confirmPassword" class="form-control" placeholder="re-enter password" onkeyup='check();'><span id='message'></span>
                        </div>
                      </div>
                    </div>
                  </div>

                <div class="form-actions">
                  <button onclick="window.location='{{url('user/restoreuserpassword')}}'" type="button" class="btn btn-warning mr-1">
                    <i class="icon-cross2"></i> Cancel
                  </button>
                  <button id="submitbtn" type="submit" class="btn btn-primary">
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
<script src="/app-assets/js/core/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/bootstrap-select.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  var currentRequest = null;
  $('#selectUser').selectpicker('refresh');
    $('#selectDiv .form-control').on('keyup', function (e) {
        $('#selectUser').empty();
        if($(this).val().length>=1) {
          if(currentRequest != null) 
          {
              currentRequest.abort();
          }
          currentRequest = $.ajax({
                type: "GET",
                url: '/user/userlist?searchText=' + $(this).val()
            }).done(function(data) {
              currentRequest = null;
                $('#selectedUser').empty();
                $.each(data, function(index) {
                    $('#selectUser').append($('<option>', {
                         value: data[index].id,
                         text: data[index].username
                    }));
                });
                $('#selectUser').selectpicker('refresh');
            }).fail(function(jqXHR) {
                        if(jqXHR.status != 0)
                            alert('failed to load data!');
            });
        }
        $('#selectUser').selectpicker('refresh');
    });
});
</script>
<script type="text/javascript">
    function check() {
      var password = document.getElementById('password').value;
      var confirmPassword = document.getElementById('confirmPassword').value;

      if (password == confirmPassword) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'password matching.';
        document.getElementById('submitbtn').disabled = false;
      } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = "password is not matching";
        document.getElementById('submitbtn').disabled = true;
      }
      document.getElementById('password').value = password;
      document.getElementById('confirmPassword').value = confirmPassword;
    }
  </script>
@if(Session::has('status'))
    @if(Session::get('status'))
      <script>alert('password restored!')</script>
    @else <script>alert('failed to restore password!')</script>
    @endif
  @endif
@endsection
