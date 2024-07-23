<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;
use Session;

class OfferController extends Controller
{
    public function CreateOfferForm()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        return view('offer.createoffer');
    }

    public function CreateOfferRequest(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $requestData=[
                        "name"=>$request->input('offerName'),
                        "description"=>$request->input('offerDescription')
                    ];

        $res = HttpClientExtension::ExecuteResilientHttpPostRequest('offer',$requestData);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/offer/createofferform')->with('status',false);

        return redirect('/offer/createofferform')->with('status',true);
    }

    public function ViewOffer()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $offers = HttpClientExtension::ExecuteResilientHttpGetRequest('offers');
        if($offers=='unauthorized')
            return redirect('/');
        return view('offer.closeoffer')->with('offers',$offers);
    }

    public function CloseOfferRequest($id)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $forOffer = 'offer?id='.$id;
        $res = HttpClientExtension::ExecuteResilientHttpPutRequest($forOffer,null);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/offer/viewoffer')->with('status',false);
        return redirect('/offer/viewoffer')->with('status',true);
    }
}
