{{-- <div class="seller-phone text-center">
    <p>{{ __('Phone') }}</p>
    <span type="text" id="default_phone_number_show" class="number">{{ __('+880 XXX XXX XX') }}</span>
    @if($listing->phone_hidden === 0)
         <div class="number" id="phoneNumber">{{ $listing->phone }}</div>
        <a href="#" class="show-number" id="userPhoneNumberBtn">{{ get_static_option('listing_show_phone_number_title') ?? __('Show Number') }}</a>
    @endif
</div> --}}
<div class="seller-phone text-center">
    <p>{{ __('Phone') }}</p>

    <span type="text" id="default_phone_number_show" class="number">
        @if($listing->phone_hidden === 1 || $listing->phone_shows_only_premium === 1)
            {{ $maskedPhoneNumber }}
        @else
            {{ $listing->phone }}
        @endif
    </span>

    @if($listing->phone_shows_only_premium === 1)
        @if($userHasMembership === true)
            <div class="number" id="phoneNumber" style="display:none;">{{ $listing->phone }}</div>
            <a href="javascript:void(0)" class="show-number" id="userPhoneNumberBtn">{{ get_static_option('listing_show_phone_number_title') ?? __('Show Number') }}</a>
        @else
            @include('frontend.pages.listings.listing-premium-required-modal')
            <a href="javascript:void(0)" class="show-number" data-bs-toggle="modal" data-bs-target="#premiumRequiredModal">{{ get_static_option('listing_show_phone_number_title') ?? __('Show Number') }}</a>
        @endif
    @elseif($listing->phone_hidden === 1)
        <div class="number" id="phoneNumber" style="display:none;">{{ $listing->phone }}</div>
        <a href="javascript:void(0)" class="show-number" id="userPhoneNumberBtn">{{ get_static_option('listing_show_phone_number_title') ?? __('Show Number') }}</a>
    @endif
</div>
