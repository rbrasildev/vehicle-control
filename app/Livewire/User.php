<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Users;


class User extends Component
{
    use WithPagination;

    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        $this->results = Users::where('name', 'like', '%' . $this->query . '%')->get();
    }

    public function render()
    {
        return view('livewire.user', ['user' => Users::paginate(5)]);
    }
}
