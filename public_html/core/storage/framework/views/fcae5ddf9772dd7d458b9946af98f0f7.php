<table class="DataTable_activation">
    <thead>
    <tr>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('listing-report-bulk-delete')): ?>
            <th class="no-sort">
                <div class="mark-all-checkbox">
                    <input type="checkbox" class="all-checkbox">
                </div>
            </th>
        <?php endif; ?>
        <th><?php echo e(__('ID')); ?></th>
        <th><?php echo e(__('User Name')); ?></th>
        <th><?php echo e(__('Listing Title')); ?></th>
        <th><?php echo e(__('Reason')); ?></th>
        <th><?php echo e(__('Description')); ?></th>
        <th><?php echo e(__('Action')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $all_reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($data->listing): ?>
            <tr>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('listing-report-bulk-delete')): ?>
                    <td> <?php if (isset($component)) { $__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.bulk-delete-checkbox','data' => ['id' => $data->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bulk-action.bulk-delete-checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19)): ?>
<?php $attributes = $__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19; ?>
<?php unset($__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19)): ?>
<?php $component = $__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19; ?>
<?php unset($__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19); ?>
<?php endif; ?> </td>
                <?php endif; ?>
                <td><?php echo e($data->id); ?></td>
                <td class="text-primary"><a href="<?php echo e(route('about.user.profile', $data?->user->username)); ?>" target="_blank"><?php echo e($data?->user->fullname); ?></a></td>
                <td class="text-primary">
                    <a  href="<?php echo e(route('frontend.listing.details', $data?->listing->slug)); ?>" target="_blank">
                        <?php echo e($data?->listing->title); ?>

                    </a>
                </td>
                <td> <?php echo e($data?->reason->title); ?> </td>
                <td>
                    <button class="cmnBtn btn_5 btn_bg_info radius-5 view-description" data-description="<?php echo e($data->description); ?>"><?php echo e(__('View Description')); ?></button>
                </td>
                <td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('listing-report-delete')): ?>
                        <?php if (isset($component)) { $__componentOriginal7973b0ce98592c79f9209abd6e46a09b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7973b0ce98592c79f9209abd6e46a09b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.popup.delete-popup','data' => ['url' => route('admin.listing.report.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('popup.delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.listing.report.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7973b0ce98592c79f9209abd6e46a09b)): ?>
<?php $attributes = $__attributesOriginal7973b0ce98592c79f9209abd6e46a09b; ?>
<?php unset($__attributesOriginal7973b0ce98592c79f9209abd6e46a09b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7973b0ce98592c79f9209abd6e46a09b)): ?>
<?php $component = $__componentOriginal7973b0ce98592c79f9209abd6e46a09b; ?>
<?php unset($__componentOriginal7973b0ce98592c79f9209abd6e46a09b); ?>
<?php endif; ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php if (isset($component)) { $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate','data' => ['allData' => $all_reports]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination.laravel-paginate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_reports)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $attributes = $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $component = $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
<?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/backend/pages/listings/reports/search-result.blade.php ENDPATH**/ ?>