<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StudentLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentAuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('login.student.index');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(StudentLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        //return redirect()->intended(RouteServiceProvider::HOME);
        return 1;
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

//        return redirect('/');
        return 1;
    }
}
