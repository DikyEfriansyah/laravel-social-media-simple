<div class="col-md-4">
        <!--<div class="row"> -->
            <div class="box box-primary">
                <div class="box-header with-border">
                  @if (is_null(Auth::user()->photo))
                      <img class="img-circle " src="{{asset('img/default_ava.png')}}" alt="User Image" style="display: block; margin-left: auto; margin-right: auto;" width="150" height="200">
                  @else
                      <img class="img-circle " src="{{asset('uploads/avatar/'.Auth::user()->photo )}}" alt="User Image" style="display: block; margin-left: auto; margin-right: auto;" width="150" height="200">
                  @endif

                    <p style="text-align: center;">
                      {{Auth::user()->name}}
                      <a href="/users/{{Auth::user()->id}}/edit" class="fa fa-edit"></a>
                    </p>
                    
                </div>
                  <!-- Menu Body -->
                
                  <div class="box-body">
                      <div class="text-center d-flex justify-content-md-between">
                        <a href="#" class="btn btn-primary">{{$count_followers}} Followers</a>
                        <a href="{{route('show', ['user_id' => Auth::user()->id])}}" class="btn btn-primary">{{$count_feeds}} Feeds</a>
                        <a href="#" class="btn btn-primary">{{$count_following}} Following</a>
                      </div>
                      
                  </div>
                    <!-- Menu Footer-->
            </div><!-- /.box -->
            <div class="box box-primary">
            
                    <div class="box-header with-border">
                        
                        <h2>
                          Suggestion
                        </h2>
                    </div>
                      <!-- Menu Body -->
                    <div class="box-body" id="suggestion" >
                        
                              @foreach($suggestion as $item)
                                <div class="media">
                                    @if (is_null($item->photo))
                                      <img src="{{asset('img/default_ava.png')}}" class="card-img-top" alt="Generic placeholder image" style="width:50px;height:50px;">
                                    @else
                                      <img src="{{asset('uploads/avatar/'.$item->photo)}}" class="card-img-top" alt="Generic placeholder image" style="width:50px;height:50px;">
                                    @endif
                                    
                                    <div class="media-body">
                                      
                                      <form method="POST" enctype="multipart/form-data" action="/follow">
                                        @csrf
                                        <h5 class="mt-0" value="{{ $item->name }}">{{ $item->name }}</h5>
                                        <input type="hidden" name="follow" value="{{ $item->id }}">
                                        @error('follow')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="hidden" name="name" value="{{ $item->name }}">
                                        @error('name')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <button type="submit" class="btn btn-primary">Follow</button>
                                      </form>
                                    </div>
                                </div>
                              @endforeach
                    

                    </div><!-- Menu Footer-->
                </div><!-- /.box -->
    
      </div>
     



    


      