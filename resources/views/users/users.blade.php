@extends('layout.master')

@section('content')
<div class="col-md-6" style="background-color: white;">
  <div class="box box-primary">
    <div class="box-header with-border">
      
      <h3 class="box-title">Edit data user</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="/users/{{ $users->id }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')

      <div class="box-body">
        <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $users->name }}" placeholder="Masukkan name">
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
        </div>
        <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" value="{{ $users->email }}" placeholder="Masukkan email">
                @error('email')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
        </div>
        <div class="form-group">
                <label for="date_birth">Date Birth</label>
                <input type="date" class="form-control" name="date_birth" value="{{ $users->date_birth }}" >

        </div>
        <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" rows="5" cols="30" name="address" value="{{ $users->address }}">{{ $users->address }}</textarea>
        </div>
        <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control" id="bio" rows="5" cols="30" name="bio" value="{{ $users->bio }}">{{ $users->bio }}</textarea>
        </div>

        <div class="form-group">
                <label for="photo">Photo</label>
                <div class="card" style="width: 12rem;">
                 @if (is_null($users->photo))
                     <img class="card-img-top" src="{{asset('img/default_ava.png')}}" alt="Card image cap" width="150" height="200">
                 @else
                     <img class="card-img-top" src="{{asset('uploads/avatar/'.$users->photo )}}" alt="Card image cap" width="150" height="200">
                 @endif
                 </div>
                 <br>
                 <input type="file" name="photo" class="form-control-file" id="photo" value="{{$users->photo}}">
                 @error('photo')
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

  </div>

@endsection
