<?php

namespace App\User\Controllers;

use Illuminate\Routing\Controller;

use App\Common\Models\User;

use Illuminate\Support\Facades\File;
use App\User\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function get(Request $request){
        return $request->user();
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create(array_merge(
            $request->only('name', 'email'),
            ['password' => bcrypt($request->password)],
        ));
        Auth::login($user);

        $path = storage_path('app/user'.$user->id);
        File::makeDirectory($path, 0777);

        return response()->json([
            'message' => 'Вы успешно зарегистрировались.',
            'user' => $user,
        ], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Неверный email или пароль',
                'errors' => 'Unauthorised'
            ], 401);
        }
        $user = User::where('email', $request->get('email'))->firstOrFail();
        Auth::login($user);
        return response()->json([
            'user' => $user,
        ], 200);

    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return response()->json([
            'message' => 'You are successfully logged out',
        ]);
    }
}
