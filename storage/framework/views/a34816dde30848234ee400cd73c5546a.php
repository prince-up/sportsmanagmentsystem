<div>
    <label class="label">Team</label>
    <select class="input" name="team_id">
        <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($team->id); ?>" <?php if(old('team_id', $player->team_id ?? null) == $team->id): echo 'selected'; endif; ?>><?php echo e($team->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div>
    <label class="label">Season</label>
    <select class="input" name="season_id">
        <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($season->id); ?>" <?php if(old('season_id', $player->season_id ?? null) == $season->id): echo 'selected'; endif; ?>><?php echo e($season->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div>
    <label class="label">Full Name</label>
    <input class="input" type="text" name="full_name" value="<?php echo e(old('full_name', $player->full_name ?? '')); ?>">
</div>
<div>
    <label class="label">Jersey Number</label>
    <input class="input" type="number" name="jersey_number" value="<?php echo e(old('jersey_number', $player->jersey_number ?? '')); ?>">
</div>
<div>
    <label class="label">Position</label>
    <input class="input" type="text" name="position" value="<?php echo e(old('position', $player->position ?? '')); ?>">
</div>
<div>
    <label class="label">Date of Birth</label>
    <input class="input" type="date" name="date_of_birth" value="<?php echo e(old('date_of_birth', optional($player->date_of_birth ?? null)->format('Y-m-d'))); ?>">
</div>
<div>
    <label class="label">Age</label>
    <input class="input" type="number" name="age" value="<?php echo e(old('age', $player->age ?? '')); ?>">
</div>
<div>
    <label class="label">Injury Status</label>
    <select class="input" name="injury_status">
        <?php $__currentLoopData = ['fit','minor_injury','major_injury','recovering']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($status); ?>" <?php if(old('injury_status', $player->injury_status ?? 'fit') === $status): echo 'selected'; endif; ?>><?php echo e(str_replace('_', ' ', $status)); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div>
    <label class="label">Rating</label>
    <input class="input" type="number" step="0.1" name="rating" value="<?php echo e(old('rating', $player->rating ?? '')); ?>">
</div>
<div>
    <label class="label">Market Value</label>
    <input class="input" type="number" step="0.01" name="market_value" value="<?php echo e(old('market_value', $player->market_value ?? '')); ?>">
</div>
<div class="md:col-span-2">
    <label class="label">Bio</label>
    <textarea class="input min-h-32" name="bio"><?php echo e(old('bio', $player->bio ?? '')); ?></textarea>
</div><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views/players/_form_fields.blade.php ENDPATH**/ ?>