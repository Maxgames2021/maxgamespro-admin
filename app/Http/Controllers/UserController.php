<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientExtension;
use Session;

class UserController extends Controller
{
    public function Index()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $users = HttpClientExtension::ExecuteResilientHttpGetRequest('user');
        if($users=='unauthorized')
            return redirect('/');
        $totalBalance = 0;
        if(!empty($users))
        {
            foreach($users as $user)
            {
                $totalBalance=$totalBalance+$user['balance'];
            }
        }
        $usersDetail = ["totalBalance"=>$totalBalance,"users"=>$users];
        return view('user.viewuser')->with("usersDetail",$usersDetail);
    }

    public function UpdateAdminProfile()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $userDetail = HttpClientExtension::ExecuteResilientHttpGetRequest('userdetails');
        if($userDetail=='unauthorized')
            return redirect('/');
        $name = explode(" ",$userDetail['name']);
        $user = [   'id'=>$userDetail['id'],
                    'username'=>$userDetail['username'],
                    'firstName'=>$name[0],
                    'lastName'=>$name[1],
                    'contactNo'=>$userDetail['contactNo'],
                ];

        return view('user.updateadminprofile')->with("user",$user);
    }

    public function UpdateAdminProfileRequest($id, Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $requestBody = ["contactNo"=>$request->input('contactNo')];

        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('user',$requestBody);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/user/updateadminprofile')->with('status',false);
        return redirect('/user/updateadminprofile')->with('status',true);
    }

    public function CreateAdminProfile()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        return view('user.createadminprofile');
    }

    public function CreateAdminProfileRequest(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $requestBody = ["username"=>$request->input('username'),
                        "firstname"=>$request->input('firstName'),
                        "lastname"=>$request->input('lastName'),
                        "contactNo"=>$request->input('contactNo'),
                        "password"=>$request->input('password'),
                        "allowedLogin"=>$request->input('allowedLogin')];

        $res = HttpClientExtension::ExecuteResilientHttpPostRequest('adminuser',$requestBody);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/user/createadminprofile')->with('status',false);
        return redirect('/user/createadminprofile')->with('status',true);
    }

    public function RestoreUserPassword()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        
        return view('user.restoreuserpassword');
    }

    public function RestoreUserPasswordRequest(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }
        $requestBody = ["id"=>$request->input('selectUser'),
                        "password"=>$request->input('password')];

        error_log('id: '.$requestBody['id'].' pwd: '.$request->input('password'));

        $res = HttpClientExtension::ExecuteResilientHttpPutRequest('userpwd',$requestBody);
        if($res=='unauthorized')
            return redirect('/');
        if($res=="failed")
            return redirect('/user/restoreuserpassword')->with('status',false);
        return redirect('/user/restoreuserpassword')->with('status',true);
    }

    public function ViewAdminUser()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $users = HttpClientExtension::ExecuteResilientHttpGetRequest('user');
        if($users=='unauthorized')
            return redirect('/');
        return view('user.viewadminuser')->with("users",$users);
    }

    public function ViewUserDetail()
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        return view('user.userdetail');
    }

    public function GetUserDetail(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $id = $request->id;

        $userdetail = HttpClientExtension::ExecuteResilientHttpGetRequest('userdetail?id='.$id);
        if($userdetail=='unauthorized')
            return redirect('/');
        return $userdetail;
    }

    public function GetUsernameHint(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $searchText = $request->searchText;

        $userlist = HttpClientExtension::ExecuteResilientHttpGetRequest('usernamehint?searchText='.$searchText);
        if($userlist=='unauthorized')
            return redirect('/');
        return $userlist;
    }
    public function GetUsersGameTransaction(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $userId = $request->userId;

        $gameTransactionList = HttpClientExtension::ExecuteResilientHttpGetRequest('usergametransactionarchive?offset=0&limit=9999999&userId='.$userId);
        if($gameTransactionList=='unauthorized')
            return redirect('/');
        
        return $gameTransactionList;
    }

    public function GetUsersDepositTransaction(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $userId = $request->userId;

        $depositTransactionList = HttpClientExtension::ExecuteResilientHttpGetRequest('userdepositarchive?offset=0&limit=9999999&userId='.$userId);
        if($depositTransactionList=='unauthorized')
            return redirect('/');
        
        return $depositTransactionList;
    }

    public function GetUsersWithdrawalTransaction(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $userId = $request->userId;

        $withdrawalTransactionList = HttpClientExtension::ExecuteResilientHttpGetRequest('userwithdrawalarchive?offset=0&limit=9999999&userId='.$userId);
        if($withdrawalTransactionList=='unauthorized')
            return redirect('/');
        
        return $withdrawalTransactionList;
    }

    public function UpdateUsersBeneficiaryDetail(Request $request)
    {
        if(!Session::has('refresh_token'))
        {
            return redirect('login');
        }

        $data = ["userId"=>$request->input('userId'),
                "isBeneficiaryIn"=>$request->input('isBeneficiaryIn')];

        $result = HttpClientExtension::ExecuteResilientHttpPutRequest('userbankaccountbeneficiaryin',$data);
        if($result=='unauthorized')
            return redirect('/');
        if($result=="failed")
            return response()->json('',400);
        return response()->json('',200);
    }
}
