<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestNoteController extends Controller
{
    public function index(Request $request)
    {
        $notes = $request->session()->get('guest_notes', []);

        // Sort notes by priority (highest first)
        usort($notes, function ($a, $b) {
            return $b['priority'] <=> $a['priority'];
        });

        return view('guest-notes.index', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|string|max:500',
        ]);

        $notes = $request->session()->get('guest_notes', []);

        if (count($notes) >= 6) {
            return back()->with('error', 'Guest notes limit reached (6).');
        }

        $notes[] = [
            'id' => uniqid(),
            'content' => $request->note,
            'priority' => 1, // default priority
        ];

        $request->session()->put('guest_notes', $notes);

        // Flash a success message to the session
        return back()->with('success', 'Note added successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $notes = $request->session()->get('guest_notes', []);

        $notes = array_filter($notes, fn($note) => $note['id'] !== $id);

        $request->session()->put('guest_notes', $notes);

        return back();
    }

    public function updatePriority(Request $request, $id)
    {
        $notes = session('guest_notes', []);

        foreach ($notes as &$note) {
            if ($note['id'] === $id) {
                $note['priority'] = (int) $request->priority;
                break;
            }
        }

        session(['guest_notes' => $notes]);

        return back()->with('success', 'Priority updated.');
    }
}
