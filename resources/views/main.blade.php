@extends('layout.master')

@section('content')
<div class="col-md-6" style="background-color: white;">
  <div class="box box-primary">
    <div class="box-header with-border">
      
      <h3 class="box-title">Whats Happening?</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form role="form" enctype="multipart/form-data" action="{{ route('post.create') }}" method="POST">
        @csrf
      <div class="box-body">
        <div class="form-group">
          <textarea class="form-control" id="body" rows="6" cols="30" placeholder="Whats Happening?" name="body"> </textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Upload Photos</label>
          <input type="file" id="img" name="img">
          @error('img')
              <div class="alert alert-danger">
                  {{ $message }}
              </div>
          @enderror
        </div>
      </div><!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div><!-- /.box -->

  <div class="box box-primary">
      <div class="box-header with-border">
          <h3 class="box-title">Timeline</h3>
        </div><!-- /.box-header -->
    <!-- The time line -->
    <ul class="timeline">

    @foreach($posts as $post)
    @if (is_null($post->img))
        <!-- timeline time label -->
        <li class="time-label">
            <span class="bg-red">
              {{$post->created_at->format('y-M-d')}}  <!--tanggal post -->
            </span>
          </li>
          <!-- /.timeline-label -->
          <!-- timeline item -->
          <li>
            <i class="fa fa-envelope bg-blue"></i>
            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i>{{$post->created_at->format('H:m')}}</span>  <!--jam post-->
              <h3 class="timeline-header"><a href="#">{{$post->user->name}}</a></h3>
              <div class="timeline-body">
               {{$post->caption}}
              </div>
              <div class='timeline-footer'>
                @if (is_null($post->likes_cnt))
                <a class="btn btn-primary btn-xs">0 Likes</a>
                @else
                <a class="btn btn-primary btn-xs">{{$post->likes_cnt}} Likes</a>
                @endif

                @if (is_null($post->comments_cnt))
                <a class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#addComment">0 Comments</a>
                @else
                <a class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#addComment">{{$post->comments_cnt}} Comments</a>
                @endif
                
              </div>
            </div>
          </li>
          <!-- END timeline item -->
    @else
         <!-- timeline time label -->
        <li class="time-label">
          <span class="bg-green">
              {{$post->created_at->format('y-M-d')}}
          </span>
        </li>
        <!-- /.timeline-label -->
        <!-- timeline item -->
        <li>
          <i class="fa fa-camera bg-purple"></i>
          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i>{{$post->created_at->format('H:m')}}</span>
            <h3 class="timeline-header"><a href="#">{{$post->user->name}}</a></h3>
            <div class="timeline-body">
              <img src="{{asset('uploads/feeds/'.$post->img )}}" class='margin' width="400" height="450"/>
              <p>{{$post->caption}}</p>
            </div>
            <div class='timeline-footer'>
                @if (is_null($post->likes_cnt))
                <a class="btn btn-primary btn-xs">0 Likes</a>
                @else
                <a class="btn btn-primary btn-xs">{{$post->likes_cnt}} Likes</a>
                @endif

                @if (is_null($post->comments_cnt))
                <a class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#addComment">0 Comments</a>
                @else
                <a class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#addComment">{{$post->comments_cnt}} Comments</a>
                @endif
                
              </div>
          </div>
        </li>
        
        <!-- END timeline item -->
    @endif

     

      @endforeach
      <li>
          <i class="fa fa-clock-o bg-gray"></i>
        </li>
        </ul>
  </div>

  </div>

  <script>
      var token = '{{ Session::token() }}';
          var urlEdit = '{{ route('edit') }}';
          var urlLike = '{{ route('like') }}';
  </script>

@include('layout.partial.modal')

@endsection

