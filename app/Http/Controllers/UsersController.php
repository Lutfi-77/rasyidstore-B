<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $length = config('admin.pagination.length');

        $users = User::query();

        if ($request->get('search', null) !== null)
            $users->where('fullname', 'like', '%' . $request->get('search', '') . '%');


        return Inertia::render('Users/List', ['data' => $users->paginate($length)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateRequest = $request->validate([
            'fullname' => 'required',
            'username' => 'required|unique:users|min:3',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()]
        ]);

        $validateRequest['password'] = Hash::make($validateRequest['password']);

        User::create($validateRequest);

        return Redirect::route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return Inertia::render('Users/Edit', ['entry' => $user->only('username', 'fullname', 'email'), 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hasPassword = $request->get('password', null) !== null;
        $rules = [
            'fullname' => 'required',
            'username' => 'required|min:3|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
        ];

        // tell if the password is included 
        if ($hasPassword)
            array_push($rules, ...[
                'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()]
            ]);

        // validation request
        $validateRequest = $request->validate($rules);


        // hashing pass
        if ($hasPassword) $validateRequest['password'] = Hash::make($validateRequest['password']);


        User::find($id)->update($validateRequest);

        return redirect()->route('users.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('users.index');
    }
}
