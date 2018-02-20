<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Spatie\Permission\Models\Permission;
use \Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        return view('admin.pages.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.pages.role.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $role = null;
       if(request("name") != null && trim(request("name")) != "" ){

            $role = \Spatie\Permission\Models\Role::where("name",trim(request("name")))->get()->first();
            if($role != null){
                return redirect()->route('admin.roles');
            }
            $role = Role::create(['name' => trim(request("name"))]);
            $role->syncPermissions(request("perms"));
            $role->save();
        }
        
        return redirect()->route('admin.roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
         return view('admin.pages.role.view')->with(['role'=>$role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if(request("name") != null && trim(request("name")) != "" ){
            $role->name = request("name");
            $role->save();
        }
        $role->syncPermissions(request("perms"));
        return view('admin.pages.role.view')->with(['role'=>$role]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        foreach(\App\User::role($role->name)->get() as $user){
            $user->removeRole($role);
        }
        $role->delete();
        return redirect()->route('admin.roles');
    }
}
