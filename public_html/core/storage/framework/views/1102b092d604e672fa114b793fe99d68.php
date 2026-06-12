<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Tickets')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        button.btn.btn-secondary.btn-sm.radius-5.fileUploads_item__file__btn {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: 57%;
            height: 11%;
        }

        .supportTicket-messages-body {
            max-height: 380px;
            overflow-y: auto;
        }
        .supportTicket_single__attachment {
            display: flex;
        }
        .text-end.margin-reverse-30 {
            margin-top: -38px;
        }
        .dashboard_promo__single{
            height: max-content;
        }
        .dashboard_promo__single.style_01 {
            border: 1px solid #006769;
           background-color: #00000000;
        }
        .dashboard_promo__single.style_02 {
            border: 1px solid #006769;
            background-color: #00676912;
        }
        .admin_message_show{
            display: flex;
            flex-direction: column;
            align-items: end;
        }
        .user_message_show{
            text-align: start;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row g-4 mt-0">
        <div class="col-xl-8 col-lg-8">
            <div class="dashboard__card bg__white padding-20 radius-10">
                <div class="dashboard__inner__header mb-3">
                    <div class="dashboard__inner__header__flex">
                        <div class="dashboard__inner__header__left">
                            <h4 class="dashboard__inner__header__title"><?php echo e(__('All Tickets')); ?></h4>
                            <div class="mt-3">
                                <strong>#<?php echo e($ticket_details->id); ?></strong>
                                <?php if($ticket_details->status == 'open'): ?>
                                    <a href="javascript:void(0)" class="status_btn completed"><?php echo e(__('Open')); ?></a>
                                <?php else: ?>
                                    <a href="javascript:void(0)" class="status_btn cancelled"><?php echo e(__('Closed')); ?></a>
                                <?php endif; ?>
                                <a href="javascript:void(0)" class="status_btn completed"><?php echo e($ticket_details->priority); ?></a>
                                <h5 class="mt-3"><?php echo e($ticket_details->title); ?></h5>
                            </div>
                        </div>
                        <div class="dashboard__inner__header__left">
                            <span class="supportTicket_single__content__time">
                                <?php echo e(__('Last update')); ?>

                                <?php echo e($ticket_details?->get_ticket_latest_message?->updated_at->diffForHumans() ?? $ticket_details->updated_at->diffForHumans()); ?>

                            </span>
                        </div>
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
                <div class="inbox_wrapper__body padding-20">
                    <div class="supportTicket_single__item supportTicket-messages-body">
                        <?php $__currentLoopData = $ticket_details->message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($message->type == 'admin'): ?>
                                <div class="supportTicket_single__chat dashboard_promo__single style_01 radius-10 mt-2">
                                    <div class="supportTicket_single__chat__flex admin_message_show">
                                        <div class="dashboard__header__author__thumb">
                                          <?php
                                               $profile_img = get_attachment_image_by_id(auth()->user()->image,null,true);
                                          ?>
                                            <img src="<?php echo e($profile_img['img_url']); ?>" alt="<?php echo e(__('admin')); ?>">
                                        </div>
                                        <span><?php echo e(__('Name:')); ?>  <?php echo e(auth()->user()->name); ?></span>
                                        <div class="supportTicket_single__chat__contents">
                                            <div class="supportTicket_single__chat__box">
                                                <p class="supportTicket_single__chat__message text_style_manege">
                                                    <?php echo $message->message; ?>

                                                </p>
                                                <?php if($message->attachment): ?>
                                                    <a href="<?php echo e(asset('assets/uploads/ticket/chat-messages/'.$message->attachment)); ?>" download class="supportTicket_single__uploads">
                                                        <i class="fa-solid fa-cloud-arrow-up"></i> <?php echo e(__('Download Attachment')); ?>

                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <p class="supportTicket_single__chat__time mt-2 text-end"><?php echo e($message->created_at->diffForHumans()); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="supportTicket_single__chat reply text-end dashboard_promo__single style_02 radius-10 mt-2 padding-20">
                                    <div class="supportTicket_single__chat__flex user_message_show">
                                        <div class="text-start">
                                            <div class="dashboard__header__author__thumb">
                                                <?php if($ticket_details->user?->image): ?>
                                                    <?php
                                                        $profile_img = get_attachment_image_by_id($ticket_details->user?->image,null,true);
                                                    ?>
                                                    <img src="<?php echo e($profile_img['img_url']); ?>" alt="<?php echo e(__('user')); ?>">
                                                <?php endif; ?>
                                            </div>
                                            <?php echo e(__("Name:")); ?> <?php echo e($ticket_details->user?->fullname); ?>

                                        </div>
                                        <div class="supportTicket_single__chat__contents">
                                            <div class="supportTicket_single__chat__box">
                                                <p class="supportTicket_single__chat__message text_style_manege">
                                                    <?php echo $message->message; ?>

                                                </p>
                                                <?php if($message->attachment): ?>
                                                    <a href="<?php echo e(asset('assets/uploads/ticket/chat-messages/'.$message->attachment)); ?>"
                                                       download class="supportTicket_single__uploads">
                                                        <i class="fa-solid fa-cloud-arrow-up"></i> <?php echo e(__('Download Attachment')); ?>

                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <p class="supportTicket_single__chat__time mt-2"><?php echo e($message->created_at->diffForHumans()); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="supportTicket_single__item">
                        <div class="supportTicket_single__chat__replyForm">
                            <form action="<?php echo e(route('admin.ticket.details',$ticket_details->id)); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="supportTicket_single__chat__replyForm__input mt-2">
                                    <textarea name="message" id="message" class="form-message" placeholder="<?php echo e(__('Write your reply....')); ?>"></textarea>
                                </div>

                                <div class="form__input__single mt-3 w-25">
                                  <input type="file" class="inputFileTag form-control radius-5"  name="attachment" id="attachment">
                                </div>

                                <div class="supportTicket-single-chat-replyForm-input mt-2 ">
                                    <label for="email_notify" class="label-title">
                                        <input type="checkbox" name="email_notify" id="email_notify"> <?php echo e(__('Email Notify')); ?>

                                    </label>
                                </div>

                                <?php if (isset($component)) { $__componentOriginal356fea1ac7c276bdc0a7e9efd6c883bd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal356fea1ac7c276bdc0a7e9efd6c883bd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.file.file-support','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('file.file-support'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal356fea1ac7c276bdc0a7e9efd6c883bd)): ?>
<?php $attributes = $__attributesOriginal356fea1ac7c276bdc0a7e9efd6c883bd; ?>
<?php unset($__attributesOriginal356fea1ac7c276bdc0a7e9efd6c883bd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal356fea1ac7c276bdc0a7e9efd6c883bd)): ?>
<?php $component = $__componentOriginal356fea1ac7c276bdc0a7e9efd6c883bd; ?>
<?php unset($__componentOriginal356fea1ac7c276bdc0a7e9efd6c883bd); ?>
<?php endif; ?>

                                <div class="btn_wrapper mt-5">
                                    <button type="submit" class="cmnBtn btn_5 btn_bg_blue radius-5  send_reply"><?php echo e(__('Send Reply')); ?></button>
                                </div>
                            </form>
                        </div>

                        <div class="text-end margin-reverse-30">
                            <?php if($ticket_details->status === 'open'): ?>
                                <?php if (isset($component)) { $__componentOriginaled49183813b6264fe02b2283042511dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled49183813b6264fe02b2283042511dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.status-change','data' => ['title' => __('Close Ticket'),'url' => route('admin.ticket.status',$ticket_details->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status.table.status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Close Ticket')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.ticket.status',$ticket_details->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $attributes = $__attributesOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__attributesOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $component = $__componentOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__componentOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="dashboard__card bg__white padding-20 radius-10">
                <div class="dashboard__inner__header mb-3">
                    <div class="dashboard__inner__header__flex">
                        <div class="dashboard__inner__header__left">
                            <h4 class="dashboard__inner__header__title"><?php echo e(__('Ticket Details')); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="inbox_sidebar__inner">
                   <?php echo $ticket_details->description ?? __('No Details'); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('supportticket::backend.ticket.ticket-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/Modules/SupportTicket/resources/views/backend/ticket/details.blade.php ENDPATH**/ ?>