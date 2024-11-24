<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Users;


class User extends Component
{
    use WithPagination;

    public $perPage = "5";
    public $search = '';



    public function delete($userId)
    {
        User::find($userId)->delete();
    }


    public function render()
    {
        return view('livewire.user', ['user' => Users::search($this->search)->paginate($this->perPage)]);
    }
}
