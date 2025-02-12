<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('components.layouts.empty')] #[Title('Login')] class
    // <-- Here is the `empty` layout
    extends Component {
    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required')]
    public string $password = '';

    public function mount()
    {
        // It is logged in
        if (auth()->user()) {
            return redirect('/');
        }
    }

    public function login()
    {
        $credentials = $this->validate();

        if (auth()->attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->intended('/');
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }
};
?>




<div class="relative h-[100%] w-96 mx-auto">
    <img style="
                position: absolute;
                width: 700px;
                height: 700px;
                left: 10%;
                top: -300px;
                animation-delay: 1s;
                z-index: -999;
                animation-duration: 4.25s;
            "
        src="/img/blur.svg" class="animate-pulse-slow" />
    <x-mary-form wire:submit="login" class="mt-64 sm:mt-72">
        <x-mary-input class="border border-secondary" label="E-mail" wire:model="email" icon="o-envelope" inline />
        <x-mary-input class="border border-secondary" label="Password" wire:model="password" type="password"
            icon="o-key" inline />

        <x-slot:actions>
            <x-mary-button label="Criar uma conta" class="btn-ghost" link="/register" />
            <x-mary-button label="Login" type="submit" icon="o-paper-airplane" class="btn-secondary"
                spinner="login" />
        </x-slot:actions>
    </x-mary-form>
</div>
