<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CageController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [CageController::class, 'index'])->name('cage.index');

Route::get('/cage', [CageController::class, 'index'])->name('cage.index');
Route::get('/cage/{cage}', [CageController::class, 'show'])->name('cage.show');
Route::get('/animal/{animal}', [AnimalController::class, 'show'])->name('animal.show');

Route::get('/animal', [AnimalController::class, 'index'])->name('animal.index'); // Обработка добавления животного
Route::get('/animal/{animal}', [AnimalController::class, 'show'])->name('animal.show'); // Просмотр животного

Route::middleware(['auth'])->group(function () {
    Route::get('/cage/create', [CageController::class, 'create'])->name('cage.create'); // Форма для добавления клетки
    Route::post('/cage', [CageController::class, 'store'])->name('cage.store'); // Обработка добавления клетки
    //Route::get('/cage', [CageController::class, 'index'])->name('cage.index');

    //Route::get('/cage/{cage}', [CageController::class, 'show'])->name('cage.show'); // Просмотр клетки
    Route::get('/cage/{cage}/edit', [CageController::class, 'edit'])->name('cage.edit'); // Форма редактирования клетки
    //Route::put('/cage/{cage}', [CageController::class, 'update'])->name('cage.update'); // Обновление клетки
    Route::delete('/cage/{cage}', [CageController::class, 'destroy'])->name('cage.destroy'); // Удаление клетки

    Route::get('/animal/create', [AnimalController::class, 'create'])->name('animal.create'); // Форма добавления животного
    Route::post('/animal', [AnimalController::class, 'store'])->name('animal.store'); // Обработка добавления животного

    Route::get('/animal/{animal}/edit', [AnimalController::class, 'edit'])->name('animal.edit'); // Форма редактирования животного
    Route::put('/animal/{animal}', [AnimalController::class, 'update'])->name('animal.update'); // Обновление животного
    Route::delete('/animal/{animal}', [AnimalController::class, 'destroy'])->name('animal.destroy'); // Удаление животного
});





