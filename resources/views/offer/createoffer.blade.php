@extends('layouts.master')

@section('title')
    Max Games | Offers
@endsection

@section('content')

<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">Create Offer</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Offer
              </li>
              </li>
              <li class="breadcrumb-item active">Create Offer
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-body">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title" id="basic-layout-form">Offer Info</h4>
              <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                </ul>
              </div>
            </div>
          <div class="card-body collapse in">
            <div class="card-block">
            <form class="form" action="/offer/createofferrequest" method="POST">
              {{ csrf_field() }}
                <div class="form-body">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput1">Offer Name</label>
                          <input type="text" required name="offerName" class="form-control" placeholder="Offer Name">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput1">Offer Description</label>
                          <textarea required name="offerDescription" class="form-control" placeholder="Offer Description" maxlength="1000"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                <div class="form-actions">
                  <button onclick="window.location='{{url('offer/createofferform')}}'" type="button" class="btn btn-warning mr-1">
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
<script src="/app-assets/js/core/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/jquery.dataTables.min.js" type="text/javascript"></script>
@if(Session::has('status'))
    @if(Session::get('status'))
      <script>alert('offer created!')</script>
    @else <script>alert('failed to create offer!')</script>
    @endif
  @endif
@endsection