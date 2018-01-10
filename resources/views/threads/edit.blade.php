@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Forum Thread</div>
                    <div class="panel-body">
                        <form method="post" action="{{route('threads.update', $thread->id)}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="title"> Title:</label>
                                <input type="text" class="form-control" name="title" value="{{ $thread->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="body"> Thread Body:</label>
                                <textarea name="body" class="form-control" id="body" cols="60"
                                          rows="5" required>{{ $thread->body }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Select image to upload:</label>
                                <input type="file" name="image" id="image" value="{{ $thread->image }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Post</button>
                            </div>
                            @if(count($errors))
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
