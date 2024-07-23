@extends('layouts.master')

@section('title')
    Max Games | Bet Details
@endsection

@section('content')
    <!-- main-content -->
    <div class="content-body">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
                <h2 class="content-header-title">Refund Bets</h2>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
                <div class="breadcrumb-wrapper col-xs-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Refund Bets
                        </li>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Refund Bet</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <form cclass="form" method="POST" onSubmit="return Confirmation(event);">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select id="selectedMarket" name="selectedMarket" class="form-control">
                                            @isset($markets)
                                                @foreach($markets as $market)
                                                    @if($market['isActive']==1)
                                                        <option value="{{ $market['id'] }}">{{ $market['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button onclick="window.location='{{url('gametransaction/betrefund')}}'"
                                        type="button" class="btn btn-warning mr-1">
                                    <i class="icon-cross2"></i> Cancel
                                </button>
                                <button type="submit" name="save" class="btn btn-primary" formaction="/gametransaction/betrefund">
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
        function Confirmation(e) {
            var marketName = document.getElementById('selectedMarket').options[document.getElementById('selectedMarket').selectedIndex].text;
            return confirm("Initiating refund for '" + marketName + "'. Press Ok to continue.");
        }
    </script>
    @if(Session::has('status'))
        @if(Session::get('status'))
            <script>alert('data updated!')</script>
        @else
            <script>alert('failed to update data!')</script>
        @endif
    @endif
@endsection
