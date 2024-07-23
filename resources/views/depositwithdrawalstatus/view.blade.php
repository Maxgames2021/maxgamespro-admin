@extends('layouts.master')

@section('title')
    Max Games | Update Deposit/Withdrawal Status
@endsection

@section('content')

<!-- main-content -->
<div class="content-body">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">Update Deposit/Withdrawal Status</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Management
              </li>
              <li class="breadcrumb-item active">Update Deposit/Withdrawal Status
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-body">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title" id="basic-layout-form">Deposit/Withdrawal Status</h4>
              <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                </ul>
              </div>
            </div>
          <div class="card-body collapse in">
            <div class="card-block">
            <form class="form" action="/depositwithdrawalstatus" method="POST">
              {{ csrf_field() }}
                <div class="form-body">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="projectinput1">Transaction Type</label>
                          <select name="selectedTransactionType" class="form-control" onchange="GetStatus(this.value)">
                            <option value="">-- select --</option>
                            @isset($depositwithdrawalstatus)
                            @foreach($depositwithdrawalstatus as $dwstatus)
                              <option value="{{ $dwstatus['id'] }}">{{ $dwstatus['transactionType'] }}</option>
                            @endforeach
                            @endisset
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="projectinput1">Status</label>
                          <select name="transactionStatus" id="transactionStatus" class="form-control">
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="projectinput1">Min Amount</label>
                          <input type="text" name="minAmount" id="minAmount" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="projectinput1">Message</label>
                          <textarea maxlength="1000" name="message" id="message" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                    <div id="upiDiv" class="row" style="display:none">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="projectinput1">Payee Address</label>
                            <input name="payeeAddress" id="payeeAddress" class="form-control"/>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="projectinput1">Payee Name</label>
                            <input name="payeeName" id="payeeName" class="form-control"/>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="projectinput1">Merchant Code</label>
                            <input name="merchantCode" id="merchantCode" class="form-control"/>
                          </div>
                        </div>
                      </div>
                  </div>

                <div class="form-actions">
                  <button onclick="window.location='{{url('depositwithdrawalstatus')}}'" type="button" class="btn btn-warning mr-1">
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
<script type="text/javascript">
    function GetStatus(period) {
      if(period!="")
      {
        var sel = $("#transactionStatus");
        sel.empty();
        if(period==1)// deposit
        {
          sel.append($('<option>', {
                                value: '0',
                                text: 'OFF'
                            }));
          sel.append($('<option>', {
                                value: '1',
                                text: 'ONLINE'
                            }));
          sel.append($('<option>', {
                                value: '2',
                                text: 'MANUAL'
                            }));
          sel.append($('<option>', {
                                value: '3',
                                text: 'ONLINE + MANUAL'
                            }));
          
          $("#upiDiv").show();
        }
        else if(period==2)
        {
          sel.append($('<option>', {
                                value: '0',
                                text: 'OFF'
                            }));
          sel.append($('<option>', {
                                value: '1',
                                text: 'ON'
                            }));

          $("#upiDiv").hide();
        }
        
        $.ajax({
        type: "GET",
        url: '/depositwithdrawalstatus/'+period
        }).done(function( data ) {
            sel.val(data["status"]);
            $("#minAmount").val(data["minAmount"]);
            $("#message").val(data["message"]);
            $("#payeeAddress").val(data["payeeAddress"]);
            $("#payeeName").val(data["payeeName"]);
            $("#merchantCode").val(data["merchantCode"]);
        }).fail(function() {
            alert('failed to load data!');
        });
      }
      else
      {
        alert('Please select transaction type.');
      }
  }
</script>
@if(Session::has('status'))
    @if(Session::get('status'))
      <script>alert('data updated!')</script>
    @else <script>alert('failed to update data!')</script>
    @endif
  @endif
@endsection
