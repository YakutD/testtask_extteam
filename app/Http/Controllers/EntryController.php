<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Traits\CheckCaptcha;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Entry;

class EntryController extends Controller
{
    use CheckCaptcha;

    public function index()
    {
        $entries = Entry::where('approved', true)->orderBy('created_at', 'desc')->paginate(2);;
        return view('guestbook.main', ['entries' => $entries->toArray(), 'links' => $entries->links()]);
    }

    public function store(Request $request)
    {
        
        $rules = [
            'name'    => "required|max:25",
            'message' => "required|min:5|max:150",
        ];

        $this->validate($request, $rules);

        $recaptcha = $request->all()['g-recaptcha-response'] ?? null;
        if(empty($recaptcha)) redirect()->back()->withErrors(['captcha' => 'CAPTCHA is empty']);
        else if(!$this->reCaptcha($recaptcha)) redirect()->back()->withErrors(['captcha' => 'CAPTCHA is wrong']);
      
        $entry = new Entry;
        $entry->name = $request->name;
        $entry->message = $request->message;
        $entry->approved = false;
        $entry->save();

        $request->flush();
        return redirect()->back()->with('status', 'Entry added!');
    }

    public function edit(int $id)
    {
        $entry = Entry::findOrFail($id);
    
        return view('admin.form', ['id' => $id,'entry'=>$entry->toArray(), 'is_admin' => true]);
    }

    public function update(Request $request, int $id)
    {
        
        $rules = [
            'name'    => "required|max:25",
            'message' => "required|min:5|max:150",
        ];

        $this->validate($request, $rules);

        $entry = Entry::findOrFail($id);
        $entry->name = $request->name;
        $entry->message = $request->message;
        $entry->approved = !empty($request->approved);
        $entry->save();

        $request->flush();
        return redirect()->back()->with('status', 'Entry updated!');
    }

    public function delete(int $id)
    {
        $entry = Entry::findOrFail($id);
        $entry->delete();

        return redirect()->back()->with('status', 'Entry deleted!');
    }
}
