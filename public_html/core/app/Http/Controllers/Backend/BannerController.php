<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    /**
     * Display a listing of all banners.
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Store a newly created banner in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'nullable|string|max:255',
            'image'    => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
            'url'      => 'nullable|url|max:500',
            'position' => 'nullable|in:top_1,top_2,bottom_1,bottom_2,listings_top_1,listings_top_2',
        ]);

        // Handle image upload
        $uploadPath = base_path('../assets/images/banners');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $imageFile = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
        $imageFile->move($uploadPath, $imageName);

        Banner::create([
            'title'     => $request->title,
            'image'     => 'assets/images/banners/' . $imageName,
            'url'       => $request->url,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'position'  => $request->input('position', 'top_1'),
        ]);

        return redirect()->route('admin.banner.index')
            ->with(FlashMsg::item_new(__('Banner başarıyla eklendi.')));
    }

    /**
     * Delete a banner record and its image file.
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        // Delete the physical image file
        $imagePath = base_path('../' . $banner->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $banner->delete();

        return redirect()->route('admin.banner.index')
            ->with(FlashMsg::item_delete(__('Banner başarıyla silindi.')));
    }

    /**
     * Toggle the is_active status of a banner.
     */
    public function toggle($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->is_active = !$banner->is_active;
        $banner->save();

        return redirect()->route('admin.banner.index')
            ->with(FlashMsg::item_new(__('Banner durumu güncellendi.')));
    }
}
