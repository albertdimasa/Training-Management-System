<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::latest()->paginate(20);
        return view('master.venue.index', compact('venues'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'venue_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'venue_type' => 'required|in:INHOUSE,CLIENT_SITE,HOTEL,ONLINE',
        ]);

        Venue::create($validated);

        return redirect()->route('master.venue')->with('success', 'Venue berhasil ditambahkan!');
    }

    public function update(Request $request, Venue $venue)
    {
        $validated = $request->validate([
            'venue_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'venue_type' => 'required|in:INHOUSE,CLIENT_SITE,HOTEL,ONLINE',
        ]);

        $venue->update($validated);

        return redirect()->route('master.venue')->with('success', 'Venue berhasil diperbarui!');
    }

    public function destroy(Venue $venue)
    {
        $venue->delete();

        return redirect()->route('master.venue')->with('success', 'Venue berhasil dihapus!');
    }
}
