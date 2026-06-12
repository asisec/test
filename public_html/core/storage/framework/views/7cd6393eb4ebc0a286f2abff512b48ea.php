<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Listing Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa)): ?>
<?php $attributes = $__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa; ?>
<?php unset($__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa)): ?>
<?php $component = $__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa; ?>
<?php unset($__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa); ?>
<?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <?php if (isset($component)) { $__componentOriginaldfdc73ee107e48d175ea9d298bebd7fa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldfdc73ee107e48d175ea9d298bebd7fa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('summernote.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldfdc73ee107e48d175ea9d298bebd7fa)): ?>
<?php $attributes = $__attributesOriginaldfdc73ee107e48d175ea9d298bebd7fa; ?>
<?php unset($__attributesOriginaldfdc73ee107e48d175ea9d298bebd7fa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldfdc73ee107e48d175ea9d298bebd7fa)): ?>
<?php $component = $__componentOriginaldfdc73ee107e48d175ea9d298bebd7fa; ?>
<?php unset($__componentOriginaldfdc73ee107e48d175ea9d298bebd7fa); ?>
<?php endif; ?>
    <style>
        /* Description container */
        .list-desc h1, h2, h3, h4, h5, h6, a, span, p small, strong {
            max-width: 100%;
            font-size: 16px!important;
            line-height: 1.6!important;
        }

        span {
            display: inline;
        }
        .dashboard__rates__card__thumb {
            gap: 6px;
            margin: 5px;
            padding: 7px;
            display: flex;
            flex-wrap: wrap;
        }

        .effectBorder {
            pointer-events: none; /* Disable interactions */
            cursor: not-allowed; /* Indicate non-interactivity */
        }
        .customer__account__details__item__flex {
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: flex-start;
        }

        .seller-img {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            overflow: hidden;
            border: 1px solid #ddd;
            position: relative;
        }

        .seller-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row g-4 mt-0">
        <div class="col-xl-12 col-lg-12 mt-0">
            <div class="dashboard__card bg__white padding-20 radius-10">
                <div class="header-wrap d-flex justify-content-between">
                    <div class="left-content">
                        <h4 class="header-title"><?php echo e(__('Listing Details')); ?>   </h4>
                    </div>
                    <div class="right-content">
                        <a class="cmnBtn btn_5 btn_bg_info radius-5" href="<?php echo e(route('admin.user.all.listings')); ?>"><?php echo e(__('All Listings')); ?></a>
                    </div>
                </div>
                <?php if (isset($component)) { $__componentOriginal4bb59b834d778ff0cb72af5a473e2885 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('validation.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $attributes = $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $component = $__componentOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
                <div class="product__details__single">
                    <div class="editProduct">
                        <div class="row g-4">
                            <div class="col-xxl-3 col-lg-4">
                                <div class="editProduct__contents__category mb-2">
                                    <strong class="editProduct__contents__sku__para"><?php echo e(__('Thumb Image:')); ?></strong>
                                </div>
                                <div class="editProduct__thumb">
                                    <div class="editProduct__thumb__main">
                                        <?php echo render_image_markup_by_attachment_id($listing->image, '', 'thumb'); ?>

                                    </div>
                                </div>
                                <div class="editProduct__contents__category mt-3">
                                    <strong class="editProduct__contents__sku__para"><?php echo e(__('Gallery Images:')); ?></strong>
                                </div>
                                <div class="dashboard__rates__card__thumb">
                                    <?php echo render_gallery_image_attachment_preview($listing->gallery_images ?? ''); ?>

                                </div>

                                 <div class="customer__details__author__item__header mt-3">
                                    <div class="customer__details__author__item__header__flex">
                                        <div class="customer__details__author__item__header__left">
                                            <h4 class="customer__details__author__item__title">
                                                <?php if($listing->user_id != null && $listing->user_id != 0): ?>
                                                    <?php echo e(__('User Info:')); ?>

                                                <?php elseif($listing->user_id === 0): ?>
                                                    <?php echo e(__('Guest Info:')); ?>

                                                <?php else: ?>
                                                    <?php echo e(__('Admin Info:')); ?>

                                                <?php endif; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="customer__details__author__item__inner border_top_1 top_15">
                                    <div class="customer__account__details">
                                        <?php if($listing->user_id != null && $listing->user_id != 0): ?>
                                            <!-- User Info -->
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <a href="<?php echo e(route('about.user.profile', optional($listing->user)->username)); ?>" target="_blank">
                                                        <div class="customer__details__author__thumb">
                                                            <div class="seller-img">
                                                               <?php echo render_image_markup_by_attachment_id($listing->user->image ?? '/assets/uploads/no-image.png', '', 'thumb'); ?>

                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <strong><?php echo e(__('Name')); ?></strong>
                                                    <a href="<?php echo e(route('about.user.profile', optional($listing->user)->username)); ?>" target="_blank">
                                                    <span><?php echo e(optional($listing->user)->fullname); ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <strong><?php echo e(__('Email')); ?></strong>
                                                    <span><?php echo e(optional($listing->user)->email); ?></span>
                                                </div>
                                            </div>
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <strong><?php echo e(__('Phone')); ?></strong>
                                                    <span><?php echo e(optional($listing->user)->phone); ?></span>
                                                </div>
                                            </div>

                                        <?php elseif($listing->user_id === 0): ?>
                                            <!-- Guest Info -->
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <div class="customer__details__author__thumb">
                                                      <img src="<?php echo e(asset('assets/frontend/img/static/user-no-image.webp')); ?>" alt="No Image">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <strong><?php echo e(__('Name')); ?></strong>
                                                    <span><?php echo e(optional($listing->guestListing)->guestfullname); ?></span>
                                                </div>
                                            </div>
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <strong><?php echo e(__('Email')); ?></strong>
                                                    <span><?php echo e(optional($listing->guestListing)->email); ?></span>
                                                </div>
                                            </div>
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <strong><?php echo e(__('Phone')); ?></strong>
                                                    <span><?php echo e(optional($listing->guestListing)->phone); ?></span>
                                                </div>
                                            </div>

                                        <?php else: ?>
                                        <!-- Admin Info -->
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <strong></strong>
                                                    <a href="<?php echo e(route('about.user.profile', optional($listing->admin)->username)); ?>" target="_blank">
                                                        <div class="customer__details__author__thumb">
                                                            <?php echo render_image_markup_by_attachment_id($listing->admin->image, '', 'thumb'); ?>

                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <strong><?php echo e(__('Name')); ?></strong>
                                                    <a href="<?php echo e(route('about.user.profile', optional($listing->admin)->username)); ?>" target="_blank">
                                                        <span><?php echo e(optional($listing->admin)->name); ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <strong><?php echo e(__('Email')); ?></strong>
                                                    <span><?php echo e(optional($listing->admin)->email); ?></span>
                                                </div>
                                            </div>
                                            <div class="customer__account__details__item">
                                                <div class="customer__account__details__item__flex">
                                                    <strong><?php echo e(__('Phone')); ?></strong>
                                                    <span><?php echo e(optional($listing->admin)->phone); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!--step two -->
                            <div class="col-xxl-4 col-lg-4">
                                <div class="editProduct__contents">
                                    <form action="<?php echo e(route('admin.listings.updateRead', ['id' => $listing->id])); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input name="phone_shows_only_premium" value="<?php echo e(+!$listing->phone_shows_only_premium); ?>" hidden>
                                    
                                        <button class="btn btn-primary btn-md" id="bulk_delete_btn">
                                            <b><?php if($listing->phone_shows_only_premium === 1): ?> <?php echo e(__('Show')); ?> <?php else: ?> <?php echo e(__('Hide')); ?> <?php endif; ?></b> <?php echo e(__('Phone Number To Non-Premium Users')); ?>

                                        </button>
                                    </form>
                                    <div class="editProduct__contents__category mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Item Name:')); ?></strong> <?php echo e($listing->title); ?></span>
                                    </div>
                                    <div class="editProduct__contents__category mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Price:')); ?></strong> <?php echo e(float_amount_with_currency_symbol($listing->price)); ?></span>
                                    </div>
                                    <div class="editProduct__contents__category mt-3">
                                           <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Negotiable:')); ?></strong></span>
                                           <input class="effectBorder" type="checkbox" <?php if(!empty($listing->negotiable)): ?> checked <?php endif; ?>>
                                           <span class="checkmark"></span>
                                    </div>
                                    <div class="editProduct__contents__category mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Category:')); ?></strong> <?php echo e(optional($listing->category)->name); ?></span>
                                    </div>
                                    <div class="editProduct__contents__category mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Sub Category:')); ?></strong> <?php echo e(optional($listing->subcategory)->name); ?></span>
                                    </div>
                                    <div class="editProduct__contents__category mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Child Category:')); ?></strong> <?php echo e(optional($listing->childcategory)->name); ?></span>
                                    </div>
                                    <div class="editProduct__contents__brand mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Brand:')); ?></strong> <?php echo e(optional($listing->brand)->title); ?></span>
                                    </div>
                                    <div class="editProduct__contents__brand mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Condition:')); ?></strong> <?php echo e($listing->condition); ?></span>
                                    </div>
                                    <div class="editProduct__contents__brand mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Authenticity:')); ?></strong> <?php echo e($listing->authenticity); ?></span>
                                    </div>

                                    <div class="editProduct__contents__brand mt-3">
                                        <div class="editProduct__contents__sku__para d-flex gap-2">
                                            <strong><?php echo e(__('Country:')); ?></strong>
                                            <div class="d-flex align-items-center gap-2">
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
                                                <span><?php echo e($listing->country->country ?? '-'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="editProduct__contents__brand mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Phone:')); ?></strong> <?php echo e($listing->phone); ?></span>
                                    </div>
                                    <div class="editProduct__contents__category mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Hide Phone Number:')); ?></strong></span>
                                        <input class="effectBorder" type="checkbox" <?php if(!empty($listing->phone_hidden)): ?> checked <?php endif; ?>>
                                        <span class="checkmark"></span>
                                    </div>

                                    <div class="editProduct__contents__brand mt-3">
                                          <span class="editProduct__contents__sku__para">
                                                <strong><?php echo e(__('Tags:')); ?></strong>
                                                <?php $__empty_1 = true; $__currentLoopData = $listing->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                  <?php echo e($tag->name); ?>

                                                  <?php if(!$loop->last): ?> , <?php endif; ?>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                  <?php echo e(__('No tags available')); ?>

                                              <?php endif; ?>
                                          </span>
                                    </div>

                                    <div class="editProduct__contents__brand mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('View Count:')); ?></strong> <?php echo e($listing->view); ?></span>
                                    </div>

                                    <div class="editProduct__contents__brand mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Status:')); ?></strong>
                                            <?php if($listing->status==1): ?>
                                                <span class="status_btn completed"><?php echo e(__('Approved')); ?></span>
                                            <?php else: ?>
                                                <span class="status_btn cancelled"><?php echo e(__('Pending')); ?></span>
                                            <?php endif; ?>
                                        </span>
                                    </div>

                                    <?php if(empty(get_static_option('google_map_settings_on_off'))): ?>
                                        <div class="editProduct__contents__brand mt-3">
                                            <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Country:')); ?></strong> <?php echo e(optional($listing->country)->country); ?></span>
                                        </div>

                                        <div class="editProduct__contents__brand mt-3">
                                            <span class="editProduct__contents__sku__para"><strong><?php echo e(__('State:')); ?></strong> <?php echo e(optional($listing->state)->state); ?></span>
                                        </div>

                                        <div class="editProduct__contents__brand mt-3">
                                            <span class="editProduct__contents__sku__para"><strong><?php echo e(__('City:')); ?></strong> <?php echo e(optional($listing->city)->city); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="editProduct__contents__brand mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Address:')); ?></strong> <?php echo e($listing->address); ?></span>
                                    </div>

                                    <div class="editProduct__contents__category mt-3">
                                        <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Is Featured:')); ?></strong></span>
                                        <input class="effectBorder" type="checkbox" <?php if(!empty($listing->is_featured)): ?> checked <?php endif; ?>>
                                        <span class="checkmark"></span>
                                    </div>

                                </div>
                            </div>
                            <!-- attributes -->
                            <?php if($listing->listing_attributes->isNotEmpty()): ?>
                            <div class="col-xxl-4 col-lg-4">
                                <div class="dashboard_orderDetails__sidebar__item">
                                    <div class="right-content">
                                        <h4 class="header-title mb-2"><?php echo e(get_static_option('listing_attribute_section_title') ?? __('Attributes')); ?></h4>
                                    </div>
                                    <?php $__currentLoopData = $listing->listing_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="dashboard_orderDetails__sidebar__data">
                                            <p class="dashboard_orderDetails__sidebar__left">
                                                <?php echo e($attribute->title); ?>

                                                <span class="dashboard_orderDetails__sidebar__left__para"> <strong><?php echo e($attribute->description); ?></strong> </span>
                                            </p>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!--step two -->
                        <div class="row g-4">
                            <div class="col-xxl-6 col-lg-6 mt-5">
                                <span class="editProduct__contents__sku__para"><strong><?php echo e(__('Description:')); ?></strong></span>
                                  <div class="list-desc">
                                    <p class="product__details__para"><?php echo $listing->description; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.markup','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75)): ?>
<?php $attributes = $__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75; ?>
<?php unset($__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75)): ?>
<?php $component = $__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75; ?>
<?php unset($__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php if (isset($component)) { $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $attributes = $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $component = $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/fontawesome-iconpicker.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/fontawesome-iconpicker.min.css')); ?>">
    <?php if (isset($component)) { $__componentOriginale5b58a3009df297f039f4deb857ae091 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale5b58a3009df297f039f4deb857ae091 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('summernote.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale5b58a3009df297f039f4deb857ae091)): ?>
<?php $attributes = $__attributesOriginale5b58a3009df297f039f4deb857ae091; ?>
<?php unset($__attributesOriginale5b58a3009df297f039f4deb857ae091); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale5b58a3009df297f039f4deb857ae091)): ?>
<?php $component = $__componentOriginale5b58a3009df297f039f4deb857ae091; ?>
<?php unset($__componentOriginale5b58a3009df297f039f4deb857ae091); ?>
<?php endif; ?>
    <script>
        <?php if (isset($component)) { $__componentOriginal9bb7c769e10559efc2f738350a5fc6e1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9bb7c769e10559efc2f738350a5fc6e1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.icon-picker','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icon.icon-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9bb7c769e10559efc2f738350a5fc6e1)): ?>
<?php $attributes = $__attributesOriginal9bb7c769e10559efc2f738350a5fc6e1; ?>
<?php unset($__attributesOriginal9bb7c769e10559efc2f738350a5fc6e1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9bb7c769e10559efc2f738350a5fc6e1)): ?>
<?php $component = $__componentOriginal9bb7c769e10559efc2f738350a5fc6e1; ?>
<?php unset($__componentOriginal9bb7c769e10559efc2f738350a5fc6e1); ?>
<?php endif; ?>
    </script>
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                //zone
                $(document).ready(function () {
                    $('.zone_settings').select2();
                });

                // Disable clicks on the checkbox
                $('#checkbox').on('click', function(e) {
                    e.preventDefault();
                });

                // Optionally, prevent keyboard events (spacebar) to toggle checkbox
                $('#checkbox').on('keydown', function(e) {
                    if (e.which === 32) {
                        e.preventDefault();
                    }
                });

                //Permalink Code
                var sl =  $('.category_slug').val();
                var url = `<?php echo e(url('/service-list/category/')); ?>/` + sl;
                var data = $('#slug_show').text(url).css('color', 'blue');

                function converToSlug(slug){
                    let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                    finalSlug = slug.replace(/  +/g, ' ');
                    finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                    return finalSlug;
                }
                //Slug Edit Code
                $(document).on('click', '.slug_edit_button', function (e) {
                    e.preventDefault();
                    $('.category_slug').show();
                    $(this).hide();
                    $('.slug_update_button').show();
                });

                //Slug Update Code
                $(document).on('click', '.slug_update_button', function (e) {
                    e.preventDefault();
                    $(this).hide();
                    $('.slug_edit_button').show();
                    var update_input = $('.category_slug').val();
                    var slug = converToSlug(update_input);
                    var url = `<?php echo e(url('/service-list/category/')); ?>/` + slug;
                    $('#slug_show').text(url);
                    $('.category_slug').val(slug)
                    $('.category_slug').hide();
                });

                // for summernote
                $('.summernote').summernote({
                    height: 400,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function (contents, $editable) {
                            $(this).prev('input').val(contents);
                        }
                    }
                });
                if ($('.summernote').length > 0) {
                    $('.summernote').each(function (index, value) {
                        $(this).summernote('code', $(this).data('content'));
                    });
                }
            });
        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/backend/pages/listings/listing-details.blade.php ENDPATH**/ ?>