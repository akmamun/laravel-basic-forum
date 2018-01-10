<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Thread;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{


    public function __construct()
    {

        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $threads = Thread::latest();
        // if request('by'), we should filter by the given username.
        if ($username = request('by')) {
            $user = \App\User::where('name', $username)->firstOrFail();
            $threads->where('user_id', $user->id);
        }
        $threads = $threads->get();
        return view('threads.index', compact('threads'));
    }


    public function create()
    {
        return view('threads.create');
    }


    public function store(Request $request)
    {

        $this->validate($request, [

            'title' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $thread = new Thread;
        $thread->user_id = auth()->id();
        $thread->title = $request->title;
        $thread->body = $request->body;
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('public/images',$filename);
        $thread->image = $filename;
        $thread->save();

        return redirect($thread->path());


    }


    public function show($id)

    {
        $thread = Thread::find($id);
        return view('threads.show', compact('thread'));
    }



    public function edit($id)
    {
        $thread = Thread::find($id);

        if( ! $thread->isTheOwner(Auth::user()))
        {
            return redirect('/threads');
        }

        return view('threads.edit',compact('thread'));
    }
//
//    public function update(Request $request, Thread $thread)
//    {
//        //
//    }
//
 public function update(Request $request,$id )
    {
        $thread = Thread::FindorFail($id);

        if( ! $thread->isTheOwner(Auth::user()))
        {
            return redirect('/threads');
        }


        $this->validate($request, [

            'title' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $thread->title = $request->title;
        $thread->body = $request->body;

        if ($request->hasFile('image'))
        {

            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('public/images',$filename);
            $thread->image = $filename;
            $thread->save();


        }
        else{
            $input = $request->all();
            $thread->fill($input)->save();
        }



        dd($thread);



        return redirect($thread->path());
    }




    public function destroy($id)
    {
        $thread = Thread::findOrFail($id);
        if( ! $thread->isTheOwner(Auth::user()))
        {
            return redirect('/threads');
        }

        $thread->delete();
        return redirect()->route('threads.index')
            ->with('flash_message',
                'Thread successfully deleted');
    }
}
