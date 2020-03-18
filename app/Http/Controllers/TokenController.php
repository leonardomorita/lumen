<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function gerarToken(Request $request)
    {
        // Garantindo que os dados vão ser passados
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $usuario = User::where('email', $request->email)->first();

        if (is_null($usuario) || !Hash::check($request->password, $usuario->password)) {
            return response()->json('Usuário ou senha inválidos', 401);
        }

        $token = JWT::encode(['email' => $request->email], env('JWT_KEY'));

        return [
            'acess_token' => $token
        ];
    }
}
