@extends('layouts.app')

@section('content')
<div class="container" style="background-color:white;">
        <section class="row new-post">
                <div class="col-md-6 col-md-offset-3">
                    <header>
                        <h3>What do you have to say?</h3>
                    </header>
                    <form action="{{ route('post.create') }}" method="post">
                        <div class="form-group">
                            <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Post</button>
                        <input type="hidden" value="{{ Session::token() }}" name="_token">
                    </form>
                </div>
            </section>
            <section class="row posts">
                <div class="col-md-6 col-md-offset-3">
                    <header>
                        <h3>Check the posts</h3>
                    </header>
                    @foreach($posts as $post)
                    <article class="post" data-postid="{{ $post->id }}">
                        <p>{{ $post->caption }}</p>
                        <div class="info">
                            Posted by {{ $post->user->name }} on {{ $post->created_at }}
                        </div>
                        <div class="interaction">
                            <a href="#"
                                class="like">{{ $post->user->likes()->where('feeds_id', $post->id)->first() ? Auth::user()->likes()->where('feeds_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>
                            |
                            <a href="#"
                                class="like">{{ $post->user->likes()->where('feeds_id', $post->id)->first() ? Auth::user()->likes()->where('feeds_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
                            @if(Auth::user()->id == $post->user->id)
                            |
                            <a href="#" class="edit">Edit</a> |
                            <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                            @endif
                        </div> 
                    </article>
                    @endforeach
                </div>
            </section>
            
            <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit Post</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="post-body">Edit the Post</label>
                                    <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            
            <script>
                var token = '{{ Session::token() }}';
                    var urlEdit = '{{ route('edit') }}';
                    var urlLike = '{{ route('like') }}';
            </script>
</div>
@endsection