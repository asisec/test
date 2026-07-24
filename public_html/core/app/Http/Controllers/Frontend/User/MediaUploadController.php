<?php

namespace App\Http\Controllers\Frontend\User;

use App\Actions\Media\MediaHelper;
use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use App\Models\Backend\MediaUpload;
use Illuminate\Http\Request;

class MediaUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function uploadMediaFile(Request $request)
    {
        $this->validate($request, [
            'file' => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);
        $image_details = MediaHelper::insert_media_image($request,'web');
        if ($image_details) {
            $img_url = asset('assets/uploads/media-uploader/' . $image_details->path);
            if (file_exists('assets/uploads/media-uploader/grid-' . $image_details->path)) {
                $img_url = asset('assets/uploads/media-uploader/grid-' . $image_details->path);
            }
            return response()->json([
                'id' => $image_details->id,
                'img_url' => $img_url,
            ]);
        }
        return response()->json(['error' => 'Upload failed'], 422);
    }

    public function allUploadMediaFile(Request $request)
    {
        return response()->json(MediaHelper::fetch_media_image($request,'web'));
    }

    public function deleteUploadMediaFile(Request $request)
    {
        MediaHelper::delete_media_image($request,'web');

        return redirect()->back()->with(FlashMsg::error('Image Deleted'));
    }

    public function altChangeUploadMediaFile(Request $request)
    {
        $this->validate($request, [
            'imgid' => 'required',
            'alt' => 'nullable',
        ]);
        MediaUpload::where(['id' => $request->imgid,'type' => 'web','user_id' => auth('web')->id()])->update(['alt' => $request->alt]);
        return __('alt update done');
    }
    public function getImageForLoadmore(Request $request){
        return response()->json(MediaHelper::load_more_images($request,'web'));
    }
}
