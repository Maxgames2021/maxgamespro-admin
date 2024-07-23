<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;
use Session;
use Log;

class GameTransactionController extends Controller
{
    public function GetGameTransactionForm()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        return view('gametransaction.viewgametransaction');
    }

    public function GetGameTransaction(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $date = $request->input('dateInput');

        $gameTransactions = HttpClientExtension::ExecuteResilientHttpGetRequest('gametransactions'.'?date='.$date);
        if($gameTransactions=='unauthorized')
            return redirect('/');
        $transactionData = [
                                "transactionDate"=>$date,
                                "gameTransactions"=>$gameTransactions
                            ];

        return view('gametransaction.viewgametransaction')->with("transactionData",$transactionData);
    }

    public function LoadMarkets()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $markets = HttpClientExtension::ExecuteResilientHttpGetRequest('markets?isNGType=2');
        if($markets=='unauthorized')
            return redirect('/');
        return view('gametransaction.viewcurrentgametransaction')->with("markets",$markets);
    }

    public function GetCurrentGameTransaction(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $forMarket = 'marketgametransactions?id='.$request->input('selectedMarket');

        $gameTransactions = HttpClientExtension::ExecuteResilientHttpGetRequest($forMarket);
        if($gameTransactions=='unauthorized')
            return redirect('/');
        $totalBetAmount = 0;
        if(!empty($gameTransactions))
        {
            foreach($gameTransactions as $gameTransaction)
            {
                $totalBetAmount=$totalBetAmount+$gameTransaction['betAmount'];
            }
        }
        $gameTransactionsDetail = ["totalBetAmount"=>$totalBetAmount,"gameTransactions"=>$gameTransactions];

        return view('gametransaction.viewcurrentgametransaction')->with("gameTransactionsDetail",$gameTransactionsDetail);
    }

    public function GetBetAnalysis()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $markets = HttpClientExtension::ExecuteResilientHttpGetRequest('markets?isNGType=2');
        if($markets=='unauthorized')
            return redirect('/');
        return view('gametransaction.viewbetanalysis')->with("markets",$markets);
    }

    public function LoadBetAnalysis($id,Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $date = $request->date;

        $forGame = 'gametransactionsbyid?id='.$id;

        if($date != null || $date != '')
            $forGame .= '&date='.$date;

        $gameTransactions = HttpClientExtension::ExecuteResilientHttpGetRequest($forGame);
        if($gameTransactions=='unauthorized')
            return redirect('/');
        return $gameTransactions;
    }
    public function ViewBettingStats()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        return view('gametransaction.viewgametransactionstats');
    }
    public function GetBettingStats()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $marketstat = HttpClientExtension::ExecuteResilientHttpGetRequest('marketstat');
        if($marketstat=='unauthorized')
            return redirect('/');
        return $marketstat;
    }

    public function GetAsyncGameTransaction($offset, Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $date = $request->date;

        $gameTransactions = HttpClientExtension::ExecuteResilientHttpGetRequest('gametransactions?offset='.$offset.'&date='.$date);
        if($gameTransactions=='unauthorized')
            return redirect('/');
        return $gameTransactions;
    }

    public function ExcelReportView()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $markets = HttpClientExtension::ExecuteResilientHttpGetRequest('markets?isNGType=2');
        if($markets=='unauthorized')
            return redirect('/');
        return view('gametransaction.excelreport')->with("markets",$markets);
    }

    public function GetExcelReportData(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $marketId = $request->input('selectedMarket');
        $reultType = $request->input('selectedResultType');

        $forMarket = 'gametransactionsexcelreportdata?id='.$marketId.'&isOpenResultType='.$reultType;

        $reportDataResult = HttpClientExtension::ExecuteResilientHttpGetRequest($forMarket);
        if($reportDataResult=='unauthorized')
            return redirect('/');

        if($reportDataResult=="failed")
            return redirect('/gametransaction/excelreport')->with('status',false);

        $resultTypeText = "Close";
        if($reultType=="1")
            $resultTypeText = "Open";

        $reportData = [
            "resultType"=>$resultTypeText,
            "reportDataResult"=>$reportDataResult
        ];

        return view('gametransaction.excelreport')->with("reportData",$reportData);
    }

    public function GetBetRefundForm()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $markets = HttpClientExtension::ExecuteResilientHttpGetRequest('markets?isNGType=2');
        if($markets=='unauthorized')
            return redirect('/');
        return view('gametransaction.betrefund')->with("markets",$markets);
    }

    public function PostBetRefundForm(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $marketId = $request->input('selectedMarket');

        $res = HttpClientExtension::ExecuteResilientHttpGetRequest('gametransactionrefund?marketId='.$marketId);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/gametransaction/betrefund')->with('status',false);
        return redirect('/gametransaction/betrefund')->with('status',true);
    }
}
