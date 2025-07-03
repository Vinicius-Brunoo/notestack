<?php

use App\Http\Controllers\NoteController;

Route::get('/', [NoteController::class, 'index'])->name('notes.index');
Route::resource('notes', NoteController::class)->except(['index']);
Route::patch('/notes/{note}/toggle-favorite', [NoteController::class, 'toggleFavorite'])->name('notes.toggleFavorite');

