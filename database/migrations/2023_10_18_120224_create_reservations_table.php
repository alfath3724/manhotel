<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Rooms;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('nmpenyewa');
            $table->enum('jenisidentitas', ['ktp', 'passport']);
            $table->string('noidentitas');
            $table->foreignIdFor(User::class, 'idstaff');
            $table->foreignIdFor(Rooms::class, 'idkamar');
            $table->dateTime('checkin');
            $table->dateTime('checkout')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
