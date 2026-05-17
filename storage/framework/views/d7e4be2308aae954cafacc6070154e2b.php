<div>
    <label class="label">Season</label>
    <select class="input" name="season_id">
        <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($season->id); ?>" <?php if(old('season_id', $team->season_id ?? null) == $season->id): echo 'selected'; endif; ?>><?php echo e($season->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div>
    <label class="label">Team Name</label>
    <input class="input" type="text" name="name" value="<?php echo e(old('name', $team->name ?? '')); ?>">
</div>
<div>
    <label class="label">Coach</label>
    <input class="input" type="text" name="coach_name" value="<?php echo e(old('coach_name', $team->coach_name ?? '')); ?>">
</div>
<div>
    <label class="label">City</label>
    <input class="input" type="text" name="city" value="<?php echo e(old('city', $team->city ?? '')); ?>">
</div>
<div>
    <label class="label">Contact Email</label>
    <input class="input" type="email" name="contact_email" value="<?php echo e(old('contact_email', $team->contact_email ?? '')); ?>">
</div>
<div>
    <label class="label">Contact Phone</label>
    <input class="input" type="text" name="contact_phone" value="<?php echo e(old('contact_phone', $team->contact_phone ?? '')); ?>">
</div>
<div>
    <label class="label">Budget</label>
    <input class="input" type="number" step="0.01" name="budget" value="<?php echo e(old('budget', $team->budget ?? '')); ?>">
</div>
<div>
    <label class="label">Logo</label>
    <input class="input" type="file" name="logo">
</div>
<div class="md:col-span-2">
    <label class="label">Notes</label>
    <textarea class="input min-h-32" name="notes"><?php echo e(old('notes', $team->notes ?? '')); ?></textarea>
</div><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views/teams/_form_fields.blade.php ENDPATH**/ ?>