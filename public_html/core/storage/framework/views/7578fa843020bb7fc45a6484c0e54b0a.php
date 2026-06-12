<!--Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Ratings & Feedback')); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="custom-form ">
                    <form action="<?php echo e(route('user.review.add')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="rating" name="rating">
                        <input type="hidden" id="user_id" name="user_id">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="user-ratings-modal text-center">
                                    <div class="user_img_review">
                                        <?php echo render_image_markup_by_attachment_id($user->image, ''); ?>

                                    </div>
                                    <div class="name text-center mt-2"><?php echo e($user->fullname); ?></div>
                                </div>
                                <div class="single-commetns">
                                  <div class="new-reviews" id="review"></div>
                                </div>
                                <div class="single-input">
                                    <label for="ticketTitle" class="label_title"><?php echo e(__('Write your comments')); ?></label>
                                    <textarea id="message" name="message" cols="20" rows="4"  class="form--control radius-10 textarea-input" placeholder="<?php echo e(__('Comments')); ?>"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-btn-wraper">
                            <button type="button" class="modal-btn cancle" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                            <button type="submit" class="modal-btn submit"><?php echo e(__('Send Review')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/frontend/pages/user/review-add-modal.blade.php ENDPATH**/ ?>