<x-slot name="header">
    <div class="col-sm-6">
        <h4 class="page-title">Tambah Order</h4>
    </div>
</x-slot>
<div class="row" wire:click="resetAll">
    <div class="col-sm-12">
        <div class="card m-b-30">
            <div class="card-body">
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                </div>
                @endif
                <form>
                    <!-- Pelanggan -->
                    <div class="form-group row">
                        <label class="col-sm-12">Pelanggan</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Pilih pelanggan..."
                                wire:model.debounce.400ms="key_pelanggan" wire:keydown.escape="resetKeyPelanggan"
                                wire:keydown.tab="resetKeyPelanggan" />

                            <div wire:loading wire:target='key_pelanggan' class="list-group shadow">
                                <div class="list-item">Searching...</div>
                            </div>

                            @if(!empty($key_pelanggan))
                            <div class="list-group shadow">
                                @if(!empty($data_pelanggan))
                                @foreach($data_pelanggan as $i => $item)
                                <a class="list-group-item"
                                    wire:click='selectPelanggan({{ $item['kode_pelanggan'] }})'>{{ $item['nama_pelanggan'] }}</a>
                                @endforeach
                                @else
                                <div class="list-group-item">No results!</div>
                                @endif
                            </div>
                            @endif

                            @error('pelanggan') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-5 input-group">
                            <input class="form-control" readonly
                                value="{{ $pelanggan ? $pelanggan['nama_pelanggan'] : null}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" wire:click='deletePelanggan'><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Barang -->
                    <div class="form-group row">
                        <label class="col-sm-12">Barang</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Pilih barang..."
                                wire:model.debounce.400ms="key_barang" wire:keydown.escape="resetKeyBarang"
                                wire:keydown.tab="resetKeyBarang" />

                            <div wire:loading wire:target='key_barang' class="list-group shadow">
                                <div class="list-item">Searching...</div>
                            </div>

                            @if(!empty($key_barang))
                            <div class="list-group shadow">
                                @if(!empty($data_barang))
                                @foreach($data_barang as $i => $item)
                                <a class="list-group-item"
                                    wire:click='selectBarang({{ (int)$item['kode_barang'] }})'>{{ $item['nama_barang'] }}</a>
                                @endforeach
                                @else
                                <div class="list-group-item">No results!</div>
                                @endif
                            </div>
                            @endif
                            @error('barang') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-5 input-group">
                            <input class="form-control" readonly value="{{ $barang ? $barang['nama_barang'] : null}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" wire:click='deleteBarang'><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <select class="form-control" wire:model='harga'>
                            @if ($opt_harga)
                            <option selected>Pilih</option>
                            @foreach ($opt_harga as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('harga') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-8 col-xs-8 col-form-label">Kuantitas</label>
                        <label for="" class="col-4 col-xs-4 col-form-label">Satuan</label>
                        <div class="col-sm-8">
                            <input type="number" class='form-control' wire:model='qty'>
                            @error('qty') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" wire:model="satuan">
                                @if ($opt_satuan)
                                <option selected>Pilih</option>
                                @foreach ($opt_satuan as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('satuan') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{-- <button type="button" wire:click='addItemOrder' class="btn btn-primary">Baru</button> --}}
                            <button type="button" wire:click='addItemOrder' class="btn btn-secondary">Tambah</button>
                            <button type="button" wire:click='saveOrder' class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                @if (session()->has('success-order'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success-order') }}
                </div>
                @endif
                @if ($orders)
                <h4 class="mt-0 mb-3 header-title">
                    No order : #{{ $noorder }}
                </h4>
                @endif
                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Pelanggan</th>
                            <th>Barang</th>
                            <th>Satuan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $i => $item)
                        <tr>
                            <td>
                                <button type="button" wire:click="deleteItemOrder({{ $i }})"
                                    class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                            <td>{{ $item['nama_pelanggan'] }}</td>
                            <td>{{ $item['nama_barang'] }}</td>
                            <td>{{ $item['satuan'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['harga'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    @if ($orders)
                    <tfoot>
                        <tr>
                            <td colspan='5' class='text-right'>Total</td>
                            <th>{{ $total }}</th>
                        </tr>
                    </tfoot>
                    @endif
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div>
