<?php $__env->startSection('site-title'); ?>
    <?php if($subcategory !=''): ?>
        <?php echo e($subcategory->name); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php if($subcategory !=''): ?>
        <?php echo e($subcategory->name); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inner-title'); ?>
    <?php if($subcategory !=''): ?>
        <?php echo e($subcategory->name); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_page_meta_data_for_subcategory($subcategory); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="catagory-wise-listing section-padding2">
        <div class="container-1440">
            <?php if (isset($component)) { $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb','data' => ['title' => '','innerTitle' => $subcategory->category?->name,'subInnerTitle' => $subcategory->name,'chidInnerTitle' => '','routeName' => route('frontend.show.listing.by.category', $subcategory->category?->slug ?? 'x'),'subRouteName' => '#']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subcategory->category?->name),'subInnerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subcategory->name),'chidInnerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'routeName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('frontend.show.listing.by.category', $subcategory->category?->slug ?? 'x')),'subRouteName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('#')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $attributes = $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $component = $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginalc04996af13f0d779852114b39ea43e16 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04996af13f0d779852114b39ea43e16 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation.frontend-error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('validation.frontend-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04996af13f0d779852114b39ea43e16)): ?>
<?php $attributes = $__attributesOriginalc04996af13f0d779852114b39ea43e16; ?>
<?php unset($__attributesOriginalc04996af13f0d779852114b39ea43e16); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04996af13f0d779852114b39ea43e16)): ?>
<?php $component = $__componentOriginalc04996af13f0d779852114b39ea43e16; ?>
<?php unset($__componentOriginalc04996af13f0d779852114b39ea43e16); ?>
<?php endif; ?>

            <?php if(!is_null($subcategory->description)): ?>
            <div class="row g-4 mt-4">
                <div class="col-12">
                    <div class="category_info_new mb-5 mt-2">
                        <?php echo $subcategory->description; ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>

            <h3 class="catagory-wise-title"><?php echo e(sprintf(__('Available Listing Sub Categories in :subcategory', ['subcategory' => $subcategory->name]))); ?></h3>
            <div class="catagory-wise-list-wraper exploreCategories">
                <div id="services_sub_category_load_wrap">
                    <div class="services_sub_category_load_wraper mt-4">
                        <?php if($child_category_under_category->count() != 0): ?>
                            <?php $__currentLoopData = $child_category_under_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="singleCategories categories1 wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="categoriIcon text-center">
                                                <a href="<?php echo e(route('frontend.show.listing.by.child.category', $child_cat->slug ?? 'x')); ?>">
                                                       <?php echo render_image_markup_by_attachment_id($child_cat->image); ?>

                                                </a>
                                            </div>
                                            <div class="categorie-text">
                                                <h4 class="text-center">
                                                    <a href="<?php echo e(route('frontend.show.listing.by.child.category', $child_cat->slug ?? 'x')); ?>" class="title oneLine mt-2">
                                                    <?php echo e($child_cat->name); ?>

                                                    </a>
                                                </h4>
                                                <p> <?php echo e(__('Listing :total_listings', ['total_listings' => $child_cat->total_listings ?? 0])); ?></p>
                                            </div>
                                    </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <span><?php echo e(__('No Category Yet')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="load-more-button">
                        <?php if($child_category_under_category->count() >20): ?>
                            <div class="load_more_button_warp">
                                <a href="#" id="load_more_btn" data-total="20" class="new-cmn-btn rounded-red-btn"><?php echo e(__('Load More')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="featureListing mb-5 mt-5">
                        <div class="container-1440">
                            <div class="titleWithBtn d-flex justify-content-between align-items-center mb-40">
                                <h3 class="catagory-wise-title"><?php echo e(sprintf(__('Available Listings in %s'), $subcategory->name)); ?></h3>
                                <form id="filter_with_listing_page_subcategory" action="<?php echo e(url('/') .'/'. get_static_option('listing_filter_page_url') ?? url('/listings')); ?>" method="get">
                                    <input type="hidden" name="cat" value="<?php echo e($subcategory->category_id); ?>"/>
                                    <input type="hidden" name="subcat" value="<?php echo e($subcategory->id); ?>"/>
                                    <a href="#" id="submit_form_listing_filter_subcategory" class="see-all"><?php echo e(__('See All')); ?><i class="las la-angle-right"></i></a>
                                </form>
                            </div>
                            <div class="slider-inner-margin">
                                <?php if (isset($component)) { $__componentOriginal5d6be7b7c18d78de17591c73d7917c83 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d6be7b7c18d78de17591c73d7917c83 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.listings.listing-single','data' => ['listings' => $all_listings]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listings.listing-single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['listings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_listings)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5d6be7b7c18d78de17591c73d7917c83)): ?>
<?php $attributes = $__attributesOriginal5d6be7b7c18d78de17591c73d7917c83; ?>
<?php unset($__attributesOriginal5d6be7b7c18d78de17591c73d7917c83); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5d6be7b7c18d78de17591c73d7917c83)): ?>
<?php $component = $__componentOriginal5d6be7b7c18d78de17591c73d7917c83; ?>
<?php unset($__componentOriginal5d6be7b7c18d78de17591c73d7917c83); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

         </div>
     </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        (function($){
            "use strict";

            $(document).on('click','#load_more_btn',function(e){
                e.preventDefault();

                let totalNo = $(this).data('total');
                let el = $(this);
                let container = $('#services_sub_category_load_wrap > .row');

                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('frontend.listing.load.more.subcategories')); ?>",
                    beforeSend: function(e){
                        el.text("<?php echo e(__('loading...')); ?>")
                    },
                    data : {
                        _token: "<?php echo e(csrf_token()); ?>",
                        total: totalNo,
                        catId: "<?php echo e($subcategory->id); ?>"
                    },
                    success: function(data){

                        el.text("<?php echo e(__('Load More')); ?>");
                        if(data.markup === ''){
                            el.hide();
                            container.append("<div class='col-lg-12'><div class='text-center text-warning mt-3'><?php echo e(__('no more subcategory found')); ?></div></div>");
                            return;
                        }

                        $('#load_more_btn').data('total',data.total);

                        container.append(data.markup);
                    }
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/frontend/pages/listings/category/sub-category-wise-listings.blade.php ENDPATH**/ ?>