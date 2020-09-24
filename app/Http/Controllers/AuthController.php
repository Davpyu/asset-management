<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $attempt = $request->only(['username', 'password']);
        if (!Auth::attempt($attempt)) {
            return $this->responseServerError('Username or password wrong');
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('api-login');
        return $this->responseWithToken($token->plainTextToken, $user->role);
    }

    public function register(RegisterRequest $request)
    {
        $role = $request->role ?? 'user';
        if ($role === 'admin' && Auth::check() && !Auth::user()->isAdmin()) {
            return $this->responseUnauthorized('Tidak bisa membuat admin dengan login role user');
        }
        $user = User::create([
            'name'          => $request->nama,
            'username'      => $request->username,
            'password'      => bcrypt($request->password),
            'email'         => $request->email,
            'phone_number'  => $request->no_hp,
            'address'       => $request->alamat,
            'role'          => $role
        ]);
        Auth::login($user);
        $token = $user->createToken('api-login');
        return $this->responseWithToken($token->plainTextToken, $user->role);
    }

    public function forgot(ForgotPasswordRequest $request)
    {
        /** @var User $user */
        $user = User::where('username', $request->username)
                    ->where('email', $request->email)
                    ->first();
        if (!$user) {
            return $this->responseUnprocessable('Email atau username salah');
        }

        $temp_password = Str::random(8);

        $user->update([
            'password' => bcrypt($temp_password)
        ]);
        
        return $this->responseWithData([
            'temp_password' => $temp_password
        ]);
    }

    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        Auth::guard('web')->logout();
        $user->tokens()->delete();
        return $this->responseSuccess('Logout success');
    }

    public function user()
    {
        return $this->responseWithData([
            'user' => Auth::user()
        ]);
    }
}
