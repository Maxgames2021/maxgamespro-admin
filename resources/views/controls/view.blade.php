@extends('layouts.master')

@section('title')
    Max Games | Controls
@endsection

@section('content')

<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">Admin Controls</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Controls
              </li>
              </li>
              <li class="breadcrumb-item active">Admin Controls
              </li>
            </ol>
          </div>
        </div>
      </div>
      @isset($controlsData)
      <div class="content-body">
          <div class="row">
              <div class="col-xs-12">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Market Result Controls</h4>
                      </div>
                      <div class="card-body collapse in">
                          <div class="card-block card-dashboard">
                            <form cclass="form" method="POST">
                              {{ csrf_field() }}
                              <div class="form-body">
                                  <div class="row">
                                      <div class="col-lg-10">
                                        @if($controlsData['marketResultCreated']==1)
                                          <h5><strong>Market Result already created for the day.</strong></h5>
                                        @else
                                          <h5><strong>Market Result not yet created for the day.</strong></h5>
                                        @endif
                                      </div>
                                  </div>
                              </div>
                              <div class="form-actions">
                                @if($controlsData['marketResultCreated']!=1)
                                  <button type="submit" name="save" class="btn btn-primary" formaction="/controls/marketresultcreatetrigger">
                                      <i class="icon-check2"></i> Create Market Results
                                  </button>
                                @endif
                              </div>
                            </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="content-body">
          <div class="row">
              <div class="col-xs-12">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">DBCleanup Controls</h4>
                      </div>
                      <div class="card-body collapse in">
                          <div class="card-block card-dashboard">
                            <form cclass="form" method="POST">
                              {{ csrf_field() }}
                              <div class="form-body">
                                  @if($controlsData['dbCleanedUp'] != 1)
                                  <div class="row">
                                      <div class="col-lg-10">
                                          <h5><strong>DB cleanup not yet done for the day.</strong></h5>
                                      </div>
                                  </div>
                                  @else
                                  <div class="row">
                                      <div class="col-lg-10">
                                          <h5><strong>DB cleanup already done for the day.</strong></h5>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label>Deposit Transactions Archived : {{$controlsData['depositTransactionsArchived']}}</label>
                                      </div>
                                      <div class="col-md-4">
                                          <label>Withdrawal Transactions Archived : {{$controlsData['withdrawalTransactionArchived']}}</label>
                                      </div>
                                      <div class="col-md-4">
                                          <label>Game Transactions Archived : {{$controlsData['gameTransactionsArchived']}}</label>
                                      </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4">
                                          <label>Deposit Transactions Archive Delete : {{$controlsData['depositTransactionsArchiveDeleted']}}</label>
                                      </div>
                                      <div class="col-md-4">
                                          <label>Withdrawal Transactions Archive Delete : {{$controlsData['withdrawalTransactionsArchiveDeleted']}}</label>
                                      </div>
                                      <div class="col-md-4">
                                          <label>Game Transactions Archive Delete : {{$controlsData['gameTransactionsArchiveDeleted']}}</label>
                                      </div>
                                  </div>
                                  @endif
                              </div>
                              <div class="form-actions">
                                @if($controlsData['dbCleanedUp']!=1)
                                  <button type="submit" name="save" class="btn btn-primary" formaction="/controls/dbcleanuptrigger">
                                      <i class="icon-check2"></i> Start DB Cleanup
                                  </button>
                                @endif
                              </div>
                            </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="content-body">
          <div class="row">
              <div class="col-xs-12">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Inactive User Delete Threshold Controls</h4>
                      </div>
                      <div class="card-body collapse in">
                          <div class="card-block card-dashboard">
                            <form cclass="form" method="POST">
                              {{ csrf_field() }}
                              <div class="form-body">
                                  <div class="row">
                                      <div class="col-lg-10">
                                          <div style="display:inline-block"><label>Delete inactive user created before</label></div>
                                          <div style="display:inline-block"><input type="text" required name="thresholdValue" class="form-control" value="{{$controlsData['userDeleteThresholdValue']}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></div> 
                                          <div style="display:inline-block"><label>{{$controlsData['userDeleteThresholdDescription']}}.</label></div>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-actions">
                                  <button type="submit" name="save" class="btn btn-primary" formaction="/controls/inactiveuserthreshold">
                                      <i class="icon-check2"></i> Save
                                  </button>
                              </div>
                            </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      @endisset
</div>
<!-- main-content -->
@endsection

@section('scripts')
<script src="/app-assets/js/core/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/jquery.dataTables.min.js" type="text/javascript"></script>

@if(Session::has('status'))
    @if(Session::get('status'))
      <script>alert('data updated!')</script>
    @else <script>alert('failed to update data!')</script>
    @endif
  @endif
@endsection
