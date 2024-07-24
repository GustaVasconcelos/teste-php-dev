<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\AuthenticationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm(): View|RedirectResponse
    {
        try {
            return view('pages.auth.login');
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Erro ao mostrar a página de login');
        }
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $user = $this->authService->authenticate($request->validated());

            Auth::guard('web')->login($user, $request->filled('remember'));

            return redirect()->route('home')->with('success', 'Autenticação feita com sucesso');
        } catch (AuthenticationException $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Erro inesperado');
        }
    }

    public function logout(): RedirectResponse
    {
        try {
            Auth::guard('web')->logout();
    
            return redirect()->route('showFormLogin')->with('success', 'desconectado com sucesso');
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', 'Erro inesperado ao desconectar');
        }
    }
}