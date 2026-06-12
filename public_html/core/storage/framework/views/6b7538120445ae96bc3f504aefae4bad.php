<!-- Pagination -->
<div class="row justify-content-center mt-4 mb-4">
    <div class="col-lg-12">
        <div class="pagination">
            <?php if($alldata->count() > 0): ?>
                <div class="blog-pagination">
                    <div class="custom-pagination">
                        <?php echo $alldata->links(); ?>

                    </div>
                </div>
            <?php else: ?>
                <div class="no-listings-message">
                    <h2 class=""><?php echo e($title ?? ''); ?></h2>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/components/pagination/frontend-laravel-paginate.blade.php ENDPATH**/ ?>