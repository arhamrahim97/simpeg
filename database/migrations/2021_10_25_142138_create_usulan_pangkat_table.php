<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulanPangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_pangkat', function (Blueprint $table) {
            $table->id();
            $table->text('unique_id');
            $table->integer('id_user');
            $table->text('nama');
            $table->integer('status_tim_penilai');
            $table->text('alasan_tolak_tim_penilai')->nullable();
            $table->dateTime('tanggal_konfirmasi_tim_penilai')->nullable();
            $table->integer('status_kepegawaian');
            $table->text('alasan_tolak_kepegawaian')->nullable();
            $table->dateTime('tanggal_konfirmasi_kepegawaian')->nullable();
            $table->integer('status_kasubag');
            $table->text('alasan_tolak_kasubag')->nullable();
            $table->dateTime('tanggal_konfirmasi_kasubag')->nullable();
            $table->integer('status_sekretaris');
            $table->text('alasan_tolak_sekretaris')->nullable();
            $table->dateTime('tanggal_konfirmasi_sekretaris')->nullable();
            $table->integer('status_kepala_dinas');
            $table->text('alasan_tolak_kepala_dinas')->nullable();
            $table->dateTime('tanggal_konfirmasi_kepala_dinas')->nullable();
            $table->text('nomor_surat')->nullable();
            $table->date('tmt_pangkat_selanjutnya')->nullable();
            $table->date('tmt_pangkat_sebelumnya')->nullable();
            $table->integer('jumlah_tahun_kerja_lama');
            $table->integer('jumlah_bulan_kerja_lama');
            $table->bigInteger('pangkat_selanjutnya')->nullable();
            $table->bigInteger('pangkat_sebelumnya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UsulanPangkat');
    }
}
