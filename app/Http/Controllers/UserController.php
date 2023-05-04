<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    
    public function __construct()
    {
        $this->limit = 5;
    }
    
    public function index()
    {
        
        $users = User::paginate($this->limit);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            
        ]);
        
        
        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $filename = time() . '_' . $profilePicture->getClientOriginalName();
            $path = $profilePicture->storeAs('public/profile_pictures', $filename);
            $user->profile_picture = $filename;        
        }

        $user->save();
        $user->assignRole($validatedData['role']);
        
        return redirect()->route('admin.users.edit', $user->id)->with('success', 'User created successfully.');
    }

    public function edit(Request $request)
    {
        $roles = Role::all();
        $user = User::find($request->id);        
        return view('admin.users.edit', compact('user','roles'));
    }

    public function update(Request $request)
    {
    
        $user = User::find($request->id);
        
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
        ]);

        // Update the user
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
        
        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // first remove profile picture
            $user->deleteProfilePicture();
            $profilePicture = $request->file('profile_picture');
            $filename = time() . '_' . $profilePicture->getClientOriginalName();
            
            $path = $profilePicture->storeAs('profile_pictures', $filename);
            $user->profile_picture = $filename;        
        }
        
        $user->save();
        
        //Role
        $presentRole = $user->getRoleNames()->implode(', '); 
        if($presentRole != $request->role)
        {
            // remove present role
            if($presentRole !=''){
                    $user->removeRole($presentRole);
                }
            // assign new role
            $user->assignRole($request->role);
        }        

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if($user->id == 1) {
            return redirect()->back()->with('error', 'You cannot delete the first user.');
        }
    
        // Soft delete the user
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}

?>