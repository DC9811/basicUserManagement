<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
//Register
    public function showRegister() {
        return view('register');
    }

    public function register(Request $request) {
        $response = Http::post('http://localhost:8000/register', $request->only(['name', 'email', 'password']));
        if (!$response->json('errors')) {
            return redirect()->route('showLogin');
        }
        else {
            $errors = $response->json('errors');
            return back()->withErrors($errors)->withInput();
        }
    }

//Login
    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {
        $response = Http::post('http://localhost:8000/login', $request->only(['email', 'password']));
        if ($response->successful()) {
            $user = $response->json('user');
            $login_id = $user['id'];

            Session::put('login_id', $login_id);

            if($user['role_id'] == 1){
                return redirect()->route('showAdmin');
            }
            else{
               return redirect()->route('showUser');  
            }
        }
        else{
            return back()->withErrors(['error' => 'Login failed']);
        }
    }
    public function logout(){
        Session::flush();
        return redirect()->route('showLogin');
    }
//Admin
    public function showAdmin() { 
        $login_id = Session::get('login_id');
        if (!$login_id) {
            return redirect()->route('showLogin')->withErrors(['error' => 'Unauthorized']);
        }
        $response = Http::get('http://localhost:8000/users',['id' => $login_id]);
        $users = collect($response->json());

        return view('admin', compact('users'));
    }
//User
    public function showUser(){
        $login_id = Session::get('login_id');
        $response = Http::get('http://localhost:8000/name',['login_id' => $login_id]);
        $name = collect($response->json());

        return view('user',compact('name'));
    }
//Add
    public function showAddUser(){
        $response = Http::get('http://localhost:8000/roles');
        $roles = $response->json();
        return view('adduser',compact('roles'));
    }

    public function adduser(Request $request){
        $response = Http::post('http://localhost:8000/register', $request->only(['name', 'email', 'role_id', 'password']));
        if (!$response->json('errors')) {
            return redirect()->route('showAdmin');
        }
        else {
            $errors = $response->json('errors');
            return back()->withErrors($errors)->withInput();
        }

    }
//Update
    public function showUpdateUser(Request $request){
        $login_id = Session::get('login_id');
        $response = Http::get('http://localhost:8000/search_user',['id' => $request->id, 'login_id' => $login_id]);
     
        $datas = $response->json();
        if(!$response->json('errors')){
             return view('updateuser', compact('datas'));
        }
        else{
            $errors = $response->json('errors');
            return redirect()->route('showAdmin')->withErrors([$errors]);
        }
    }

    public function updateuser(Request $request){
        $response = Http::put('http://localhost:8000/users/'.$request->id,
                                                            [
                                                            'name' => $request->name,
                                                            'role_id' => $request->role_id,
                                                            'email' => $request->email,
                                                            'password' => $request->password,
                                                            ]);
                                
        if (!$response->json('errors')) {
            return redirect()->route('showAdmin');
        }
        else {
            $errors = $response->json('errors');
            return back()->withErrors($errors)->withInput();
        }
    }
//Delete
    public function deleteuser(Request $request){
        $response = Http::delete('http://localhost:8000/users/'.$request->id);

        if (!$response->json('error')) {
            return redirect()->route('showAdmin');
        }
        else{
            $errors = $response->json('errors');
            return redirect()->route('showAdmin')->withErrors([$errors]);  
        }
    }
}

