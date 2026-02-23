<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = \App\Models\Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($request->title);
        
        // Ensure slug is unique
        $count = \App\Models\Page::where('slug', 'like', $validated['slug'] . '%')->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        \App\Models\Page::create($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully.');
    }

    public function edit($id)
    {
        // Support both ID and Slug for existing links
        $page = is_numeric($id) 
            ? \App\Models\Page::findOrFail($id) 
            : \App\Models\Page::where('slug', $id)->firstOrFail();
            
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = is_numeric($id) 
            ? \App\Models\Page::findOrFail($id) 
            : \App\Models\Page::where('slug', $id)->firstOrFail();
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        if ($request->title !== $page->title) {
            $validated['slug'] = \Illuminate\Support\Str::slug($request->title);
            $count = \App\Models\Page::where('slug', 'like', $validated['slug'] . '%')
                ->where('id', '!=', $page->id)
                ->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    public function destroy($id)
    {
        $page = is_numeric($id) 
            ? \App\Models\Page::findOrFail($id) 
            : \App\Models\Page::where('slug', $id)->firstOrFail();
            
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}
