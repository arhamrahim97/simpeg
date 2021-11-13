<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileGuruPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_guru_pegawai', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('nama');
            $table->string('nik');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_hp');
            $table->string('email');
            $table->text('alamat');
            $table->string('pendidikan_terakhir');
            $table->string('jenis_asn');
            $table->string('status');
            $table->string('jenis_guru')->default('-');
            $table->string('bidang_studi')->default('-');
            $table->string('mata_pelajaran')->default('-');
            $table->string('npsn')->default('-');
            $table->string('nip')->nullable();
            $table->string('nuptk')->nullable();
            $table->string('jenis_jabatan');
            $table->integer('jabatan_pangkat_golongan')->nullable();
            $table->integer('unit_kerja');
            $table->string('kecamatan');
            $table->date('tanggal_kerja')->nullable();
            $table->date('tmt_pengangkatan');
            $table->date('tmt_pangkat')->nullable();
            $table->date('tmt_gaji')->nullable();
            $table->bigInteger('nilai_gaji')->nullable();
            $table->text('foto')->nullable();
            $table->integer('status_profile')->default(0);
            $table->text('alasan_profile')->nullable();
            $table->dateTime('konfirmasi_profile')->default(Carbon::now());
            $table->integer('status_berkas_dasar')->default(-1);
            $table->text('alasan_berkas_dasar')->nullable();
            $table->dateTime('konfirmasi_berkas_dasar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_guru_pegawai');
    }
}
