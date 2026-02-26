@props([
    'title' => null,
    'subtitle' => null,
    'actions' => null,
])

<section {{ $attributes->merge(['class' => 'bg-white/90 backdrop-blur-sm border border-slate-200 shadow-sm']) }} style="border-radius: 20px !important; ">
    @if ($title || $actions)
        <div class="flex items-start justify-between gap-3 px-4 pt-4 pb-2 lg:px-5">
            <div>
                @if ($title)
                    <h2 class="text-sm font-semibold text-slate-900">
                        {{ $title }}
                    </h2>
                @endif
                @if ($subtitle)
                    <p class="mt-0.5 text-xs text-slate-500">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>
            @if ($actions)
                <div class="shrink-0">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif

    <div class="px-4 pb-4 pt-1 lg:px-5 lg:pb-5">
        {{ $slot }}
    </div>
</section>
