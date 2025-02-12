<?php

use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

new class extends Component {
    public array $headers = [['key' => 'avatar', 'label' => 'Avatar', 'class' => 'w-1'], ['key' => 'name', 'label' => 'Nome', 'class' => 'w-1'], ['key' => 'email', 'label' => 'email', 'class' => 'w-1']];
    public string $search = '';
    public $users;

    public function mount(): void
    {
        $this->users = $this->users();
    }

    public function users(): Collection
    {
        return User::query()
            ->when($this->search, fn(Builder $q) => $q->where('name', 'like', "%$this->search%"))
            ->get();
    }

    public function delete(User $user): void
    {
        $user->delete();
        $this->warning("$user->name deleted", 'Good bye!', position: 'toast-bottom');
    }
};

?>

<div>
    <x-mary-header title="Users" subtitle="Check this on mobile">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-funnel" />
            <x-mary-button icon="o-plus" class="btn-primary" link="/register" />
        </x-slot:actions>
    </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$users" striped>
        @scope('cell_avatar', $user)
            <x-mary-avatar image="{{ $user->avatar ?? '/empty-user.jpg' }}" class="!w-10" />
        @endscope
        @scope('actions', $user)
            <x-mary-button icon="o-trash" wire:click="delete({{ $user->id }})" spinner class="btn-sm" />
        @endscope
    </x-mary-table>
</div>
