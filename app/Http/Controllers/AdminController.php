<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $urls = Url::where('user_id', auth()->id())->get();

        return view('dashboard', compact('urls'));
    }
}
