<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class AjaxTokenVerify extends Controller
{
  public function VerifyToken (Request $request)
  {
    $request->session()->regenerate();
    return csrf_token();
  }
}
