@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="col-lg-6">
                    @foreach($threads as $thread)
                    <div class="thumbnail">
                        <img src="{{asset('storage/images/' . $thread->image  )}}" alt="" style="width:60%">
                        <a href="{{route('threads.show',$thread->id)}}">  <h3>{{$thread->title}}</h3></a>
                            <p>{{$thread->body}}</p>
                        </div>
                    @endforeach
                    </div>

                </div>
    </div>
@endsection
