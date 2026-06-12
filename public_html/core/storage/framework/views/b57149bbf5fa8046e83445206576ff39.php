<!--Daily Blog Part-->
<div class="daily-blog-part">
    <div class="container-1440">
        <div class="daily-blog-top-part">
            <h2 class="blog-heading"><?php echo e($title); ?></h2>
        </div>
        <div class="shorting-button-wraper">
            <div class="shorting-buttons global-slick-init slider-inner-margin sliderArrow" data-centerMode="false" data-variableWidth="true" data-rtl="<?php echo e(get_user_lang_direction() == 'rtl' ? 'true' : 'false'); ?>" data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="5" data-swipeToSlide="true" data-autoplay="false" data-autoplaySpeed="2500" data-prevArrow='<div class="prev-icon blog-preview"><i class="las la-angle-left"></i></div>'
                 data-nextArrow='<div class="next-icon blog-next"><i class="las la-angle-right"></i></div>' data-responsive='[{"breakpoint": 1400,"settings": {"slidesToShow": 5}},{"breakpoint": 1200,"settings": {"slidesToShow": 4}},{"breakpoint": 992,"settings": {"slidesToShow": 4}},{"breakpoint": 768, "settings": {"slidesToShow": 3}},{"breakpoint": 577, "settings": {"slidesToShow": 3}}, {"breakpoint": 510, "settings": {"slidesToShow": 2}}, {"breakpoint": 375, "settings": {"slidesToShow": 1}}]'>
                <div class="short-btn active" data-filter=".catagory"><?php echo e(__('All')); ?></div>
                <?php $__currentLoopData = $blog_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="short-btn" data-filter=".catagory<?php echo e($category->id); ?>"><?php echo e($category->name); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="devider"></div>
    <div class="blog-wraper">
        <div class="container-1440">
            <div class="row g-4 grid">
                <?php $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 catagory catagory<?php echo e($blog->category->id); ?>">
                        <div class="blog-card">
                            <a href="<?php echo e(route('frontend.blog.single', $blog->slug ?? 'x')); ?>">
                                <div class="img">
                                    <?php echo render_image_markup_by_attachment_id($blog->image,'','','thumb'); ?>

                                </div>
                            </a>
                            <div class="text-part">
                                <div class="date"><?php echo e(optional($blog->created_at)->diffForHumans()); ?></div>
                                <div class="title">
                                    <a href="<?php echo e(route('frontend.blog.single', $blog->slug ?? 'x')); ?>">
                                        <?php echo strlen($blog->title) > 55 ? substr($blog->title, 0, 55) . '...' : $blog->title; ?>

                                    </a>
                                </div>
                                <p class="pera">
                                    <?php echo strlen(strip_tags($blog->blog_content)) > 80 ? substr(strip_tags($blog->blog_content), 0, 80) . '...' : $blog->blog_content; ?>

                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php if (isset($component)) { $__componentOriginalbcd4445a5f614c7d25b965fb7d05eb57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbcd4445a5f614c7d25b965fb7d05eb57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.frontend-laravel-paginate','data' => ['alldata' => $all_blogs,'title' => __('No Blog Yet')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination.frontend-laravel-paginate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alldata' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_blogs),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('No Blog Yet'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbcd4445a5f614c7d25b965fb7d05eb57)): ?>
<?php $attributes = $__attributesOriginalbcd4445a5f614c7d25b965fb7d05eb57; ?>
<?php unset($__attributesOriginalbcd4445a5f614c7d25b965fb7d05eb57); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbcd4445a5f614c7d25b965fb7d05eb57)): ?>
<?php $component = $__componentOriginalbcd4445a5f614c7d25b965fb7d05eb57; ?>
<?php unset($__componentOriginalbcd4445a5f614c7d25b965fb7d05eb57); ?>
<?php endif; ?>


<?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/Modules/Blog/resources/views/addon-view/all-blog.blade.php ENDPATH**/ ?>