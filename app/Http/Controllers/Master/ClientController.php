<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('primaryContact')->latest()->paginate(20);
        return view('master.client.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_code' => 'required|string|unique:clients,client_code',
            'client_name' => 'required|string|max:255',
            'client_type' => 'required|in:CORPORATE,GOVERNMENT,EDUCATION,INDIVIDUAL_RESELLER',
            'industry' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'status' => 'required|in:ACTIVE,INACTIVE',
        ]);

        Client::create($validated);

        return redirect()->route('master.client')->with('success', 'Client berhasil ditambahkan!');
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'client_code' => 'required|string|unique:clients,client_code,' . $client->id,
            'client_name' => 'required|string|max:255',
            'client_type' => 'required|in:CORPORATE,GOVERNMENT,EDUCATION,INDIVIDUAL_RESELLER',
            'industry' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'status' => 'required|in:ACTIVE,INACTIVE',
        ]);

        $client->update($validated);

        return redirect()->route('master.client')->with('success', 'Client berhasil diperbarui!');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('master.client')->with('success', 'Client berhasil dihapus!');
    }
}
