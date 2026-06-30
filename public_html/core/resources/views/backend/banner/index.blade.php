@extends('backend.admin-master')
@section('site-title')
    {{ __('Banner Yönetimi') }}
@endsection
@section('content')
    <div class="row g-4 mt-0">
        <div class="col-12">
            <div class="dashboard__card bg__white padding-20 radius-10 mb-2">
                <x-validation.error/>

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('danger') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="dashboard__inner__header">
                    <div class="dashboard__inner__header__flex">
                        <div class="dashboard__inner__header__left">
                            <h4 class="dashboard__inner__header__title">{{ __('Banner Yönetimi') }}</h4>
                        </div>
                        <div class="dashboard__inner__header__right">
                            <button type="button" class="cmnBtn btn_5 btn_bg_blue radius-5"
                                    data-bs-toggle="modal" data-bs-target="#addBannerModal">
                                <i class="las la-plus"></i> {{ __('Yeni Banner Ekle') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="tableStyle_three mt-4">
                    <div class="table_wrapper custom_Table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Görsel') }}</th>
                                    <th>{{ __('Başlık') }}</th>
                                    <th>{{ __('URL') }}</th>
                                     <th>{{ __('Konum') }}</th>
                                     <th>{{ __('Durum') }}</th>
                                     <th>{{ __('İşlemler') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset($banner->image) }}"
                                                 alt="{{ $banner->title ?? 'Banner' }}"
                                                 style="height: 60px; width: auto; max-width: 120px; object-fit: cover; border-radius: 4px; border: 1px solid #dee2e6;">
                                        </td>
                                        <td>{{ $banner->title ?? '—' }}</td>
                                        <td>
                                            @if($banner->url)
                                                <a href="{{ $banner->url }}" target="_blank" class="text-primary" style="word-break: break-all;">
                                                    {{ Str::limit($banner->url, 40) }}
                                                </a>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>{{ ['top_1' => 'Üst 1 (Sol)', 'top_2' => 'Üst 2 (Sağ)', 'bottom_1' => 'Alt 1 (Sol)', 'bottom_2' => 'Alt 2 (Sağ)'][$banner->position] ?? $banner->position }}</td>
                                        <td>
                                            <form action="{{ route('admin.banner.toggle', $banner->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit"
                                                        class="badge border-0 {{ $banner->is_active ? 'bg-success' : 'bg-secondary' }}"
                                                        style="cursor: pointer; font-size: 0.85rem; padding: 6px 12px;"
                                                        title="{{ $banner->is_active ? __('Aktif — Pasife almak için tıkla') : __('Pasif — Aktife almak için tıkla') }}">
                                                    {{ $banner->is_active ? __('Aktif') : __('Pasif') }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST" class="d-inline"
                                                  onsubmit="return confirm('{{ __('Bu banneri silmek istediğinizden emin misiniz?') }}')">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="las la-trash"></i> {{ __('Sil') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="las la-image" style="font-size: 2rem;"></i>
                                            <p class="mt-2">{{ __('Henüz banner eklenmemiş.') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Add Banner Modal --}}
    <div class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="addBannerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBannerModalLabel">
                        <i class="las la-image"></i> {{ __('Yeni Banner Ekle') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="banner_title" class="form-label fw-semibold">{{ __('Başlık') }} <span class="text-muted">({{ __('İsteğe bağlı') }})</span></label>
                            <input type="text" class="form-control" id="banner_title" name="title"
                                   placeholder="{{ __('Banner başlığı girin...') }}" value="{{ old('title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="banner_image" class="form-label fw-semibold">
                                {{ __('Görsel') }} <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" id="banner_image" name="image"
                                   accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/svg+xml" required>
                            <div class="form-text">{{ __('İzin verilen formatlar: JPG, PNG, GIF, WEBP, SVG. Maks. 5MB.') }}</div>
                            <div id="imagePreviewWrapper" class="mt-2" style="display:none;">
                                <img id="imagePreview" src="#" alt="Önizleme"
                                     style="max-height: 120px; border-radius: 6px; border: 1px solid #dee2e6;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="banner_url" class="form-label fw-semibold">{{ __('Yönlendirme URL') }} <span class="text-muted">({{ __('İsteğe bağlı') }})</span></label>
                            <input type="url" class="form-control" id="banner_url" name="url"
                                   placeholder="https://example.com" value="{{ old('url') }}">
                        </div>
                        <div class="mb-3">
                            <label for="banner_position" class="form-label fw-semibold">{{ __('Konum') }}</label>
                            <select class="form-select" id="banner_position" name="position">
                                <option value="top_1" {{ old('position') === 'top_1' || old('position') === null ? 'selected' : '' }}>{{ __('Üst 1 (Sol)') }}</option>
                                <option value="top_2" {{ old('position') === 'top_2' ? 'selected' : '' }}>{{ __('Üst 2 (Sağ)') }}</option>
                                <option value="bottom_1" {{ old('position') === 'bottom_1' ? 'selected' : '' }}>{{ __('Alt 1 (Sol)') }}</option>
                                <option value="bottom_2" {{ old('position') === 'bottom_2' ? 'selected' : '' }}>{{ __('Alt 2 (Sağ)') }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="banner_is_active"
                                       name="is_active" value="1" checked>
                                <label class="form-check-label fw-semibold" for="banner_is_active">
                                    {{ __('Aktif olarak yayınla') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('İptal') }}</button>
                        <button type="submit" class="cmnBtn btn_5 btn_bg_blue radius-5">
                            <i class="las la-save"></i> {{ __('Kaydet') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function () {
            "use strict";
            // Image preview on file select
            document.getElementById('banner_image').addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('imagePreview').src = e.target.result;
                        document.getElementById('imagePreviewWrapper').style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Re-open modal with validation errors
            @if($errors->any())
                var addBannerModal = new bootstrap.Modal(document.getElementById('addBannerModal'));
                addBannerModal.show();
            @endif
        })();
    </script>
@endsection
