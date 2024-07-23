@extends('layouts.master')

@section('title')
    Max Games | Game Transaction
@endsection

@section('content')
    <!-- Small modal -->
    <div id="marketSelectModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
         aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Select Report Options</h5>
                </div>
                <div class="modal-body">
                    <form class="form" action="/gametransaction/getexcelreportdata" method="POST">
                        {{ csrf_field() }}
                        <div>
                            <label>Market</label>
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
                        <div>
                            <label>Result Type</label>
                            <select name="selectedResultType" class="form-control">
                                <option value="1">Open</option>
                                <option value="0">Close</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-actions">
                            <button type="button" onclick="window.location='{{url('home')}}'"
                                    class="btn btn-warning mr-1">Close
                            </button>
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
                        <h2 class="content-header-title">Generate Excel Report</h2>
                    </div>
                    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
                        <div class="breadcrumb-wrapper col-xs-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Generate Excel Report
                                </li>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form">Excel Data</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <button onclick="printExcel()">print</button>
                                    <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                    <li><a href="{{url('gametransaction/excelreport')}}"><i class="icon-cross2"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block">
                                @if(isset($reportData) && isset($reportData['reportDataResult']))
                                    <input type="hidden" id="resultTypeText" value="{{$reportData['resultType']}}">
                                    <input type="hidden" id="marketName" value="{{$reportData['reportDataResult']['marketName']}}">
                                    <table id="excelData" class="table table-bordered">
                                        <tr>
                                            <td style="text-align: center">
                                                <h3><strong>{{$reportData['reportDataResult']['marketName']}}</strong></h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                        </tr>
                                        @if(isset($reportData['reportDataResult']['games']))
                                        @foreach($reportData['reportDataResult']['games'] as $games)
                                            <tr>
                                                <td>
                                                    <h4><strong>{{$games['gameName']}}</strong></h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h5><strong>Bet Number</strong></h5>
                                                </th>
                                                <th>
                                                    <h5><strong>Bet Amount</strong></h5>
                                                </th>
                                            </tr>
                                            @if(isset($games['bets']))
                                            @foreach($games['bets'] as $bets)
                                                <tr>
                                                    <td>
                                                        {{$bets['betNumber']}}
                                                    </td>
                                                    <td>
                                                        {{$bets['betAmount']}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @endif
                                            <tr>
                                                <td>
                                                    <strong>Total</strong>
                                                </td>
                                                <td>
                                                    <strong>{{$games['totalBetAmount']}}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </table>
                                @endif
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
                <script src="/app-assets/js/core/jquery.table2excel.min.js" type="text/javascript"></script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        @if(isset($markets) && !isset($reportData))
                        $('#marketSelectModal').modal('show');
                        @endif
                    });
                </script>
                <script>
                    function printExcel()
                    {
                        let date = new Date()
                        let fullDate = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate();
                        let fileName = document.getElementById("marketName").value+'_'+document.getElementById("resultTypeText").value+'_'+fullDate+'.xls'

                        $("#excelData").table2excel({
                            filename: fileName
                        });
                    }
                </script>
                @if(Session::has('status'))
                    @if(Session::get('status'))
                        <script>alert('data loaded!')</script>
                    @else
                        <script>alert('failed to load data!')</script>
    @endif
    @endif
@endsection
