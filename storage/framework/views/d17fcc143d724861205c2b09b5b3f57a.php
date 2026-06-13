<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['judul', 'nilai', 'ikon', 'warna' => 'blue']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['judul', 'nilai', 'ikon', 'warna' => 'blue']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="stat-card stat-<?php echo e($warna); ?>">
    <div class="stat-icon"><?php echo e($ikon); ?></div>
    <div class="stat-info">
        <p class="stat-judul"><?php echo e($judul); ?></p>
        <h3 class="stat-nilai"><?php echo e($nilai); ?></h3>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\BioAquaLab\BioAquaLab\resources\views/components/stat-card.blade.php ENDPATH**/ ?>