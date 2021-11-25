<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Lib\ApiWrapper;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)

    {
        try {
            $res = array();
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('calendarApp')->plainTextToken;
            $success['name'] = $user->name;
            $res = $success;
            $message = 'User register successfully.';
        }catch (\Exception $e){
            $res = ["error" => $e->getMessage()];
            $message = 'error in creating user.';
        }

        return ApiWrapper::sendResponse($res, $message);

    }


    /**
     * Login api
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = Auth::user();
            $success['name'] = $user->name;
            $success['token'] = $user->createToken('calendarApp')->plainTextToken;
            $res = $success;
            $message = 'User login successfully.';
        } else {
            $res = ['error' => 'Unauthorised'];
            $message = 'Unauthorised.';
        }

        return ApiWrapper::sendResponse($res, $message);
    }
}
