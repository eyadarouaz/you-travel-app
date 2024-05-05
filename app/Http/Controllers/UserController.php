<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('user.index')->with('success', 'User added successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $userId)
    {
        try{
            $user = User::findOrFail($userId);

            if (!empty($request->email)) {
                $user->email = $request->email;
            }

            if (!empty($request->password)) {
                $validator = Validator::make($request->all(), [
                    'password' => 'min:8'
                ]);
    
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                
                $user->password = Hash::make($request->password);
            }

            $user->save();
            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }


    public function delete(User $user)
    {
        try{
            $user = User::findOrFail($user->id);
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User deleted successfully.');
        } catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
}
