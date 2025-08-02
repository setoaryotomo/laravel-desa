<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penghuni', function (Blueprint $table) {
            $table->id();
            $table->string('kartu_keluarga');
            $table->bigInteger('rumah_id')->unsigned();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->string('no_hp')->nullable();
            $table->date('tgl_lahir');
            $table->enum('status_martial', ['MENIKAH', 'JANDA/DUDA', 'BELUM MENIKAH']);
            $table->enum('pendidikan', ['Blm/tidak', 'SD', 'SMP', 'SMA', 'Diploma', 'S1', 'S2', 'S3']);
            $table->enum('pekerjaan', ['swasta', 'pns', 'guru', 'dosen', 'pensiunan', 'ibu rumah tangga', 'lainnya']);
            $table->string('tempat_kerja')->nullable();
            $table->enum('status_penghuni', ['pemilik rumah', 'kontrak', 'boro']);
            $table->string('file_ktp')->nullable();
            $table->string('is_kepala_keluarga');
            $table->string('no_wa')->nullable();
            $table->timestamps();

            $table->foreign('rumah_id')->references('id')->on('rumah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghuni');
    }
};
