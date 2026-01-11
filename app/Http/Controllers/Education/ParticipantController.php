<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::latest()->paginate(20);
        return view('education.participant.index', compact('participants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'participant_code' => 'required|string|unique:participants,participant_code',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:M,F',
            'dob' => 'nullable|date',
            'city' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
        ]);

        Participant::create($validated);

        return redirect()->route('education.participant')->with('success', 'Peserta berhasil ditambahkan!');
    }

    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'participant_code' => 'required|string|unique:participants,participant_code,' . $participant->id,
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:M,F',
            'dob' => 'nullable|date',
            'city' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
        ]);

        $participant->update($validated);

        return redirect()->route('education.participant')->with('success', 'Peserta berhasil diperbarui!');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return redirect()->route('education.participant')->with('success', 'Peserta berhasil dihapus!');
    }
}
