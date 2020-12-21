<!--side bar-->
<div id="app">
<aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
    <section class="sidebar">
        <div class="w-80px mt-3 mb-3 ml-3">
            <img src="{{asset('assets/img/basic/logo.png')}}" alt="">
        </div>
        <div class="relative">
            <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
               aria-controls="userSettingsCollapse" class="btn-fab btn-fab-sm absolute fab-right-bottom fab-top btn-primary shadow1 ">
                <i class="icon icon-cogs"></i>
            </a>
            <div class="user-panel p-3 light mb-2">
                <div>
                    <div class="float-left image">
                        <img class="user_avatar" src="{{asset('assets/img/dummy/u2.png')}}" alt="User Image">
                    </div>
                    <div class="float-left info">
                        <h6 class="font-weight-light mt-2 mb-1"></h6>
                        <a href="#"><i class="icon-circle text-primary blink"></i> Online</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="collapse multi-collapse" id="userSettingsCollapse">
                    <div class="list-group mt-3 shadow">
                        <a href="index.html" class="list-group-item list-group-item-action ">
                            <i class="mr-2 icon-umbrella text-blue"></i>Profile
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"><i
                                class="mr-2 icon-cogs text-yellow"></i>Settings</a>
                        <a href="#" class="list-group-item list-group-item-action"><i
                                class="mr-2 icon-security text-purple"></i>Change Password</a>
                    </div>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header"><strong>MAIN NAVIGATION</strong></li>
            <li class="treeview"><a href="{{ url('/dashboard') }}">
                <i class="icon icon-dashboard2 purple-text s-18"></i> <span><Datal>Dashboard</Datal></span> <i
                    class="icon icon-angle-right s-18 pull-right"></i>
            </a>
            </li>
            @can('Role')
            <li>
                <a href="{{ url('/role') }}">
                    <i class="icon icon-key4 amber-text s-18"></i> 
                    <span>Role</span><i
                    class="icon icon-angle-right s-18 pull-right"></i>
                </a>
            </li>
            
            <li class="no-b">
                <a href="{{ url('/permission') }}">
                    <i class="icon icon-clipboard-list2 text-success s-18"></i> 
                    <span>Permission</span><i
                    class="icon icon-angle-right s-18 pull-right"></i>
                </a>
            </li>

            <li class="no-b">
            <a href="{{ url('/pengguna') }}">
                <i class="icon icon-users blue-text s-18"></i> 
                <span>Pengguna</span><i
                    class="icon icon-angle-right s-18 pull-right"></i>
            </a>
            </li>
            @endcan
            
            
        </ul>


        <ul class="sidebar-menu">
            
            <li class="header"><strong>DATA</strong></li>
            <li class="treeview"><a href="{{ url('/mahasiswa') }}">
                <i class="icon icon-school purple-text s-18"></i> <span><Data>Mahasiswa</Data></span> <i
                    class="icon icon-angle-right s-18 pull-right"></i>
            </a>
            </li>
            
            @can('Mahasiswa')
            <li class="treeview"><a href="{{ url('/jurusan') }}">
                <i class="icon icon-book purple-text s-18"></i> <span><Data>Jurusan</Data></span> <i
                    class="icon icon-angle-right s-18 pull-right"></i>
            </a>
            </li>

            <li class="treeview"><a href="{{ url('/matapelajaran') }}">
                <i class="icon icon-file purple-text s-18"></i> <span><Data>Mata Pelajaran</Data></span> <i
                    class="icon icon-angle-right s-18 pull-right"></i>
            </a>
            </li>
           
            <li class="treeview"><a href="{{ url('/jupel') }}">
                <i class="icon icon-plus purple-text s-18"></i> <span><Data>Tambah Jurusan Dan Pelajaran</Data></span> <i
                    class="icon icon-angle-right s-18 pull-right"></i>
            </a>
            </li>
            @endcan
        </ul>
    </section>
</aside>
<!--Sidebar End-->