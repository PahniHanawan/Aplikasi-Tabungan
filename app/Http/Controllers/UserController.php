<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'User Management';
        $user = User::all();
        return view('admin.users.index', compact('user','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $title = 'Create User ';
        return view('admin.users.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try{
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = "user";
        $user->password = Hash::make($request->password);
        $user->save();
            \Session::flash('sukses','Data Berhasil Di Tambah');
        }catch(\Exception $e){
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->route('users.index');
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
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
