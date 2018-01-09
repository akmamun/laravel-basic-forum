<?php

namespace App\Http\Controllers;

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

//    public function store($channelId, Thread $thread)

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


    public function edit(Reply $reply)
    {
        //
    }


    public function update(Request $request, Reply $reply)
    {
        //
    }

    public function destroy(Reply $reply)
    {
        //
    }
}
