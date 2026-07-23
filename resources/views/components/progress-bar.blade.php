@props(['persen' => 0, 'label' => ''])
<div>
    @if($label)
        <div class="flex justify-between text-sm mb-1">
            <span>{{ $label }}</span>
            <span class="font-semibold">{{ number_format($persen, 1) }}%</span>
        </div>
    @endif
    <div class="w-full bg-white rounded-full h-3 overflow-hidden border border-sage/40">
        <div class="h-3 rounded-full bg-gradient-to-r from-sage to-peach transition-all"
             style="width: {{ min(100, max(0, $persen)) }}%"></div>
    </div>
</div>
