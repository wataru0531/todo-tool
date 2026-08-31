<?php

// コントローラー 司令塔

// Tasksテーブルに関するコントローラ
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;


// web.phpのRouteから受け取る
class TasksController extends Controller {
  // アクションを定義
  // web.phpで下記のように記述 ↓
  // Route::get("tasks", [TasksController::class, "index"]);

  // ✅ タスク一覧ページを表示
  public function index(Request $request) {
    $tasks = Task::all(); // MySQLからtaskカラムのデータを全件取得
    // dd($task); // dump and die。中身を表示、その時点でプログラムの実行を中止

    return view("tasks.index", [
      "tasks" => $tasks,
    ]);
  }

  // ✅ タスク作成ページに遷移
  public function create() {
    return view("tasks.create");
  }

  // ✅ タスク作成時の処理
  public function store(Request $request) {
    // return "コントローラーが呼び出されました。";

    // バリデーション。モデルで$rules、 $messagesを定義
    // 👉 バリデーションを通過した、task、due_dateの値が入る
    $validated = $request->validate(Task::$rules, Task::$messages);

    // $task = $request->input("task");
    // $due_date = $request->input("due_date");

    // ✅ モデルからDBに追加。create ... 一括で保存
    // $result = Task::create([
    //   "task" => $task,
    //   "due_date" => $due_date,
    // ]);

    $result = Task::create($validated);
    // dd($result);

    // セッションにフラッシュメッセージを追加
    session()->flash("create", "「{$result->task}」 を作成しました。");
    return redirect()->route("tasks.index");
  }

  // ✅ 編集画面を表示する処理。index.blade.phpから動的パラメータを受け取る
  public function edit($id) {
    // echo $id . "を編集します。";
    $task = Task::findOrFail($id); // idにあうデータを取得。ないなら404に飛ぶ
    // dd($task);
    return view("tasks.edit", [
      "task" => $task,
    ]);
  }

  // ✅ 編集時に使う関数
  public function update(Request $request, $id) {
    // 該当するレコードを探す
    $task = Task::findOrFail($id);
    // バリデーションを通す → ひっかかれば入力画面に戻される
    $validated = $request->validate(Task::$rules, Task::$messages);
    $task->update($validated); // レコードを更新する

    return redirect()->route("tasks.index"); // 転送。/taskにリダイレクト
  }

  // ✅ タスクを一つ削除
  public function destroy($id) {
    $task = Task::findOrFail($id);
    $task->delete();

    // セッションに、キー : 値の形式で保存する。
    // flash() → 次のリクエストまで一時的に保持する
    session()->flash("success", "タスクを削除しました。");

    return redirect()->route("tasks.index"); // 見つかれば/tasksにリダイレクト
  }

  // ✅ タスクの完了/未完了
  public function done($id) {
    $task = Task::findOrFail($id);
    $task->done = !$task->done; // 反転
    $task->save();

    session()->flash("done", "タスクの完了/未完了を更新しました。");
    return redirect()->route("tasks.index");
  }

}
