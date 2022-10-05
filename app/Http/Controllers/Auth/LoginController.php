<?php

namespace App\Http\Controllers\Auth;

use App\Dto\Response\MessageDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('auth/login');
    }

    public function login(
        AuthLoginRequest $loginRequest,
        AuthServiceInterface $authService,
    ): RedirectResponse
    {
        if (Auth::attempt(request()->only('email', 'password'))) {
            $redirectResponse = redirect()->to(route('dashboard'));
        } else {
            $redirectResponse = back()->with([
                'message' => new MessageDto(
                    trans('messages.auth.incorrect_credentials'),
                    MessageDto::TYPE_DANGER
                ),
            ]);
        }

        return $redirectResponse;
    }

    public function logout(AuthServiceInterface $authService): RedirectResponse
    {
        $authService->logout();
        Auth::logout();

        return redirect()->to(route('auth.login.index'));
    }
}