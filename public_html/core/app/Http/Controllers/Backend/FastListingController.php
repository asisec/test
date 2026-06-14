<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FastListingController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->where('status', 1)->get();
        return view('backend.fast-listing', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. Doğrulama (Tek resimden, çoklu resme (array) geçiş ve maksimum 6 sınırı)
        $request->validate([
            'images'   => 'required|array|max:6',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
            'fake_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|integer'
        ]);

        try {
            // 2. ÖNCE SAHTE KULLANICIYI YARAT
            $nameParts = explode(' ', $request->fake_name, 2);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? 'Kullanıcısı';
            $fakeEmail = Str::slug($request->fake_name) . rand(10, 99) . '@textileforum.net';
            
            $userId = DB::table('users')->insertGetId([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $fakeEmail,
                'username' => Str::slug($request->fake_name) . rand(10, 99),
                'password' => Hash::make('12345678'),
                'status' => 1,
                'email_verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. ÇOKLU MEDYA KLONLAMASI VE DÖNGÜSÜ
            $mainMediaId = null;
            $allMediaIds = [];
            $allImagePaths = []; // JSON olarak kaydedeceğimiz dizi
            $destinationPath = base_path('../assets/uploads/media-uploader');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $file) {
                    
                    // WebP motoru çöktüğü için formatı JPG'ye sabitliyoruz
                    $extension = 'jpg'; 
                    // uniqid() eklendi: Aynı saniyede yüklenen resimlerin isimleri çakışmasın!
                    $fileName = time() . '-' . uniqid() . '-' . Str::slug($request->title) . '.' . $extension;

                    // Ana Resmi Presle ve Boyutlarını Çek
                    $img = \Image::make($file)->resize(1000, null, function ($c) { $c->aspectRatio(); $c->upsize(); });
                    $img->encode($extension, 80)->save($destinationPath . '/' . $fileName);
                    
                    // Kilo ve Boy istihbaratını hesapla
                    $width = $img->width();
                    $height = $img->height();
                    $filesize = filesize($destinationPath . '/' . $fileName);
                    $sizeStr = round($filesize / 1024, 2) . ' KB';
                    $dimensions = $width . ' x ' . $height . ' pixels';

                    // Yardımcı Klonlar (Grid ve Thumb)
                    \Image::make($file)->resize(700, null, function ($c) { $c->aspectRatio(); $c->upsize(); })
                        ->encode($extension, 80)->save($destinationPath . '/grid-' . $fileName);
                    \Image::make($file)->resize(150, null, function ($c) { $c->aspectRatio(); $c->upsize(); })
                        ->encode($extension, 80)->save($destinationPath . '/thumb-' . $fileName);

                    // BİREBİR DNA MÜHÜRLENMESİ
                    $mediaId = DB::table('media_uploads')->insertGetId([
                        'title' => $fileName,
                        'path' => $fileName,
                        'alt' => NULL, 
                        'size' => $sizeStr, 
                        'dimensions' => $dimensions, 
                        'user_id' => $userId, 
                        'type' => 'web', 
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Yüklenen İLK resmi, ilanın ANA resmi (vitrin) olarak belirliyoruz
                    if ($index === 0) {
                        $mainMediaId = $mediaId;
                    } else {
                      $allMediaIds[] = (string) $mediaId;
                        }
                    // JSON sütunu için yolu kaydediyoruz
                    $allImagePaths[] = 'assets/uploads/media-uploader/' . $fileName;
                }
            }

            // 4. İLANI YENİ DETAYLARLA BİRLİKTE VERİTABANINA BASMA
            DB::table('listings')->insert([
                'user_id' => $userId,
                'image' => $mainMediaId, // İlk fotoğrafın ID'si
                'gallery_images' => implode(',', $allMediaIds), // Bütün fotoğrafların yolları (JSON Array)
                'title' => $request->title,
                'slug' => Str::slug($request->title) . '-' . rand(1000, 9999),
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'condition' => $request->condition ?? 'new',
                'negotiable' => $request->negotiable ?? 0,
                'phone' => $request->phone,
                'address' => $request->address,
                'authenticity' => 'original',
                'status' => 1,
                'is_published' => 1,
                'country_id' => $request->country_id ?? 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('msg', 'İlan ve görseller başarıyla basıldı!');

        } catch (\Exception $e) {
            // MOTOR PATLARSA SESSİZCE ÖLMESİN, HATAYI YÜZÜMÜZE VURSUN
            return redirect()->back()->withErrors(['error' => 'HATA!: ' . $e->getMessage()]);
        }
    }
}