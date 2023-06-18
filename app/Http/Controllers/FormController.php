<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormController extends Controller
{
    function form(): Response
    {
        return response()->view('form');
    }

    function submitForm(Request $request): Response
    {
        $name = $request->input('name');
        return response()->view('hello', ['name' => $name]);
    }
}
