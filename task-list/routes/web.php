<?php




// Different http verbs
// GET
//POST
//UPDATE
//DELETE

// Route::get('/hello', function () {
//     return 'Welcome to Laravel!';
// })->name('hello');

// redirect and named routes

// Route::get('/hallo', function () {
//     return redirect('hello');
//     return redirect()->route('hello');
// });

// Fallback route in case no route is matched/found
// Route::fallback(function () {
//     return 'Still got some!';
// });

// use App\Models\Task ;

use App\Http\Requests\TaskRequest;
use App\Models\Task as ModelsTask;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {}
}

$tasks = [
    new Task(
        1,
        'Buy groceries',
        'Task 1 description',
        'Task 1 long description',
        false,
        '2023-03-01 12:00:00',
        '2023-03-01 12:00:00'
    ),
    new Task(
        2,
        'Sell old stuff',
        'Task 2 description',
        null,
        false,
        '2023-03-02 12:00:00',
        '2023-03-02 12:00:00'
    ),
    new Task(
        3,
        'Learn programming',
        'Task 3 description',
        'Task 3 long description',
        true,
        '2023-03-03 12:00:00',
        '2023-03-03 12:00:00'
    ),
    new Task(
        4,
        'Take dogs for a walk',
        'Task 4 description',
        null,
        false,
        '2023-03-04 12:00:00',
        '2023-03-04 12:00:00'
    ),
];

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => ModelsTask::latest()->paginate()

        // It lets you get the more recents records being created/saved
        // 'tasks' => \App\Models\Task::latest()->get()

        // It will fetch the completed tasks
        // 'tasks' => \App\Models\Task::latest()->where('completed', true)->get()
    ]);
})->name('tasks.index');

// Render Create View
Route::view('/tasks/create', 'create')
    ->name('tasks.create');


// Edit Task
Route::get('/tasks/{task}/edit', function (ModelsTask $task) {
    return view('edit', [
        'task' =>   $task
    ]);
})->name('tasks.edit');

// Get Single Task
Route::get('/tasks/{task}', function (ModelsTask $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

// Create Task
Route::post('/tasks', function (TaskRequest $request) {
    $task = ModelsTask::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

// Update Task
Route::put('/tasks/{task}', function (ModelsTask $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

// Delete Task
Route::delete('/tasks/{task}', function (ModelsTask $task) {
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

// Toggle Complete
Route::put('/tasks/{task}/toggle-complete', function (ModelsTask $task) {
    $task->toggleComplete();
    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');
