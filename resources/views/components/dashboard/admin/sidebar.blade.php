<div class="sidebar sidebar-style-2" data-background-color="blue">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav">
                <li class="nav-item nav-dashboard">
                    <a href="{{url('dashboard-admin')}}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Usulan</h4>
                </li>
                <li class="nav-item nav-usulan-kenaikan-gaji">
                    <a href="{{url('proses-usulan-kenaikan-gaji-admin')}}">
                        <i class="fas fa-briefcase"></i>
                        <p>Kenaikan Gaji</p>
                    </a>
                </li>
                <li class="nav-item nav-usulan-kenaikan-pangkat">
                    <a href="{{url('proses-usulan-kenaikan-pangkat-admin')}}">
                        <i class="fas fa-briefcase"></i>
                        <p>Kenaikan Pangkat</p>
                    </a>
                </li>
                <li class="nav-section">
                    <h4 class="text-section">Master</h4>
                </li>
                <li class="nav-item nav-jabatan-fungsional">
                    <a href="{{url('master-jabatan-fungsional')}}">
                        <i class="fas fa-briefcase"></i>
                        <p>Jabatan Fungsional</p>
                    </a>
                </li>
                <li class="nav-item nav-jabatan-struktural">
                    <a href="{{url('master-jabatan-struktural')}}">
                        <i class="fas fa-briefcase"></i>
                        <p>Jabatan Struktural</p>
                    </a>
                </li>
                <li class="nav-item nav-unit-kerja">
                    <a href="{{url('master-unit-kerja')}}">
                        <i class="fas fa-school"></i>
                        <p>Unit Kerja</p>
                    </a>
                </li>
                <li class="nav-item nav-master-persyaratan">
                    <a href="{{url('master-persyaratan')}}">
                        <i class="fas fa-list-ol"></i>
                        <p>Persyaratan</p>
                    </a>
                </li>

                <li class="nav-section">
                    <h4 class="text-section">Berkas Dasar, Profile, Akun</h4>
                </li>
                <li class="nav-item nav-berkas-dasar">
                    <a href="{{url('data-berkas-dasar')}}">
                        <i class="fas fa-file"></i>
                        <p>Berkas Dasar</p>
                    </a>
                </li>
                <li class="nav-item nav-profile">
                    <a data-toggle="collapse" href="#profile-nav" class="collapsed" aria-expanded="false">
                        <i class="far fa-address-book"></i>
                        <p>Profil</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="profile-nav" style="">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/profile-guru-pegawai-">
                                    <span class="sub-item">Guru/Pegawai</span>
                                </a>
                            </li>
                            <li>
                                <a href="/profile-non-guru-pegawai">
                                    <span class="sub-item">Non Guru/Pegawai</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item nav-user">
                    <a href="{{url('user')}}">
                        <i class="fas fa-users"></i>
                        <p>Akun</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
