
<div class="row mb-24">
    <div class="col-sm-12">
        <nav aria-label="breadcrumb" class="frontend-breadcrumb-wrap">
            <h4 class="breadcrumb-contents-title"> {{ deepl_translate($title) }} </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">{{ deepl_translate(__('Home')) }}</a></li>
                <li class="breadcrumb-item"><a href="{{$routeName}}">{{ deepl_translate($innerTitle) }} </a></li>
                @if(isset($subInnerTitle) && $subInnerTitle)
                  <li class="breadcrumb-item"><a href="{{$subRouteName}}">{{ deepl_translate($subInnerTitle ?? '') }} </a></li>
                @endif
                @if(isset($chidInnerTitle) && !empty($chidInnerTitle))
                  <li class="breadcrumb-item"><a href="#">{{ deepl_translate($chidInnerTitle ?? '') }} </a></li>
                @endif
            </ol>
        </nav>
    </div>
</div>
