<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    function response(Request $request): Response
    {
        return response("Hello Response");
    }

    function header(Request $request): Response
    {
        $body = ["firstName" => "Rangga", "lastName" => "Setiawan"];
        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                "Author" => "Rangga Setiawan",
                "App" => "Belajar Laravel"
            ]);
    }

    function responseView(Request $request): Response
    {
        return response()->view('hello', ['name' => 'rangga']);
    }

    function responseJson(Request $request): JsonResponse
    {
        $body = ['firstName' => 'Rangga', 'lastName' => 'Setiawan'];
        return response()->json($body);
    }

    function responseFile(Request $request): BinaryFileResponse
    {
        return response()->file(storage_path('app/public/picture/Jasa pembuatan website profesional.png'));
    }

    function responseDownload(Request $request): BinaryFileResponse
    {
        return response()->download(storage_path('app/public/picture/Jasa pembuatan website profesional.png'));
    }
}
