<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsArticleController extends Controller
{
    public function index()
    {
        $articles = NewsArticle::orderByDesc('published_at')->get();
        return view('admin.news.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:150|unique:news_articles,slug',
            'title_en' => 'required|string|max:200',
            'title_dari' => 'nullable|string|max:200',
            'title_pashto' => 'nullable|string|max:200',
            'excerpt_en' => 'nullable|string',
            'excerpt_dari' => 'nullable|string',
            'excerpt_pashto' => 'nullable|string',
            'content_en' => 'nullable|string',
            'content_dari' => 'nullable|string',
            'content_pashto' => 'nullable|string',
            'category' => 'nullable|string|max:256',
            'published_at' => 'required|date',
            'is_published' => 'boolean',
            'cover_image_file' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $ext = $file->getClientOriginalExtension();
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time();
            $validated['cover_image_url'] = $file->storeAs('uploads', $name . '.' . $ext, 'public');
        }

        $validated['is_published'] = $request->boolean('is_published', false);

        NewsArticle::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'News article created successfully.');
    }

    public function edit(NewsArticle $article)
    {
        return view('admin.news.edit', compact('article'));
    }

    public function update(Request $request, NewsArticle $article)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:150|unique:news_articles,slug,' . $article->id,
            'title_en' => 'required|string|max:200',
            'title_dari' => 'nullable|string|max:200',
            'title_pashto' => 'nullable|string|max:200',
            'excerpt_en' => 'nullable|string',
            'excerpt_dari' => 'nullable|string',
            'excerpt_pashto' => 'nullable|string',
            'content_en' => 'nullable|string',
            'content_dari' => 'nullable|string',
            'content_pashto' => 'nullable|string',
            'category' => 'nullable|string|max:256',
            'published_at' => 'required|date',
            'is_published' => 'boolean',
            'cover_image_file' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('cover_image_file')) {
            if ($article->cover_image_url && Storage::disk('public')->exists($article->cover_image_url)) {
                Storage::disk('public')->delete($article->cover_image_url);
            }
            $file = $request->file('cover_image_file');
            $ext = $file->getClientOriginalExtension();
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time();
            $validated['cover_image_url'] = $file->storeAs('uploads', $name . '.' . $ext, 'public');
        } else {
            unset($validated['cover_image_url']);
        }

        $validated['is_published'] = $request->boolean('is_published', false);

        $article->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'News article updated successfully.');
    }

    public function destroy(NewsArticle $article)
    {
        if ($article->cover_image_url && Storage::disk('public')->exists($article->cover_image_url)) {
            Storage::disk('public')->delete($article->cover_image_url);
        }
        $article->delete();
        return redirect()->route('admin.news.index')->with('success', 'News article deleted successfully.');
    }
}