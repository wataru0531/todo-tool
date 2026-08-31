<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
  */
  public function up(): void {
    // due_dateのカラムを追加
    Schema::table("tasks", function(Blueprint $table) {
      $table->date("due_date")->nullable()->after("task");
    });
  }

  /**
   * Reverse the migrations.
  */
  public function down(): void {
    // due_dateのカラムを削除
    Schema::table("tasks", function (Blueprint $table) {
      $table->dropColumn("due_date");
    });

  }
};
