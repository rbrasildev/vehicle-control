<?php
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('components.layouts.empty')] #[Title('Login')] class extends Component {
    #[Rule('required|email')]
    public string $email = '';
    #[Rule('required')]
    public string $password = '';
    public string $name = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    public function mount()
    {
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

        $this->addError('email', 'As credenciais fornecidas não correspondem aos nossos registros.');
    }
};
?>
<div class="md:w-96 mx-auto mt-20">
    <div class="pt-12 text-center sm:pt-20">
        <h1 class="mx-auto px-16 text-center text-5xl font-semibold leading-tight sm:text-6xl">Registrar</h1>

        <p class="mx-auto mt-8 max-w-xl text-xl font-normal text-gray-400">Faça seu registro para entrar no sistema</p>
    </div>

    <div class="mb-10">
        <img src="/img/blur.svg" class="animate-pulse-slow absolute top-0 left-24 w-96 h-96" />
    </div>

    <x-mary-form wire:submit="register">
        <x-mary-input class="border border-secondary" label="Name" wire:model="name" icon="o-user" inline />
        <x-mary-input class="border border-secondary" label="E-mail" wire:model="email" icon="o-envelope" inline />
        <x-mary-input class="border border-secondary" label="Password" wire:model="password" type="password"
            icon="o-key" inline />
        <x-mary-input class="border border-secondary" label="Confirm Password" wire:model="password_confirmation"
            type="password" icon="o-key" inline />

        <x-slot:actions>
            <x-mary-button label="Já tem uma conta?" class="btn-ghost" link="/login" />
            <x-mary-button label="Registrar" type="submit" icon="o-paper-airplane" class="btn-secondary"
                spinner="register" />
        </x-slot:actions>
    </x-mary-form>
</div>
