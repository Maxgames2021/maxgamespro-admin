<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;
use Session;

class GameController extends Controller
{
    public function UpdateGameForm()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $markets = HttpClientExtension::ExecuteResilientHttpGetRequest('markets?isNGType=2');
        if($markets=='unauthorized')
            return redirect('/');
        return view('game.updategame')->with("markets",$markets);
    }
    public function GetGameDetail(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        
        $forMarket = 'marketgames?id='.$request->input('selectedMarket');

        $games = HttpClientExtension::ExecuteResilientHttpGetRequest($forMarket);
        if($games=='unauthorized')
            return redirect('/');

        $gameDetails = ["marketId"=>$request->input('selectedMarket'),
                        "games"=>$games];

        return view('game.updategame')->with("gameDetails",$gameDetails);
    }

    // to avoid market selection on each update
    public function GetGameDetail2($id)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        
        $forMarket = 'marketgames?id='.$id;

        $games = HttpClientExtension::ExecuteResilientHttpGetRequest($forMarket);
        if($games=='unauthorized')
            return redirect('/');

        $gameDetails = ["marketId"=>$id,
                        "games"=>$games];

        return view('game.updategame')->with("gameDetails",$gameDetails);
    }

    public function UpdateGameRequest($id,Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $marketId = $request->input('marketId');

        $requestData =[ "id"=>$id,
                    "ratio"=>$request->input('gameRatio'),
                    "isActive"=>1];

        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('marketgames',$requestData);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/game/getgamedetail/'.$marketId)->with('status',false);
        return redirect('/game/getgamedetail/'.$marketId)->with('status',true);
    }

    public function GetGames($id)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $forMarket = 'marketgames?id='.$id;

        $games = HttpClientExtension::ExecuteResilientHttpGetRequest($forMarket);
        if($games=='unauthorized')
            return redirect('/');

        return $games;
    }
}
