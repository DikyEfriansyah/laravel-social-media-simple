<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="/dashboard" class="navbar-brand"><b>Sosmed</b>LTE</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

         
          <!-- Navbar Right Menu -->

            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                
                <!-- User Account Menu -->
                <li class="nav-item dropdown">
                  <!-- Menu Toggle Button -->
                  <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">{{Auth::user()->name}}</span>
                  </a>
                  
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                 </div>
                
                </li>
              </ul>
            </div><!-- /.navbar-custom-menu -->
            
        </div><!-- /.container-fluid -->
      </nav>
  </header>