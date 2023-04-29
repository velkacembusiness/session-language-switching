<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeLanguageController extends Controller
{
    public function __invoke($locale)
    {
        // Check if the locale is available and valid
        if (!in_array($locale, config('app.available_locales'))) {
            return redirect()->back();
        }

        if (Auth::check()) {
            // Update the user's language preference in the database
            Auth::user()->update(['language' => $locale]);
        } else {
            // Set the language in the session for guests
            session()->put('locale', $locale);
        }

        // Redirect back to the previous page
        return redirect()->back();
    }
}
