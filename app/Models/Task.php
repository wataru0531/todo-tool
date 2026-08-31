<?php

// /app/Models/Task.php
// → モデル名は単数形

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
  // このモデルで、外部から値を一括代入してよいカラムを指定するためのプロパティ
  // 下記のように、コントローラでDBに入れるとする。
  // 下記の場合は、そのままDBに入れてもいいが、安易に入れたくない時もあるので指定する
  // Task::create([
  //   "task" => "こんにちは"
  // ]);
  protected $fillable = [
    "task",
    "due_date",
    "done",
  ];

  // バリデーションの設定項目
  public static $rules = [
    "task" => "required",
    "due_date" => "nullable|date",
    "done" => "boolean",
  ];

  // エラーメッセージ
  // bladeファイルでのバリデーションに使用
  public static $messages = [
    "task.required" => "タスクの内容を入力くてください。",
  ];

}

