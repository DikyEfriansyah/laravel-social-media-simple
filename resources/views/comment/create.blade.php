@extends('layout.master')

@extends('layout.partial.modal')

@section('modal-content')
<form id="postForm" name="postForm" class="form-horizontal">
    <input type="hidden" name="post_id" id="post_id">
     <div class="form-group">
         <label for="name" class="col-sm-2 control-label">Title</label>
         <div class="col-sm-12">
             <input type="text" class="form-control" id="title" name="title" value="" required="">
         </div>
     </div>

     <div class="form-group">
         <label class="col-sm-2 control-label">Body</label>
         <div class="col-sm-12">
             <input class="form-control" id="body" name="body" value="" required="">
         </div>
     </div>
     <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
      </button>
     </div>
 </form>
@endsection