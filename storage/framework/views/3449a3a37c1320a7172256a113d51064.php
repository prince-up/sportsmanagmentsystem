

<?php $__env->startSection('page-title', 'Venues'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['title' => 'Venues','subtitle' => 'Track capacity, location, and availability for match scheduling.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Venues','subtitle' => 'Track capacity, location, and availability for match scheduling.']); ?> <?php echo $__env->renderComponent(); ?>
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
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Add venue</h2>
            <form method="POST" action="<?php echo e(route('venues.store')); ?>" class="grid gap-4">
                <?php echo csrf_field(); ?>
                <input class="input" type="text" name="name" placeholder="Venue name">
                <input class="input" type="text" name="city" placeholder="City">
                <input class="input" type="text" name="location" placeholder="Location">
                <input class="input" type="number" name="capacity" placeholder="Capacity">
                <select class="input" name="availability_status">
                    <option value="available">Available</option>
                    <option value="limited">Limited</option>
                    <option value="closed">Closed</option>
                </select>
                <textarea class="input min-h-28" name="notes" placeholder="Notes"></textarea>
                <button class="btn-primary" type="submit">Save venue</button>
            </form>
        </div>

        <div class="card p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                    <thead class="text-left text-slate-500 dark:text-slate-400">
                        <tr>
                            <th class="py-3 pr-4">Venue</th>
                            <th class="py-3 px-4">City</th>
                            <th class="py-3 px-4">Capacity</th>
                            <th class="py-3 px-4">Availability</th>
                            <th class="py-3 pl-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php $__currentLoopData = $venues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="py-3 pr-4 font-medium text-slate-900 dark:text-white"><?php echo e($venue->name); ?></td>
                                <td class="py-3 px-4"><?php echo e($venue->city); ?></td>
                                <td class="py-3 px-4"><?php echo e(number_format($venue->capacity)); ?></td>
                                <td class="py-3 px-4"><?php echo e(ucfirst($venue->availability_status)); ?></td>
                                <td class="py-3 pl-4">
                                    <form method="POST" action="<?php echo e(route('venues.destroy', $venue)); ?>" onsubmit="return confirm('Delete this venue?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="text-rose-600 hover:text-rose-700" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-6"><?php echo e($venues->links()); ?></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views/venues/index.blade.php ENDPATH**/ ?>