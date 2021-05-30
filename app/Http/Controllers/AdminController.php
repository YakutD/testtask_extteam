<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Entry;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $entries = Entry::orderBy('created_at', 'desc')->paginate(2);
        return view('admin.list', ['entries' => $entries->toArray(), 'links' => $entries->links(), 'is_admin' => true]);
        
    }
}
