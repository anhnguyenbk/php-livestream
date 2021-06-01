<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('class_id');
            $table->string('event_uuid', 50);
            $table->bigInteger('event_id')->nullable();
            $table->string('topic', 255)->nullable();
            $table->string('status', 20)->nullable();
            $table->dateTime('start_time')->nullable();
            $table->integer('duration')->nullable();
            $table->string('timezone', 50)->nullable();
            $table->text('start_url');
            $table->text('join_url');
            $table->mediumText('event_response');
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
        Schema::dropIfExists('tasks');
    }
}