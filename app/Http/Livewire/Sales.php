<?php

namespace App\Http\Livewire;

use App\Models\Sales as ModelsSales;
use Livewire\Component;

class Sales extends Component
{
    public function render()
    {
        $sales = ModelsSales::all();
        return view('livewire.sales', compact('sales'))->layout('layouts.dashboard');
    }
}
