<?php

namespace App\Http\Controllers\Modulo\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modulo\Usuario\UserStoreRequest;
use App\Http\Requests\Modulo\Usuario\UserUpdateRequest;
use App\Http\Resources\Modulo\Usuario\UserCollection;
use App\Http\Resources\Modulo\Usuario\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Modulo\Usuario\UserCollection
     */
    public function index(Request $request)
    {
        $users = User::all();

        return new UserCollection($users);
    }

    /**
     * @param \App\Http\Requests\Modulo\Usuario\UserStoreRequest $request
     * @return \App\Http\Resources\Modulo\Usuario\UserResource
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());

        return new UserResource($user);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \App\Http\Resources\Modulo\Usuario\UserResource
     */
    public function show(Request $request, User $user)
    {
        return new UserResource($user);
    }

    /**
     * @param \App\Http\Requests\Modulo\Usuario\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \App\Http\Resources\Modulo\Usuario\UserResource
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}
