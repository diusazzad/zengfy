<!-- p:\Zengfy-Ecosystem\core\resources\views\components\landing\preloader.blade.php -->
@props(['version' => 'v1.2'])

<script>
    (function () {
        const version = '{{ $version }}';
        if (localStorage.getItem('zengfy_preloader_version') === version) {
            document.documentElement.style.overflow = 'auto';
            document.body.style.overflow = 'auto';
            document.write('<style>#preloader { display: none !important; }</style>');
        }
    })();
</script>

<div id="preloader">
    <div class="loader-container">
        <div class="loader-logo-inner">ZENGFY</div>
        <svg class="circular-loader" width="150" height="150">
            <circle class="loader-circle-bg" cx="75" cy="75" r="70"></circle>
            <circle id="progress-circle" class="loader-circle" cx="75" cy="75" r="70"></circle>
        </svg>
        <div id="loader-percentage">0%</div>
    </div>
    <p class="mt-8 text-gray-400 font-medium tracking-[0.2em] text-[10px] uppercase">Architecting Ecosystem</p>
</div>