<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $this->validateLogin($request);

        if (Auth::attempt($this->credentials($request))) {
            $request->session()->regenerate();

            // Redirect based on user role

            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->route('vendors.index');
            } elseif ($user->hasRole('vendor')) {
                return redirect()->route('vendor-products.index');
            } elseif ($user->hasRole('customer')) {
                return redirect()->route('tasks.index');
            }

            // Default redirect
            return redirect()->intended('/');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Validate the user's login request.
     */
    protected function validateLogin(LoginRequest $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    }

    /**
     * Get the credentials from the request.
     */
    protected function credentials(LoginRequest $request)
    {
        return $request->only('email', 'password');
    }
}
