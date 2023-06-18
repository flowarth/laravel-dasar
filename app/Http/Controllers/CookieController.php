<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    function createCookie(Request $request): Response
    {
        return response('Hello Cookie')
            ->cookie('User-Id', 'Rangga', 1000, '/')
            ->cookie('Is-Member', 'true', 1000, '/');
    }

    function getCookie(Request $request): JsonResponse
    {
        return response()
            ->json([
                'userId' => $request->cookie('User-Id', 'guest'),
                'isMember' => $request->cookie('Is-Member', 'false')
            ]);
    }

    function clearCookie(Request $request): Response
    {
        return response('Clear Cookie')
            ->withoutCookie('User-Id')
            ->withoutCookie('Is-Member');
    }
}
