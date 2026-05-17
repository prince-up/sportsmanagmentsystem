<?php if (isset($component)) { $__componentOriginal1e6834b7596effc838ab3adb1475b477 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1e6834b7596effc838ab3adb1475b477 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.guest','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.guest'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Forgot password</h2>
    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">We will email a reset link to your inbox.</p>

    <form method="POST" action="<?php echo e(route('password.email')); ?>" class="mt-6 space-y-4">
        <?php echo csrf_field(); ?>
        <div>
            <label class="label">Email</label>
            <input class="input" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
        </div>
        <div class="flex items-center justify-between gap-3">
            <a class="text-sm font-medium text-brand-700 hover:text-brand-800" href="<?php echo e(route('login')); ?>">Back to login</a>
            <button class="btn-primary" type="submit">Send reset link</button>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1e6834b7596effc838ab3adb1475b477)): ?>
<?php $attributes = $__attributesOriginal1e6834b7596effc838ab3adb1475b477; ?>
<?php unset($__attributesOriginal1e6834b7596effc838ab3adb1475b477); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1e6834b7596effc838ab3adb1475b477)): ?>
<?php $component = $__componentOriginal1e6834b7596effc838ab3adb1475b477; ?>
<?php unset($__componentOriginal1e6834b7596effc838ab3adb1475b477); ?>
<?php endif; ?><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views\auth\forgot-password.blade.php ENDPATH**/ ?>