<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndChangeColumnTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            //is_completedカラム追加(デフォルトは0)
            //$table->boolean('is_completed')->default(0);

            //外部キー制約を削除
            $table->dropForeign(['point_id']);
        });

        Schema::table('todos', function (Blueprint $table) {
            // point_idをnullableに変更、デフォルトもnullにする
            $table->unsignedBigInteger('point_id')->nullable()->default(null)->change();

            //外部キー制約を再追加
            $table->foreign('point_id')->references('id')->on('points')->onDelete('cascade');

            //deadlineもデフォルトnullに変更
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
            //外部キー制約の解除
            $table->dropForeign(['point_id']);

            //is_completedカラムの削除
            $table->dropColumn('is_completed');

            //point_idを元に戻す(nullable解除、default解除)
            $table->unsignedBigInteger('point_id')->nullable(false)->change();

            //外部キー制約を再追加
            $table->foreign('point_id')->references('id')->on('points')->onDelete('cascade');

            //deadlineも必要に応じてデフォルトなしに戻す
        });
    }
}
