<div class="panel panel-default">
    <div class="panel-heading">
         <a href="#">{{$reply->owner->name}}</a> commented by :
         {{$reply->created_at->diffForHumans()}}
    </div>
    <div class="panel-body">
      <article>
          {{$reply->body}}
      </article>
    </div>
       <form method="POST" action="{{route('reply.destroy',$reply->id)}}">
           {{ csrf_field() }}
           {{ method_field('DELETE') }}
           <div class="form-group" >
               <input type="submit" class="btn btn-danger" value="Delete">
           </div>
       </form>

 </div>
