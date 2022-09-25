<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6'
            ]);

            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = Hash::make($validated['password']);
            $user->save();

            return Response($user, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (! $token = auth()->attempt($credentials)) {
                return Response(['error' => 'Credenciales inválidas'], Response::HTTP_UNAUTHORIZED);
            }

            return $this->respondWithToken($token);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function me()
    {
        return Response(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return Response(['message' => 'Ha cerrado sesion correctamente']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return Response([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
