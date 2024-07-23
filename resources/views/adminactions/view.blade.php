@extends('layouts.master')

@section('title')
    Max Games | Admin Actions Log
@endsection

@section('content')
    <!-- main-content -->
    <div class="content-body">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
                <h2 class="content-header-title">Admin Actions Log</h2>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
                <div class="breadcrumb-wrapper col-xs-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Management
                        </li>
                        <li class="breadcrumb-item active">Admin Actions Log
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Select Options</h4>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        {{-- as per logic of AdjustCurrentDate function from DB --}}
                                        <input class="form-control" type="date" name="dateInput" id="dateInput"
                                            max="{{ date('Y-m-d', strtotime(date('Y-m-d h:i:sa')) - 60 * 30) }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Action Type</label>
                                        <select id="actionTypeSelect" name="actionTypeSelect" class="form-control">
                                            @isset($initialData['actionTypes'])
                                                @foreach ($initialData['actionTypes'] as $actionType)
                                                    <option value="{{ $actionType['id'] }}">{{ $actionType['name'] }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Admin User</label>
                                        <select id="adminUserSelect" name="adminUserSelect" class="form-control">
                                            @isset($initialData['adminUsers'])
                                                @foreach ($initialData['adminUsers'] as $adminUser)
                                                    <option value="{{ $adminUser['id'] }}">{{ $adminUser['username'] }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="float:right;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary" onclick="GetLogs();">Get Logs</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="divResultDeclareLogs" class="content-body" style="display:none">
            <!-- Basic Tables start -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Result Declare Logs</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                    <li><a href="{{ url('adminactions') }}"><i
                                                class="icon-cross2"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block card-dashboard">
                                <div class="table-responsive">
                                    <table id="tableResultDeclareLogs" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Admin User</th>
                                                <th>Date</th>
                                                <th>Market Name</th>
                                                <th>Market Result</th>
                                                <th>Status</th>
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
            <!-- Basic Tables end -->
        </div>

        <div id="divTransactionLogs" class="content-body" style="display:none">
            <!-- Basic Tables start -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Transaction Logs</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                    <li><a href="{{ url('adminactions') }}"><i
                                                class="icon-cross2"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block card-dashboard">
                                <div class="table-responsive">
                                    <table id="tableTransactionLogs" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Transaction Id</th>
                                                <th>Initiated By</th>
                                                <th>Initiated For</th>
                                                <th>Amount</th>
                                                <th>Request Time</th>
                                                <th>Transaction Status</th>
                                                <th>Processed By</th>
                                                <th>Processed Time</th>
                                                <th>PaymentMode Id</th>
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
        $(document).ready(function() {
            $('#tableBettings').DataTable({
                "iDisplayLength": 100
            });
        });

    </script>

    <script type="text/javascript">
        function GetLogs() {
            var date = document.getElementById("dateInput").value;
            if (date != '' && date != null) {
                var actionType = document.getElementById("actionTypeSelect").value;
                var adminUserId = document.getElementById("adminUserSelect").value;

                $.ajax({
                    type: "GET",
                    url: '/adminactions/loadlogs?date=' + date + '&actionType=' + actionType + '&adminUserId=' + adminUserId
                }).done(function(data) {
                    if(actionType != 7)
                    {
                        $("#tableTransactionLogs").DataTable().clear();
                        $("#tableTransactionLogs").DataTable().destroy();
                        for (var i = 0; i < data.length; i++) {
                            $("#tableTransactionLogs").find('tbody')
                            .append('<tr><td>' +
                                data[i]['transactionId'] + '</td><td>' +
                                data[i]['initiatedBy'] + '</td><td>' +
                                data[i]['initiatedFor'] + '</td><td>' +
                                data[i]['amount'] + '</td><td>' +
                                data[i]['requestTime'] + '</td><td>' +
                                data[i]['transactionStatus'] + '</td><td>' +
                                (data[i]['processedBy'] == null ? '' : data[i]['processedBy']) + '</td><td>' +
                                (data[i]['processedTime'] == null ? '' : data[i]['processedTime']) + '</td><td>' +
                                (data[i]['modeTransactionId'] == null ? '' : data[i]['modeTransactionId'])
                                + '</td></tr>'
                            );
                        }
                        $('#tableTransactionLogs').DataTable({
                            "iDisplayLength": 100
                        }).draw();
                        $("#divResultDeclareLogs").hide();
                        $("#divTransactionLogs").show();
                    }
                    else
                    {
                        $("#tableResultDeclareLogs").DataTable().clear();
                        $("#tableResultDeclareLogs").DataTable().destroy();
                        for (var i = 0; i < data.length; i++) {
                            $("#tableResultDeclareLogs").find('tbody')
                            .append('<tr><td>' +
                                data[i]['id'] + '</td><td>' +
                                data[i]['adminName'] + '</td><td>' +
                                data[i]['actionDate'] + '</td><td>' +
                                data[i]['marketName'] + '</td><td>' +
                                data[i]['marketResult'] + '</td><td>' +
                                data[i]['actionStatus']
                                + '</td></tr>'
                            );
                        }
                        $('#tableResultDeclareLogs').DataTable({
                            "iDisplayLength": 100
                        }).draw();
                        $("#divTransactionLogs").hide();
                        $("#divResultDeclareLogs").show();
                    }
                }).fail(function() {
                    alert('failed to load data!');
                });

            } else {
                alert('Please select a date.');
            }
        }

        // function LoadBettings(period) {
        //     if (period != "") {
        //         var date = document.getElementById("dateInput").value;
        //         $.ajax({
        //             type: "GET",
        //             url: '/gametransaction/loadbetanalysis/' + period + "?date=" + date
        //         }).done(function(data) {
        //             $("#tableBettings").DataTable().clear();
        //             $("#tableBettings").DataTable().destroy();
        //             var totalAmt = 0;
        //             for (var i = 0; i < data.length; i++) {
        //                 $("#tableBettings").find('tbody').append('<tr><td>' + data[i]['betNumber'] + '</td><td>' +
        //                     data[i]['betsMade'] + '</td><td>' + data[i]['betAmount'] + '</td></tr>');
        //                 totalAmt = totalAmt + parseFloat(data[i]['betAmount']);
        //             }
        //             $('#tableBettings').DataTable({
        //                 "iDisplayLength": 100
        //             }).draw();
        //             $("#divBettings").show();
        //             document.getElementById("totalBetAmount").innerHTML = "Total Bet Amount: " + totalAmt;
        //         }).fail(function() {
        //             alert('failed to load data!');
        //         });
        //     } else {
        //         $("#divBettings").hide();
        //     }
        // }

    </script>
@endsection
