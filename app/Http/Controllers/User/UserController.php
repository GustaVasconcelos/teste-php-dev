<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Services\User\UserService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller 
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(): View|RedirectResponse
    {
        try {
            return view('pages.auth.register');
        } catch (Exception $e) {
            return redirect()->route('showLoginForm')->with('error', 'Erro ao mostrar a página de cadastro!');
        }
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            $this->userService->create($request->validated());
            return redirect()->route('showLoginForm')->with('success', 'Cadastro feito com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('create')->with('error', 'Erro ao realizar o cadastro!');
        }
    }
}
