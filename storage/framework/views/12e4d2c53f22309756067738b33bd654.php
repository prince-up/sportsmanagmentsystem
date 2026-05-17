<select class="input" name="season_id">
    <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($season->id); ?>" <?php if(old('season_id', $match->season_id ?? null) == $season->id): echo 'selected'; endif; ?>><?php echo e($season->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<select class="input" name="venue_id">
    <?php $__currentLoopData = $venues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($venue->id); ?>" <?php if(old('venue_id', $match->venue_id ?? null) == $venue->id): echo 'selected'; endif; ?>><?php echo e($venue->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<select class="input" name="home_team_id">
    <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($team->id); ?>" <?php if(old('home_team_id', $match->home_team_id ?? null) == $team->id): echo 'selected'; endif; ?>><?php echo e($team->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<select class="input" name="away_team_id">
    <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($team->id); ?>" <?php if(old('away_team_id', $match->away_team_id ?? null) == $team->id): echo 'selected'; endif; ?>><?php echo e($team->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<input class="input" type="datetime-local" name="match_date" value="<?php echo e(old('match_date', isset($match->match_date) ? $match->match_date->format('Y-m-d\TH:i') : '')); ?>">
<select class="input" name="status">
    <?php $__currentLoopData = ['scheduled','live','completed','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($status); ?>" <?php if(old('status', $match->status ?? 'scheduled') === $status): echo 'selected'; endif; ?>><?php echo e(ucfirst($status)); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views/matches/_form_fields.blade.php ENDPATH**/ ?>