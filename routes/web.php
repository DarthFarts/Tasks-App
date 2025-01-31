<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\TaskRequest;
use App\Models\Task;

//Default Laravel routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
//End Default Laravel Routes




//Index
Route::get('/tasks', function() {
    return view('index', ['tasks' => Task::latest()->paginate(10)]);
})->name('tasks.index');

//Create
Route::view('/tasks/create', 'create')->name('tasks.create');

//Edit
Route::get('/tasks/{task}/edit', function (Task $task){
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

//Show
Route::get('/tasks/{task}', function (Task $task){
    return view('show', ['task' =>$task]);
})->name('tasks.show');


    Route::get('/', function (){
        return redirect()->route('tasks.index');
    });

    Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {

        $task->update($request->validated());

        return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success','Task Updated Successfully!');
    })->name('tasks.update');


    Route::post('/tasks', function (TaskRequest $request) {
        $task = Task::create($request->validated());

        return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success','Task Created Successfully!'); 
    })->name('tasks.store');

    //delete
    Route::delete('/tasks/{task}', function (Task $task) {
        $task->delete();

        return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
    })->name('tasks.destroy');

    //toggle complete
    Route::put('tasks/{task}/toggle-complete', function(Task $task){
        $task->toggleComplete();
         
        return redirect()->back()->with('success', 'Task updated successfully!');
    })->name('tasks.toggle-complete');

    //Fallback route
    Route::Fallback(function () {
        return "Hello, you are lost!";
    });