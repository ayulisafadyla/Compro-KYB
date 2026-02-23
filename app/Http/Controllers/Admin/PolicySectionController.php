<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PolicySection;
use Illuminate\Http\Request;

class PolicySectionController extends Controller
{
    public function index()
    {
        $policySections = PolicySection::orderBy('order')->paginate(15);
        return view('admin.policy-sections.index', compact('policySections'));
    }

    public function create()
    {
        return view('admin.policy-sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        PolicySection::create($validated);

        return redirect()->route('admin.policy-sections.index')
            ->with('success', 'Policy section created successfully.');
    }

    public function edit(PolicySection $policySection)
    {
        return view('admin.policy-sections.edit', compact('policySection'));
    }

    public function update(Request $request, PolicySection $policySection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $policySection->update($validated);

        return redirect()->route('admin.policy-sections.index')
            ->with('success', 'Policy section updated successfully.');
    }

    public function destroy(PolicySection $policySection)
    {
        $policySection->delete();
        return redirect()->route('admin.policy-sections.index')
            ->with('success', 'Policy section deleted successfully.');
    }
}
