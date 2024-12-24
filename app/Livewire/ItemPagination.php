<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DataSPKUA; // Pastikan untuk mengimpor model yang sesuai

class ItemPagination extends Component
{
    use WithPagination; // Menggunakan trait untuk pagination

    protected $paginationTheme = 'bootstrap'; // Tema pagination, bisa diubah sesuai kebutuhan

    public function render()
    {
        // Mengambil item dengan pagination
        $items = DataSPKUA::paginate(10); // Mengambil 10 item per halaman

        return view('livewire.item-pagination', [
            'items' => $items,
        ]);
    }
}
