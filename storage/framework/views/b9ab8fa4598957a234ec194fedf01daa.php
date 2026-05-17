

<?php $__env->startSection('page-title', $player->exists ? 'Edit Player' : 'Add Player'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['title' => $player->exists ? 'Edit player' : 'Add player','subtitle' => 'Record jersey numbers, age bands, and stats in a consistent way.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($player->exists ? 'Edit player' : 'Add player'),'subtitle' => 'Record jersey numbers, age bands, and stats in a consistent way.']); ?> <?php echo $__env->renderComponent(); ?>
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
        <form method="POST" action="<?php echo e($player->exists ? route('players.update', $player) : route('players.store')); ?>" class="grid gap-6 md:grid-cols-2">
            <?php echo csrf_field(); ?>
            <?php if($player->exists): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <div>
                <label class="label">Team</label>
                <select class="input" name="team_id">
                    <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($team->id); ?>" <?php if(old('team_id', $player->team_id) == $team->id): echo 'selected'; endif; ?>><?php echo e($team->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="label">Season</label>
                <select class="input" name="season_id">
                    <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($season->id); ?>" <?php if(old('season_id', $player->season_id) == $season->id): echo 'selected'; endif; ?>><?php echo e($season->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="label">Full Name</label>
                <input class="input" type="text" name="full_name" value="<?php echo e(old('full_name', $player->full_name)); ?>">
            </div>
            <div>
                <label class="label">Jersey Number</label>
                <input class="input" type="number" name="jersey_number" value="<?php echo e(old('jersey_number', $player->jersey_number)); ?>">
            </div>
            <div>
                <label class="label">Position</label>
                <input class="input" type="text" name="position" value="<?php echo e(old('position', $player->position)); ?>">
            </div>
            <div>
                <label class="label">Date of Birth</label>
                <input class="input" type="date" name="date_of_birth" value="<?php echo e(old('date_of_birth', optional($player->date_of_birth)->format('Y-m-d'))); ?>">
            </div>
            <div>
                <label class="label">Age</label>
                <input class="input" type="number" name="age" value="<?php echo e(old('age', $player->age)); ?>">
            </div>
            <div>
                <label class="label">Injury Status</label>
                <select class="input" name="injury_status">
                    <?php $__currentLoopData = ['fit','minor_injury','major_injury','recovering']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status); ?>" <?php if(old('injury_status', $player->injury_status) === $status): echo 'selected'; endif; ?>><?php echo e(str_replace('_', ' ', $status)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="label">Rating</label>
                <input class="input" type="number" step="0.1" name="rating" value="<?php echo e(old('rating', $player->rating)); ?>">
            </div>
            <div>
                <label class="label">Market Value</label>
                <input class="input" type="number" step="0.01" name="market_value" value="<?php echo e(old('market_value', $player->market_value)); ?>">
            </div>
            <div class="md:col-span-2">
                <label class="label">Bio</label>
                <textarea class="input min-h-32" name="bio"><?php echo e(old('bio', $player->bio)); ?></textarea>
            </div>
            <div class="md:col-span-2 flex gap-3">
                <button class="btn-primary" type="submit"><?php echo e($player->exists ? 'Update player' : 'Save player'); ?></button>
                <a class="btn-secondary" href="<?php echo e(route('players.index')); ?>">Cancel</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views/players/form.blade.php ENDPATH**/ ?>