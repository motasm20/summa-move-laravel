<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $users = User::all();
        return view( 'admin.users.index', compact( 'users' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        return view( 'admin.users.create' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        $validated = $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',
        ] );

        $validated[ 'password' ] = bcrypt( $validated[ 'password' ] );

        \App\Models\User::create( $validated );

        return redirect()->route( 'admin.users.index' )->with( 'success', 'Gebruiker aangemaakt.' );

    }

    /**
    * Display the specified resource.
    */

    public function show( string $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, User $user ) {
        $request->validate( [
            'role' => 'required|in:user,admin',
        ] );

        $user->role = $request->role;
        $user->save();

        return redirect()->route( 'admin.users.index' )->with( 'success', 'Rol bijgewerkt.' );

    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        if (auth()->id() === $user->id) {
        return back()->with('error', 'Je kunt jezelf niet verwijderen.');
    }

    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'Gebruiker verwijderd.');
    }
}
