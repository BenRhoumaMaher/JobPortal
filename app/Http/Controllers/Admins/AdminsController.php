<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Category\Category;
use App\Models\Job\Application;
use App\Models\Job\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminsController extends Controller
{
    public function viewLogin()
    {
        if(!auth()->guard('admin')->check()) {
            return view('admins.login');
        } else {
            return redirect()->route('admins.dashboard');
        }
    }
    public function checkLogin(Request $request)
    {
        if (auth()->guard('admin')->attempt([
        'email' => $request->input("email"),
        'password' => $request->input("password")
        ])) {
            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }
    public function index(Job $jobs, Category $category, Admin $admin, Application $application)
    {
        if(auth()->guard('admin')->check()) {
            $jobsCount = $jobs->count();
            $categoryCount = $category->count();
            $adminCount = $admin->count();
            $applicationCount = $application->count();
            return view('admins.index')->with([
                'jobsCount' => $jobsCount,
                'categoryCount' => $categoryCount,
                'adminCount' => $adminCount,
                'applicationCount' => $applicationCount,
            ]);
        } else {
            return redirect()->route('view.login');
        }
    }
    public function admins(Admin $admin)
    {
        $admins = $admin->get();
        return view('admins.admins')->with([
            'admins' => $admins,
        ]);
    }
    public function createAdmins()
    {
        return view('admins.create');
    }
    public function storeAdmins(Request $request, Admin $admin)
    {
        $incomingFields = $request->validate([
            'name' => ['required','min:3',Rule::unique('admins', 'name')],
            'email' => ['required','min:3',Rule::unique('admins', 'email')],
            'password' => ['required','min:5'],
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $admin->create($incomingFields);
        return redirect()->route('view.admins')->with('createadmin', 'admin has been created');
    }
    public function categories(Category $category)
    {
        $categories = $category->get();
        return view('admins.categories')->with([
            'categories' => $categories,
        ]);
    }
    public function createCategories()
    {
        return view('admins.create-categories');
    }
    public function storeCategories(Request $request, Category $category)
    {
        $incomingFields = $request->validate([
            'name' => ['required','min:3',Rule::unique('categories', 'name')],
        ]);
        $category->create($incomingFields);
        return redirect()->route('admins.categories')->with('createcategory', 'category has been created');
    }
    public function editCategories(Category $category)
    {
        return view('admins.edit-category')->with([
            'category' => $category,
        ]);
    }
    public function updateCategories(Request $request, Category $category)
    {
        $incomingFields = $request->validate([
            'name' => ['required','min:3'],
        ]);
        $category->update($incomingFields);
        return redirect()->route('admins.categories')->with('updatecategory', 'category has been updated');
    }
    public function deleteCategories(Category $category)
    {
        $category->delete();
        return redirect()->route('admins.categories')->with('deletecategory', 'category has been deleted');
    }
    public function showJob(Job $job)
    {
        $jobs = $job->get();
        return view('admins.jobs')->with([
            'jobs' => $jobs,
        ]);
    }
    public function createJobs()
    {
        return view('admins.create-jobs');
    }
    public function storeJobs(Request $request, Job $job)
    {
        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);
        $incomingFields = $request->validate([
            'job_title' => ['required','min:3',Rule::unique('jobs', 'job_title')],
            'job_region' => 'required',
            'company' => 'required',
            'job_type' => 'required',
            'vacancy' => 'required',
            'experience' => 'required',
            'salary' => 'required',
            'gender' => 'required',
            'application_deadline' => 'required',
            'jobdescription' => 'required',
            'responsabilities' => 'required',
            'education_experience' => 'required',
            'otherbenifits' => 'required',
            'category' => 'required',
            'image' => 'required',
        ]);

        $incomingFields['image'] = $myimage;
        $job->create($incomingFields);
        return redirect()->route('admins.jobs')->with('createjob', 'new job has been created');
    }
    public function deleteJob(Job $job)
    {
        $job->delete();
        return redirect()->route('show.jobs')->with('deletejob', 'job has been deleted');
    }
    public function showApplications(Application $application)
    {
        $applications = $application->get();
        return view('admins.applications')->with([
            'applications' => $applications,
        ]);
    }
    public function deleteApplications(Application $application)
    {
        $application->delete();
        return redirect()->route('show.applications')->with('deleteapp', 'app has been deleted');
    }
}
