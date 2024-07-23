@extends('layouts.master')

@section('title')
    Max Games | Offers
@endsection

@section('content')


<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">Close Offers</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Offers
              </li>
              </li>
              <li class="breadcrumb-item active">Close
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
                          <h4 class="card-title">Registered Offers</h4>
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
                                          <th>Offer Name</th>
                                          <th>Description</th>
                                          <th>Created On</th>
                                          <th>Closed On</th>
                                          <th>Active</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($offers as $offer)
                                      <tr>
                                          <td>{{$offer['name']}}</td>
                                          <td><textarea disabled>{{$offer['description']}}</textarea></td>
                                          <td>{{$offer['dateCreated']}}</td>
                                          <td>{{$offer['dateClosed']}}</td>
                                          @if($offer['isActive']==1)
                                            <td>Yes</td>
                                          <form action="/offer/closeofferrequest/{{$offer['id']}}" method="POST">
                                          {{ csrf_field() }}
                                          <td style='text-align:center;'>
                                          <button type="submit" style="bg-color:blue" class="btn btn-danger">Close</button>                                          </td>
                                          </form>
                                          @endif
                                          @if($offer['isActive']==0)
                                            <td>No</td>
                                          <form action="" method="POST">
                                          {{ csrf_field() }}
                                          <td style='text-align:center;'>
                                          <button disabled type="submit" style="bg-color:blue" class="btn btn-danger">Close</button>                                          </td>
                                          </form>
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
      $('#example').DataTable(
        {
        "order": [[ 4, "desc" ]]
      }
      );
  } );
</script>
@if(Session::has('status'))
    @if(Session::get('status'))
      <script>alert('data updated!')</script>
    @else <script>alert('failed to update data!')</script>
    @endif
  @endif
@endsection