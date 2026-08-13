<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\PageBanner;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageBannerController extends Controller
{
    public function edit(string $page)
    {
        $this->ensureValidPage($page);

        return view('admin.page-banners.edit', [
            'banner'  => PageBanner::firstOrNew(['page' => $page]),
            'pageKey' => $page,
            'label'   => PageBanner::PAGES[$page],
        ]);
    }

    public function update(Request $request, string $page)
    {
        $this->ensureValidPage($page);

        $request->validate([
            'image' => 'required|image|mimes:png|min:2048|max:10240',
        ]);

        $banner = PageBanner::firstOrNew(['page' => $page]);

        Media::deleteRef($banner->image);

        $banner->image = Media::storeUpload($request->file('image'));
        $banner->save();

        return redirect()->route('admin.page-banners.edit', $page)
            ->with('success', 'Banner halaman '.PageBanner::PAGES[$page].' diperbarui.');
    }

    public function destroy(string $page)
    {
        $this->ensureValidPage($page);

        $banner = PageBanner::where('page', $page)->first();

        if ($banner) {
            Media::deleteRef($banner->image);
            $banner->delete();
        }

        return redirect()->route('admin.page-banners.edit', $page)
            ->with('success', 'Banner halaman '.PageBanner::PAGES[$page].' dihapus.');
    }

    private function ensureValidPage(string $page): void
    {
        if (! array_key_exists($page, PageBanner::PAGES)) {
            throw new NotFoundHttpException();
        }
    }
}
