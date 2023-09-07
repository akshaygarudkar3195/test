<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Create a new client
        Client::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'notes' => $request->input('notes'),
        ]);

        // Redirect to the client list with a success message
        return redirect()->route('clients.index')->with('success', 'Client created successfully');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email,' . $client->id,
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Update the client data
        $client->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'notes' => $request->input('notes'),
        ]);

        // Redirect to the client list with a success message
        return redirect()->route('clients.index')->with('success', 'Client updated successfully');
    }

    public function destroy(Client $client)
    {
        // Delete the client
        $client->delete();

        // Redirect to the client list with a success message
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully');
    }
}
