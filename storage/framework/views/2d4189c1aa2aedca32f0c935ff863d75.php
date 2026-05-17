

<?php $__env->startSection('page-title', 'League Table'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['title' => 'League standings','subtitle' => 'Auto-sorted by points, goal difference, goals scored, and fair play.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'League standings','subtitle' => 'Auto-sorted by points, goal difference, goals scored, and fair play.']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a class="btn-primary" href="<?php echo e(route('league.standings.export')); ?>">Download PDF</a>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $attributes = $__attributesOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__attributesOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $component = $__componentOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__componentOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>

    <div class="card p-6">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500 dark:text-slate-400">Season</p>
                <p class="text-lg font-semibold text-slate-900 dark:text-white"><?php echo e($season->name); ?></p>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400"><?php echo e($standings->count()); ?> teams ranked</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm dark:divide-slate-800">
                <thead class="text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="py-3 pr-4">#</th>
                        <th class="py-3 px-4">Team</th>
                        <th class="py-3 px-4">P</th>
                        <th class="py-3 px-4">W</th>
                        <th class="py-3 px-4">D</th>
                        <th class="py-3 px-4">L</th>
                        <th class="py-3 px-4">GF</th>
                        <th class="py-3 px-4">GA</th>
                        <th class="py-3 px-4">GD</th>
                        <th class="py-3 px-4">Pts</th>
                        <th class="py-3 pl-4">Fair Play</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    <?php $__currentLoopData = $standings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="py-3 pr-4 font-semibold text-brand-700 dark:text-brand-300"><?php echo e($loop->iteration); ?></td>
                            <td class="py-3 px-4 font-medium text-slate-900 dark:text-white"><?php echo e($row['team_name']); ?></td>
                            <td class="py-3 px-4"><?php echo e($row['played']); ?></td>
                            <td class="py-3 px-4"><?php echo e($row['wins']); ?></td>
                            <td class="py-3 px-4"><?php echo e($row['draws']); ?></td>
                            <td class="py-3 px-4"><?php echo e($row['losses']); ?></td>
                            <td class="py-3 px-4"><?php echo e($row['goals_for']); ?></td>
                            <td class="py-3 px-4"><?php echo e($row['goals_against']); ?></td>
                            <td class="py-3 px-4"><?php echo e($row['goal_difference']); ?></td>
                            <td class="py-3 px-4 font-semibold"><?php echo e($row['points']); ?></td>
                            <td class="py-3 pl-4"><?php echo e($row['fair_play_points']); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views/league/standings.blade.php ENDPATH**/ ?>