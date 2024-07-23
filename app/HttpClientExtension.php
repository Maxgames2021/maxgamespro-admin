<?php

namespace App;

use Illuminate\Support\Facades\Http;
use Session;
use Log;

class HttpClientExtension
{
    public static function ExecuteResilientHttpGetRequest($uri)
    {
        $res = HttpClientExtension::ExecuteResilientHttpRequest('GET',$uri);
        return HttpClientExtension::HandleHttpresponse('GET',$uri,$res);
    }
    public static function ExecuteResilientHttpPostRequest($uri, $data)
    {
        $res = HttpClientExtension::ExecuteResilientHttpRequest('POST',$uri, $data);
        return HttpClientExtension::HandleHttpresponse('POST',$uri,$res, $data);
    }
    public static function ExecuteResilientHttpPutRequest($uri, $data)
    {
        $res = HttpClientExtension::ExecuteResilientHttpRequest('PUT',$uri, $data);
        return HttpClientExtension::HandleHttpresponse('PUT',$uri,$res, $data);
    }
    public static function ExecuteResilientHttpDeleteRequest($uri)
    {
        $res = HttpClientExtension::ExecuteResilientHttpRequest('DELETE',$uri);
        return HttpClientExtension::HandleHttpresponse('DELETE',$uri,$res);
    }

    private static function ExecuteResilientHttpRequest($method, $uri, $data=null)
    {
        $baseUrl = env('API_BASE_URL');
        $requestUri = $baseUrl.$uri;
        if(Session::has('token') && Session::has('refresh_token'))
        {
            $token = 'Bearer '.Session::get('token');
            switch($method)
            {

                case 'GET' : return Http::withHeaders([
                                                    'Authorization' => $token
                                                    ])->get($requestUri);
                break;
                case 'POST': return Http::withHeaders([
                                                    'Authorization' => $token
                                                    ])->post($requestUri,$data);
                break;
                case 'PUT': return Http::withHeaders([
                                                    'Authorization' => $token
                                                    ])->put($requestUri,$data);
                break;
                case 'DELETE': return Http::withHeaders([
                                                    'Authorization' => $token
                                                    ])->delete($requestUri);
                break;
                default:return null;
            }
        }
    }

    private static function HandleHttpresponse($method,$uri,$res,$data=null)
    {
        if(!($res->successful()))
        {
            Log::info('status : '.$res->status().'- method : '.$method.' - uri : '.$uri.' - data : '.json_encode($data));

            if($res->status() == 401)
            {
                $isTokenAvailable = HttpClientExtension::RefreshToken();
                if($isTokenAvailable)
                {
                    $res = HttpClientExtension::ExecuteResilientHttpRequest($method,$uri,$data);
                    if($res->successful())
                    {
                        $resposneData = $res->json();
                        return $resposneData;
                    }
                    else
                    {
                        Log::info('status : '.$res->status().'- method : '.$method.' - uri : '.$uri.' - data : '.json_encode($data));
                        return "failed";
                    }
                }
                else
                {
                    Session::forget(['token', 'refresh_token']);
                    return 'unauthorized';
                }
            }
            else
            {
                return "failed";
            }
        }
        else
        {
            $resposneData = $res->json();
            return $resposneData;
        }
    }

    public static function CreateToken($data)
    {
        $requestUri = env('API_BASE_URL').'adminlogin';
        $res = Http::post($requestUri,$data);
        if($res->successful())
        {
            $reposneData = $res->json();
            HttpClientExtension::SetSessionUserId($reposneData['token']);
            Session::put('token', $reposneData['token']);
            Session::put('refresh_token', $reposneData['refreshToken']);
            return true;
        }
        else return false;
    }

    public static function RefreshToken()
    {
        $requestUri = env('API_BASE_URL').'refresh';
        if(Session::has('refresh_token'))
        {
            $refreshToken = Session::get('refresh_token');
            $response = Http::withHeaders([
                                    'X-RefreshToken' => $refreshToken
                                    ])->get($requestUri);

            if($response->successful())
            {
                $data =  $response->json();
                Session::forget(['token', 'refresh_token']);
                HttpClientExtension::SetSessionUserId($data['token']);
                Session::put('token',$data['token']);
                Session::put('refresh_token',$data['refreshToken']);
                return true;
            }
            else return false;
        }
        else return false;
    }
    public static function SetSessionUserId($jwt)
    {
        $tokenParts = explode('.', $jwt);
        $payload = base64_decode($tokenParts[1]);
        $userId = json_decode($payload)->userid;
        $username = json_decode($payload)->username;
        Session::put('user_id',$userId);
    }
}
