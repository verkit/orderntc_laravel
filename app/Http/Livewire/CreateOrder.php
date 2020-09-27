<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use App\Models\Order;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateOrder extends Component
{

    /**
     * Inputan dari pencarian
     */

    public
        $key_barang,
        $key_pelanggan;

    /**
     * Variabel menampung hasil query pencarian dari key
     */

    public
        $data_pelanggan,
        $data_barang;

    /**
     * Variabel array dari barang dipilih
     * ditampilkan pada select option
     */

    public
        $opt_harga,
        $opt_satuan;

    /**
     * Variabel Utama
     */

    public
        $orders = [],
        $noorder,
        $pelanggan,
        $barang,
        $harga,
        $satuan,
        $qty,
        $total;

    /**
     * Validation
     */

    protected $rules = [
        'pelanggan' => 'required',
        'barang' => 'required',
        'harga' => 'required',
        'qty' => 'required|gte:1',
        'satuan' => 'required',
    ];

    protected $messages = [
        'pelanggan.required' => 'Pelanggan wajib dipilih',
        'barang.required' => 'Barang wajib dipilih',
        'harga.required' => 'Harga wajib dipilih',
        'satuan.required' => 'Satuan wajib dipilih',
        'qty.required' => 'Kuantitas wajib diisi',
        'qty.gte' => 'Kuantitas harus >= 1',
    ];

    /**
     * Mount function
     */

    public function mount()
    {
        $this->deletePelanggan();
        $this->deleteBarang();
        $this->total = 0;
        $this->setNoOrder();
    }

    public function setNoOrder(){
        $date = Carbon::now();
        $this->noorder = $date->isoFormat('YMD') . (($date->hour * 60) + $date->minute) . Auth::id();
    }

    public function resetAll()
    {
        $this->key_pelanggan = '';
        $this->key_barang = '';
    }

    public function render()
    {
        return view('livewire.create-order')->layout('layouts.dashboard');
    }

    /**
     * Pencarian pelanggan
     */

    public function updatedKeyPelanggan()
    {
        $this->data_pelanggan = Pelanggan::whereRaw('lower(nama_pelanggan) like (?)', '%' . strtolower($this->key_pelanggan) . '%')
            ->take(7)
            ->get()
            ->toArray();
    }

    public function resetKeyPelanggan()
    {
        $this->key_pelanggan = '';
    }

    /**
     * Pilih pelanggan
     */

    public function selectPelanggan($kode)
    {
        // Mengisi angka 0 dengan panjang 4
        $convert_code = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $this->pelanggan = Pelanggan::whereKodePelanggan($convert_code)->first()->toArray();

        $this->resetKeyPelanggan();
    }

    public function deletePelanggan()
    {
        $this->pelanggan = [];
    }

    /**
     * Pencarian Barang
     */

    public function updatedKeyBarang()
    {
        $this->data_barang = Barang::whereRaw('lower(nama_barang) like (?)', '%' . strtolower($this->key_barang) . '%')
            ->take(7)
            ->get()
            ->toArray();
    }

    public function resetKeyBarang()
    {
        $this->key_barang = '';
    }

    /**
     * Pilih barang
     */

    public function selectBarang($kode)
    {
        // Mengisi angka 0 dengan panjang 6
        $convert_code = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $this->barang = Barang::whereKodeBarang($convert_code)->first()->toArray();

        $this->deleteForm();
        $this->opt_harga = [
            $this->barang['hargajual1'],
            $this->barang['hargajual2'],
            $this->barang['hargajual3'],
        ];
        $this->opt_satuan = [
            $this->barang['kemasan1'],
            $this->barang['kemasan2'],
            $this->barang['kemasan3'],
        ];
        $this->resetKeyBarang();
    }

    public function deleteBarang()
    {
        $this->barang = [];
        $this->deleteForm();
    }

    public function deleteForm()
    {
        $this->opt_harga = null;
        $this->opt_satuan = null;
        $this->qty = '';
    }

    /**
     * Order
     */

    public function addItemOrder()
    {
        $this->validate();

        array_push($this->orders, [
            'kode_pelanggan' => str_pad($this->pelanggan['kode_pelanggan'], 4, "0", STR_PAD_LEFT),
            'nama_pelanggan' => $this->pelanggan['nama_pelanggan'],
            'kode_barang' => $this->barang['kode_barang'],
            'nama_barang' => $this->barang['nama_barang'],
            'harga' => $this->harga,
            'quantity' => $this->qty,
            'satuan' => $this->satuan,
        ]);

        $this->total = $this->total + ($this->harga * $this->qty);

        $this->deleteBarang();
        session()->flash('success', 'Berhasil menambahkan item');
    }

    public function deleteItemOrder($index)
    {
        // hapus 1 item sesuai dengan index
        array_splice($this->orders, $index, 1);
    }

    public function saveOrder()
    {
        foreach ($this->orders as $item) {
            Order::create([
                'kode_sales' => Auth::user()->sales->kode_sales,
                'nama_sales' => Auth::user()->sales->nama_sales,
                'kode_pelanggan' => $item['kode_pelanggan'],
                'nama_pelanggan' => $item['nama_pelanggan'],
                'kode_barang' => $item['kode_barang'],
                'nama_barang' => $item['nama_barang'],
                'harga' => $item['harga'],
                'quantity' => $item['quantity'],
                'tanggal' => Carbon::now()->toDateString(),
                'satuan' => $item['satuan'],
                'noorder' => $this->noorder,
            ]);
        }

        $this->orders = [];
        $this->deleteBarang();
        $this->deletePelanggan();
        $this->setNoOrder();
        session()->flash('success-order', 'Order berhasil ditambahkan');
    }
}
