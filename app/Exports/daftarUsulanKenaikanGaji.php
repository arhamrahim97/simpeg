<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class daftarUsulanKenaikanGaji implements FromCollection, WithColumnFormatting, WithColumnWidths, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return ProfileGuruPegawai::all();
        return DB::table('profile_guru_pegawai')
            ->join('unit_kerja', 'profile_guru_pegawai.unit_kerja', '=', 'unit_kerja.id')
            ->join('jabatan_fungsional', 'profile_guru_pegawai.jabatan_pangkat_golongan', '=', 'jabatan_fungsional.id')
            ->select('profile_guru_pegawai.nama', 'profile_guru_pegawai.nik', 'profile_guru_pegawai.jenis_kelamin', 'profile_guru_pegawai.tempat_lahir', 'profile_guru_pegawai.tanggal_lahir', 'profile_guru_pegawai.no_hp', 'profile_guru_pegawai.email', 'profile_guru_pegawai.alamat', 'profile_guru_pegawai.pendidikan_terakhir', 'profile_guru_pegawai.jenis_asn', 'profile_guru_pegawai.status', 'profile_guru_pegawai.jenis_guru', 'profile_guru_pegawai.bidang_studi', 'profile_guru_pegawai.mata_pelajaran', 'profile_guru_pegawai.npsn', 'profile_guru_pegawai.nip', 'profile_guru_pegawai.nuptk', 'jabatan_fungsional.pangkat', 'jabatan_fungsional.golongan', 'jabatan_fungsional.jabatan', 'unit_kerja.nama as sekolah', 'profile_guru_pegawai.kecamatan', 'profile_guru_pegawai.tanggal_kerja', 'profile_guru_pegawai.tmt_pengangkatan', 'profile_guru_pegawai.tmt_pangkat', 'profile_guru_pegawai.tmt_gaji')
            ->whereRaw('tmt_gaji < (now() - interval 2 year) AND status LIKE "%PNS%"')
            ->orderBy('tmt_gaji', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIK',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'No HP',
            'Email',
            'Alamat',
            'Pendidikan Terakhir',
            'Jenis ASN',
            'Status Kepegawaian',
            'Jenis PTK',
            'Bidang Studi',
            'Mata Pelajaran',
            'NPSN',
            'NIP',
            'NUPTK',
            'Pangkat',
            'Golongan',
            'Jabatan',
            'Unit Kerja',
            'Kecamatan',
            'Tanggal Kerja',
            'TMT Pengangkatan',
            'TMT Pangkat',
            'TMT Gaji',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 18,
            'C' => 14,
            'D' => 23,
            'E' => 13,
            'F' => 14,
            'G' => 30,
            'H' => 40,
            'I' => 19,
            'J' => 11,
            'K' => 19,
            'L' => 18,
            'M' => 38,
            'N' => 36,
            'O' => 10,
            'P' => 20,
            'Q' => 18,
            'R' => 18,
            'S' => 10,
            'T' => 24,
            'U' => 30,
            'V' => 14,
            'W' => 13,
            'X' => 18,
            'Y' => 13,
            'Z' => 12,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_NUMBER,
            'P' => NumberFormat::FORMAT_NUMBER,
            'Q' => NumberFormat::FORMAT_NUMBER
        ];
    }
}
