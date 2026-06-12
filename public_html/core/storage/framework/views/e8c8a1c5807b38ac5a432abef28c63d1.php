<?php if($listing->country && $listing->country->country_code): ?>
    <img
        src="https://flagcdn.com/h24/<?php echo e(strtolower($listing->country->country_code)); ?>.png"
        srcset="https://flagcdn.com/h48/<?php echo e(strtolower($listing->country->country_code)); ?>.png 2x"
        style="width: 36px; height: 24px; border-radius: 4px; object-position: center; object-fit: cover; overflow: hidden;"
        alt="<?php echo e($listing->country->country); ?>"
    />
<?php else: ?>
    -
<?php endif; ?><?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/components/listings/table-country-image-render.blade.php ENDPATH**/ ?>