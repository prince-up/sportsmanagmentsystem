

<?php $__env->startSection('page-title', 'Injuries'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['title' => 'Injury recovery','subtitle' => 'Track fitness status and expected return dates across the squad.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Injury recovery','subtitle' => 'Track fitness status and expected return dates across the squad.']); ?> <?php echo $__env->renderComponent(); ?>
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
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Log injury</h2>
            <form method="POST" action="<?php echo e(route('injuries.store')); ?>" class="grid gap-4">
                <?php echo csrf_field(); ?>
                <input class="input" type="number" name="player_id" placeholder="Player ID">
                <input class="input" type="number" name="team_id" placeholder="Team ID">
                <input class="input" type="number" name="season_id" placeholder="Season ID">
                <input class="input" type="text" name="injury_type" placeholder="Injury type">
                <select class="input" name="severity">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="critical">Critical</option>
                </select>
                <input class="input" type="date" name="started_at">
                <input class="input" type="date" name="expected_return_at">
                <input class="input" type="number" name="recovery_progress" min="0" max="100" placeholder="Recovery progress">
                <textarea class="input min-h-28" name="notes" placeholder="Notes"></textarea>
                <button class="btn-primary" type="submit">Save injury</button>
            </form>
        </div>

        <div class="card p-6">
            <div class="space-y-4">
                <?php $__currentLoopData = $injuries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $injury): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white"><?php echo e($injury->player?->full_name); ?></p>
                                <p class="text-sm text-slate-500 dark:text-slate-400"><?php echo e($injury->injury_type); ?> · <?php echo e(ucfirst($injury->severity)); ?></p>
                            </div>
                            <span class="rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700 dark:bg-rose-500/10 dark:text-rose-300"><?php echo e($injury->recovery_progress); ?>%</span>
                        </div>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Return: <?php echo e($injury->expected_return_at?->format('d M Y') ?? 'TBA'); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="mt-6"><?php echo e($injuries->links()); ?></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views\injuries\index.blade.php ENDPATH**/ ?>