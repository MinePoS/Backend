<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function forbiddenResponse()
    {
        return \Response::make(view('admin.errors.403'), 403);
    }
}
