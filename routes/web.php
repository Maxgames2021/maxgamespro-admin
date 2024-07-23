<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@Index');
Route::post('login', 'MainController@Login');
Route::get('logout', 'MainController@Logout');

Route::middleware(['auth'])->group(function () {
    Route::get('home', 'HomeController@Index');
    Route::get('user/viewuser', 'UserController@Index');
    Route::get('deposit/viewdepositrequest', 'DepositController@RequestsForm');
    Route::get('deposit/viewonlinedepositrequest', 'DepositController@OnlineDepositRequestsForm');
    Route::get('deposit/viewdepositrequestdetails', 'DepositController@RequestsDetails');
    Route::get('deposit/viewonlinedepositrequestdetails', 'DepositController@OnlineDepositRequestsDetails');
    Route::get('deposit/viewdepositrequest/{offset}', 'DepositController@GetAsyncDepositRequests');
    Route::get('deposit/viewonlinedepositrequest/{offset}', 'DepositController@GetAsyncOnlineDepositRequests');
    Route::get('deposit/createdeposit', 'DepositController@CreateDeposit');
    Route::post('deposit/createdepositrequest/{id}', 'DepositController@CreateDepositRequest');
    Route::get('deposit/viewpendingdepositrequest', 'DepositController@PendingRequests');
    Route::get('deposit/viewpendingsystemdepositrequest', 'DepositController@PendingSystemRequests');
    Route::get('withdrawal/viewwithdrawalrequest', 'WithdrawalController@RequestsForm');
    Route::get('withdrawal/viewwithdrawalrequestdetails', 'WithdrawalController@RequestsDetails');
    Route::get('withdrawal/viewwithdrawalrequest/{offset}', 'WithdrawalController@GetAsyncWithdrawalRequests');
    Route::get('withdrawal/viewpendingwithdrawalrequest', 'WithdrawalController@PendingRequests');
    Route::post('deposit/updatependingdepositrequest/{id}', 'DepositController@UpdatePendingRequests');
    Route::post('deposit/updatependingsystemdepositrequest/{id}', 'DepositController@UpdatePendingSystemRequests');
    Route::get('deposit/approvependingsystemdepositrequest', 'DepositController@ApprovePendingSystemRequests');
    Route::get('deposit/declinependingdepositrequest', 'DepositController@DeclinePendingRequests');
    Route::post('withdrawal/updatependingwithdrawalrequest/{id}', 'WithdrawalController@UpdatePendingRequests');
    Route::get('withdrawal/viewpendingsystemwithdrawalrequest', 'WithdrawalController@PendingSystemRequests');
    Route::get('withdrawal/createwithdrawal', 'WithdrawalController@CreateWithdrawal');
    Route::post('withdrawal/createwithdrawalrequest/{id}', 'WithdrawalController@CreateWithdrawalRequest');
    Route::post('withdrawal/updatependingsystemwithdrawalrequest/{id}', 'WithdrawalController@UpdatePendingSystemRequests');
    //Route::get('withdrawal/declinependingwithdrawalrequest', 'WithdrawalController@DeclinePendingRequests');
    Route::get('withdrawal/approvependingsystemwithdrawalrequest', 'WithdrawalController@ApprovePendingSystemRequests');
    Route::get('market/createmarketform', 'MarketController@CreateMarketForm');
    Route::post('market/createmarketrequest', 'MarketController@CreateMarketRequest');
    Route::get('market/updatemarketform', 'MarketController@UpdateMarketForm');
    Route::post('market/getmarketdetail', 'MarketController@GetMarketDetail');
    Route::post('market/updatemarketrequest', 'MarketController@UpdateMarketRequest');

    Route::get('game/updategameform', 'GameController@UpdateGameForm');
    Route::post('game/getgamedetail', 'GameController@GetGameDetail');
    Route::post('game/updategamerequest/{id}', 'GameController@UpdateGameRequest');
    Route::get('game/getgamedetail/{id}', 'GameController@GetGameDetail2');
    Route::get('game/getgames/{id}', 'GameController@GetGames');

    Route::get('market/updatemarketresultform', 'MarketController@UpdateMarketResultForm');
    Route::get('market/updatengmarketresultform', 'MarketController@UpdateNGMarketResultForm');
    Route::post('market/getmarketresultdetail', 'MarketController@GetMarketResultDetail');
    Route::post('market/getngmarketresultdetail', 'MarketController@GetNGMarketResultDetail');
    Route::post('market/updatemarketresultrequest', 'MarketController@UpdateMarketResultRequest');
    Route::post('market/updatengmarketresultrequest', 'MarketController@UpdateNGMarketResultRequest');
    Route::get('market/marketresultpoolview', 'MarketController@MarketResultPoolView');
    Route::get('market/marketresultrefresh/{marketId}', 'MarketController@MarketResultRefresh');
    Route::get('market/marketresultconsolidate/{poolId}', 'MarketController@MarketResultConsolidate');
    

    Route::get('gametransaction/viewgametransaction', 'GameTransactionController@GetGameTransactionForm');
    Route::get('gametransaction/viewgametransactiondetails', 'GameTransactionController@GetGameTransaction');
    Route::get('gametransaction/viewgametransaction/{offset}', 'GameTransactionController@GetAsyncGameTransaction');
    Route::get('gametransaction/viewcurrentgametransaction', 'GameTransactionController@LoadMarkets');
    Route::post('gametransaction/getcurrentgametransaction', 'GameTransactionController@GetCurrentGameTransaction');
    Route::get('gametransaction/viewbetanalysis', 'GameTransactionController@GetBetAnalysis');
    Route::get('gametransaction/loadbetanalysis/{id}', 'GameTransactionController@LoadBetAnalysis');
    Route::get('gametransaction/excelreport','GameTransactionController@ExcelReportView');
    Route::post('gametransaction/getexcelreportdata','GameTransactionController@GetExcelReportData');
    Route::get('gametransaction/betrefund','GameTransactionController@GetBetRefundForm');
    Route::post('gametransaction/betrefund','GameTransactionController@PostBetRefundForm');
    

    Route::get('offer/createofferform', 'OfferController@CreateOfferForm');
    Route::post('offer/createofferrequest', 'OfferController@CreateOfferRequest');
    Route::get('offer/viewoffer', 'OfferController@ViewOffer');
    Route::post('offer/closeofferrequest/{id}', 'OfferController@CloseOfferRequest');

    Route::get('user/updateadminprofile', 'UserController@UpdateAdminProfile');
    Route::post('user/updateadminprofilerequest/{id}', 'UserController@UpdateAdminProfileRequest');

    Route::get('user/createadminprofile', 'UserController@CreateAdminProfile');
    Route::post('user/createadminprofilerequest', 'UserController@CreateAdminProfileRequest');

    Route::get('user/restoreuserpassword', 'UserController@RestoreUserPassword');
    Route::post('user/restoreuserpasswordrequest', 'UserController@RestoreUserPasswordRequest');

    Route::get('user/viewadminuser', 'UserController@ViewAdminUser');

    Route::get('user/userdetail', 'UserController@ViewUserDetail');
    Route::get('user/userdetailbyid', 'UserController@GetUserDetail');
    Route::get('user/userlist', 'UserController@GetUsernameHint');
    Route::get('user/deposittransactions', 'UserController@GetUsersDepositTransaction');
    Route::get('user/withdrawaltransactions', 'UserController@GetUsersWithdrawalTransaction');
    Route::get('user/gametransactions', 'UserController@GetUsersGameTransaction');

    Route::post('user/beneficiarydetail', 'UserController@UpdateUsersBeneficiaryDetail');

    Route::get('gametransaction/viewbetstats', 'GameTransactionController@ViewBettingStats');
    Route::get('gametransaction/betstats', 'GameTransactionController@GetBettingStats');

    Route::get('depositwithdrawalstatus', 'DepositWithdrawalStatusController@Index');
    Route::get('depositwithdrawalstatus/{id}', 'DepositWithdrawalStatusController@DepositWithdrawalStatusByIdGet');
    Route::post('depositwithdrawalstatus', 'DepositWithdrawalStatusController@DepositWithdrawalStatusUpdate');
    
    Route::get('paymentmodes', 'DepositWithdrawalStatusController@PaymentModes');
    Route::post('paymentmode/{id}', 'DepositWithdrawalStatusController@PaymentModeUpdate');

    Route::get('stats', 'StatsController@Index');

    Route::get('adminactions', 'AdminActionsController@Index');
    Route::get('adminactions/loadlogs', 'AdminActionsController@LoadLogs');


    Route::get('controls/view', 'ControlsController@Index');
    Route::post('controls/marketresultcreatetrigger', 'ControlsController@MarketResultCreateTrigger');
    Route::post('controls/dbcleanuptrigger', 'ControlsController@DBCleanupTrigger');
    Route::post('controls/inactiveuserthreshold', 'ControlsController@InactiveUserDeleteThresholdUpdate');
});

