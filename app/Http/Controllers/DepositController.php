<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;
use Session;

class DepositController extends Controller
{
    public function RequestsForm()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        return view('deposit.viewrequest');
    }

    public function OnlineDepositRequestsForm()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        return view('deposit.viewonlinedepositrequest');
    }

    public function RequestsDetails(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $date = $request->input('dateInput');

        $deposits = HttpClientExtension::ExecuteResilientHttpGetRequest('deposits'.'?date='.$date);
        if($deposits=='unauthorized')
            return redirect('/');

        $transactionData = [
            "transactionDate"=>$date,
            "deposits"=>$deposits
        ];

        return view('deposit.viewrequest')->with("transactionData",$transactionData);
    }

    public function OnlineDepositRequestsDetails(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $date = $request->input('dateInput');

        $deposits = HttpClientExtension::ExecuteResilientHttpGetRequest('onlinedeposits'.'?date='.$date);
        if($deposits=='unauthorized')
            return redirect('/');

        $transactionData = [
            "transactionDate"=>$date,
            "deposits"=>$deposits
        ];

        return view('deposit.viewonlinedepositrequest')->with("transactionData",$transactionData);
    }

    public function PendingRequests()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $pendingdeposits = HttpClientExtension::ExecuteResilientHttpGetRequest('pendingdeposits');
        if($pendingdeposits=='unauthorized')
            return redirect('/');
        return view('deposit.viewpendingrequest')->with("pendingdeposits",$pendingdeposits);
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
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('userdeposits',$requestData);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/deposit/viewpendingdepositrequest')->with('status',false);
        return redirect('/deposit/viewpendingdepositrequest')->with('status',true);
    }

    public function PendingSystemRequests()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $pendingdeposits = HttpClientExtension::ExecuteResilientHttpGetRequest('pendingdeposits');
        if($pendingdeposits=='unauthorized')
            return redirect('/');
        $totalDeposits=0;
        if(!empty($pendingdeposits))
        {
            foreach($pendingdeposits as $pendingdeposit)
            {
                if($pendingdeposit['isSystemTransaction']==1)
                    $totalDeposits=$totalDeposits+$pendingdeposit['amount'];
            }
        }

        // inr currency formatting
        $totalDeposits = IND_money_format($totalDeposits);

        $pendingDepositsDetail = ["pendingdeposits"=>$pendingdeposits,"totalDeposits"=>$totalDeposits];
        return view('deposit.viewpendingsystemrequest')->with("pendingDepositsDetail",$pendingDepositsDetail);
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
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('userdeposits',$requestData);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/deposit/viewpendingsystemdepositrequest')->with('status',false);
        return redirect('/deposit/viewpendingsystemdepositrequest')->with('status',true);
    }

    public function ApprovePendingSystemRequests(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('approvedeposits',null);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/deposit/viewpendingsystemdepositrequest')->with('status',false);
        return redirect('/deposit/viewpendingsystemdepositrequest')->with('status',true);
    }

    public function DeclinePendingRequests(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('declinedeposits',null);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/deposit/viewpendingdepositrequest')->with('status',false);
        return redirect('/deposit/viewpendingdepositrequest')->with('status',true);
    }

    public function CreateDeposit()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $users = HttpClientExtension::ExecuteResilientHttpGetRequest('user');
        if($users=='unauthorized')
            return redirect('/');
        return view('deposit.createdeposit')->with("users",$users);
    }

    public function CreateDepositRequest($id,Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $requestData = ['id' => $id,
                        'amount' => $request->input('depositAmount')];
        $res = HttpClientExtension::ExecuteResilientHttpPostRequest('deposits',$requestData);

        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return response()->json('',400);
        return response()->json('',200);
    }

    public function GetAsyncDepositRequests(Request $request, $offset)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $date = $request->date;
        $isOnline = 0;
        if(isset($request->isOnline))
            $isOnline = $request->isOnline;

        $deposits = HttpClientExtension::ExecuteResilientHttpGetRequest('deposits?offset='.$offset.'&date='.$date.'&isOnline='.$isOnline);
        if($deposits=='unauthorized')
            return redirect('/');

        return $deposits;
    }

    public function GetAsyncOnlineDepositRequests(Request $request, $offset)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        
        $date = $request->date;
        $url = 'onlinedeposits?offset='.$offset.'&date='.$date;
        if(isset($request->paymentStatus))
            $url = $url.'&statusCode='.$request->paymentStatus;
        if(isset($request->merchantCode))
            $url = $url.'&merchantCode='.$request->merchantCode;


        $deposits = HttpClientExtension::ExecuteResilientHttpGetRequest($url);
        if($deposits=='unauthorized')
            return redirect('/');

        return $deposits;
    }
}
