<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    function hello(Request $request): string
    {
        $name = $request->input('name');
        return "Hello $name";
    }

    function helloFirst(Request $request): string
    {
        $firstName = $request->input('name.first');
        return "Hello $firstName";
    }

    function helloInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }

    function arrayInput(Request $request): string
    {
        $names = $request->input('products.*.name');
        return json_encode($names);
    }

    function inputType(Request $request): string
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthDate = $request->date('birthDate', 'Y-m-d');

        return json_encode([
            'name' => $name,
            'married' => $married,
            'birthDate' => $birthDate->format('Y-m-d')
        ]);
    }

    function filterOnly(Request $request): string
    {
        $name = $request->only(['name.first', 'name.last']);
        return json_encode($name);
    }

    function filterExcept(Request $request): string
    {
        $user = $request->except(['admin']);
        return json_encode($user);
    }

    function filterMerge(Request $request): string
    {
        $request->merge(['admin' => false]);
        $user = $request->input();
        return json_encode($user);
    }
}
