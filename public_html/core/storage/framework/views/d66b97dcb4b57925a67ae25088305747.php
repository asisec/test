<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('SMTP Settings')); ?>

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
        <div class="col-xl-6 col-lg-6">
            <div class="dashboard__card bg__white padding-20 radius-10">
                <h2 class="dashboard__card__header__title"><?php echo e(__('SMTP Settings')); ?></h2>
                <form action="<?php echo e(route('admin.email.smtp.update.settings')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form__input__flex">
                        <div class="form__input__single">
                            <label for="site_global_email" class="form__input__single__label"><?php echo e(__('Global Email')); ?></label>
                            <input type="text" class="form__control radius-5" name="site_global_email" value="<?php echo e(get_static_option('site_global_email')); ?>">
                            <small class="form-text text-muted"><?php echo e(__('use your web mail here')); ?></small>
                        </div>

                        <div class="form__input__single">
                            <label for="site_smtp_mail_mailer" class="form__input__single__label"><?php echo e(__('SMTP Mailer')); ?></label>
                            <select name="site_smtp_mail_mailer" class="form__control radius-5">
                                <option value="smtp" <?php if(get_static_option('site_smtp_mail_mailer') == 'smtp'): ?> selected <?php endif; ?>><?php echo e(__('SMTP')); ?></option>
                                <option value="sendmail" <?php if(get_static_option('site_smtp_mail_mailer') == 'sendmail'): ?> selected <?php endif; ?>><?php echo e(__('SendMail')); ?></option>
                                <option value="mailgun" <?php if(get_static_option('site_smtp_mail_mailer') == 'mailgun'): ?> selected <?php endif; ?>><?php echo e(__('Mailgun')); ?></option>
                                <option value="postmark" <?php if(get_static_option('site_smtp_mail_mailer') == 'postmark'): ?> selected <?php endif; ?>><?php echo e(__('Postmark')); ?></option>
                            </select>
                        </div>

                        <div class="form__input__single">
                            <label for="site_smtp_mail_host" class="form__input__single__label"><?php echo e(__('SMTP Mail Host')); ?></label>
                            <input type="text" class="form__control" name="site_smtp_mail_host" value="<?php echo e(get_static_option('site_smtp_mail_host')); ?>">
                        </div>

                        <div class="form__input__single">
                            <label for="site_smtp_mail_port" class="form__input__single__label"><?php echo e(__('SMTP Mail Port')); ?></label>
                            <select name="site_smtp_mail_port" class="form__control">
                                <option value="587" <?php if(get_static_option('site_smtp_mail_port') == '587'): ?> selected <?php endif; ?>><?php echo e(__('587')); ?></option>
                                <option value="465" <?php if(get_static_option('site_smtp_mail_port') == '465'): ?> selected <?php endif; ?>><?php echo e(__('465')); ?></option>
                                <option value="25" <?php if(get_static_option('site_smtp_mail_port') == '25'): ?> selected <?php endif; ?>><?php echo e(__('25')); ?></option>
                                <option value="2525" <?php if(get_static_option('site_smtp_mail_port') == '2525'): ?> selected <?php endif; ?>><?php echo e(__('2525')); ?></option>
                            </select>
                        </div>

                        <div class="form__input__single">
                            <label for="site_smtp_mail_username" class="form__input__single__label"><?php echo e(__('SMTP Mail Username')); ?></label>
                            <input type="text" class="form__control" name="site_smtp_mail_username" value="<?php echo e(get_static_option('site_smtp_mail_username')); ?>">
                        </div>

                        <div class="form__input__single">
                            <label for="site_smtp_mail_password" class="form__input__single__label"><?php echo e(__('SMTP Mail Password')); ?></label>
                            <input type="text" class="form__control" name="site_smtp_mail_password"  value="<?php echo e(get_static_option('site_smtp_mail_password')); ?>">
                        </div>

                        <div class="form__input__single">
                            <label for="site_smtp_mail_encryption" class="form__input__single__label"><?php echo e(__('SMTP Mail Encryption')); ?></label>
                            <select name="site_smtp_mail_encryption" class="form__control">
                                <option value="ssl" <?php if(get_static_option('site_smtp_mail_encryption') == 'ssl'): ?> selected <?php endif; ?>><?php echo e(__('SSL')); ?></option>
                                <option value="tls" <?php if(get_static_option('site_smtp_mail_encryption') == 'tls'): ?> selected <?php endif; ?>><?php echo e(__('TLS')); ?></option>
                                <option value="none" <?php if(get_static_option('site_smtp_mail_encryption') == 'none'): ?> selected <?php endif; ?>><?php echo e(__('None')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="btn_wrapper mt-4">
                        <button type="submit" id="update" class="cmnBtn btn_5 btn_bg_blue radius-5"><?php echo e(__('Update Changes')); ?></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="dashboard__card padding-20 radius-10">
                <h2 class="dashboard__card__header__title mb-3"><?php echo e(__('SMTP Test')); ?></h2>
                <form action="<?php echo e(route('admin.email.smtp.settings.test')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form__input__flex">
                        <div class="form__input__single">
                            <label for="Email" class="form__input__single__label"><?php echo e(__('Email')); ?></label>
                            <input type="text" class="form__control radius-5" name="email">
                        </div>
                    </div>
                    <div class="btn_wrapper mt-4">
                        <button type="submit" id="send" class="cmnBtn btn_5 btn_bg_blue radius-5"><?php echo e(__('Send')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        <?php if (isset($component)) { $__componentOriginal20443469c8bea553ad55c3d156eba0b5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal20443469c8bea553ad55c3d156eba0b5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.send','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn.send'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal20443469c8bea553ad55c3d156eba0b5)): ?>
<?php $attributes = $__attributesOriginal20443469c8bea553ad55c3d156eba0b5; ?>
<?php unset($__attributesOriginal20443469c8bea553ad55c3d156eba0b5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal20443469c8bea553ad55c3d156eba0b5)): ?>
<?php $component = $__componentOriginal20443469c8bea553ad55c3d156eba0b5; ?>
<?php unset($__componentOriginal20443469c8bea553ad55c3d156eba0b5); ?>
<?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/backend/email-settings/smtp-settings.blade.php ENDPATH**/ ?>