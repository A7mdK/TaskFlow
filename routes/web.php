<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

/*
Route::get('/', function(){
  return redirect()->route('tasks.index');
});
*/

Route::get('/tasks', function() {
    return view('index', [
      'tasks' => Task::latest()->paginate(15)//get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
->name('tasks.create');

Route::get('/tasks/{task}/edit', function(Task $task) {
  return view('edit', [
    'task' => $task
  ]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function(Task $task) {
  return view('show', [
    'task' => $task //Task::findOrFail($task)
    ]);
})->name('tasks.show');

Route::post('/tasks', function(TaskRequest $request){
  /*
  dd($request->all());

  $data = $request->validate([
    'title' => 'required|max:255',
    'description' => 'required',
    'long_description' => 'required',
  ]);

  $data = $request->validated();
  
  $task = new Task;
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];
  $task->save();
  */

  $task = Task::create($request->validated());

  return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task Created Succesfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function(Task $task, TaskRequest $request){
  $task->update($request->validated());

  return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task Updated Succesfully!');
})->name('tasks.update');

Route::delete('/task/{task}', function(Task $task){
  $task->delete();

  return redirect()->route('tasks.index')->with('success', 'Task Deleted Successfully!');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function(Task $task){
  $task->toggleComplete();

  return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');

Route::fallback(function(){
  return redirect()->route('tasks.index');  
});