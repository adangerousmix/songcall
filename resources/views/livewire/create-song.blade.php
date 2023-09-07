<div>
    <form wire:submit="save">
        <input type="hidden" wire:model="form.request">
        <div>
            @error('form.request') <span class="error">{{ $message }}</span> @enderror
        </div>

        <input type="hidden" wire:model="form.requester">
        <div>
            @error('form.requester') <span class="error">{{ $message }}</span> @enderror
        </div>

        <input type="checkbox" wire:model="form.extra_life">
        <div>
            @error('form.extra_life') <span class="error">{{ $message }}</span> @enderror
        </div>

        <input type="hidden" wire:model="form.donation">
        <div>
            @error('form.donation') <span class="error">{{ $message }}</span> @enderror
        </div>
    </form>
</div>
