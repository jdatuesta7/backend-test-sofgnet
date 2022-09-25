<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string'
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response($user, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                /** @var \App\Models\MyUserModel $user **/
                $user = Auth::user();
                $token = $user->createToken('token')->plainTextToken;
                $cookie = cookie('cookie_user_token', $token, 60 * 24);
                return response([
                    "token" => $token
                ], Response::HTTP_OK)->withCookie($cookie);
            } else {
                return response([
                    'error' => "Credenciales inválidas"
                ], Response::HTTP_UNAUTHORIZED);
            }
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function logout()
    {
        try {
            $cookie = Cookie::forget('cookie_user_token');
            return response(["message" => "se ha cerrado la sesión"], Response::HTTP_OK)->withCookie($cookie);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }
}
