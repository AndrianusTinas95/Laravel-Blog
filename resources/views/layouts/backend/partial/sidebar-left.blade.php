<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
        <img src="{!!asset('storage/profile/'.auth()->user()->image )!!}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->username}}</div>
        <div class="email">{{auth()->user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{!! auth()->user()->role_id == 1 ? route('admin.settings') : route('author.settings')!!}"><i class="material-icons">settings</i>Settings</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             <i class="material-icons">input</i>Sign Out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            
            @if (request()->is('admin*') ?  $user='admin' : $user='author' )
            @endif
                
            @if (request()->is('admin*') || request()->is('author*'))

            <li class="{{request()->is($user.'/dashboard') ? 'active':'' }}">
                <a href="{{route($user.'.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>

            @if (request()->is('admin*'))
            <li class="{{request()->is($user.'/tag*') ? 'active':'' }}">
                <a href="{{route($user.'.tag.index')}}">
                    <i class="material-icons">label</i>
                    <span>Tag</span>
                </a>
            </li>
            <li class="{{request()->is($user.'/category*') ? 'active':'' }}">
                <a href="{{route($user.'.category.index')}}">
                    <i class="material-icons">apps</i>
                    <span>Category</span>
                </a>
            </li>
            @endif

            <li class="{{request()->is($user.'/post*') ? 'active':'' }}">
                <a href="{{route($user.'.post.index')}}">
                    <i class="material-icons">library_books</i>
                    <span>Posts</span>
                </a>
            </li>
            

            @if (request()->is('admin*'))
            <li class="{{request()->is('admin/pending/post') ? 'active':'' }}">
                <a href="{{route($user.'.post.pending')}}">
                    <i class="material-icons">library_books</i>
                    <span>Posts Pending</span>
                </a>
            </li>
            @endif
            
            <li class="{{request()->is($user.'/favorite*') ? 'active':'' }}">
                <a href="{{route($user.'.favorite.index')}}">
                    <i class="material-icons">favorite</i>
                    <span>Favorite</span>
                </a>
            </li>
            <li class="{{request()->is($user.'/comment*') ? 'active':'' }}">
                <a href="{{route($user.'.comment.index')}}">
                    <i class="material-icons">comment</i>
                    <span>Comments</span>
                </a>
            </li>
            @if (request()->is('admin*'))  
            <li class="{{request()->is('admin/subscriber*') ? 'active':'' }}">
                <a href="{{route($user.'.subscriber.index')}}">
                    <i class="material-icons">subscriptions</i>
                    <span>Subcribers</span>
                </a>
            </li>
            @endif

            <li class="header">System</li>
            <li class="{{request()->is($user.'/settings*') ? 'active':'' }}">
                <a href="{{route($user.'.settings')}}">
                    <i class="material-icons">settings</i>
                    <span>Settings</span>
                </a>
            </li>
            @endif
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     <i class="material-icons">input</i>
                     <span>Logout</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                </form>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>