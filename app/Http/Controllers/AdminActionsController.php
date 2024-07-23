<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;
use Session;
use Log;

class AdminActionsController extends Controller
{
    public function Index()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $adminUsers = HttpClientExtension::ExecuteResilientHttpGetRequest('adminuser');
        if($adminUsers=='unauthorized')
            return redirect('/');

        $actionTypes = HttpClientExtension::ExecuteResilientHttpGetRequest('adminactiontypes');
        if($actionTypes=='unauthorized')
            return redirect('/');

        $initialData =
        [
            "adminUsers"=>$adminUsers,
            "actionTypes"=>$actionTypes
        ];

        return view('adminactions.view')->with("initialData",$initialData);
    }

    public function LoadLogs(Request $request)
    {
        $date = $request->date;
        $actionType = $request->actionType;
        $adminUserId = $request->adminUserId;

        $url = 'adminactions?actionTypeId='.$actionType.'&actionDate='.$date.'&adminUserId='.$adminUserId;

        $logs = HttpClientExtension::ExecuteResilientHttpGetRequest($url);
        if($logs=='unauthorized')
            return redirect('/');

        if($logs == 'failed')
            return null;

        return $logs;
    }
}
