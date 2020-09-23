<?php

namespace App\Http\Livewire;

use App\Models\Barang as ModelsBarang;
use Livewire\Component;

class Barang extends Component
{
    public function render()
    {
        $barang = ModelsBarang::all();
        return view('livewire.barang', compact('barang'))->layout('layouts.dashboard');
    }
}
