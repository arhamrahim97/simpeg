<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
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
            $table->string('jenis_guru')->nullable();
            $table->bigInteger('nip')->nullable();
            $table->bigInteger('nuptk')->nullable();
            $table->integer('unit_kerja');
            $table->string('status');
            $table->string('jenis_jabatan');
            $table->integer('jabatan');
            $table->integer('pangkat');
            $table->integer('golongan');
            $table->integer('jumlah_tahun_kerja');
            $table->integer('jumlah_bulan_kerja');
            $table->bigInteger('nilai_gaji');
            $table->date('tmt_gaji');
            $table->date('tmt_pangkat');
            $table->string('foto');
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
        Schema::dropIfExists('profile');
    }
}
