<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Switch the application locale and store it in session.
     */
    public function switch(Request $request, string $locale)
    {
        $supported = ['en', 'id'];

        if (in_array($locale, $supported)) {
            session(['locale' => $locale]);
        }

        return redirect()->back()->withInput();
    }
}
