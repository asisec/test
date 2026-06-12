<?php if($notification->type =='Create Listing' || $notification->type =='Edit Listing'): ?>
    <a href="<?php echo e(route('admin.listings.updateRead', $notification->identity)); ?>" class="dashboard__notification__list__item click-notification">
        <li class="dashboard__header__notification__wrap__list__item">
            <div class="dashboard__header__notification__wrap__list__flex">
                <div class="dashboard__header__notification__wrap__list__icon">
                    <i class="las la-bell"></i>
                </div>
                <div class="dashboard__header__notification__wrap__list__contents">
                    <?php echo e($notification->message ?? ''); ?>  <strong>#<?php echo e($notification->identity); ?></strong>
                    <span class="dashboard__header__notification__wrap__list__contents__sub">
                        <?php echo e($notification->created_at->toFormattedDateString()); ?>

                    </span>
                </div>
            </div>
        </li>
    </a>
<?php endif; ?>

<?php if($notification->type =='Ticket'): ?>
    <a href="<?php echo e(route('admin.ticket.details', $notification->identity)); ?>" class="dashboard__notification__list__item click-notification">
        <li class="dashboard__header__notification__wrap__list__item">
            <div class="dashboard__header__notification__wrap__list__flex">
                <div class="dashboard__header__notification__wrap__list__icon">
                    <i class="las la-bell"></i>
                </div>
                <div class="dashboard__header__notification__wrap__list__contents">
                    <?php echo e($notification->message ?? ''); ?>  <strong>#<?php echo e($notification->identity); ?></strong>
                    <span class="dashboard__header__notification__wrap__list__contents__sub">
                        <?php echo e($notification->created_at->toFormattedDateString()); ?>

                    </span>
                </div>
            </div>
        </li>
    </a>
<?php endif; ?>

<?php if(moduleExists('Membership')): ?>
    <?php if(membershipModuleExistsAndEnable('Membership')): ?>
        <?php if($notification->type =='Buy Membership'): ?>
            <a href="<?php echo e(route('admin.user.membership.read.unread', $notification->identity)); ?>" class="dashboard__notification__list__item click-notification">
                <li class="dashboard__header__notification__wrap__list__item">
                    <div class="dashboard__header__notification__wrap__list__flex">
                            <div class="dashboard__header__notification__wrap__list__icon">
                                <i class="las la-bell"></i>
                            </div>
                            <div class="dashboard__notification__list__content">
                                <span class="dashboard__notification__list__content__title"><?php echo e($notification->message ?? ''); ?>  <strong>#<?php echo e($notification->identity); ?></strong></span> <br>
                                <span class="dashboard__notification__list__content__time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                            </div>
                     </div>
                </li>
            </a>
        <?php endif; ?>
        <?php if($notification->type == 'Renew Membership'): ?>
            <a href="<?php echo e(route('admin.user.membership.read.unread', $notification->identity)); ?>" class="dashboard__notification__list__item click-notification">
                <li class="dashboard__header__notification__wrap__list__item">
                    <div class="dashboard__header__notification__wrap__list__flex">
                        <div class="dashboard__header__notification__wrap__list__icon">
                            <i class="las la-bell"></i>
                        </div>
                        <div class="dashboard__notification__list__content">
                            <span class="dashboard__notification__list__content__title"><?php echo e($notification->message ?? ''); ?>  <strong>#<?php echo e($notification->identity); ?></strong></span> <br>
                            <span class="dashboard__notification__list__content__time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                        </div>
                    </div>
                </li>
            </a>
        <?php endif; ?>
        <?php if($notification->type == 'Upgrade Membership'): ?>
            <a href="<?php echo e(route('admin.user.membership.read.unread', $notification->identity)); ?>" class="dashboard__notification__list__item click-notification">
                <li class="dashboard__header__notification__wrap__list__item">
                    <div class="dashboard__header__notification__wrap__list__flex">
                        <div class="dashboard__header__notification__wrap__list__icon">
                            <i class="las la-bell"></i>
                        </div>
                        <div class="dashboard__notification__list__content">
                            <span class="dashboard__notification__list__content__title"><?php echo e($notification->message ?? ''); ?>  <strong>#<?php echo e($notification->identity); ?></strong></span> <br>
                            <span class="dashboard__notification__list__content__time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                        </div>
                    </div>
                </li>
            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/components/backend/admin-notification-in-top.blade.php ENDPATH**/ ?>