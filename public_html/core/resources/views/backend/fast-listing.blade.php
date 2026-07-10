@extends('backend.admin-master')
@section('site-title', 'Hızlı Seri İlan Bas')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-tagsinput.css') }}">
    <style>
        .select2-container .select2-selection--single {
            background-color: var(--white-bg);
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            position: relative;
            height: auto;
            padding: 10px;
        }
        span.select2.select2-container.select2-container--default.select2-container--focus {
            width: 100% !important;
        }
        .select-itms span.select2 {
            width: 100% !important;
        }
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e3e3e3;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid #e3e3e3;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            font-size: 23px;
        }
        .select2-selection__choice__display {
            font-size: 15px;
            color: #000;
            font-weight: 400;
        }
    </style>
@endsection
@section('content')
<div class="col-lg-12 col-ml-12 padding-bottom-30">
    <div class="row">
        <div class="col-12 mt-5">
            @if(session()->has('msg'))
                <div class="alert alert-success">{{ session('msg') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Hızlı İlan Giriş Modülü </h4>
                    
                    <form action="{{ route('admin.hizli.ilan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- TEMEL BİLGİLER --}}
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label><strong>İlan Fotoğrafları (Maksimum 6 Adet)</strong></label>
                                <input type="file" class="form-control" name="images[]" id="imagesInput" accept="image/*" multiple required>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label><strong>Sahte Profil Adı</strong></label>
                                <input type="text" class="form-control" name="fake_name" placeholder="Örn: Mehmet Yılmaz" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label><strong>İlan Başlığı</strong></label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label><strong>İlan Detayı</strong></label>
                            <textarea class="form-control" name="description" rows="5" required></textarea>
                        </div>
                        
                        {{-- DETAYLI İLAN PARAMETRELERİ --}}
                        <div class="row">
                            <div class="form-group col-md-3 mb-3">
                                <label><strong>Fiyat</strong></label>
                                <input type="number" class="form-control" name="price" required>
                                <label class="contact-for-price d-block mt-2">
                                    <input type="checkbox" class="custom-check-box" name="contact_for_price" id="contact_for_price" value="1">
                                    <span class="ms-2 fw-bold text-primary">FİYAT İÇİN İLETİŞİME GEÇİN</span>
                                </label>
                            </div>
                            
                            <div class="form-group col-md-3 mb-3">
                                <label><strong>Kategori</strong></label>
                                <select class="form-control" name="category_id" required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name ?? $cat->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3 mb-3">
                                <label><strong>Eşya Durumu</strong></label>
                                <select class="form-control" name="condition">
                                    <option value="new">Sıfır</option>
                                    <option value="used">İkinci El</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3 mb-3">
                                <label><strong>Pazarlık</strong></label>
                                <select class="form-control" name="negotiable">
                                    <option value="0">Pazarlıksız</option>
                                    <option value="1">Pazarlığa Açık</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label><strong>Telefon Numarası</strong></label>
                                <input type="text" class="form-control" name="phone" placeholder="+90 5xx xxx xx xx">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label><strong>Şehir / Adres</strong></label>
                                <input type="text" class="form-control" name="address" placeholder="Örn: Denizli, Merkez">
                            </div>
                        </div>
                        
                        <div class="form-group col-md-6 mb-3">
                            <label><strong>Ülke ID (Örn: TR için --> 18)</strong></label>
                            <input type="number" class="form-control" name="country_id" value="18" placeholder="Varsayılan - Türkiye: 18">
                        </div>

                        {{-- ETİKETLER / TAGS --}}
                        @php $tags = \Modules\Blog\app\Models\Tag::where('status', 'publish')->get(); @endphp
                        <div class="form-group mb-3">
                            <label><strong>Etiketler / Tags</strong></label>
                            <div class="select-itms">
                                <select name="tags[]" id="tags" class="select2_activation" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                <small>Etiket seçin veya yeni etiket yazın (virgül/boşluk ile ayırın)</small>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3" style="width: 100%; font-size: 18px; padding: 15px;">
                            <i class="ti-rocket"></i> İlanı Yayına Al
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Dosya Sayısı Kontrolü --}}
<script>
    document.getElementById('imagesInput').addEventListener('change', function() {
        if (this.files.length > 6) {
            alert('Maksimum 6 adet görsel yükleyebilirsiniz!');
            this.value = ''; // Seçimi sıfırla
        }
    });
</script>
@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/bootstrap-tagsinput.js') }}"></script>
    <x-frontend.js.new-tag-add-js />
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $('#tags').select2();
            });
        })(jQuery);
    </script>
@endsection
