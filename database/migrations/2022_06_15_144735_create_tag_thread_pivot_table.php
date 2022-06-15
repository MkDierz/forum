<?php

use App\Models\Tag;
use App\Models\Thread;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_thread', function (Blueprint $table) {
            $table->foreignIdFor(Tag::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Thread::class)->constrained()->onDelete('cascade');
            $table->primary(['tag_id', 'thread_id']);

            $table->index('tag_id');
            $table->index('thread_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_thread');
    }
};
