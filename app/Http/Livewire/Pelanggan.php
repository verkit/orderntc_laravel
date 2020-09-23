<?php

namespace App\Http\Livewire;

use App\Models\Pelanggan as ModelsPelanggan;
use Livewire\Component;

class Pelanggan extends Component
{
    public function render()
    {
        $pelanggan = ModelsPelanggan::all();
        return view('livewire.pelanggan', compact('pelanggan'))->layout('layouts.dashboard');
    }
}
