<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreignId('id_user')->unique();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('pendidikan_terakhir');
            $table->string('jenis_asn');
            $table->string('jenis_guru')->default('-');
            $table->bigInteger('nip')->nullable();
            $table->bigInteger('nuptk')->nullable();
            $table->integer('unit_kerja');
            $table->string('status');
            $table->string('jenis_jabatan');
            $table->integer('jabatan_pangkat_golongan');
            $table->integer('jumlah_tahun_kerja');
            $table->integer('jumlah_bulan_kerja');
            $table->bigInteger('nilai_gaji');
            $table->date('tmt_gaji');
            $table->date('tmt_pangkat');
            $table->text('foto');
            $table->integer('status_berkas_dasar')->default(0);
            $table->text('alasan_berkas_dasar')->nullable();
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
