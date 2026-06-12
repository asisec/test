<body>
    <!-- Masaüstü Banner'ları -->
    <div class="desktop-banner-container">
        <a href="https://korkusuzsoft.com/" target="_blank">
            <img src="https://textileforum.net/banner-resimleri/ana-sayfa/masaustu/1.gif" alt="Sol Desktop Banner">
        </a>
        <a href="https://example.com/sag" target="_blank">
            <img src="https://textileforum.net/banner-resimleri/ana-sayfa/masaustu/2.gif" alt="Sağ Desktop Banner">
        </a>
    </div>

    <!-- Mobil Banner'ları -->
    <div class="mobile-banner-container">
        <a href="https://korkusuzgames.com/" target="_blank">
            <img src="https://textileforum.net/banner-resimleri/ana-sayfa/mobil/1.gif" alt="Sol Mobile Banner">
        </a>
        <a href="https://example.com/sag" target="_blank">
            <img src="https://textileforum.net/banner-resimleri/ana-sayfa/mobil/2.gif" alt="Sağ Mobile Banner">
        </a>
    </div>
</body>

<?php $__env->startSection('style'); ?>
    <style>
        .home-category-wrapper {
            background: #FFFFFF;;
            padding-top: 24px;
            padding-bottom: 24px;
        }

        .home-category-tabs {
            display: flex !important;
            overflow-x: auto;
            overflow-y: hidden;
            height: fit-content;
            gap: 6px;
            background-color: #000A14;
            padding: 12px;
            border-radius: 8px;
            flex-wrap: nowrap;
            overflow-x: auto;
            white-space: nowrap;
            scrollbar-width: none;
        }

        .home-category-tabs::-webkit-scrollbar {
            display: none;
        }

        .home-category-tabs li > button {
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 8px 16px;
            background-color: transparent;
            border: none;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            color: #B4D6FE;
            border-radius: 6px;
            overflow: hidden;
            text-wrap: nowrap;
            max-width: min(50vw, 200px) !important;
            width: fit-content;
            
        }

        .home-category-tabs li > button span {
            width: 100%;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .home-category-tabs li > button.active {
            background-color: #B2D4FF;
            color: #000A14;
        }

        .home-category-tab-content {
            background-color: #D7E9FE;
            border: 1px solid #C3DEFE;
            overflow: hidden;
            border-radius: 8px;
            padding: 0px;
            margin: 0px;
        }

        .home-category-tab-content .tab-pane {
            overflow: hidden;
        }

        .home-category-tab-content .tab-pane .row {
            color: #000A14;
            padding: 0 20px;
            overflow: hidden;
            margin: 0px;
            font-size: 14px;
        }

        .home-category-tab-content .tab-pane .row a {
            font-weight: 500;
        }

        .home-category-show-more-btn {
            background-color: #A5CEFE;
            padding: 10px 14px;
            color: #000A14;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            box-sizing: border-box;
        }

        .home-category-show-more-btn:hover,
        .home-category-show-more-btn:focus,
        .home-category-show-more-btn:active
        {
            background-color: #FFFFFF !important;
            color: #000A14 !important;
        }

        .home-category-tab-content .table-header {
            font-size: 14px !important;
            font-weight: 600;
            color: #000A14 !important;
            opacity: 0.5;
        }

        .no-row-margin-paddig-x {
            padding-left: 0px;
            padding-right: 0px;
            margin-left: 0px;
            margin-right: 0px;
        }

        .home-category-listing-item a {
            color: #000A14 !important;
        }
        
        .home-category-listing-item a:hover {
            text-decoration: underline;
            color: var(--main-color-one) !important;
        }
        
        .home-category-listing-item {
            border-bottom: 1px solid #c6daf5 !important;
        }
        .home-category-listing-item.last {
            border-bottom: 1px solid transparent !important;
        }

        .l-title {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* number of lines to show */
                    line-clamp: 2; 
            -webkit-box-orient: vertical;
            color: #000A14 !important;
        }

        .l-title:hover {
            text-decoration: underline;
            color: var(--main-color-one) !important;
        }

        .s-m-wrapper {
            margin-top: 10px;
            height: 40px;
        }

        @media screen and (max-width: 767px) {
            .hide-mobile {
                display: none;
            }
            
            .home-category-tab-content .tab-pane .row:not(:has(a.home-category-show-more-btn)) {
                padding: 10px 0 !important;
            }

            .home-category-tab-content .tab-pane {
                height: fit-content;;
            }

            .tab-pane-content {
                height: 60svh;
                overflow-y: auto;
            }
        }

        @media screen and (min-width: 768px) {
            .home-category-tabs {
                padding: 14px 20px;
                flex-wrap: auto;
            }

            .home-category-show-more-btn {
                font-size: 14px;
            }

            .no-padding-for-container {
                padding-left: 0px;
                padding-right: 0px;
            }

            .no-row-margin-paddig-x {
                padding-left: inherit;
                padding-right: inherit;
                margin-left: inherit;
                margin-right: inherit;
            }

            .tab-pane-content {
                height: 444px;
                overflow-y: auto;
            }
        }

        .tab-pane-content {
            --sb-track-color: #d7e9fe;
            --sb-thumb-color: #000a14;
            --sb-size: 12px;
        }

        .tab-pane-content::-webkit-scrollbar {
         width: var(--sb-size);
        }

        .tab-pane-content::-webkit-scrollbar-track {
            background: var(--sb-track-color);
            border-radius: 25px;
        }

        .tab-pane-content::-webkit-scrollbar-thumb {
            background: var(--sb-thumb-color);
            border-radius: 25px;
            border: 2px solid #ffffff;
        }

        @supports not selector(::-webkit-scrollbar) {
            .tab-pane-content {
                scrollbar-color: var(--sb-thumb-color)
                                var(--sb-track-color);
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<div class="home-category-wrapper plr">
    <div class="container-1920">
        <div class="container-1440 no-padding-for-container" style="margin-bottom: 8px;">
            <div class="row no-row-margin-paddig-x">
                <ul class="nav nav-pills home-category-tabs" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="active" id="home-category-latest-tab" data-bs-toggle="pill" data-bs-target="#home-category-latest-content" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                            <span><?php echo e(__('Latest listing')); ?></span>
                        </button>
                    </li>

                    <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item" role="presentation">
                            <button class="" id="home-category-<?php echo e($category->id ?? 0); ?>-tab" data-bs-toggle="pill" data-bs-target="#home-category-<?php echo e($category->id ?? 0); ?>-content" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                                <span><?php echo e(__($category->name ?? '')); ?></span>
                            </button>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>

        <div class="container-1440 no-padding-for-container">
            <div class="row no-row-margin-paddig-x">
                <div class="tab-content home-category-tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="home-category-latest-content" role="tabpanel" aria-labelledby="home-category-latest-tab">
                        <!-- Header -->
                        <div class="row table-header py-2 mt-1 hide-mobile">
                            <div class="col-6"><?php echo e(__('Listing Title')); ?></div>
                            <div class="col-2 text-center"><?php echo e(__('Country')); ?></div>
                            <div class="col-2 text-center"><?php echo e(__('Owner')); ?></div>
                            <div class="col-2 text-end"><?php echo e(__('Category')); ?></div>
                        </div>

                        <!-- Row 1 -->
                        <div class="tab-pane-content" style="height: 494px;">
                            <?php $__currentLoopData = $latest_listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row py-2 home-category-listing-item <?php echo e($loop->last ? 'last' : ''); ?>">
                                    <div class="col-12 col-md-6">
                                        <a href="/listing/<?php echo e($listing->slug); ?>" class="l-title">
                                            <?php echo e($listing->title); ?>

                                        </a>
                                    </div>
                                    <div class="col-2 text-center hide-mobile">
                                        <?php if (isset($component)) { $__componentOriginal1eaa59d7b76cfce7b1225e2ef9700337 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1eaa59d7b76cfce7b1225e2ef9700337 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.listings.table-country-image-render','data' => ['listing' => $listing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listings.table-country-image-render'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['listing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1eaa59d7b76cfce7b1225e2ef9700337)): ?>
<?php $attributes = $__attributesOriginal1eaa59d7b76cfce7b1225e2ef9700337; ?>
<?php unset($__attributesOriginal1eaa59d7b76cfce7b1225e2ef9700337); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1eaa59d7b76cfce7b1225e2ef9700337)): ?>
<?php $component = $__componentOriginal1eaa59d7b76cfce7b1225e2ef9700337; ?>
<?php unset($__componentOriginal1eaa59d7b76cfce7b1225e2ef9700337); ?>
<?php endif; ?>
                                    </div>
                                    <div class="col-2 text-center hide-mobile">
                                        <?php if($listing->user): ?>
                                            <a href="/profile/<?php echo e($listing->user->username); ?>">
                                                <?php echo e($listing->user->first_name); ?> <?php echo e($listing->user->last_name); ?>

                                            </a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-2 text-end text-muted hide-mobile">
                                        <?php if($listing->category): ?>
                                            <a href="/listing/category/<?php echo e($listing->category->slug); ?>">
                                                <?php echo e($listing->category->name); ?>

                                            </a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-pane fade show" id="home-category-<?php echo e($category->id ?? 0); ?>-content" role="tabpanel" aria-labelledby="home-category-<?php echo e($category->id ?? 0); ?>-tab">
                            <!-- Header -->
                            <div class="row table-header py-2 mt-1 hide-mobile">
                                <div class="col-6"><?php echo e(__('Listing Title')); ?></div>
                                <div class="col-2 text-center"><?php echo e(__('Country')); ?></div>
                                <div class="col-2 text-center"><?php echo e(__('Owner')); ?></div>
                                <div class="col-2 text-end"><?php echo e(__('Category')); ?></div>
                            </div>

                            <!-- Row 1 -->
                            <div class="tab-pane-content">
                                <?php $__currentLoopData = $category->listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row py-2 home-category-listing-item <?php echo e($loop->last ? 'last' : ''); ?>">
                                        <div class="col-12 col-md-6">
                                            <a href="/listing/<?php echo e($listing->slug); ?>" class="l-title">
                                                <?php echo e($listing->title); ?>

                                            </a>
                                        </div>
                                        <div class="col-2 text-center hide-mobile">
                                            <?php if (isset($component)) { $__componentOriginal1eaa59d7b76cfce7b1225e2ef9700337 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1eaa59d7b76cfce7b1225e2ef9700337 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.listings.table-country-image-render','data' => ['listing' => $listing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listings.table-country-image-render'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['listing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1eaa59d7b76cfce7b1225e2ef9700337)): ?>
<?php $attributes = $__attributesOriginal1eaa59d7b76cfce7b1225e2ef9700337; ?>
<?php unset($__attributesOriginal1eaa59d7b76cfce7b1225e2ef9700337); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1eaa59d7b76cfce7b1225e2ef9700337)): ?>
<?php $component = $__componentOriginal1eaa59d7b76cfce7b1225e2ef9700337; ?>
<?php unset($__componentOriginal1eaa59d7b76cfce7b1225e2ef9700337); ?>
<?php endif; ?>
                                        </div>
                                        <div class="col-2 text-center hide-mobile">
                                            <?php if($listing->user): ?>
                                                <a href="/profile/<?php echo e($listing->user->username); ?>">
                                                    <?php echo e($listing->user->first_name); ?> <?php echo e($listing->user->last_name); ?>

                                                </a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-2 text-end text-muted hide-mobile">
                                            <?php if($listing->category): ?>
                                                <a href="/listing/category/<?php echo e($listing->category->slug); ?>">
                                                    <?php echo e($listing->category->name); ?>

                                                </a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <!-- Show More -->
                            <div class="s-m-wrapper">
                                <?php if($category->show_more): ?>
                                    <div class="row b-0 px-0">
                                        <a href="/listing/category/<?php echo e($category->slug); ?>" class="col-12 text-center home-category-show-more-btn"><?php echo e(__('Show More')); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function () {
    $('.home-category-tabs button').on('click', function () {
        var $navItem = $(this).parent();
        var $navList = $navItem.parent();

        var navListPadding = 12;
        var navListWidth = $navList.outerWidth();
        var navListScrollWidth = $navList[0].scrollWidth; 
        var navItemOffset = $navItem.position().left;
        var navItemWidth = $navItem.outerWidth();

        var scrollLeft;

        scrollLeft = $navList.scrollLeft() + navItemOffset - (navListWidth / 2) + (navItemWidth / 2);

        scrollLeft = Math.max(0, Math.min(scrollLeft, navListScrollWidth - navListWidth));

        $navList.animate({
            scrollLeft: scrollLeft
        }, 300, 'swing'); 
    });
});
</script>
<?php $__env->stopSection(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Banner Yapısı</title>
    <style>
        body {
            background-color: #FFFFFF;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .desktop-banner-container, .mobile-banner-container {
            display: none;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 5px;
        }

        .desktop-banner-container img, .mobile-banner-container img {
            border-radius: 3px;
        }

        /* Masaüstü için görünüm */
        @media (min-width: 1024px) {
            .desktop-banner-container {
                display: flex;
            }

            .desktop-banner-container img {
                width: 728px;
                height: 90px;
            }
        }

        /* Mobil için görünüm */
        @media (max-width: 1023px) {
            .mobile-banner-container {
                display: flex;
                flex-direction: column;
            }

            .mobile-banner-container img {
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Masaüstü Banner'ları -->
    <div class="desktop-banner-container">
        <a href="https://example.com/sol" target="_blank">
            <img src="https://textileforum.net/banner-resimleri/ana-sayfa/masaustu/3.gif" alt="Sol Desktop Banner">
        </a>
        <a href="https://example.com/sag" target="_blank">
            <img src="https://textileforum.net/banner-resimleri/ana-sayfa/masaustu/4.gif" alt="Sağ Desktop Banner">
        </a>
    </div>

    <!-- Mobil Banner'ları -->
    <div class="mobile-banner-container">
        <a href="https://example.com/sol" target="_blank">
            <img src="https://textileforum.net/banner-resimleri/ana-sayfa/mobil/3.gif" alt="Sol Mobile Banner">
        </a>
        <a href="https://example.com/sag" target="_blank">
            <img src="https://textileforum.net/banner-resimleri/ana-sayfa/mobil/4.gif" alt="Sağ Mobile Banner">
        </a>
    </div>
</body>
</html><?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/app/Providers/../../plugins/PageBuilder/views/headers/style-one.blade.php ENDPATH**/ ?>