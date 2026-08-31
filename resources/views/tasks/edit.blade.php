<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task - Minimal Task Manager</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

    @vite(["resources/css/app.css", "resources/js/app.js"]);

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
            -webkit-font-smoothing: antialiased;
            background-color: #fcfcfc;
        }
        /* 日付入力のアイコン調整（ブラウザデフォルトの上書き） */
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            background: transparent;
            bottom: 0;
            color: transparent;
            cursor: pointer;
            height: auto;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            width: auto;
        }
        /* アニメーション */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        @keyframes slideUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes shake {
            10%, 90% { transform: translateX(-1px); }
            20%, 80% { transform: translateX(2px); }
            30%, 50%, 70% { transform: translateX(-4px); }
            40%, 60% { transform: translateX(4px); }
        }
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
        .animate-slide-up {
            animation: slideUp 0.4s ease-out forwards;
        }
        .animate-shake {
            animation: shake 0.4s cubic-bezier(.36,.07,.19,.97) both;
        }
    </style>
</head>
<body class="text-gray-800 min-h-screen flex items-center justify-center p-4 selection:bg-gray-200">
    <!-- Main Container -->
    <main class="w-full max-w-lg animate-fade-in relative">
      <!-- Header Area -->
      <header class="mb-8 px-2">
        <div class="flex items-center gap-4">
          <a 
            href="{{ route('tasks.index') }}" 
            class="text-gray-400 hover:text-[#1a1a1a] transition-colors" aria-label="戻る"
          >
            <i class="fa-solid fa-arrow-left text-lg"></i>
          </a>
          <h1 class="text-lg font-medium tracking-wide text-[#1a1a1a]">Edit Task</h1>
        </div>
      </header>

      <!-- Input Form -->
      <form action="" method="post" class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-8 animate-slide-up">
        @csrf
        <!-- Task Content Input (Error State) -->
        <div class="mb-8 group">
          <label for="task-content" class="block text-xs font-bold tracking-widest uppercase mb-2 flex items-center gap-2">
              Task Name
          </label>
          <div class="relative">
            <input 
              type="text" 
              name="task"
              id="task-content" 
              class="block w-full py-3 px-4 border-1 rounded-xl text-[#1a1a1a] focus:outline-none transition-all duration-300 text-lg font-light"
              placeholder="例: デザインカンプの作成"
              autofocus
              value="{{ old('task', $task->task) }}"
            >
            <!-- 
              old("フォームの値", 初期値)
              → 編集でこの画面に遷移した時には、初期値を表示、
                送信に失敗した時には、フォームに入力した値を残す
            -->

            <!-- Error Message -->
            @error("task")
            <p class="absolute -bottom-6 left-1 text-xs text-[#ef4444] font-medium">
                {{ $message }}
            </p>
            @enderror
          </div>
        </div>

        <!-- Due Date Input -->
        <div class="mb-10">
          <label for="due-date" class="block text-xs font-bold tracking-widest text-gray-400 uppercase mb-2">Due Date</label>
          <div class="relative hover:shadow-md transition-shadow duration-300 rounded-xl bg-gray-50">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <i class="fa-regular fa-calendar text-gray-400"></i>
            </div>
            <input 
              type="date" 
              id="due-date" 
              name="due_date"
              class="block w-full pl-12 pr-4 py-3 bg-transparent border border-transparent rounded-xl text-gray-700 placeholder-gray-400 focus:bg-white focus:border-gray-200 focus:ring-2 focus:ring-gray-100 focus:outline-none transition-all duration-300 font-light appearance-none"
              value="{{ $task->due_date }}"
            >
            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
              <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>
            </div>
          </div>
          <p class="mt-2 text-xs text-gray-400 pl-1">
            締め切りを設定しない場合は空欄のままにしてください
          </p>
        </div>

        <!-- Save Button -->
        <button type="submit" class="w-full py-4 bg-[#1a1a1a] text-white rounded-xl font-bold text-sm shadow-lg hover:bg-black hover:shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300 flex items-center justify-center gap-2">
          <span>保存する</span>
          <i class="fa-solid fa-arrow-right"></i>
        </button>
      </form>
    </main>

</body>
</html>