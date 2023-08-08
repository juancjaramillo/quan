<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersTable extends Component
{
    public function render()
    {
        $users = User::all();
        return view('livewire.users-table', compact('users'));
    }
}
