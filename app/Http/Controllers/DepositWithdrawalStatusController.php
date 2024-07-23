<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;
use Session;
use Log;

class DepositWithdrawalStatusController extends Controller
{
    public function Index()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $depositwithdrawalstatus = HttpClientExtension::ExecuteResilientHttpGetRequest('depositwithdrawalstatus');
        if($depositwithdrawalstatus=='unauthorized')
            return redirect('/');
        return view('depositwithdrawalstatus.view')->with("depositwithdrawalstatus",$depositwithdrawalstatus);
    }

    public function DepositWithdrawalStatusByIdGet($id)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        if($id == 1)
            $status = HttpClientExtension::ExecuteResilientHttpGetRequest('depositstatus');
        else
            $status = HttpClientExtension::ExecuteResilientHttpGetRequest('withdrawalstatus');

        if($status==='unauthorized')
            return redirect('/');

        return $status;
    }

    public function DepositWithdrawalStatusUpdate(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $typeId = $request->input('selectedTransactionType');
        $status = $request->input('transactionStatus');

        $requestBody = ["typeId"=>$request->input('selectedTransactionType'),
                        "isEnabled"=>$request->input('transactionStatus'),
                        "minAmount"=>$request->input('minAmount'),
                        "message"=>$request->input('message'),
                        "payeeAddress"=>$request->input('payeeAddress'),
                        "payeeName"=>$request->input('payeeName'),
                        "merchantCode"=>$request->input('merchantCode')];

        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('depositwithdrawalstatus',$requestBody);

        if($res==='unauthorized')
            return redirect('/');

        if($res=='unauthorized')
            return redirect('/');

        if($res=="failed")
            return redirect('/depositwithdrawalstatus')->with('status',false);
        return redirect('/depositwithdrawalstatus')->with('status',true);
    }

    public function PaymentModes()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $paymentmodes = HttpClientExtension::ExecuteResilientHttpGetRequest('paymentmodes');
        if($paymentmodes=='unauthorized')
            return redirect('/');
        return view('depositwithdrawalstatus.viewpaymentmodes')->with("paymentmodes",$paymentmodes);
    }

    public function PaymentModeUpdate($id, Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $maxAndroidVersion = null;
        if($request->input('maxAndroidVersion') != '')
        {
            $maxAndroidVersion =  $request->input('maxAndroidVersion');
        }

        $requestData =[ "paymentModeId"=>$id,
                    "maxAndroidVersion"=>$maxAndroidVersion,
                    "isActive"=>$request->input('isActive')];

        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('paymentmode',$requestData);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/paymentmodes')->with('status',false);
        return redirect('/paymentmodes')->with('status',true);
    }
}
