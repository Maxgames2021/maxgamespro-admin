<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description"
    content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords"
    content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="PIXINVENT">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title')</title>
  <link rel="apple-touch-icon" sizes="60x60" href="/app-assets/images/ico/apple-icon-60.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/app-assets/images/ico/apple-icon-76.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/app-assets/images/ico/apple-icon-120.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/app-assets/images/ico/apple-icon-152.png">
  <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
  <link rel="shortcut icon" type="image/png" href="/app-assets/images/ico/favicon-32.png">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-toggle.min.css">
  <!-- font icons-->
  <link rel="stylesheet" type="text/css" href="/app-assets/fonts/icomoon.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/pace.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN ROBUST CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/jquery.dataTables.min.css">
  <!-- END ROBUST CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
  <!-- END Page Level CSS-->
</head>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns"
  class="vertical-layout vertical-menu 2-columns  fixed-navbar">

  <!-- navbar-fixed-top-->
  <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav">
          <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a
              class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
          <li class="nav-item"><a href="{{url('home')}}" class="navbar-brand nav-link"><img alt="MG"
                src="/app-assets/images/logo/mg-logo-160x46.png"
                data-expand="/app-assets/images/logo/mg-logo-160x46.png"
                data-collapse="/app-assets/images/logo/mg-logo-42x46.png" class="brand-logo"></a></li>
          <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile"
              class="nav-link open-navbar-container"><i
                class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
        </ul>
      </div>
      <div class="navbar-container content container-fluid">
        <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
          <ul class="nav navbar-nav">
            <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i
                  class="icon-menu5"> </i></a></li>
          </ul>
          <ul class="nav navbar-nav float-xs-right">
            <li class="nav-item hidden-sm-down"><a href="{{ url('logout') }}" class="btn btn-danger upgrade-to-pro"><i class="icon-power3"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- ////////////////////////////////////////////////////////////////////////////-->


  <!-- main menu-->
  <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
    <!-- main menu content-->
    <div class="main-menu-content">
      <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
        <li class=" nav-item"><a href="{{url('home')}}"><i class="icon-home3"></i><span data-i18n="nav.dash.main"
              class="menu-title">Dashboard</span></a>
        </li>
        <li class=" nav-item"><a><i class="icon-user4"></i><span data-i18n="nav.page_layouts.main"
            class="menu-title">User</span></a>
        <ul class="menu-content">
          <li><a href="{{url('user/viewuser')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">View Users</a>
          </li>
          <li><a href="{{url('user/userdetail')}}" data-i18n="nav.page_layouts.2_columns" class="menu-item">User Detail</a>
          </li>
        </ul>
      </li>
        <li class=" nav-item"><a><i class="icon-wallet"></i><span data-i18n="nav.page_layouts.main"
              class="menu-title">Deposits</span></a>
          <ul class="menu-content">
            <li><a href="{{url('deposit/viewpendingdepositrequest')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Requested</a>
            </li>
            <li><a href="{{url('deposit/viewpendingsystemdepositrequest')}}" data-i18n="nav.page_layouts.2_columns" class="menu-item">System Deposits</a>
            </li>
            <li><a href="{{url('deposit/createdeposit')}}" data-i18n="nav.page_layouts.2_columns" class="menu-item">Create Deposits</a>
            </li>
            <li><a href="{{url('deposit/viewdepositrequest')}}" data-i18n="nav.page_layouts.2_columns" class="menu-item">View Deposits</a>
            </li>
            <li><a href="{{url('deposit/viewonlinedepositrequest')}}" data-i18n="nav.page_layouts.2_columns" class="menu-item">View Online Deposits</a>
            </li>
          </ul>
        </li>
        <li class=" nav-item"><a><i class="icon-banknote"></i><span data-i18n="nav.page_layouts.main"
              class="menu-title">Withdrawals</span></a>
          <ul class="menu-content">
            <li><a href="{{url('withdrawal/viewpendingwithdrawalrequest')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Requested</a>
            </li>
            <li><a href="{{url('withdrawal/viewpendingsystemwithdrawalrequest')}}" data-i18n="nav.page_layouts.2_columns" class="menu-item">System Withdrawals</a>
            </li>
            <li><a href="{{url('withdrawal/createwithdrawal')}}" data-i18n="nav.page_layouts.2_columns" class="menu-item">Create Withdrawals</a>
            </li>
            <li><a href="{{url('withdrawal/viewwithdrawalrequest')}}" data-i18n="nav.page_layouts.2_columns" class="menu-item">View Withdrawals</a>
            </li>
          </ul>
        </li>
        @if(Session::has('user_id') && Session::get('user_id')==1)
        <li class=" nav-item"><a><i class="icon-bullseye"></i><span data-i18n="nav.page_layouts.main"
              class="menu-title">Markets</span></a>
          <ul class="menu-content">
            <li><a href="{{url('market/createmarketform')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Create Market</a>
            </li>
            <li><a href="{{url('market/updatemarketform')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Update Market</a>
            </li>
          </ul>
        </li>
        <li class=" nav-item"><a><i class="icon-gamepad2"></i><span data-i18n="nav.page_layouts.main"
              class="menu-title">Games</span></a>
          <ul class="menu-content">
            <li><a href="{{url('game/updategameform')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Update Game</a>
            </li>
          </ul>
        </li>

        <li class=" nav-item"><a><i class="icon-list-alt"></i><span data-i18n="nav.page_layouts.main"
              class="menu-title">Bet Details</span></a>
          <ul class="menu-content">
            <li><a href="{{url('gametransaction/viewbetanalysis')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Bet Analysis</a>
            </li>
            <li><a href="{{url('gametransaction/viewcurrentgametransaction')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">View Current Bettings</a>
            </li>
            <li><a href="{{url('gametransaction/viewgametransaction')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">View Bettings</a>
            </li>
            <li><a href="{{url('gametransaction/betrefund')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Bet Refund</a>
              </li>
            <li><a href="{{url('gametransaction/viewbetstats')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">View Betting Stats</a>
            </li>
              <li><a href="{{url('gametransaction/excelreport')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Betting Excel Report</a>
              </li>
          </ul>
        </li>
        @endif

        <li class=" nav-item"><a><i class="icon-paper-plane"></i><span data-i18n="nav.page_layouts.main"
              class="menu-title">Market Result</span></a>
          <ul class="menu-content">
            <li><a href="{{url('market/updatemarketresultform')}}" data-i18n="nav.page_layouts.1_column" 
                  class="menu-item">Declare Result</a>
            </li>
            <li><a href="{{url('market/updatengmarketresultform')}}" data-i18n="nav.page_layouts.1_column" 
                  class="menu-item">Declare NG Result</a>
            </li>
            <li><a href="{{url('market/marketresultpoolview')}}" data-i18n="nav.page_layouts.1_column" 
                  class="menu-item">Result Pool</a>
            </li>
          </ul>
        </li>
        @if(Session::has('user_id') && Session::get('user_id')==1)
        <li class=" nav-item"><a><i class="icon-tv4"></i><span data-i18n="nav.page_layouts.main"
              class="menu-title">Manage Offers</span></a>
          <ul class="menu-content">
            <li><a href="{{url('offer/createofferform')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Create Offer</a>
            </li>
            <li><a href="{{url('offer/viewoffer')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Close Offer</a>
            </li>
          </ul>
        </li>
        <li class=" nav-item"><a><i class="icon-expeditedssl"></i><span data-i18n="nav.page_layouts.main"
              class="menu-title">Management</span></a>
          <ul class="menu-content">
            <li><a href="{{url('user/viewadminuser')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">View Admins</a>
            </li>
            <li><a href="{{url('user/createadminprofile')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Create Admin</a>
            </li>
            <li><a href="{{url('user/restoreuserpassword')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Restore Password</a>
            </li>
            <li><a href="{{url('depositwithdrawalstatus')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Reset D/W Status</a>
            </li>
            <li><a href="{{url('stats')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Statistics</a>
            </li>
            <li><a href="{{url('adminactions')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Admin Actions</a>
            </li>
            <li><a href="{{url('paymentmodes')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Payment Modes</a>
            </li>
            <li><a href="{{url('controls/view')}}" data-i18n="nav.page_layouts.1_column" class="menu-item">Controls</a>
            </li>
          </ul>
        </li>
        @endif
        <li class=" nav-item"><a href="{{url('user/updateadminprofile')}}"><i class="icon-settings2"></i><span data-i18n="nav.dash.main"
              class="menu-title">Update Profile</span></a>
        </li>
      </ul>
    </div>
    <!-- /main menu content-->
    <!-- main menu footer-->
    <!-- include includes/menu-footer-->
    <!-- main menu footer-->
  </div>
  <!-- / main menu-->

  <div class="app-content content container-fluid">
    <div class="content-wrapper">
      @yield('content')
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->

  <!-- BEGIN VENDOR JS-->
  <script src="/app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
  <script src="/app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="/app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN ROBUST JS-->
  <script src="/app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="/app-assets/js/core/app.js" type="text/javascript"></script>
  <!-- END ROBUST JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="/app-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
  @yield('scripts')
</body>

</html>
