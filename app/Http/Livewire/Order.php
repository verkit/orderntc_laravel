<?php

namespace App\Http\Livewire;

use App\Models\Order as ModelsOrder;
use Livewire\Component;

class Order extends Component
{
    public function render()
    {
        $order = ModelsOrder::distinct('noorder')->get();
        return view('livewire.order', compact('order'))->layout('layouts.dashboard');
    }
}
