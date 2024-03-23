<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request)
    {
        try 
        {
            $email = $request->input('email');
            $password = $request->input('password');

            if ($this->loginService->login($email, $password)) {
                // Login successful, generate API token
                $token = auth()->user()->createToken('api_token')->plainTextToken;
                return response()->json(['access_token' => $token]);
            }

            return response()->json(['error' => 'Invalid credentials'], 401);
         }catch (Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }
}