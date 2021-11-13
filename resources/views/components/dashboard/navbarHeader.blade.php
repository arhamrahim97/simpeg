<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        @if ((Auth::user()->role == 'Guru') || (Auth::user()->role == 'Pegawai'))
                            <img src="{{'/storage/upload/foto-profil/'.Auth::user()->profile->foto }}" alt="Foto" class="avatar-img rounded-circle">                            
                        @else
                            @if (Auth::user()->role == 'Admin')
                                <img src="/assets/dashboard/img/user.png" alt="Foto" class="avatar-img rounded-circle">                                                                                            
                            @else
                                <img src="{{'/storage/upload/foto-profil/'.Auth::user()->profilePejabat->foto }}" alt="Foto" class="avatar-img rounded-circle">                            
                            @endif                    
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                @if ((Auth::user()->role == 'Guru') || (Auth::user()->role == 'Pegawai'))                                    
                                    <div class="avatar-lg"><img src="{{'/storage/upload/foto-profil/'.Auth::user()->profile->foto }}" alt="Foto" class="avatar-img rounded"></div>                                        
                                @else
                                    @if (Auth::user()->role == 'Admin')                                                                                                     
                                        <div class="avatar-lg"><img src="/assets/dashboard/img/user.png" alt="image profile" class="avatar-img rounded"></div>
                                    @else
                                        <div class="avatar-lg"><img src="{{'/storage/upload/foto-profil/'.Auth::user()->profilePejabat->foto }}" alt="Foto" class="avatar-img rounded"></div>                                        
                                    @endif                    
                                @endif
                                <div class="u-text">
                                    <h4>{{ Auth::user()->nama }}</h4>
                                    <p class="text-muted">{{ Auth::user()->role }}</p>
                                    @if ((Auth::user()->role == 'Guru') || (Auth::user()->role == 'Pegawai'))
                                        <a href="{{ route('user.edit_akun', Auth::user()->id) }}" class="btn btn-xs btn-success btn-sm">Edit Akun</a>                                        
                                    @else
                                        @if (Auth::user()->role == 'Admin')
                                            <a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-xs btn-success btn-sm">Edit Akun</a>                                                                                    
                                        @else
                                            <a href="{{ route('user.edit_akun_pejabat', Auth::user()->id) }}" class="btn btn-xs btn-success btn-sm">Edit Akun</a>                                                                                    
                                        @endif
                                        
                                    @endif                                    
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>                                                        
                            <a class="dropdown-item" href="/logout">Logout</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
