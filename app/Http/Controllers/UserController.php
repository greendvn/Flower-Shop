<?php

namespace App\Http\Controllers;

use App\Http\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAll();
        return view('admin.users.index',compact('users'));
    }
    public function findById($id)
    {
        return $this->userService->findById($id);
    }

    public function update(Request $request, $id)
    {
        $user = $this->userService->findById($id);
        $this->userService->update($request,$user);
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = $this->userService->findById($id);
        $this->userService->destroy($user);
        return redirect()->route('user.index');
    }
}
