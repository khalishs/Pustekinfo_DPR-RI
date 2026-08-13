<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsItem;
use App\Models\Media;
use Illuminate\Http\Request;

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
        $data['title'] = ucfirst($data['title']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = Media::storeUpload($request->file('image'));
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
        $data['title'] = ucfirst($data['title']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            Media::deleteRef($news->image);
            $data['image'] = Media::storeUpload($request->file('image'));
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita diperbarui.');
    }

    public function toggleActive(NewsItem $news)
    {
        $newState = ! $news->is_active;
        $news->update(['is_active' => $newState]);

        return redirect()->route('admin.news.index')->with(
            'success',
            $newState ? 'Berita diaktifkan kembali dan akan tampil ke pengguna.' : 'Berita dinonaktifkan dan tidak akan tampil ke pengguna.'
        );
    }

    public function destroy(NewsItem $news)
    {
        Media::deleteRef($news->image);
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
            'image'           => 'nullable|image|mimes:png|min:2048|max:10240',
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
            'is_active'       => 'sometimes|boolean',
            'published_at'    => 'nullable|date',
        ]);
    }
}