@extends('backend.admin-master')
@section('site-title')
    {{ __('Tık Takip Raporu') }}
@endsection
@section('content')
    <div class="dashboard__body posPadding">
        <div class="dashboard__inner">
            <div class="dashboard__inner__item">
                <div class="dashboard__inner__item__flex">
                    <div class="dashboard__inner__item__left bodyItemPadding">
                        <div class="dashboard__inner__header">
                            <div class="dashboard__inner__header__flex">
                                <div class="dashboard__inner__header__left">
                                    <h4 class="dashboard__inner__header__title">{{ __('Tık Takip Raporu') }}</h4>
                                    <p class="dashboard__inner__header__para">{{ __('İlan görüntülenme ve banner tıklanma istatistikleri') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mt-0">
                            <div class="col-12">
                                <div class="dashboard__card bg__white padding-20 radius-10">
                                    <div class="dashboard__card__header">
                                        <h5 class="dashboard__card__header__title">{{ __('İlan Görüntülenme Raporu') }}</h5>
                                    </div>
                                    <div class="dashboard__card__inner border_top_1">
                                        <div class="dashboard__inventory__table custom_table">
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>{{ __('ID') }}</th>
                                                    <th>{{ __('İlan Başlığı') }}</th>
                                                    <th>{{ __('Sahibi') }}</th>
                                                    <th>{{ __('Görüntülenme') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($listings as $listing)
                                                    <tr class="table_row">
                                                        <td><span class="order_id">{{ $listing->id }}</span></td>
                                                        <td>
                                                            <a href="{{ route('admin.listings.updateRead', $listing->id) }}">
                                                                {{ Str::limit($listing->title, 50) }}
                                                            </a>
                                                        </td>
                                                        <td>{{ optional($listing->user)->fullname ?? optional($listing->listing_creator)->fullname ?? __('Admin') }}</td>
                                                        <td><span class="badge bg-info">{{ $listing->view }}</span></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center text-muted py-4">
                                                            <i class="las la-chart-bar" style="font-size: 2rem;"></i>
                                                            <p class="mt-2">{{ __('Henüz hiçbir ilan görüntülenme verisi bulunmamaktadır.') }}</p>
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

                        <div class="row g-4 mt-1">
                            <div class="col-12">
                                <div class="dashboard__card bg__white padding-20 radius-10">
                                    <div class="dashboard__card__header">
                                        <h5 class="dashboard__card__header__title">{{ __('Banner Tıklanma Raporu') }}</h5>
                                    </div>
                                    <div class="dashboard__card__inner border_top_1">
                                        <div class="dashboard__inventory__table custom_table">
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>{{ __('ID') }}</th>
                                                    <th>{{ __('Banner Adı / Alanı') }}</th>
                                                    <th>{{ __('Tıklanma') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($banners as $banner)
                                                    <tr class="table_row">
                                                        <td><span class="order_id">{{ $banner->id }}</span></td>
                                                        <td>{{ $banner->title ?: __('Alan:') . ' ' . str_replace('_', ' ', $banner->position) }}</td>
                                                        <td><span class="badge bg-info">{{ $banner->click_count }}</span></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted py-4">
                                                            <i class="las la-chart-bar" style="font-size: 2rem;"></i>
                                                            <p class="mt-2">{{ __('Henüz hiçbir banner tıklanma verisi bulunmamaktadır.') }}</p>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection