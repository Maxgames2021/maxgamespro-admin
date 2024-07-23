@extends('layouts.master')

@section('title')
    Max Games | Dashboard
@endsection

@section('content')
<!-- main-content -->


<div class="content-body">
  <!-- stats -->
  <div class="row">
    <div class="col-xl-3 col-lg-6 col-xs-12">
      <div class="card">
        <div class="card-body">
          <div class="card-block">
            <div class="media">
              <div class="media-body text-xs-left">
                <h3 class="pink">{{$homeData['count']['pendingDeposit']}}</h3>
                <span>Pending Deposits</span>
              </div>
              <div class="media-right media-middle">
                <i class="icon-wallet pink font-large-2 float-xs-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-12">
      <div class="card">
        <div class="card-body">
          <div class="card-block">
            <div class="media">
              <div class="media-body text-xs-left">
                <h3 class="deep-orange">{{$homeData['count']['pendingWithdrawal']}}</h3>
                <span>Pending Withdrawals</span>
              </div>
              <div class="media-right media-middle">
                <i class="icon-banknote deep-orange font-large-2 float-xs-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-12">
      <div class="card">
        <div class="card-body">
          <div class="card-block">
            <div class="media">
              <div class="media-body text-xs-left">
                <h3 class="teal">{{$homeData['count']['users']}}</h3>
                <span>Users</span>
              </div>
              <div class="media-right media-middle">
                <i class="icon-user1 teal font-large-2 float-xs-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-12">
      <div class="card">
        <div class="card-body">
          <div class="card-block">
            <div class="media">
              <div class="media-body text-xs-left">
                <h3 class="cyan">{{$homeData['count']['markets']}}</h3>
                <span>Markets</span>
              </div>
              <div class="media-right media-middle">
                <i class="icon-bullseye cyan font-large-2 float-xs-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ stats -->
  <div style="float: right; padding-right: 3%;"><button id="btn1" type="button" class="btn btn-info" onClick="ChangeResult()">Show NG Results</button></div>
  <div id="div1" class="table-responsive" style="display:block">
    <table class="table mb-0">
      <tbody>
      @isset($homeData['marketResult'])
      @if(count($homeData['marketResult']) != 0)
      @foreach($homeData['marketResult'] as $result)
          <tr >
            <td>
              <div class="table-responsive">
                <table class="table mb-0">
                  <thead>
                      <tr>
                          <th width="40%">{{$result['resultOpenTime']}}</th>
                          <th width="40%">{{$result['name']}}</th>
                          <th width="20%">{{$result['resultCloseTime']}}</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td width="40%">{{$result['openPattiResult']}}</td>
                          <td width="40%">{{$result['jodiResult']}}</td>
                          <td width="20%">{{$result['closePattiResult']}}</td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </td>
          </tr>
          @endforeach
          @endif
          @endisset
      </tbody>
    </table>
  </div>
  <div id="div2" class="table-responsive" style="display:none">
    <table class="table mb-0">
      <tbody>
      @isset($homeData['marketResultNG'])
      @if(count($homeData['marketResultNG']) != 0)
      @foreach($homeData['marketResultNG'] as $result)
          <tr >
            <td>
              <div class="table-responsive">
                <table class="table mb-0">
                  <thead>
                      <tr>
                          <td width="40%">Yesterday</td>
                          <th width="40%">{{$result['name']}}</th>
                          <td width="20%">Today</td>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                          <td width="40%">{{$result['previousJodiResult']}}</td>
                          <td width="40%"><strong>{{$result['currentResultOpenTime']}}</strong></td>
                          <td width="20%">{{$result['currentJodiResult']}}</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
            </td>
          </tr>
          @endforeach
          @endif
          @endisset
      </tbody>
    </table>
  </div>
<!-- main-content -->
@endsection

@section('scripts')

<script type="text/javascript">
    function ChangeResult() {
      var isVisibleDiv1 = document.getElementById("div1").style.display == "block";
      if(isVisibleDiv1)
      {
        document.getElementById("div1").style.display = "none";
        document.getElementById("div2").style.display = "block";
        document.getElementById("btn1").innerHTML = "Show Normal Results";
      }
      else
      {
        document.getElementById("div1").style.display = "block";
        document.getElementById("div2").style.display = "none";
        document.getElementById("btn1").innerHTML = "Show NG Results";
      }
    }
</script>
@endsection