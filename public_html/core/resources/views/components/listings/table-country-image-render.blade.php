@if ($listing->country && $listing->country->country_code)
    <img
        src="https://flagcdn.com/h24/{{strtolower($listing->country->country_code)}}.png"
        srcset="https://flagcdn.com/h48/{{strtolower($listing->country->country_code)}}.png 2x"
        style="width: 36px; height: 24px; border-radius: 4px; object-position: center; object-fit: cover; overflow: hidden;"
        alt="{{$listing->country->country}}"
    />
@else
    -
@endif