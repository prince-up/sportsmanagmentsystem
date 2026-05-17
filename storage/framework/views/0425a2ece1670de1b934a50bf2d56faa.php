

<?php $__env->startSection('page-title', 'Players'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['title' => 'Players','subtitle' => 'Manage squad lists, jersey numbers, performance data, and injuries.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Players','subtitle' => 'Manage squad lists, jersey numbers, performance data, and injuries.']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a class="btn-primary" href="<?php echo e(route('players.create')); ?>">Add player</a>
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
        <form class="mb-6 grid gap-4 lg:grid-cols-[1fr_220px_auto]" method="GET">
            <input class="input" type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search players or positions...">
            <select class="input" name="team_id">
                <option value="">All teams</option>
                <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($team->id); ?>" <?php if(request('team_id') == $team->id): echo 'selected'; endif; ?>><?php echo e($team->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button class="btn-secondary" type="submit">Filter</button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                <thead class="text-left text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="py-3 pr-4">Player</th>
                        <th class="py-3 px-4">Team</th>
                        <th class="py-3 px-4">Pos</th>
                        <th class="py-3 px-4">Age</th>
                        <th class="py-3 px-4">Rating</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 pl-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="py-3 pr-4 font-medium text-slate-900 dark:text-white"><?php echo e($player->full_name); ?></td>
                            <td class="py-3 px-4"><?php echo e($player->team?->name); ?></td>
                            <td class="py-3 px-4">#<?php echo e($player->jersey_number); ?> · <?php echo e($player->position); ?></td>
                            <td class="py-3 px-4"><?php echo e($player->age); ?></td>
                            <td class="py-3 px-4"><?php echo e($player->rating); ?></td>
                            <td class="py-3 px-4"><?php echo e(str_replace('_', ' ', $player->injury_status)); ?></td>
                            <td class="py-3 pl-4">
                                <div class="flex items-center gap-3">
                                    <a class="text-slate-600 hover:text-brand-700 dark:text-slate-300" href="<?php echo e(route('players.edit', $player)); ?>">Edit</a>
                                    <form method="POST" action="<?php echo e(route('players.destroy', $player)); ?>" onsubmit="return confirm('Delete this player?')">
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

        <div class="mt-6"><?php echo e($players->links()); ?></div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views\players\index.blade.php ENDPATH**/ ?>