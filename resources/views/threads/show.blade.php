@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{$thread->creator->name}}</a> posted:
                        {{$thread->title}}</div>
                    <div class="panel-body">
                       <div>
                           <img src="{{asset('storage/images/' . $thread->image  )}}" alt="" width="70%">
                       </div>
                     <article>
                         {{$thread->body}}
                     </article>
                    </div>
                    @if(auth()->check())
                        @if($thread->user_id == Auth::user()->id)
                        <div class="form-group">
                            <a href="{{ route('threads.edit', $thread->id) }}"> <button type="submit" class="btn btn-primary">Edit</button></a>
                            <form method="POST" action="{{route('threads.destroy', $thread->id )}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </div>
                            </form>
                        </div>
                         @endif
                     @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($thread->replies as $reply)
                   @include('threads.reply')
                @endforeach
            </div>
        </div>
      @if(auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form  method="post" action="{{$thread->path() . '/replies'}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" rows="5" placeholder="Write Something"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Comment</button>
                        </div>
                    </form>
                </div>
            </div>
       @else
                <p class="text-center">Please <a href="{{route('login')}}">Sign in</a>  to participates</p>
      @endif
    </div>
@endsection
