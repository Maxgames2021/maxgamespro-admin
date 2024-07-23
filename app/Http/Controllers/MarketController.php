<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;
use Session;

class MarketController extends Controller
{
    public function CreateMarketForm()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        return view('market.createmarket');
    }
    
    public function CreateMarketRequest(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $marketName = $request->input('marketName');

        $isNGType = 0;
        if($request->input('isNGType')=='1')
            $isNGType = 1;

        $weekdayResultOpenTime = $request->input('weekdayResultOpenTime');
        $weekdayResultCloseTime = $request->input('weekdayResultCloseTime');
        $weekdayBetOpenTime = $request->input('weekdayBetOpenTime');
        $weekdayBetCloseTime = $request->input('weekdayBetCloseTime');
        if($request->input('satTimingRadio')=="satActive" && $request->input('satTimingRadio')!="")
        {
            $satActive=1;
            $satResultOpenTime = $request->input('satResultOpenTime');
            $satResultCloseTime = $request->input('satResultCloseTime');
            $satBetOpenTime = $request->input('satBetOpenTime');
            $satBetCloseTime = $request->input('satBetCloseTime');
        }
        else
        {
            $satActive=0;   
            $satResultOpenTime=null;
            $satResultCloseTime=null;
            $satBetOpenTime = null;
            $satBetCloseTime = null;
        }
        if($request->input('sunTimingRadio')=="sunActive" && $request->input('sunTimingRadio')!="")
        {
            $sunActive=1;
            $sunResultOpenTime = $request->input('sunResultOpenTime');
            $sunResultCloseTime = $request->input('sunResultCloseTime');
            $sunBetOpenTime = $request->input('sunBetOpenTime');
            $sunBetCloseTime = $request->input('sunBetCloseTime');
        }
        else
        {
            $sunActive=0;
            $sunResultOpenTime=null;
            $sunResultCloseTime=null;
            $sunBetOpenTime = null;
            $sunBetCloseTime =null;
        }
        $requestData = null;

        if($isNGType==1)
        {
            $requestData = ["name"=>$marketName,
                        "weekdayResultOpen"=>$weekdayResultOpenTime,
                        "weekdayResultClose"=>$weekdayResultOpenTime,
                        "weekdayBetOpen"=>$weekdayBetOpenTime,
                        "weekdayBetClose"=>$weekdayBetOpenTime,
                        "satResultOpen"=>$satResultOpenTime,
                        "satResultClose"=>$satResultOpenTime,
                        "satBetOpen"=>$satBetOpenTime,
                        "satBetClose"=>$satBetOpenTime,
                        "sunResultOpen"=>$sunResultOpenTime,
                        "sunResultClose"=>$sunResultOpenTime,
                        "sunBetOpen"=>$sunBetOpenTime,
                        "sunBetClose"=>$sunBetOpenTime,                     
                        "isSatActive"=>$satActive,
                        "isSunActive"=>$sunActive,
                        "isNGType"=>$isNGType];
        }
        else
        {
            $requestData = ["name"=>$marketName,
                        "weekdayResultOpen"=>$weekdayResultOpenTime,
                        "weekdayResultClose"=>$weekdayResultCloseTime,
                        "weekdayBetOpen"=>$weekdayBetOpenTime,
                        "weekdayBetClose"=>$weekdayBetCloseTime,
                        "satResultOpen"=>$satResultOpenTime,
                        "satResultClose"=>$satResultCloseTime,
                        "satBetOpen"=>$satBetOpenTime,
                        "satBetClose"=>$satBetCloseTime,
                        "sunResultOpen"=>$sunResultOpenTime,
                        "sunResultClose"=>$sunResultCloseTime,
                        "sunBetOpen"=>$sunBetOpenTime,
                        "sunBetClose"=>$sunBetCloseTime,                     
                        "isSatActive"=>$satActive,
                        "isSunActive"=>$sunActive,
                        "isNGType"=>$isNGType];
        }
        
        $res = HttpClientExtension::ExecuteResilientHttpPostRequest('markets',$requestData);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/market/createmarketform')->with('status',false);
        return redirect('/market/createmarketform')->with('status',true);
    }

    public function UpdateMarketForm()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $markets = HttpClientExtension::ExecuteResilientHttpGetRequest('markets?isNGType=2');
        if($markets=='unauthorized')
            return redirect('/');
        return view('market.updatemarket')->with("markets",$markets);
    }
    public function GetMarketDetail(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        
        $forMarket = 'marketdetail?id='.$request->input('selectedMarket');

        $marketDetails = HttpClientExtension::ExecuteResilientHttpGetRequest($forMarket);
        if($marketDetails=='unauthorized')
            return redirect('/');
        return view('market.updatemarket')->with("marketDetails",$marketDetails);
    }

    public function UpdateMarketRequest(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $marketId = $request->input('marketId');
        
        $isActive = 0;
        if($request->input('isActive')=='1')
        {
            $isActive = 1; 
        }

        $isNGType = 0;
        if($request->input('isNGType')=='1')
        {
            $isNGType = 1; 
        }

        $marketName = $request->input('marketName');
        $weekdayResultOpenTime = $request->input('weekdayResultOpenTime');
        $weekdayResultCloseTime = $request->input('weekdayResultCloseTime');
        $weekdayBetOpenTime = $request->input('weekdayBetOpenTime');
        $weekdayBetCloseTime = $request->input('weekdayBetCloseTime');
        if($request->input('satTimingRadio')=="satActive" && $request->input('satTimingRadio')!="")
        {
            $satActive=1;
            $satResultOpenTime = $request->input('satResultOpenTime');
            $satResultCloseTime = $request->input('satResultCloseTime');
            $satBetOpenTime = $request->input('satBetOpenTime');
            $satBetCloseTime = $request->input('satBetCloseTime');
        }
        else
        {
            $satActive=0;   
            $satResultOpenTime=null;
            $satResultCloseTime=null;
            $satBetOpenTime = null;
            $satBetCloseTime = null;
        }
        if($request->input('sunTimingRadio')=="sunActive" && $request->input('sunTimingRadio')!="")
        {
            $sunActive=1;
            $sunResultOpenTime = $request->input('sunResultOpenTime');
            $sunResultCloseTime = $request->input('sunResultCloseTime');
            $sunBetOpenTime = $request->input('sunBetOpenTime');
            $sunBetCloseTime = $request->input('sunBetCloseTime');
        }
        else
        {
            $sunActive=0;
            $sunResultOpenTime=null;
            $sunResultCloseTime=null;
            $sunBetOpenTime = null;
            $sunBetCloseTime =null;
        }
        
        $requestData = null;
        if($isNGType==1)
        {
            $requestData = ["marketId"=>$marketId,
                        "name"=>$marketName,
                        "isActive"=>$isActive,
                        "weekdayResultOpen"=>$weekdayResultOpenTime,
                        "weekdayResultClose"=>$weekdayResultOpenTime,
                        "weekdayBetOpen"=>$weekdayBetOpenTime,
                        "weekdayBetClose"=>$weekdayBetOpenTime,
                        "satResultOpen"=>$satResultOpenTime,
                        "satResultClose"=>$satResultOpenTime,
                        "satBetOpen"=>$satBetOpenTime,
                        "satBetClose"=>$satBetOpenTime,
                        "sunResultOpen"=>$sunResultOpenTime,
                        "sunResultClose"=>$sunResultOpenTime,
                        "sunBetOpen"=>$sunBetOpenTime,
                        "sunBetClose"=>$sunBetOpenTime,                     
                        "isSatActive"=>$satActive,
                        "isSunActive"=>$sunActive];
        }
        else
        {
            $requestData = ["marketId"=>$marketId,
                        "name"=>$marketName,
                        "isActive"=>$isActive,
                        "weekdayResultOpen"=>$weekdayResultOpenTime,
                        "weekdayResultClose"=>$weekdayResultCloseTime,
                        "weekdayBetOpen"=>$weekdayBetOpenTime,
                        "weekdayBetClose"=>$weekdayBetCloseTime,
                        "satResultOpen"=>$satResultOpenTime,
                        "satResultClose"=>$satResultCloseTime,
                        "satBetOpen"=>$satBetOpenTime,
                        "satBetClose"=>$satBetCloseTime,
                        "sunResultOpen"=>$sunResultOpenTime,
                        "sunResultClose"=>$sunResultCloseTime,
                        "sunBetOpen"=>$sunBetOpenTime,
                        "sunBetClose"=>$sunBetCloseTime,                     
                        "isSatActive"=>$satActive,
                        "isSunActive"=>$sunActive];
        }
        
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('markets',$requestData);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/market/updatemarketform')->with('status',false);
        return redirect('/market/updatemarketform')->with('status',true);
    }

    public function UpdateMarketResultForm()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $markets = HttpClientExtension::ExecuteResilientHttpGetRequest('markets');
        if($markets=='unauthorized')
            return redirect('/');
        return view('market.updatemarketresult')->with("markets",$markets);
    }

    public function UpdateNGMarketResultForm()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $markets = HttpClientExtension::ExecuteResilientHttpGetRequest('markets?isNGType=1');
        if($markets=='unauthorized')
            return redirect('/');
        return view('market.updatengmarketresult')->with("markets",$markets);
    }

    public function GetMarketResultDetail(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        
        $forMarket = 'marketresult?id='.$request->input('selectedMarket');

        $marketResult = HttpClientExtension::ExecuteResilientHttpGetRequest($forMarket);
        if($marketResult=='unauthorized')
            return redirect('/');
        return view('market.updatemarketresult')->with("marketResult",$marketResult);
    }

    public function GetNGMarketResultDetail(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        
        $forMarket = 'marketresult?id='.$request->input('selectedMarket');

        $marketResult = HttpClientExtension::ExecuteResilientHttpGetRequest($forMarket);
        if($marketResult=='unauthorized')
            return redirect('/');
        return view('market.updatengmarketresult')->with("marketResult",$marketResult);
    }

    public function UpdateMarketResultRequest(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $marketId = $request->input('marketId');
        $marketName = $request->input('marketName');
        $openPatti = $request->input('openPatti');
        $open = $request->input('open');
        $closePatti = $request->input('closePatti');
        $close = $request->input('close');

        $requestData = ["id"=>$marketId,
                        "name"=>$marketName,
                        "openPattiResult"=>$openPatti,
                        "openResult"=>$open,
                        "closePattiResult"=>$closePatti,
                        "closeResult"=>$close];
        
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('marketresult',$requestData);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/market/updatemarketresultform')->with('status',false);
        return redirect('/market/updatemarketresultform')->with('status',true);
    }

    public function UpdateNGMarketResultRequest(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $marketId = $request->input('marketId');
        $marketName = $request->input('marketName');
        $open = $request->input('open');
        $close = $request->input('close');

        $requestData = ["id"=>$marketId,
                        "name"=>$marketName,
                        "openPattiResult"=>'***',
                        "openResult"=>$open,
                        "closePattiResult"=>'***',
                        "closeResult"=>$close];
        
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('marketresult',$requestData);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/market/updatengmarketresultform')->with('status',false);
        return redirect('/market/updatengmarketresultform')->with('status',true);
    }

    public function MarketResultPoolView()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $marketresultspool = HttpClientExtension::ExecuteResilientHttpGetRequest('marketresultspool');
        if($marketresultspool=='unauthorized')
            return redirect('/');
        return view('market.viewmarketresultpool')->with("marketresultspool",$marketresultspool);
    }

    public function MarketResultRefresh($marketId)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $res = HttpClientExtension::ExecuteResilientHttpGetRequest('marketresultrefresh?marketId='.$marketId);
        
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return response()->json('',400);
        return response()->json('',200);
    }

    public function MarketResultConsolidate($poolId)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('marketresultconsolidate?poolId='.$poolId,null);

        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return response()->json('',400);
        return response()->json('',200);
    }
}
