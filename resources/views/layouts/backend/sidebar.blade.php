<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->gravatar() }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Çevrim İçi</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="{{ url('/home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pencil"></i>
                    <span>Blog</span>
                    <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('blog.index') }}"><i class="fa fa-circle-o"></i> Tüm Makaleler</a></li>
                    <li><a href="{{ route('blog.create') }}"><i class="fa fa-circle-o"></i> Makale Ekle</a></li>
                </ul>
            </li>
            @if(check_user_permissions(request(),"Categories@index"))
            <li><a href="{{ route('categories.index') }}"><i class="fa fa-folder"></i> <span>Kategoriler</span></a></li>
            @endif
            @if(check_user_permissions(request(),"Users@index"))
            <li><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> <span>Kullanıcılar</span></a></li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
