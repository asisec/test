<a tabindex="0" class="cmnBtn btn_5 btn_bg_blue radius-5 swal_change_language_button">
    <?php echo e(__('Make Change')); ?>

</a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
    <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
    <br>
    <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>
<?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/components/status/change-default-lang.blade.php ENDPATH**/ ?>