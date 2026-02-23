<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePhilosophyController extends Controller
{
    public function index()
    {
        $philosophies = \App\Models\HomePhilosophy::orderBy('order')->get();
        return view('admin.home-philosophies.index', compact('philosophies'));
    }

    public function create()
    {
        return view('admin.home-philosophies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        \App\Models\HomePhilosophy::create($request->all());

        return redirect()->route('admin.home-philosophies.index')->with('success', 'Philosophy Item created successfully.');
    }

    public function edit(\App\Models\HomePhilosophy $homePhilosophy)
    {
        return view('admin.home-philosophies.edit', compact('homePhilosophy'));
    }

    public function update(Request $request, \App\Models\HomePhilosophy $homePhilosophy)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $homePhilosophy->update($request->all());

        return redirect()->route('admin.home-philosophies.index')->with('success', 'Philosophy Item updated successfully.');
    }

    public function destroy(\App\Models\HomePhilosophy $homePhilosophy)
    {
        $homePhilosophy->delete();
        return redirect()->route('admin.home-philosophies.index')->with('success', 'Philosophy Item deleted successfully.');
    }
}
