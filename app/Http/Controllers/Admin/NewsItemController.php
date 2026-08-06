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
        $data = $this->validated($request, null);
        $data['is_featured'] = $request->boolean('is_featured');

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
        $data = $this->validated($request, $news);
        $data['is_featured'] = $request->boolean('is_featured');

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

    private function validated(Request $request, ?NewsItem $news): array
    {
        return $request->validate([
            'title'           => 'required|string|max:255',
            'title_en'        => 'nullable|string|max:255',
            'category'        => 'required|string|max:100',
            'category_en'     => 'nullable|string|max:100',
            'excerpt'         => 'required|string',
            'excerpt_en'      => 'nullable|string',
            'content'         => 'nullable|string',
            'content_en'      => 'nullable|string',
            'image'           => 'nullable|image|min:2048|max:10240',
            'author'          => 'required|string|max:255',
            'reading_minutes' => 'required|integer|min:1',
            'is_featured'     => ['sometimes', 'boolean', function ($attribute, $value, $fail) use ($request, $news) {
                if (! $request->boolean('is_featured')) {
                    return;
                }

                $alreadyFeatured = NewsItem::where('is_featured', true)
                    ->when($news, fn ($q) => $q->whereKeyNot($news->id))
                    ->exists();

                if ($alreadyFeatured) {
                    $fail('Sudah ada berita lain yang dijadikan berita utama. Batalkan status berita utama tersebut terlebih dahulu sebelum memilih berita ini.');
                }
            }],
            'published_at'    => 'nullable|date',
        ]);
    }
}