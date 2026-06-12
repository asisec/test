

<div class="seller-phone text-center">
    <p><?php echo e(__('Phone')); ?></p>

    <span type="text" id="default_phone_number_show_for_responsive" class="number">
        <?php if($listing->phone_hidden === 1 || $listing->phone_shows_only_premium === 1): ?>
            <?php echo e($maskedPhoneNumber); ?>

        <?php else: ?>
            <?php echo e($listing->phone); ?>

        <?php endif; ?>
    </span>

    <?php if($listing->phone_shows_only_premium === 1): ?>
        <?php if($userHasMembership === true): ?>
            <div class="number" id="phoneNumberForResponsive" style="display:none;"><?php echo e($listing->phone); ?></div>
            <a href="javascript:void(0)" class="show-number callPhoneNumberBtn" id="userPhoneNumberBtnForResponsive"><?php echo e(get_static_option('listing_show_phone_number_title') ?? __('Show Number')); ?></a>
        <?php else: ?>
            <?php echo $__env->make('frontend.pages.listings.listing-premium-required-modal-responsive', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <a href="javascript:void(0)" class="show-number" data-bs-toggle="modal" data-bs-target="#premiumRequiredModalResponsive"><?php echo e(get_static_option('listing_show_phone_number_title') ?? __('Show Number')); ?></a>
        <?php endif; ?>
    <?php elseif($listing->phone_hidden === 1): ?>
        <div class="number" id="phoneNumberForResponsive" style="display:none;"><?php echo e($listing->phone); ?></div>
        <a href="javascript:void(0)" class="show-number callPhoneNumberBtn" id="userPhoneNumberBtnForResponsive"><?php echo e(get_static_option('listing_show_phone_number_title') ?? __('Show Number')); ?></a>
    <?php endif; ?>
</div><?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/components/listings/user-listing-phone-for-responsive.blade.php ENDPATH**/ ?>