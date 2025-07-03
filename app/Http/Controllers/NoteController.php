<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $notes = Note::query();

        if ($request->get('favorite')) {
            $notes->where('favorite', true);
        }

        return view('notes.index', ['notes' => $notes->latest()->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'color' => 'nullable|string|max:7',
        ]);

        Note::create([
            'title' => $request->title,
            'content' => $request->content,
            'color' => $request->color ?? '#fef3c7',
        ]);

        return redirect()->route('notes.index');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index');
    }

    public function toggleFavorite(Note $note)
    {
        $note->favorite = !$note->favorite;
        $note->save();

        return redirect()->route('notes.index');
    }
}
