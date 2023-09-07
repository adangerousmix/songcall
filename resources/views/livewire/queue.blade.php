<div>
    <livewire:createsong />
    @foreach($songs as $song)
        <x-list-item :item="$song" sub-value="request">
            @if($song->extra_life)
                <x-slot:avatar>
                    <x-badge value="${{ $song->donation }}" class="p-3 badge-primary" />
                </x-slot:avatar>
            @else
                <x-slot:avatar>
                    <x-badge value="$0" class="p-3 badge-neutral" />
                </x-slot:avatar>
            @endif

            <x-slot:value>
                    {{ $song->request }}
            </x-slot:value>
            <x-slot:sub-value>
                {{ $song->requester }}
            </x-slot:sub-value>
            <x-slot:actions>
                <x-button icon="o-check-circle" class="text-green-500" wire:click="delete({{ $song->id }})" spinner />
            </x-slot:actions>
        </x-list-item>
    @endforeach
</div>
