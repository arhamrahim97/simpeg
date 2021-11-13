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

        .table-content td {
            border: 1px solid black;
        }

        .table-content th {
            border: 1px solid black;
        }

    </style>

    <title>{{$usulanPangkat->nama}}</title>
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
            <td width="60%"></td>
            <td width="40%">
                <p class="mb-0"><span style="display: inline-block;
                    margin-left: 22px;"></span>Palu,
                    {{$hariIni->day . ' ' . $hariIni->monthName . ' ' . $hariIni->year;}}</p>
                <p class="mb-0"><span style="display: inline-block;
                    margin-left: 22px;"></span>Kepada</p>
                <p class="mb-0"> Yth. Kepala Badan Kepegawaian dan Pengembangan</p>
                <p class="mb-0"><span style="display: inline-block;
                    margin-left: 20px;"></span> Sumber Daya Manusia Daerah Kota Palu</p>
                <p class="mb-0"><span style="display: inline-block;
                    margin-left: 23px;"></span>Di-</p>
                <p class="mb-0"><span class="tab4"></span>Palu</p>
            </td>
        </tr>
    </table>

    <p class="text-center fw-bold times text-decoration-underline mb-0 mt-3">SURAT PENGANTAR</p>
    <p class="text-center times mt-0">Nomor : {{$usulanPangkat->nomor_surat}}.2/ABCTES/Dikbud</p>

    <table style="width:100%" class="table-content times mt-3">
        <tr class="fw-bold text-center">
            <td width="5%">No</td>
            <td>Jenis Yang Dikirim</td>
            <td>Banyaknya</td>
            <td>Keterangan</td>
        </tr>
        <tr style="border-bottom : 0px !important">
            <td style="border-bottom : 0px !important"></td>
            <td style="border-bottom : 0px !important" class="p-2">Pengusulan Berkas Kenaikan Pangkat a.n :</td>
            <td style="border-bottom : 0px !important"></td>
            <td style="border-bottom : 0px !important"></td>
        </tr>
        <tr style="border-top : 0px !important">
            <td style="border-top : 0px !important" class="text-center">1</td>
            <td style="border-top : 0px !important" class="p-2">
                <p class="fw-bold">{{$user->nama}}</p>
                <p>{{$user->profile->nip}}</p>
                @if ($user->role == "Guru")
                <p>{{$usulanPangkat->pangkatFungsionalSelanjutnya->jabatan}}</p>
                @else
                <p>{{$usulanPangkat->pangkatStrukturalSelanjutnya->jabatan}}</p>
                @endif
                <p>{{$user->profile->unitKerja->nama}}</p>
            </td>
            <td style="border-top : 0px !important" class="p-2">
                <p>1 (Satu)</p>
                <p>Berkas</p>
            </td>
            <td style="border-top : 0px !important" class="p-2">Dikirim dengan hormat untuk proses selanjutnya</td>
        </tr>
    </table>

    <table width="100%" class="times mt-3">
        <tr>
            <td width="60%" class="text-center align-items-center">
                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($usulanPangkat->unique_id, 'QRCODE')}}"
                    alt="barcode" /><br>
                <p>ID Dokumen : {{$usulanPangkat->unique_id}}</p><br>
            </td>
            <td width="40%" class="text-center">
                <div class="ttd">
                    <p>a.n. Kepala Dinas Pendidikan dan Kebudayaan Kota Palu</p>
                    <p>Sekretaris,</p>
                    <br>
                    <br>
                    <br>
                    <p class="mb-0 fw-bold text-uppercase" style="border-bottom:2px solid black ">{{$sekretaris->nama}}
                    </p>
                    <p class="mb-0">{{$sekretaris->profilePejabat->jabatanStruktural->jabatan}}</p>
                    <p class="mb-0">NIP. {{$sekretaris->profilePejabat->nip}} </p>
                    <div class="gambarTtd">
                        <img src="{{public_path('storage/upload/foto-ttd/' . $sekretaris->profilePejabat->foto_ttd)}}"
                            alt="" width="225px">
                    </div>
                    <div class="cap">
                        <img src="assets/dashboard/img/cap.png" alt="" width="125px">
                    </div>
                </div>

            </td>
        </tr>
    </table>

    <table width="100%" class="times mt-3" style="border-bottom: 2px solid black">
        <tr>
            <td width="15%" class="text-decoration-underline">Yang Membawa</td>
            <td width="85%">

            </td>
        </tr>
        <tr>
            <td width="15%">Nama</td>
            <td width="85%">
                :
            </td>
        </tr>
        <tr>
            <td width="15%">Nip</td>
            <td width="85%">
                :
            </td>
        </tr>
        <tr>
            <td width="15%">Tanda Tangan</td>
            <td width="85%">
                :
            </td>
        </tr>
        <tr>
            <td width="15%">No. Hp</td>
            <td width="85%">
                :
            </td>
        </tr>
    </table>
    <table width="100%" class="times mt-2">
        <tr>
            <td width="15%" class="text-decoration-underline">Pemeriksa</td>
            <td width="85%">

            </td>
        </tr>
        <tr>
            <td width="15%">Nama</td>
            <td width="85%">
                :
            </td>
        </tr>
        <tr>
            <td width="15%">Nip</td>
            <td width="85%">
                :
            </td>
        </tr>
        <tr>
            <td width="15%">Tanda Tangan</td>
            <td width="85%">
                :
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
