<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // registartion api
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return sendResponse($success, 'Registration successfully.');
    }


    // login api
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error.', $validator->errors());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token =  $user->createToken('MyApp')->plainTextToken;
            $tokenId = getUserIdFromToken($token);
            //token expiration
            $expiresAt = Carbon::now()->addHours(1);
            $user->tokens()->where('id', $tokenId)->update(['expires_at' => $expiresAt]);
            $success['token'] = $token;
            $success['name'] = $user->name;
            $success['expires_at'] = $expiresAt->toDateTimeString(); 

            return sendResponse($success, 'User login successfully.');
        } else {
            return sendError('Unauthorised.', ['error' => 'Credentials does not match, please try  again!']);
        }
    }
}
