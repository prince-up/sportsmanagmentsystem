

<?php $__env->startSection('page-title', 'Teams'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['title' => 'Teams','subtitle' => 'Register and maintain club profiles, budgets, and contacts.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Teams','subtitle' => 'Register and maintain club profiles, budgets, and contacts.']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a class="btn-primary" href="<?php echo e(route('teams.create')); ?>">Create team</a>
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
        <form class="mb-6 grid gap-4 md:grid-cols-[1fr_auto]" method="GET">
            <input class="input" type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search teams, city, coach...">
            <button class="btn-secondary" type="submit">Search</button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                <thead class="text-left text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="py-3 pr-4">Team</th>
                        <th class="py-3 px-4">Coach</th>
                        <th class="py-3 px-4">City</th>
                        <th class="py-3 px-4">Budget</th>
                        <th class="py-3 px-4">Players</th>
                        <th class="py-3 px-4">QR</th>
                        <th class="py-3 pl-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="py-3 pr-4 font-medium text-slate-900 dark:text-white">
                                <a class="hover:text-brand-600" href="<?php echo e(route('teams.show', $team)); ?>"><?php echo e($team->name); ?></a>
                            </td>
                            <td class="py-3 px-4"><?php echo e($team->coach_name); ?></td>
                            <td class="py-3 px-4"><?php echo e($team->city); ?></td>
                            <td class="py-3 px-4">$<?php echo e(number_format((float) $team->budget, 2)); ?></td>
                            <td class="py-3 px-4"><?php echo e($team->players->count()); ?></td>
                            <td class="py-3 px-4"><a class="text-brand-700 underline" href="<?php echo e(route('teams.qr', $team)); ?>" target="_blank">View</a></td>
                            <td class="py-3 pl-4">
                                <div class="flex items-center gap-3">
                                    <a class="text-slate-600 hover:text-brand-700 dark:text-slate-300" href="<?php echo e(route('teams.edit', $team)); ?>">Edit</a>
                                    <form method="POST" action="<?php echo e(route('teams.destroy', $team)); ?>" onsubmit="return confirm('Delete this team?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="text-rose-600 hover:text-rose-700" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6"><?php echo e($teams->links()); ?></div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views/teams/index.blade.php ENDPATH**/ ?>