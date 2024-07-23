@extends('layouts.master')

@section('title')
    Max Games | User Detail
@endsection

@section('content')

    <!-- main-content -->
    <div class="content-body">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
                <h2 class="content-header-title">User Detail</h2>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
                <div class="breadcrumb-wrapper col-xs-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">User
                        </li>
                        <li class="breadcrumb-item active">User Detail
                        </li>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Select User</h4>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div id="selectDiv" class="form-group">
                                        <label for="projectinput1">Select User</label>
                                        <select name="selectedUser" id="selectedUser" required class="selectpicker form-control" data-live-search="true">
                                        </select>
                                        <input type="hidden" id="selectedUserId">
                                        <input type="hidden" id="depositLoaded" value=0>
                                        <input type="hidden" id="withdrawalLoaded" value=0>
                                        <input type="hidden" id="gameTransactionLoaded" value=0>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="float:right;">
                            <div class="col-md-12">
                                <div class="form-actions">
                                    <button id="submitbtn" class="btn btn-primary" onclick="GetDetail();">Load
                                        Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="masterCardDiv" class="content-body" style="display: none;">
            <div class="card">
                <div class="card-header" style="border: none;">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <button class="nav-link" id="userDetailGet">User Details</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="depositGet">Deposit Transaction</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="withdrawalGet">Withdrawal Transaction</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="gameTransactionGet">Game Transaction</button>
                        </li>
                    </ul>
                    <!-- <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a> -->
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            <li><a href="{{ url('user/userdetail') }}"><i class="icon-cross2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <div id="userDetailsDiv" class="form-body" style="display: none;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">Username</label>
                                        <input type="text" readonly id="inputUsername" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">BeneficiaryIn</label>
                                        <input type="text" id="beneficiaryIn" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button id="beneficiaryInUpdate" class="btn btn-primary">update</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">First Name</label>
                                        <input type="text" readonly id="inputFirstName" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">Last Name</label>
                                        <input type="text" readonly id="inputLastName" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">Contact No.</label>
                                        <input type="text" readonly id="inputContactNo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">Balance</label>
                                        <input type="text" readonly id="inputBalance" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">UPI Id</label>
                                        <input type="text" readonly id="inputUpiId" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">Account No.</label>
                                        <input type="text" readonly id="inputAccountNo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">IFSC Code</label>
                                        <input type="text" readonly id="inputIfscCode" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">Account Holder Name</label>
                                        <input type="text" readonly id="inputAccountHolderName" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">Bank Name</label>
                                        <input type="text" readonly id="inputBankName" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="projectinput1">Bank Branch</label>
                                        <input type="text" readonly id="inputBankBranch" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="depositDiv" class="table-responsive" style="display: none;">
                            <table id="depositTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Request Time</th>
                                        <th>Deposited By</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Status</th>
                                        <th>Closing Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div id="withdrawalDiv" class="table-responsive" style="display: none;">
                            <table id="withdrawalTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Request Time</th>
                                        <th>Withdrawn By</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Status</th>
                                        <th>Closing Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div id="gameTransactionDiv" class="table-responsive" style="display: none;">
                            <table id="gameTransactionTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- <th>Id</th> -->
                                        <th>Bet Time</th>
                                        <th>Game</th>
                                        <th>Bet Number</th>
                                        <th>Bet Amount</th>
                                        <th>Closing Balance</th>
                                        <th>Status</th>
                                        <th>Winning Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
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
            $('#selectedUser').selectpicker('refresh');
            $('#selectDiv .form-control').on('keyup', function (e) {
                $('#selectedUser').empty();
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
                            $('#selectedUser').append($('<option>', {
                                value: data[index].id,
                                text: data[index].username
                            }));
                        });
                        $('#selectedUser').selectpicker('refresh');
                    })
                    .fail(function(jqXHR) {
                        if(jqXHR.status != 0)
                            alert('failed to load data!');
                    });
                }
                $('#selectedUser').selectpicker('refresh');
            });

            $("#beneficiaryInUpdate").on("click",function(){

                if(document.getElementById("selectedUser").value == null || document.getElementById("beneficiaryIn").value == null)
                {
                    alert("field is empty");
                }

                data = { 
                    userId: document.getElementById("selectedUser").value,
                    isBeneficiaryIn : document.getElementById("beneficiaryIn").value
                };

                $.ajax({
                    url: '/user/beneficiarydetail',
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    headers: {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                }).done(function(data) {
                    alert("updated");
                }).fail(function() {
                    alert('failed!');
                });
            });
        });

    </script>
    <script type="text/javascript">
        function GetDetail() {
            $("#selectedUserId").val(document.getElementById("selectedUser").value);
            $("#gameTransactionLoaded").val(0);
            $("#withdrawalLoaded").val(0);
            $("#depositLoaded").val(0);
            document.getElementById("inputUsername").value = "";
            document.getElementById("inputFirstName").value = "";
            document.getElementById("inputLastName").value = "";
            document.getElementById("inputContactNo").value = "";
            document.getElementById("inputBalance").value = "";
            document.getElementById("inputUpiId").value = "";
            document.getElementById("inputAccountNo").value = "";
            document.getElementById("inputIfscCode").value = "";
            document.getElementById("inputAccountHolderName").value = "";
            document.getElementById("inputBankName").value = "";
            document.getElementById("inputBankBranch").value = "";
            document.getElementById("beneficiaryIn").value = "";
            

            $("#depositTable").DataTable().clear();
            $("#depositTable").DataTable().destroy();

            $("#withdrawalTable").DataTable().clear();
            $("#withdrawalTable").DataTable().destroy();

            $("#gameTransactionTable").DataTable().clear();
            $("#gameTransactionTable").DataTable().destroy();

            $.ajax({
                type: "GET",
                url: '/user/userdetailbyid?id=' + document.getElementById("selectedUser").value
            }).done(function(data) {

                document.getElementById("inputUsername").value = data['username'];
                document.getElementById("inputFirstName").value = data['firstName'];
                document.getElementById("inputLastName").value = data['lastName'];
                document.getElementById("inputContactNo").value = data['contactNumber'];
                document.getElementById("inputBalance").value = data['balance'];
                document.getElementById("inputUpiId").value = data['userUPIId'];
                document.getElementById("inputAccountNo").value = data['accountNumber'];
                document.getElementById("inputIfscCode").value = data['ifscCode'];
                document.getElementById("inputAccountHolderName").value = data['accountHolderName'];
                document.getElementById("inputBankName").value = data['bankName'];
                document.getElementById("inputBankBranch").value = data['branchName'];
                document.getElementById("beneficiaryIn").value = data['isBeneficiaryIn'];
                
                $(".nav button").removeClass("active");
                $("#userDetailGet").addClass("active");
                $('#userDetailsDiv').show();
                $('#masterCardDiv').show();
            }).fail(function() {
                alert('failed to load data!');
            });
        }

    </script>
    <script>
        $("#userDetailGet").on("click",function(){
            
            $('#depositDiv').hide();
            $('#withdrawalDiv').hide();
            $('#gameTransactionDiv').hide();
            $('#userDetailsDiv').show();

            $(".nav button").removeClass("active");
            $(this).addClass("active");
        });

        $("#depositGet").on("click",function(){
            $('#withdrawalDiv').hide();
            $('#gameTransactionDiv').hide();
            $('#userDetailsDiv').hide();
            $('#depositDiv').show();

            $(".nav button").removeClass("active");
            $(this).addClass("active");

            if($("#depositLoaded").val()==0)
            {
                $("#depositLoaded").val(1);
                $.ajax({
                    type: "GET",
                    url: '/user/deposittransactions?userId='+$("#selectedUserId").val()
                }).done(function( data ) {
                    $("#depositTable").DataTable().clear();
                    $("#depositTable").DataTable().destroy();
                    for (var i=0; i<data.length; i++) {
                        $("#depositTable")
                        .find('tbody')
                        .append('<tr><td>'+data[i]['id']+
                                '</td><td>'+data[i]['requestTime']+
                                '</td><td>'+data[i]['depositedBy']+
                                '</td><td>'+data[i]['amount']+
                                '</td><td>'+data[i]['paymentMode']+
                                '</td><td>'+data[i]['status']+
                                '</td><td>'+data[i]['closingBalance']+
                                '</td></tr>');
                    }
                    $('#depositTable').DataTable({"iDisplayLength": 100,"ordering": false}).draw();
                }).fail(function() {
                    alert('failed to load data!');
                });
            }

        });

        $("#withdrawalGet").on("click",function(){
            $('#gameTransactionDiv').hide();
            $('#userDetailsDiv').hide();
            $('#depositDiv').hide();
            $('#withdrawalDiv').show();

            $(".nav button").removeClass("active");
            $(this).addClass("active");

            if($("#withdrawalLoaded").val()==0)
            {
                $("#withdrawalLoaded").val(1);
                $.ajax({
                    type: "GET",
                    url: '/user/withdrawaltransactions?userId='+$("#selectedUserId").val()
                }).done(function( data ) {
                    $("#withdrawalTable").DataTable().clear();
                    $("#withdrawalTable").DataTable().destroy();
                    for (var i=0; i<data.length; i++) {
                        $("#withdrawalTable")
                        .find('tbody')
                        .append('<tr><td>'+data[i]['id']+
                                '</td><td>'+data[i]['requestTime']+
                                '</td><td>'+data[i]['withdrawnBy']+
                                '</td><td>'+data[i]['amount']+
                                '</td><td>'+data[i]['paymentMode']+
                                '</td><td>'+data[i]['status']+
                                '</td><td>'+data[i]['closingBalance']+
                                '</td></tr>');
                    }
                    $('#withdrawalTable').DataTable({"iDisplayLength": 100,"ordering": false}).draw();
                }).fail(function() {
                    alert('failed to load data!');
                });
            }
        });

        $("#gameTransactionGet").on("click",function(){
            $('#userDetailsDiv').hide();
            $('#depositDiv').hide();
            $('#withdrawalDiv').hide();
            $('#gameTransactionDiv').show();

            $(".nav button").removeClass("active");
            $(this).addClass("active");

            if($("#gameTransactionLoaded").val()==0)
            {
                $("#gameTransactionLoaded").val(1);
                $.ajax({
                    type: "GET",
                    url: '/user/gametransactions?userId='+$("#selectedUserId").val()
                }).done(function( data ) {
                    $("#gameTransactionTable").DataTable().clear();
                    $("#gameTransactionTable").DataTable().destroy();
                    for (var i=0; i<data.length; i++) {
                        var status = 'N.A.';
                        if(data[i]['status']==0)
                            status = 'Lose';
                        else if(data[i]['status']==1)
                            status = 'Win';
                        else if(data[i]['status']==2)
                            status = 'Pending';

                        $("#gameTransactionTable")
                        .find('tbody')
                        .append('<tr><td>'+data[i]['date']+' '+data[i]['time']+
                                '</td><td>'+data[i]['gameName']+
                                '</td><td>'+data[i]['betNumber']+
                                '</td><td>'+data[i]['betAmount']+
                                '</td><td>'+data[i]['closingBalance']+
                                '</td><td>'+status+
                                '</td><td>'+data[i]['winningAmount']+
                                '</td></tr>');
                    }
                    $('#gameTransactionTable').DataTable({"iDisplayLength": 100,"ordering": false}).draw();
                }).fail(function() {
                    alert('failed to load data!');
                });
            }
        });

    </script>
    @if (Session::has('status'))
        @if (Session::get('status'))
            <script>
                alert('password restored!')

            </script>
        @else <script>
                alert('failed to restore password!')

            </script>
        @endif
    @endif
@endsection
