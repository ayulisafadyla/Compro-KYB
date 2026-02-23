<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\HandleImageUpload;

class ArticleController extends Controller
{
    use HandleImageUpload;

    public function index(Request $request)
    {
        $query = Article::query();

        // Filter by published status
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'published') {
                $query->where('is_published', true);
            } else {
                $query->where('is_published', false);
            }
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }

        $articles = $query->latest()->paginate(15);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'articles');
        }

        $validated['is_published'] = $request->has('is_published');

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $this->deleteImage($article->image);
            $validated['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'articles');
        }

        $validated['is_published'] = $request->has('is_published');

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        // Delete image
        $this->deleteImage($article->image);

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
