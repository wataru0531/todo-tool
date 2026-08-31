<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::table('tasks', function (Blueprint $table) {
      // doneカラムを追加
      Schema::table("tasks", function(Blueprint $table) {
        $table->boolean("done")->default(false)->after("task");
      });
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::table('tasks', function (Blueprint $table) {
      // タスクを削除する
      $table->dropColumn("done");

    });
  }
};
