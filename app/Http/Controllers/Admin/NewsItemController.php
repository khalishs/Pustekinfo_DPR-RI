<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsItemController extends Controller
{
    public function index()
    {
        return view('admin.news.index', [
            'newsItems' => NewsItem::latest('published_at')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.news.form', ['newsItem' => new NewsItem()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('berita', 'public');
        }

        NewsItem::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita ditambahkan.');
    }

    public function edit(NewsItem $news)
    {
        return view('admin.news.form', ['newsItem' => $news]);
    }

    public function update(Request $request, NewsItem $news)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('berita', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita diperbarui.');
    }

    public function destroy(NewsItem $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title'           => 'required|string|max:255',
            'category'        => 'required|string|max:100',
            'excerpt'         => 'required|string',
            'content'         => 'nullable|string',
            'image'           => 'nullable|image|max:2048',
            'author'          => 'required|string|max:255',
            'reading_minutes' => 'required|integer|min:1',
            'is_featured'     => 'nullable|boolean',
            'published_at'    => 'nullable|date',
        ]);
    }
}