<div wire:poll.1s>
    @if ($isOnline)
        <i class="bx bx-wifi text-lg text-green-500"></i>
    @else
        <i class="bx bx-wifi text-lg text-red-500"></i>
    @endif
</div>
