<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Write static login information to the session.
 * Use for test purposes.
 */
class AuthController extends Controller
{
    public function login(Request $request, $id) {
        if( $id >= 2 && $id <= 4) {
            $request->session()->put('abalo_user', "visitor$id");
            $request->session()->put('abalo_mail', "visitor$id@abalo.example.com");
            $request->session()->put('abalo_time', time());
        }
        if( $id >= 5 && $id <= 7 ) {
            $request->session()->put('abalo_user', "seller$id");
            $request->session()->put('abalo_mail', "seller$id@abalo.example.com");
            $request->session()->put('abalo_time', time());
        }
        if ($id == 1) {
            $request->session()->put('abalo_user', "admin");
            $request->session()->put('abalo_mail', "admin@abalo.example.com");
            $request->session()->put('abalo_time', time());
        }
        return redirect()->route('haslogin');
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('haslogin');
    }


    public function isLoggedIn(Request $request) {
        if($request->session()->has('abalo_user')) {
            $r["user"] = $request->session()->get('abalo_user');
            $r["time"] = $request->session()->get('abalo_time');
            $r["mail"] = $request->session()->get('abalo_mail');
            $r["auth"] = "true";
        }
        else $r["auth"]="false";
        return response()->json($r);
    }

    public function loginInformation(Request $request) {
        if($request->session()->has('abalo_user')) {
            $r["user"] = $request->session()->get('abalo_user');
            $r["time"] = $request->session()->get('abalo_time');
            $r["mail"] = $request->session()->get('abalo_mail');
            $r["auth"] = "true";
            return json_encode($r);
        }
        else {
            return redirect()->route('haslogin');
        }
    }
}
