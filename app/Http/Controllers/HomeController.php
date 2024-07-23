<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;

class HomeController extends Controller
{
    public function Index()
    {
        $count = HttpClientExtension::ExecuteResilientHttpGetRequest('count');
        $marketResult = HttpClientExtension::ExecuteResilientHttpGetRequest('marketresults');
        $marketResultNG = HttpClientExtension::ExecuteResilientHttpGetRequest('marketresultsng');
        

        if($count == 'unauthorized' || $marketResult == 'unauthorized' || $marketResultNG == 'unauthorized')
            return redirect('/');
        $homeData = [
                    "count"=>$count,
                    "marketResult"=>$marketResult,
                    "marketResultNG"=>$marketResultNG
                ];
        return view('home.dashboard')->with("homeData",$homeData);
    }
}
