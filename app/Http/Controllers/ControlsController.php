<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;
use Session;
use Log;

class ControlsController extends Controller
{
    public function Index()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $controlsData = HttpClientExtension::ExecuteResilientHttpGetRequest('constrolsdata');
        if($controlsData=='unauthorized')
            return redirect('/');


        return view('controls.view')->with("controlsData",$controlsData);
    }

    public function MarketResultCreateTrigger()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $res = HttpClientExtension::ExecuteResilientHttpGetRequest('marketresultcreatetrigger');

        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/controls/view')->with('status',false);

        return redirect('/controls/view')->with('status',true);
    }

    public function DBCleanupTrigger()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $res = HttpClientExtension::ExecuteResilientHttpGetRequest('dbcleanuptrigger');
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/controls/view')->with('status',false);
            
        return redirect('/controls/view')->with('status',true);
    }

    public function InactiveUserDeleteThresholdUpdate(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }


        $value = $request->input('thresholdValue');
        if(!isset($value) || $value==null)
            $value = 0;

        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('inactiveuserthreshold?inactiveUserThreshold='.$value, null);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/controls/view')->with('status',false);
            
        return redirect('/controls/view')->with('status',true);
    }
}
