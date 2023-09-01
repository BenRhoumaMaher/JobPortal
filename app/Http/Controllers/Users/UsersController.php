<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UsersController extends Controller
{
    public function profile(User $user)
    {
        return view('users.profile')->with([
            'profile' => $user,
        ]);
    }
    public function applications()
    {
        $applications = auth()->user()->applications()->get();
        return view('users.applications')->with([
            'applications' => $applications,
        ]);
    }
    public function savedJobs()
    {
        $jobs = auth()->user()->jobs()->get();
        return view('users.jobs')->with([
            'jobs' => $jobs,
        ]);
    }
    public function editDetails(User $user)
    {
        return view('users.editdetails')->with([
            'profile' => $user,
        ]);
    }
    public function updateDetails(Request $request, User $user)
    {
        $incomingFields = $request->validate([
            'name' => ['required','min:3'],
            'job_title' => ['required','min:3'],
            'bio' => ['required','min:3'],
            'facebook' => ['required','min:3'],
            'twitter' => ['required','min:3' ],
            'linkedin' => ['required','min:3'],
        ]);
        $user->update($incomingFields);
        $profile = auth()->user()->name;
        return redirect()->route('profile', $profile)->with('updateprofile', 'Your informations have been updated successfully');
    }
}
