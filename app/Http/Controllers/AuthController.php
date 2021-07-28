<?php
namespace App\Http\Controllers;

use App\Components\ApiController;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function register(UserRequest $request)
    {
        $user = new User();
        $user->fill($request->toArray());
        $user->password = Hash::make($user->password);
        $user->save();

        return $this->sendResponse(self::$RESPONSE_CREATED, self::$CREATE_SUCCESS, $user);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOne($id);

        $data = $request->only(['name', 'password', 'email']);
        $user->fill($data);
        if($request->get('password')){
            $user->password = Hash::make($user->password);
        }

        $user->save();

        return $this->sendResponse(self::$RESPONSE_SUCCESS, self::$UPDATE_SUCCESS, $user);
    }

    public function login(UserLoginRequest $request)
    {
        $userInfo = $request->only(['email', 'password']);

        if (Auth::attempt($userInfo)) {
            $token = Auth::user()->createToken('Laravel Personal Access Client')->accessToken;

            return $this->sendResponse(self::$RESPONSE_SUCCESS, 'login success', [
                'access_token' => $token,
                'user' => Auth::user()
            ]);

        }else{
            return $this->sendResponse(self::$RESPONSE_AUTHORIZE, '', [
                'email' => 'User or password invalid'
            ]);
        }

    }

    public function getMe()
    {
        $user = \auth()->user();
        return $this->sendResponse(self::$RESPONSE_SUCCESS, self::$REQUEST_SUCCESS, $user);
    }

    public function forgotPassword()
    {

    }
}
