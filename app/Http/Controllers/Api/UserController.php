<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index(UserService $service)
    {
        return $service->get();
    }


    public function show($id, UserService $service)
    {
        return $service->show($id);
    }

//    TODO эту хуйню просто заменить на update и на фронте просто отправлять объект с 1 полем
    public function changeName(Request $request)
    {
        return Auth::user()->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name']
        ]);
    }

    public function update(UpdateUserRequest $request, int $id, UserService $service)
    {
        return $service->update($request, $id);
    }

    public function user()
    {
        $user = Auth::user();

        if ($user) {
            $userPublic = $user->only(['full_name', 'email']);
            $userPublic['role'] = $user->role->role;

            return response()->json($userPublic);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

}
