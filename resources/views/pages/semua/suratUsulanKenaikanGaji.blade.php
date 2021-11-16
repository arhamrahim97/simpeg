<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .times {
            font-family: "Times New Roman", Times, serif;
        }

        table {
            border-collapse: collapse
        }

        .tab {
            display: inline-block;
            margin-left: 40px;
        }

        .tab2 {
            display: inline-block;
            margin-left: 55px;
        }

        .tab3 {
            display: inline-block;
            margin-left: 32px;
        }

        .tab4 {
            display: inline-block;
            margin-left: 70px;
        }

        .ttd {
            position: relative;
            overflow: visible;
        }

        .gambarTtd {
            position: absolute;
            top: 10px;
            left: 30px;
        }

        .cap {
            position: absolute;
            top: 0;
            left: 50px;
        }

        table {
            table-layout: fixed;
        }

        p,
        td {
            font-size: 11px;
            margin-bottom: 0px !important;
        }
    </style>

    <title>Hello, world!</title>
</head>

<body>
    <table width="100%" style="border-bottom: 3px solid black">
        <tr>
            <td width="20%" align="center"><img src="{{public_path('assets/dashboard/img/kota_palu.png')}}"
                    width="50px"></td>
            <td width="80%" align="center" class="mb-2">
                <p class="mb-0 fw-bold" style="font-size: 15px">PEMERINTAH KOTA PALU</p>
                <p class="mb-0 fw-bold" style="font-size: 17px">DINAS PENDIDIKAN DAN KEBUDAYAAN</p>
                <p class="mb-0" style="font-size: 12px">Jalan Bantilan Kelurahan Lere Telepon (0451) 4021542 Kode Pos
                    94221</p>
                <p style="font-size: 12px">E-Mail : <a href="">disdikpalu.kota@gmail.com</a> Website : <a
                        href="">www.disdikbudkotapalu.com</a>
                </p>
            </td>
        </tr>
    </table>

    <table width="100%" class="times">
        <tr>
            <td width="10%">
                No.Pend
                Perihal
            </td>
            <td width="40%">
                : {{$usulanGaji->nomor_surat}}.3 / 149-KB/ PT / DIKBUD <br>
                : Kenaikan Gaji Berkala
            </td>
            <td width="20%"></td>
            <td width="30%">
                <p class="mb-0"><span class="tab3"></span>Palu,
                    {{$hariIni->day . ' ' . $hariIni->monthName . ' ' . $hariIni->year;}}</p>
                <p class="mb-0"><span class="tab3"></span>Kepada</p>
                <p class="mb-0"> Yth. Kepala Pengelolaan Keuangan</p>
                <p class="mb-0"><span class="tab3"></span>dan Aset Daerah Kota Palu</p>
                <p class="mb-0"><span class="tab2"></span>Di-</p>
                <p class="mb-0"><span class="tab4"></span>Palu</p>
            </td>
        </tr>
    </table>

    <p class="times mt-3"> <span class="tab"></span>Dengan ini diberitahukan bahwa dengan telah
        dipenuhinya masa kerja
        dan
        syarat-syarat lainnya
        kepada :
    </p>

    <table width="100%" class="times">
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>1. Nama</p>
            </td>
            <td width="75%">
                <p class=""> : <span class="fw-bold">{{$user->nama}}</span></p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>2. NIP</p>
            </td>
            <td width="75%">
                <p class=""> : {{$user->profile->nip}}</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>3. Tempat / Tanggal Lahir</p>
            </td>
            <td width="75%">
                <p class=""> :
                    {{$user->profile->tempat_lahir}},
                    @php
                    $tanggalLahir = \Carbon\Carbon::createFromFormat('Y-m-d',
                    $user->profile->tanggal_lahir)->locale('id');
                    echo $tanggalLahir->day . ' ' . $tanggalLahir->monthName . ' ' . $tanggalLahir->year;
                    @endphp
                </p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>4. Pangkat/Gol</p>
            </td>
            @if ($user->role == 'Guru')
            <td width="75%">
                <p class=""> : {{$user->profile->jabatanFungsional->pangkat}} /
                    {{$user->profile->jabatanFungsional->golongan}}</p>
            </td>
            @endif
            @if ($user->role == 'Pegawai')
            <td width="75%">
                <p class=""> : {{$user->profile->jabatanStruktural->pangkat}} /
                    {{$user->profile->jabatanStruktural->golongan}}</p>
            </td>
            @endif
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>5. Jenis Guru</p>
            </td>
            <td width="75%">
                <p class=""> : {{$user->profile->jenis_guru}}</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>6. Jabatan</p>
            </td>
            <td width="75%">
                <p class=""> : {{$user->profile->jabatanStruktural->jabatan}}</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>7. Tempat Tugas</p>
            </td>
            <td width="75%">
                <p class=""> : {{$user->profile->unitKerja->nama}}</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>8. Gaji Pokok Lama</p>
            </td>
            <td width="75%">
                <p class=""> : Rp. {{number_format($usulanGaji->nilai_gaji_sebelumnya,0,',','.')}}</p>
            </td>
        </tr>
    </table>

    <p class="times"><span class="tab"></span>Atas dasar Surat Keputusan terakhir tentang Kenaikan Berkala /
        Kenaikan
        Pangkat Pegawai Negeri Sipil yang ditetapkan :
    </p>

    <table width="100%" class="times">
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>a. Oleh Pejabat</p>
            </td>
            <td width="75%">
                <p class=""> : Kepala Dinas Pendidikan dan Kebudayaan</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>b. Nomor dan Tanggal</p>
            </td>
            <td width="75%">
                <p class=""> : {{$usulanGaji->nomor_surat}} / 186/PS/Dikbud <span class="tab2"></span>{{$hariIni->day .
                    ' ' . $hariIni->monthName . ' ' . $hariIni->year;}}</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>c. Tanggal Mulai Berlaku<br><span class="tab2"></span>Gaji
                    Tersebut </p>
            </td>
            <td width="75%" class="align-bottom">
                <p class=""> :
                    @php
                    $mulaiBerlaku = \Carbon\Carbon::createFromFormat('Y-m-d',
                    $usulanGaji->tmt_gaji_sebelumnya)->locale('id');
                    echo $mulaiBerlaku->day . ' ' . $mulaiBerlaku->monthName . ' ' .
                    $mulaiBerlaku->year;
                    @endphp
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>d. Masa Kerja Golongan<br><span class="tab2"></span>Pada
                    tanggal
                    tersebut </p>
            </td>
            <td width="75%" class="align-bottom">
                <p class=""> : {{$usulanGaji->jumlah_tahun_kerja_lama}} Tahun
                    {{$usulanGaji->jumlah_bulan_kerja_lama}} Bulan</p>
            </td>
        </tr>
    </table>
    <p class="mb-0 times"><span class="tab2"></span>Diberikan Kenaikan Gaji Berkala hingga memperoleh : </p>
    <table width="100%" class="times">
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>e. Gaji Pokok Baru</p>
            </td>
            <td width="75%">
                <p class=""> : Rp. {{number_format($usulanGaji->nilai_gaji_selanjutnya,0,',','.')}}</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>f. Berdasarkan Masa Kerja</p>
            </td>
            <td width="75%">
                <p class=""> : {{($usulanGaji->jumlah_tahun_kerja_lama + 2)}} Tahun
                    {{$usulanGaji->jumlah_bulan_kerja_lama}} Bulan</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>g. Dalam Golongan</p>
            </td>
            @if ($user->role == 'Guru')
            <td width="75%">
                <p class=""> : {{$user->profile->jabatanFungsional->pangkat}} /
                    {{$user->profile->jabatanFungsional->golongan}}</p>
            </td>
            @endif
            @if ($user->role == 'Pegawai')
            <td width="75%">
                <p class=""> : {{$user->profile->jabatanStruktural->pangkat}} /
                    {{$user->profile->jabatanStruktural->golongan}}</p>
            </td>
            @endif
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>h. Mulai Tanggal</p>
            </td>
            <td width="75%">
                <p class=""> :
                    @php
                    $mulaiTanggal = \Carbon\Carbon::createFromFormat('Y-m-d',
                    $usulanGaji->tmt_gaji_selanjutnya)->locale('id');
                    echo $mulaiTanggal->day . ' ' . $mulaiTanggal->monthName . ' ' .
                    $mulaiTanggal->year;
                    @endphp
                </p>
            </td>
        </tr>
    </table>


    <p class="times "><span class="tab"></span>Dapat dibayarkan penghasilannya berdasarkan gaji pokoknya yang baru
        sesuai dengan Peraturan Pemerintah No. 15 Tahun 2019
    </p>

    <table width="100%" class="times mt-3">
        <tr>
            <td width="60%"></td>
            <td width="40%" class="text-center">
                <div class="ttd">
                    <p>Plt. Kepala Dinas Pendidikan dan Kebudayaan Kota Palu,</p>
                    <br>
                    <br>
                    <br>
                    @if($kepalaDinas)
                    <p class="mb-0 fw-bold text-uppercase" style="border-bottom:1px solid black ">{{$kepalaDinas->nama}}
                    </p>
                    <p class="mb-0">{{$kepalaDinas->profilePejabat->jabatanStruktural->jabatan}}</p>
                    <p class="mb-0">NIP. {{$kepalaDinas->profilePejabat->nip}}</p>
                    <div class="gambarTtd">
                        <img src="{{public_path('storage/upload/foto-ttd/' . $kepalaDinas->profilePejabat->foto_ttd)}}"
                            alt="" width="225px">
                    </div>
                    <div class="cap">
                        <img src="assets/dashboard/img/cap.png" alt="" width="125px">
                    </div>
                    @endif
                </div>

            </td>
        </tr>
    </table>
    <br>
    <table width="100%" class="times">
        <tr>
            <td width="90%">
                <p class="mb-0">Tembusan surat ini disampaikan kepada :</p>
                <ol type="1">
                    <li>Menteri Dalam Negeri di Jakarta</li>
                    <li>Kepala BKN Up. Deputi Bidang Informasi Kepegawaian di Jakarta</li>
                    <li>Direktur Jenderal Anggaran Departemen Keuangan di Jakarta</li>
                    <li>Direktur Pembendaharaan dan Kas Negara di Jakarta</li>
                    <li>Kepala Kantor Regional IV BKN di Makassar</li>
                    <li>Kepala PT Taspen (PERSERO) Cabang Palu di Palu</li>
                    <li>Bendaharawan Gaji Pegawai Negeri Sipil yang bersangkutan</li>
                    <li>Sdr./i : <span class="fw-bold text-uppercase">{{$user->nama}}</span></li>
                </ol>
            </td>
            <td width="10%" class="text-center align-items-center">
                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($usulanGaji->unique_id, 'QRCODE')}}"
                    alt="barcode" /><br>
                <p>ID Dokumen : {{$usulanGaji->unique_id}}</p><br>
            </td>
        </tr>
    </table>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
