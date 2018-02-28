<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem as File;

class ThemeController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.pages.settings.theme.index');
    }

    public function set(String $themeName){
    	if(\Theme::exists($themeName)){
    	\Setting::set("theme",$themeName);
    	\Theme::set($themeName);
    	\Setting::save();
    	session()->flash('good', 'Storefront Theme now set to '.$themeName.'!');
    }else{
    	if($themeName == "disabled"){
    		\Setting::set("theme",null);
	    	\Theme::set(null);
	    	\Setting::save();
	    	session()->flash('good', 'Theme unloaded, Storefront will now look default!');
    	}else{
		session()->flash('bad', 'Theme does not exsist');
	}
    }
        return redirect()->back();
    }
public function uploadform(){
	return view('admin.pages.settings.theme.upload');
}
     public function upload(Request $request){
      //  $path = $request->file('theme')->store('themes');

		move_uploaded_file( $_FILES['theme']['tmp_name'], storage_path("themes/").$request->file('theme')->getClientOriginalName());
        $name = str_replace(".theme.tar.gz", "", $request->file('theme')->getClientOriginalName());
	    $exitCode = \Artisan::call('theme:install', ['package' => "buycraft"]);
	    session()->flash('bad', $exitCode);
	    unlink(storage_path("themes/").$request->file('theme')->getClientOriginalName());
		session()->flash('good', 'Theme uploaded! you may have to refresh the page for it to show');
        return redirect()->route('admin.settings.theme');
    }

}
