

<?php $__env->startSection('page-title', $team->exists ? 'Edit Team' : 'Create Team'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['title' => $team->exists ? 'Edit team' : 'Create team','subtitle' => 'Keep team registrations clean, traceable, and easy to maintain.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($team->exists ? 'Edit team' : 'Create team'),'subtitle' => 'Keep team registrations clean, traceable, and easy to maintain.']); ?> <?php echo $__env->renderComponent(); ?>
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
        <form method="POST" action="<?php echo e($team->exists ? route('teams.update', $team) : route('teams.store')); ?>" enctype="multipart/form-data" class="grid gap-6 md:grid-cols-2">
            <?php echo csrf_field(); ?>
            <?php if($team->exists): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <div>
                <label class="label">Season</label>
                <select class="input" name="season_id">
                    <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($season->id); ?>" <?php if(old('season_id', $team->season_id) == $season->id): echo 'selected'; endif; ?>><?php echo e($season->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['season_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-rose-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="label">Team Name</label>
                <input class="input" type="text" name="name" value="<?php echo e(old('name', $team->name)); ?>">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-rose-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="label">Coach</label>
                <input class="input" type="text" name="coach_name" value="<?php echo e(old('coach_name', $team->coach_name)); ?>">
            </div>
            <div>
                <label class="label">City</label>
                <input class="input" type="text" name="city" value="<?php echo e(old('city', $team->city)); ?>">
            </div>
            <div>
                <label class="label">Contact Email</label>
                <input class="input" type="email" name="contact_email" value="<?php echo e(old('contact_email', $team->contact_email)); ?>">
            </div>
            <div>
                <label class="label">Contact Phone</label>
                <input class="input" type="text" name="contact_phone" value="<?php echo e(old('contact_phone', $team->contact_phone)); ?>">
            </div>
            <div>
                <label class="label">Budget</label>
                <input class="input" type="number" step="0.01" name="budget" value="<?php echo e(old('budget', $team->budget)); ?>">
            </div>
            <div>
                <label class="label">Logo</label>
                <input class="input" type="file" name="logo">
            </div>
            <div class="md:col-span-2">
                <label class="label">Notes</label>
                <textarea class="input min-h-32" name="notes"><?php echo e(old('notes', $team->notes)); ?></textarea>
            </div>
            <div class="md:col-span-2 flex gap-3">
                <button class="btn-primary" type="submit"><?php echo e($team->exists ? 'Update team' : 'Create team'); ?></button>
                <a class="btn-secondary" href="<?php echo e(route('teams.index')); ?>">Cancel</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views\teams\form.blade.php ENDPATH**/ ?>