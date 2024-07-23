<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;
use Session;

class WithdrawalController extends Controller
{
    public function RequestsForm()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        return view('withdrawal.viewrequest');
    }

    public function RequestsDetails(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $date = $request->input('dateInput');

        $withdrawals = HttpClientExtension::ExecuteResilientHttpGetRequest('withdrawals'.'?date='.$date);
        if($withdrawals=='unauthorized')
            return redirect('/');

        $transactionData = [
            "transactionDate"=>$date,
            "withdrawals"=>$withdrawals
        ];

        return view('withdrawal.viewrequest')->with("transactionData",$transactionData);
    }

    public function PendingRequests()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $pendingwithdrawals = HttpClientExtension::ExecuteResilientHttpGetRequest('pendingwithdrawals');
        if($pendingwithdrawals=='unauthorized')
            return redirect('/');
        return view('withdrawal.viewpendingrequest')->with("pendingwithdrawals",$pendingwithdrawals);
    }

    public function UpdatePendingRequests($id,Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $pm_mode = $request->input('paymentmode');
        $modeTransactionId = $request->input('transactionId');
        $statusId = $request->input('submit');
        $requestData = ['id' => $id,
                        'statusId' => $statusId,
                        'paymentModeId' => $pm_mode,
                        'modeTransactionId'=>$modeTransactionId];
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('userwithdrawals',$requestData);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/withdrawal/viewpendingwithdrawalrequest')->with('status',false);
        return redirect('/withdrawal/viewpendingwithdrawalrequest')->with('status',true);
    }


    public function PendingSystemRequests()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $pendingwithdrawals = HttpClientExtension::ExecuteResilientHttpGetRequest('pendingwithdrawals');
        if($pendingwithdrawals=='unauthorized')
            return redirect('/');

        $totalWithdrawals=0;
        if(!empty($pendingwithdrawals))
        {
            foreach($pendingwithdrawals as $pendingwithdrawal)
            {
                if($pendingwithdrawal['isSystemTransaction']==1)
                    $totalWithdrawals=$totalWithdrawals+$pendingwithdrawal['amount'];
            }
        }

        // inr currency formatting
        $totalWithdrawals = IND_money_format($totalWithdrawals);

        $pendingWithdrawalsDetail = ["pendingwithdrawals"=>$pendingwithdrawals,"totalWithdrawals"=>$totalWithdrawals];
        return view('withdrawal.viewpendingsystemrequest')->with("pendingWithdrawalsDetail",$pendingWithdrawalsDetail);
    }

    public function UpdatePendingSystemRequests($id,Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $pm_mode = $request->input('paymentmode');
        $modeTransactionId = $request->input('transactionId');
        $statusId = $request->input('submit');
        $requestData = ['id' => $id,
                        'statusId' => $statusId,
                        'paymentModeId' => $pm_mode,
                        'modeTransactionId'=>$modeTransactionId];
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('userwithdrawals',$requestData);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/withdrawal/viewpendingsystemwithdrawalrequest')->with('status',false);
        return redirect('/withdrawal/viewpendingsystemwithdrawalrequest')->with('status',true);
    }

   public function ApprovePendingSystemRequests(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('approvewithdrawals',null);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/withdrawal/viewpendingsystemwithdrawalrequest')->with('status',false);
        return redirect('/withdrawal/viewpendingsystemwithdrawalrequest')->with('status',true);
    }

    /* public function DeclinePendingRequests(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('declinewithdrawals',null);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/withdrawal/viewpendingwithdrawalrequest')->with('status',false);
        return redirect('/withdrawal/viewpendingwithdrawalrequest')->with('status',true);
    } */

    public function CreateWithdrawal()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $users = HttpClientExtension::ExecuteResilientHttpGetRequest('user');
        if($users=='unauthorized')
            return redirect('/');
        return view('withdrawal.createwithdrawal')->with("users",$users);
    }

    public function CreateWithdrawalRequest($id,Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $requestData = ['id' => $id,
                        'amount' => $request->input('withdrawalAmount')];
        $res = HttpClientExtension::ExecuteResilientHttpPostRequest('withdrawals',$requestData);
        
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return response()->json('',400);
        return response()->json('',200);
    }

    public function GetAsyncWithdrawalRequests(Request $request, $offset)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $date = $request->date;

        $withdrawals = HttpClientExtension::ExecuteResilientHttpGetRequest('withdrawals?offset='.$offset.'&date='.$date);
        if($withdrawals=='unauthorized')
            return redirect('/');

        return $withdrawals;
    }
}
