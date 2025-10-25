<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_attendances_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->enum('status', ['Hadir', 'Izin', 'Alpa']);
            $table->timestamps();
            $table->unique(['student_id', 'date']); // Satu siswa hanya bisa absen sekali sehari
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}