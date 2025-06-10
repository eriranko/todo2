<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlagColumnTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {

        //flag追加(isCompletedを追加,デフォルトは0)
        $table->boolean('is_completed')->default(0);

        //point_idのデフォルトをnullにする
        $table->unsignedBigInteger('point_id')->constrained()->cascadeOnDelete()->nullable()->default(null)->change();

        //deadlineのデフォルトをnullにする
        $table->string('deadline')->nullable()->default(null)->change();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {

        //追加したカラムを削除する
        $table->dropColumn('is_completed');
        });

    }
}
