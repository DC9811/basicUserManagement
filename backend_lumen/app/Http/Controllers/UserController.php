<?php
namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class UserController extends Controller
{
    private function userValidator(Request $request, $id = null){
        return Validator::make($request->all(),[
                                                'name' => 'required',
                                                'role_id' => 'nullable',
                                                'email' => 'required|email|unique:users,email'. ($id ? ','. $id : ''),
                                                'password' =>  [
                                                                $id ? 'nullable' : 'required',
                                                                'min:8',
                                                                'regex:/[A-Z]/',
                                                                'regex:/[a-z]/',
                                                                'regex:/[0-9]/',
                                                                'regex:/[@$!%*?&]/'
                                                                ]
                                               ],
                                        [
                                            'name.required' => 'Name is required.',
                                            'email.required' => 'Email is required.',
                                            'password.required' => 'Password is required.',
                                            'password.min' => 'The password must be aleast 8 characters.',
                                            'password.regex' => 'The password must contain the following: An uppercase, lowercase, a number, and a special character.'
                                        ]
                                );
    }

    private function roles_db(){
       return DB::table('roles')->get();
    }

    private function user_name_db($login_id){
        return $name = DB::table('users')->where('id', '=', $login_id)
                                  ->value('name');
    }

//Get View
    public function get_users(Request $request){
        $name = $this->user_name_db($request->login_id);

        $users = DB::table('users')->where('id', '!=', $request->id)
                                   ->where('deleted_at', '=', null)
                                   ->get();

        return response()->json([
                'name' => $name,
                'users' => $users
            ]);
    }

    public function get_name(Request $request){
        return response()->json($this->user_name_db($request->login_id));
    }

    public function get_roles(){
        return $this->roles_db();
    }
//Register
    public function register_user(Request $request){
        $validator = $this->userValidator($request);
         
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'input' => $request->except('password'),]);
        }
        else{
            $user = DB::table('users')
                        ->insertGetId([
                            'name' => $request->name,
                            'role_id'=>($request->role_id ? $request->role_id : 2),
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'created_at' => Carbon::now('Asia/Manila')
                         ]);

            return response()->json($user); 
        }
         
    }
//Login
    public function login_users(Request $request) {
        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['message' => 'Login successful', 'user' => $user]);
    }
//Update
    public function search_user(Request $request){
        $id = $request->id;
        $login_id = $request->login_id;

        if($login_id != $id){
            $user = DB::table('users')
                        ->where('id', $id)
                        ->first();

            $roles = $this->roles_db();
        
            if (isset($user->deleted_at) && $user->deleted_at !== null) {
                return response()->json(['errors' => 'This user has been deleted.']);
            }
        
            return response()->json(['user' => $user,'roles' => $roles]);
        }
        else{
             return response()->json(['errors' => 'This user cannot edit self.']);
        }
    }

    public function update_user(Request $request, $id) {
        $validator = $this->userValidator($request, $id);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'input' => $request->except('password'),]);
        }
        else{
            $data = $request->only(['name', 'email', 'role_id']);

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $data['updated_by'] = $id;
            $data['updated_at'] = Carbon::now('Asia/Manila');

            $user = DB::table('users')->where('id', $id)->update($data);

            return response()->json($user);
        }
    }
//Delete
    public function delete_user($id) {
        $user_db = DB::table('users')->where('id', $id);
        
        $user_db->update(['deleted_at'=>Carbon::now('Asia/Manila')]);
        return response()->json(['message' => 'User deleted']);
    }

}