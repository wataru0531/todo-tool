<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
  Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

Route::get("/", function() {
  // return "Hello Laravel";
  $sum = 1 + 2;
  return "1 + 2 = " . $sum;
});

Route::get("/about", function() {
  // return "About Page";
  return view("about.index");
});

// ✅ タスク作成ページ
Route::get("/tasks/create", [TasksController::class, "create"])->name("tasks.create");

// Route::post("/tasks/create", function() {
//   $task = request("task");
//   return $task . " がtaskが送信されました。";
// });

// ✅ タスク一覧ページ
Route::get("/tasks", [TasksController::class, "index"])->name("tasks.index");

// ✅ 編集画面
Route::get("/tasks/{id}/edit", [TasksController::class, "edit"])->name("tasks.edit");

// ✅ タスク編集時の処理
Route::post("/tasks/{id}/edit", [TasksController::class, "update"])->name("tasks.update");

// ✅ タスク作成時の処理
Route::post("/tasks/create", [TasksController::class, "store"])->name("tasks.store");

// ✅ タスク削除時の処理
Route::delete("/tasks/{id}", [TasksController::class, "destroy"])->name("tasks.destroy");

// ✅ タスクの完了/未完了
Route::post("/tasks/{id}/done", [TasksController::class, "done"])->name("tasks.done");


