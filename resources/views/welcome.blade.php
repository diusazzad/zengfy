<x-layouts.landing>
    <x-landing.hero />

    <x-landing.service-hub />

    <x-landing.service-grid :services="$services" />

    <x-landing.features :features="$features" />

    <x-landing.cta />
</x-layouts.landing>