
<?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container py-4">
    <div class="row">
        <div class="col-12 py-4">
            <?php echo $__env->make('components.banner', [
                'title' => 'Home Page',
                'dark' => true,
                'button' => 'Register now!',
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-12 col-lg-6">
            <?php echo $__env->make('components.banner', [
                'title' => 'Free Account!',
                'button' => 'Register now!',
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-12 col-lg-6">
            <?php echo $__env->make('components.banner', [
                'title' => 'Special offers!',
                'dark' => true,
                'button' => 'Register now!',
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <div class="col-12">
        
            <?php dump(get_defined_vars()); ?>
        </div>
        <div class="col-12">
            <?php echo '<svg version="1.1" width="100" height="100" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" xml:space="preserve"><rect fill="#000" width="100" height="100"/><text fill="#FFF" font-size="10px" font-weight="bold" font-family="Raleway, Helvetica, sans-serif" transform="matrix(1 0 0 1 16.666666666667 55)">POLKRYPTEX</text></svg>'; ?>
        </div>
    </div>
</div>

<div class="container py-4">
    <footer class="pt-3 mt-4 text-muted border-top">
        Polkryptex © <?php echo e(date('Y')); ?>

    </footer>
</div>

<?php echo $__env->make('components.toast-container', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH E:\www\rdev\polkryptex\app\common\views/home.blade.php ENDPATH**/ ?>