<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function createUser(User $user, Request $request)
    {
        // dd($request);
        $this->userRepository->createUser($request);
        return redirect('/');

    }
    public function addUser(Request $request)
    {
        $user = Auth::user();

        if (Gate::denies('createUser', $user)) {
            return redirect('user_dashboard')->with('error', 'You are not authorized to create a user');
        } else {
            $this->userRepository->createUser($request);
            return redirect('admin_dashboard')->with('success', 'User created successfully');
        }
    }
    public function userDashboard()
    {
        $users = $this->userRepository->getAllUsersMembers();
        return view('user_dashboard', $users);
    }
    public function adminDashboard()
    {
        $users = $this->userRepository->getAllUsersAdmin();
        return view('admin_dashboard', $users);
    }

    public function login(Request $request)
    {
        $user = $this->userRepository->login($request);

        if ($user) {
            $user = Auth::user();
            if ($user->role === 1) {
                return redirect('user_dashboard')->with(['user' => $user]);
            } else {
                return redirect('admin_dashboard')->with(['user' => $user]);
            }

        } else {
            // Authentication failed, redirect back with error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Invalid credentials. Please try again.']);
        }
    }

    public function editUser(Request $request)
    {
        $user = Auth::user();
        if (Gate::denies('editUser', $user)) {
            return redirect('user_dashboard')->with('error', 'You are not authorized to edit a user');
        } else {
            $user = $this->userRepository->editUser($request);
            return redirect('admin_dashboard')->with('success', 'User updated successfully');
        }

    }

    public function deleteUser(Request $request)
    {
        $user = Auth::user();
        if (Gate::denies('deleteUser', $user)) {
            return redirect('user_dashboard')->with('error', 'You are not authorized to delete a user');
        } else {
            $user = $this->userRepository->deleteUser($request);
            return redirect('admin_dashboard')->with('success', 'User deleted successfully');
        }

        

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    
}
