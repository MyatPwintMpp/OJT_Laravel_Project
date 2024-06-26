<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Index function
     *
     * @return View
     */
    public function index(): View
    {
        $users = $this->userService->getAllUser();
        
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8|max:255',
            'password_confirmation' => 'required|min:8|max:255',
            'img' => 'image',
        ]);

        $this->userService->insert($request);

        return redirect()->route('users.index');
    }

    /**
     * show user detail
     *
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        $data = $this->userService->getUserById($id);

        return view('users.detail', ['user' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $data = $this->userService->getUserById($id);
        
        return view('users.edit', ['user' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'img' => 'image',
        ]);

        $this->userService->update($request);

        return redirect()->route('users.index');
    }

    /**
     * Delete user
     *
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        $this->userService->delete($id);

        return redirect()->route('users.index');
    }
}
