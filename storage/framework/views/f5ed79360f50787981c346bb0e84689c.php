

<?php $__env->startSection('page-title', 'Seasons'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['title' => 'Seasons','subtitle' => 'Create, activate, and archive multiple league seasons.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Seasons','subtitle' => 'Create, activate, and archive multiple league seasons.']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $attributes = $__attributesOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__attributesOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $component = $__componentOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__componentOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>

    <div class="grid gap-6 xl:grid-cols-[0.8fr_1.2fr]">
        <div class="card p-6">
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">New season</h2>
            <form method="POST" action="<?php echo e(route('seasons.store')); ?>" class="grid gap-4">
                <?php echo csrf_field(); ?>
                <input class="input" type="text" name="name" placeholder="Season name">
                <input class="input" type="date" name="starts_on">
                <input class="input" type="date" name="ends_on">
                <label class="flex items-center gap-3 text-sm text-slate-700 dark:text-slate-300">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                    Set as active season
                </label>
                <button class="btn-primary" type="submit">Create season</button>
            </form>
        </div>

        <div class="card p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                    <thead class="text-left text-slate-500 dark:text-slate-400">
                        <tr>
                            <th class="py-3 pr-4">Season</th>
                            <th class="py-3 px-4">Dates</th>
                            <th class="py-3 px-4">Active</th>
                            <th class="py-3 pl-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="py-3 pr-4 font-medium text-slate-900 dark:text-white"><?php echo e($season->name); ?></td>
                                <td class="py-3 px-4"><?php echo e($season->starts_on?->format('d M Y')); ?> - <?php echo e($season->ends_on?->format('d M Y')); ?></td>
                                <td class="py-3 px-4"><?php echo e($season->is_active ? 'Yes' : 'No'); ?></td>
                                <td class="py-3 pl-4">
                                    <form method="POST" action="<?php echo e(route('seasons.archive', $season)); ?>" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button class="text-slate-600 hover:text-brand-700 dark:text-slate-300" type="submit">Archive</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-6"><?php echo e($seasons->links()); ?></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views\seasons\index.blade.php ENDPATH**/ ?>