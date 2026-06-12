<div class="contact-new-wraper" data-padding-top="<?php echo e($padding_top); ?>" data-padding-bottom="<?php echo e($padding_bottom); ?>">
    <div class="container-1440">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-5">
                <div class="get-in-touch-wraper">
                    <div class="text">
                        <h3 class="section-title"><?php echo e($title); ?></h3>
                        <p><?php echo e($sub_title); ?></p>
                    </div>
                       <?php echo $form_details; ?>

                 </div>
            </div>
            <div class="col-md-6">
                <div class="get-in-touch-right-part">
                    <div class="body-part box-shadow1 p-24">
                        <div class="address d-flex align-items-center gap-3 mb-3">
                            <div class="icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="text">
                                <p><?php echo e(__('Address')); ?></p>
                                <h5 class="title"><?php echo e($address); ?></h5>
                            </div>
                        </div>
                        <div class="email d-flex align-items-center gap-3 mb-3">
                            <div class="icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="text">
                                <p><?php echo e(__('Email')); ?></p>
                                <h5 class="title"><?php echo e($email); ?></h5>
                            </div>
                        </div>
                        <div class="phone d-flex align-items-center gap-3">
                            <div class="icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="text">
                                <p><?php echo e(__('Phone Number')); ?></p>
                                <h5 class="title"><?php echo e($phone); ?></h5>
                            </div>
                        </div>
                        <div class="devider"></div>
                        <div class="social-icon d-flex align-items-center gap-4">
                            <?php $__currentLoopData = $repeater_data_share_icons['icon_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($repeater_data_share_icons['icon_link_'][$key]); ?>" target="_blank">
                                    <div class="icon">
                                        <i class="<?php echo e($icon); ?>"></i>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/app/Providers/../../plugins/PageBuilder/views/contact/contact-info.blade.php ENDPATH**/ ?>