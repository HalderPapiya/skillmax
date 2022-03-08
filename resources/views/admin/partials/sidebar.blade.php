<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item  {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item announcement {{ request()->is('admin/announcement*') ? 'active' : '' }}" href="{{ route('admin.announcement.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Announcement</span>
            </a>
        </li>
         <li>
            <a class="app-menu__item interest {{ request()->is('admin/interest*') ? 'active' : '' }}" href="{{ route('admin.interest.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Interest</span>
            </a>
        </li>
         {{-- <li>
            <a class="app-menu__item user {{ request()->is('admin/user*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">User</span>
            </a>
        </li> --}}
        <li>
            <a class="app-menu__item user {{ request()->is('admin/user*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">User</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item team {{ request()->is('admin/team*') ? 'active' : '' }}" href="{{ route('admin.team.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Team</span>
            </a>
        </li>
         <li>
            <a class="app-menu__item banner {{ request()->is('admin/banner*') ? 'active' : '' }}" href="{{ route('admin.banner.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Banner</span>
            </a>
        </li>
         <li>
            <a class="app-menu__item event {{ request()->is('admin/event*') ? 'active' : '' }}" href="{{ route('admin.event.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Event</span>
            </a>
        </li>
         <li>
            <a class="app-menu__item forum {{ request()->is('admin/forum*') ? 'active' : '' }}" href="{{ route('admin.forum.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Forum</span>
            </a>
        </li>
         <li>
            <a class="app-menu__item forum {{ request()->is('admin/forum/comment*') ? 'active' : '' }}" href="{{ route('admin.forum-comment.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Forum Comment</span>
            </a>
        </li>
        {{-- <li>
            <a class="app-menu__item customer" href=""><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Customer</span>
            </a>
        </li> --}}
       

        
        

    </ul>
</aside>

<script>
    $urlData = document.getElementsByClassName('app-menu__item');
    $a = window.location.href;
    console.log($a)
    if($a.includes('banner')){
        $urlData.add('active');
    }else{
        console.log('false')
    }
</script>