<?php

use Livewire\Volt\Component;
use App\Models\User;
use Mary\Traits\Toast;
use Livewire\WithFileUploads;

new class extends Component {
    use Toast, WithFileUploads;

    public array $rules = [
        'name' => ['required'],
        'email' => ['required', 'email'],
        'photo' => ['nullable', 'image', 'max:1024'],
    ];

    // Component parameter
    public User $user;


    public string $name = '';


    public string $email = '';

    public mixed $photo = null;
    
    public function mount(): void
    {
        $this->fill($this->user);
    }
    public function save()
    {
        $data = $this->validate();

        $this->user->update($data);

        // Upload file and save the avatar `url` on User model
        if ($this->photo) {
            $url = $this->photo->store('users', 'public');
            $this->user->update(['avatar' => "/storage/$url"]);
        }

        $this->success('User updated.', redirectTo: '/users');
    }
}; ?>

<div>
    <x-mary-header title="Update {{ $user->name }}" separator />

    <x-mary-form wire:submit="save">
        <x-mary-file label="Avatar" wire:model="photo" accept="image/png, image/jpeg" ... crop-after-change>
            <img src="{{ $user->avatar ?? '/empty-user.jpg' }}" class="h-40 rounded-lg" />
        </x-mary-file>

        <x-mary-input label="Name" wire:model="name" />
        <x-mary-input label="Email" wire:model="email" />


        <x-slot:actions>
            <x-mary-button label="Cancel" link="/users" />
            <x-mary-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
        </x-slot:actions>
    </x-mary-form>
</div>
