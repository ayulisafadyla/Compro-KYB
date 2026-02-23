<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactItem;
use Illuminate\Http\Request;

class ContactItemController extends Controller
{
    public function index()
    {
        $contactItems = ContactItem::orderBy('order')->paginate(15);
        return view('admin.contact-items.index', compact('contactItems'));
    }

    public function create()
    {
        return view('admin.contact-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        ContactItem::create($validated);

        return redirect()->route('admin.contact-items.index')
            ->with('success', 'Contact item created successfully.');
    }

    public function edit(ContactItem $contactItem)
    {
        return view('admin.contact-items.edit', compact('contactItem'));
    }

    public function update(Request $request, ContactItem $contactItem)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $contactItem->update($validated);

        return redirect()->route('admin.contact-items.index')
            ->with('success', 'Contact item updated successfully.');
    }

    public function destroy(ContactItem $contactItem)
    {
        $contactItem->delete();
        return redirect()->route('admin.contact-items.index')
            ->with('success', 'Contact item deleted successfully.');
    }
}
