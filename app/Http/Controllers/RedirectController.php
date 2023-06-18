<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    function redirectTo(): string
    {
        return "Redirect To";
    }

    function redirectFrom(): RedirectResponse
    {
        return redirect('/redirect/to');
    }

    function redirectName(): RedirectResponse
    {
        return redirect()->route('redirect-hello', ['name' => 'Rangga']);
    }

    function redirectHello(string $name): string
    {
        return "Hello $name";
    }

    function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], ['name' => 'Rangga']);
    }

    function redirectAway(): RedirectResponse
    {
        return redirect()->away('https://www.google.com');
    }
}
