<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Rooms;
use App\Models\User;

class CreateRoomCleaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roomcleanings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Rooms::class, 'idkamar');
            $table->foreignIdFor(User::class, 'idstaff');
            $table->dateTime('tanggaldibersihkan');
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
        Schema::dropIfExists('room_cleanings');
    }
}
