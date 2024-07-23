<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;
use Session;

class StatsController extends Controller
{
    public function Index()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $stats = HttpClientExtension::ExecuteResilientHttpGetRequest('stats');
        if($stats=='unauthorized')
            return redirect('/');

        return view('stats.view')->with("stats",$stats);
    }
}
