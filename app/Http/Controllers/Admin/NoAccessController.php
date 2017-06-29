<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoAccessController extends Controller{
    public function index(Request $request) {
        return view('themes.admin.html.no-access.no-access');
    }
}
