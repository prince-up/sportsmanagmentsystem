

<?php $__env->startSection('page-title', 'Transfers'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['title' => 'Transfer market','subtitle' => 'Monitor player movement, fees, and transaction status.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Transfer market','subtitle' => 'Monitor player movement, fees, and transaction status.']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $attributes = $__attributesOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__attributesOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $component = $__componentOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__componentOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>

    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <div class="card p-6">
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Log transfer</h2>
            <form method="POST" action="<?php echo e(route('transfers.store')); ?>" class="grid gap-4">
                <?php echo csrf_field(); ?>
                <input class="input" type="number" name="player_id" placeholder="Player ID">
                <input class="input" type="number" name="from_team_id" placeholder="From Team ID">
                <input class="input" type="number" name="to_team_id" placeholder="To Team ID">
                <input class="input" type="number" name="season_id" placeholder="Season ID">
                <input class="input" type="date" name="transfer_date">
                <input class="input" type="number" step="0.01" name="transfer_fee" placeholder="Transfer fee">
                <select class="input" name="status">
                    <option value="rumored">Rumored</option>
                    <option value="offered">Offered</option>
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                    <option value="completed">Completed</option>
                </select>
                <textarea class="input min-h-28" name="notes" placeholder="Notes"></textarea>
                <button class="btn-primary" type="submit">Save transfer</button>
            </form>
        </div>

        <div class="card p-6">
            <div class="space-y-4">
                <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white"><?php echo e($transfer->player?->full_name); ?></p>
                                <p class="text-sm text-slate-500 dark:text-slate-400"><?php echo e($transfer->fromTeam?->name); ?> → <?php echo e($transfer->toTeam?->name); ?></p>
                            </div>
                            <span class="text-sm font-semibold text-brand-700 dark:text-brand-300">$<?php echo e(number_format((float) $transfer->transfer_fee, 2)); ?></span>
                        </div>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400"><?php echo e(ucfirst($transfer->status)); ?> · <?php echo e($transfer->transfer_date?->format('d M Y')); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="mt-6"><?php echo e($transfers->links()); ?></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views\transfers\index.blade.php ENDPATH**/ ?>