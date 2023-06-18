<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    function createSession(Request $request): string
    {
        $request->session()->put('userId', 'rangga');
        $request->session()->put('isMember', 'true');

        return "OK";
    }

    function getSession(Request $request): string
    {
        $userId = $request->session()->get('userId');
        $isMember = $request->session()->get('isMember');

        return "User id : $userId, is Member : $isMember";
    }
}
