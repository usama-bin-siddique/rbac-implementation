<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index()
    {
        $users = User::query()->with('roles:name')->latest()->get();
//return $users[0]->roles[0]->name;
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::query()->create($request->validated());
        if ($user) {
            $user->assignRole('user');
            return Redirect::route('users.create')->with('status', 'data-saved');
        }
        return Redirect::route('users.create')->with('error', 'data-saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function edit(User $user)
    {
        return view('users.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();

        if (empty($validatedData['password'])) {
            unset($validatedData['password']); // Remove the password field from the data array
        }
        $user->update($validatedData);

        return Redirect::route('users.edit', $user)->with('status', 'data-saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(DeleteUserRequest $request, User $user)
    {
        $user->delete();
        return Redirect::route('users.index', $user)->with('status', 'data-deleted');
    }
}
