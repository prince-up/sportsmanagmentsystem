

<?php $__env->startSection('page-title', 'Matches'); ?>

<?php $__env->startSection('content'); ?>
    <div x-data="{ open: false }">
        <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['title' => 'Matches','subtitle' => 'Schedule fixtures, update live scores, and keep match history organized.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Matches','subtitle' => 'Schedule fixtures, update live scores, and keep match history organized.']); ?>
             <?php $__env->slot('actions', null, []); ?> 
                <button class="btn-primary" type="button" @click="open = true">Schedule match</button>
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

        <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['id' => 'match-create-modal','title' => 'Schedule match']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'match-create-modal','title' => 'Schedule match']); ?>
            <form method="POST" action="<?php echo e(route('matches.store')); ?>" class="grid gap-4 md:grid-cols-2">
                <?php echo csrf_field(); ?>
                <?php echo $__env->make('matches._form_fields', ['match' => new \App\Models\MatchModel(), 'seasons' => $seasons, 'venues' => $venues, 'teams' => $teams], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <div class="md:col-span-2 flex gap-3">
                    <button class="btn-primary" type="submit">Create match</button>
                    <button class="btn-secondary" type="button" @click="open = false">Cancel</button>
                </div>
            </form>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>

        <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
            <div class="card p-6">
                <form class="mb-6 flex gap-3" method="GET">
                    <select class="input" name="status">
                        <option value="">All statuses</option>
                        <?php $__currentLoopData = ['scheduled','live','completed','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status); ?>" <?php if(request('status') === $status): echo 'selected'; endif; ?>><?php echo e(ucfirst($status)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button class="btn-secondary" type="submit">Filter</button>
                </form>

                <div class="space-y-4">
                    <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($prediction = $predictions[$match->id]); ?>
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400"><?php echo e($match->match_date?->format('d M, H:i')); ?></p>
                                    <p class="mt-1 font-medium text-slate-900 dark:text-white"><?php echo e($match->homeTeam?->name); ?> vs <?php echo e($match->awayTeam?->name); ?></p>
                                    <p class="text-sm text-slate-500 dark:text-slate-400"><?php echo e($match->venue?->name ?? 'Venue pending'); ?> · <?php echo e(ucfirst($match->status)); ?></p>
                                </div>
                                <div class="text-right text-sm">
                                    <p class="font-semibold text-slate-900 dark:text-white">Prediction: <?php echo e($prediction['winner']); ?></p>
                                    <p class="text-slate-500 dark:text-slate-400"><span data-match-score="<?php echo e($match->id); ?>"><?php echo e($prediction['home_score']); ?> - <?php echo e($prediction['away_score']); ?></span> | <?php echo e($prediction['confidence']); ?>%</p>
                                </div>
                            </div>
                            <?php if($match->status === 'live' || $match->status === 'completed'): ?>
                                <p class="mt-3 text-sm font-medium text-brand-700 dark:text-brand-300"><?php echo e($match->home_score); ?> - <?php echo e($match->away_score); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-6"><?php echo e($matches->links()); ?></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views/matches/index.blade.php ENDPATH**/ ?>