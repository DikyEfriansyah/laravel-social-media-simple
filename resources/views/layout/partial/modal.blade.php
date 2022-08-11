<div class="modal fade" id="addComment" style="display: none;" methot="post" action="{{action('CommentController@store')}}" role="form">
  @csrf
  <div class="modal-dialog" >
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Comment</h4>
      </div>
      <div class="modal-body">
        <form role="form" enctype="multipart/form-data" action="{{ route('comment.store') }}" method="POST">
          @csrf
        <div class="box-body">
          <div class="form-group">
            @foreach($posts as $post)
            <input type="hidden" value="{{$post->id}}" name="feed">
            <input type="hidden" value="{{$post->users_id}}" name="user">
            @endforeach
            <textarea class="form-control" id="comment" rows="6" cols="30" placeholder="Whats Happening?" name="comment"> </textarea>
          </div>
        </div><!-- /.box-body -->
  
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>