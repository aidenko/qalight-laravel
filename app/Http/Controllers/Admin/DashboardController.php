<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if(Gate::allows('view_admin_dashboard'))
            return view('themes.admin.html.dashboard.dashboard');
        else
           return redirect('/');
    }
}
