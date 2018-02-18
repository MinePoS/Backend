<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.permissions.listperms');
    }

    public function updaterole(){
        //dd(request("perms"));
        $role = \Auth::user()->roles()->get()->first();
        $role->syncPermissions(request("perms"));
    return view('admin.pages.permissions.listperms');
    }
}
