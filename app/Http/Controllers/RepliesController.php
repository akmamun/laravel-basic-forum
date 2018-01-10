<?php

namespace App\Http\Controllers;

use App\User;
use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store( Thread $thread)

    {

        $this->validate(request(), ['body'=>'required']);

        $thread->addReply([
            'body'=>request('body'),
            'user_id'=>auth()->id(),

        ]);

        return back();

    }


    public function show(Reply $reply)
    {
        //
    }


    public function edit($id)
    {

    }


    public function update($id)
    {



    }

    public function destroy($id)
    {

        $reply= Reply::findOrFail($id);

        $reply->delete();
        dd($reply);

        return redirect()->route('threads.index')
            ->with('flash_message',
                'Thread successfully deleted');
    }
}
