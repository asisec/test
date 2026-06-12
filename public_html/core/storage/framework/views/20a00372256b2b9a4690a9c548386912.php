<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Listing User Public Profile Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
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
        .dashboard__card {
            height: auto;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row g-4 mt-0">
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
        <form action="<?php echo e(route('admin.user.public.profile.settings')); ?>" method="POST">
            <?php echo csrf_field(); ?>

             <div class="col-6">
                <div class="dashboard__card bg__white padding-20 radius-10">
                    <h2 class="dashboard__card__header__title mb-3"><?php echo e(__('User Public Profile Advertisements')); ?></h2>
                        <div class="form__input__single">
                            <label for="user_public_profile_page_advertisement_type" class="form__input__single__label"><?php echo e(__('Advertisement Type')); ?></label>
                            <select class="form-control" name="user_public_profile_page_advertisement_type" id="user_public_profile_page_advertisement_type">
                                <option selected disabled ><?php echo e(__('Select a Type')); ?></option>
                                <option <?php if(get_static_option('user_public_profile_page_advertisement_type') === 'image'): ?> selected <?php endif; ?> value="image"><?php echo e(__('Image')); ?></option>
                                <option <?php if(get_static_option('user_public_profile_page_advertisement_type') === 'google_adsense'): ?> selected  <?php endif; ?> value="google_adsense"><?php echo e(__('Google Adsense')); ?></option>
                                <option <?php if(get_static_option('user_public_profile_page_advertisement_type') === 'scripts'): ?> selected  <?php endif; ?> value="scripts"><?php echo e(__('Scripts')); ?></option>
                            </select>
                        </div>

                        <div class="form__input__single">
                            <label for="user_public_profile_page_advertisement_size" class="form__input__single__label"><?php echo e(__('Advertisement Size')); ?></label>
                            <select class="form-control" name="user_public_profile_page_advertisement_size" id="user_public_profile_page_advertisement_size">
                                    <option selected disabled><?php echo e(__('Select a Size')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '350*250'): ?> selected <?php endif; ?> value="350*250"><?php echo e(__('350 x 250')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '320*50'): ?> selected <?php endif; ?> value="320*50"><?php echo e(__('320 x 50')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '160*600'): ?> selected <?php endif; ?> value="160*600"><?php echo e(__('160 x 600')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '300*600'): ?> selected <?php endif; ?> value="300*600"><?php echo e(__('300 x 600')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '336*280'): ?> selected <?php endif; ?> value="336*280"><?php echo e(__('336 x 280')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '728*90'): ?> selected <?php endif; ?> value="728*90"><?php echo e(__('728 x 90')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '730*180'): ?> selected <?php endif; ?> value="730*180"><?php echo e(__('730 x 180')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '730*210'): ?> selected <?php endif; ?> value="730*210"><?php echo e(__('730 x 210')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '300*1050'): ?> selected <?php endif; ?> value="300*1050"><?php echo e(__('300 X 1050')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '950*160'): ?> selected <?php endif; ?> value="950*160"><?php echo e(__('950 X 160')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '950*200'): ?> selected <?php endif; ?> value="950*200"><?php echo e(__('950 X 200')); ?></option>
                                    <option <?php if(get_static_option('user_public_profile_page_advertisement_size') === '250*1110'): ?> selected <?php endif; ?> value="250*1110"><?php echo e(__('250 X 1110')); ?></option>
                            </select>
                        </div>

                        <div class="form__input__single">
                            <label for="user_public_profile_page_advertisement_alignment" class="form__input__single__label"><?php echo e(__('Advertisement Alignment')); ?></label>
                            <select class="form-control" name="user_public_profile_page_advertisement_alignment" id="user_public_profile_page_advertisement_alignment">
                                <option selected disabled><?php echo e(__('Select a Size')); ?></option>
                                <option <?php if(get_static_option('user_public_profile_page_advertisement_alignment') === 'start'): ?> selected <?php endif; ?> value="start"><?php echo e(__('Left')); ?></option>
                                <option <?php if(get_static_option('user_public_profile_page_advertisement_alignment') === 'end'): ?> selected <?php endif; ?> value="end"><?php echo e(__('Right')); ?></option>
                                <option <?php if(get_static_option('user_public_profile_page_advertisement_alignment') === 'center'): ?> selected <?php endif; ?> value="center"><?php echo e(__('Center')); ?></option>
                            </select>
                        </div>
                </div>
            </div>
            <div class="btn_wrapper mt-4">
                <button type="submit" id="update" class="cmnBtn btn_5 btn_bg_blue radius-5"><?php echo e(__('Update Changes')); ?></button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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
        (function($){
            "use strict";
            $(document).ready(function(){
                <?php if (isset($component)) { $__componentOriginal26b641e1adcfef4e774221a3ed7c52ce = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.update','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce)): ?>
<?php $attributes = $__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce; ?>
<?php unset($__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26b641e1adcfef4e774221a3ed7c52ce)): ?>
<?php $component = $__componentOriginal26b641e1adcfef4e774221a3ed7c52ce; ?>
<?php unset($__componentOriginal26b641e1adcfef4e774221a3ed7c52ce); ?>
<?php endif; ?>
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/backend/pages/page-settings/user-public-profile-settings.blade.php ENDPATH**/ ?>