<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #0f172a; }
        h1 { font-size: 20px; margin-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #cbd5e1; padding: 8px; text-align: left; }
        th { background: #e2e8f0; }
    </style>
</head>
<body>
    <h1><?php echo e($season->name); ?> Standings</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Team</th>
                <th>P</th>
                <th>W</th>
                <th>D</th>
                <th>L</th>
                <th>GF</th>
                <th>GA</th>
                <th>GD</th>
                <th>Pts</th>
                <th>Fair Play</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $standings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($row['team_name']); ?></td>
                    <td><?php echo e($row['played']); ?></td>
                    <td><?php echo e($row['wins']); ?></td>
                    <td><?php echo e($row['draws']); ?></td>
                    <td><?php echo e($row['losses']); ?></td>
                    <td><?php echo e($row['goals_for']); ?></td>
                    <td><?php echo e($row['goals_against']); ?></td>
                    <td><?php echo e($row['goal_difference']); ?></td>
                    <td><?php echo e($row['points']); ?></td>
                    <td><?php echo e($row['fair_play_points']); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views\exports\standings.blade.php ENDPATH**/ ?>