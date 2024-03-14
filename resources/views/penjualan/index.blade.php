@extends('layout.layout')
@section('content')

@php
    if (session('isNew')) {
        $nomor_nota = '';
    } else {
        $nomor_nota = $nota;
    }

@endphp

<h3 class="text-center">penjualan</h3>
@if (session('error'))
<div class="alert alert-warning">{{ session('error') }}</div>
@endif
<div class="container mb-3">
    <form action="{{ route('penjualan.store') }}" method="post">
    @csrf
        <div class="form-control mt-3 mb-3">
        <label for="">Nota</label>
        <input type="text" value="{{ session('error') ? '' : $nomor_nota }}" name="nota" id="nota" readonly>
    </div>
    <div class="form-control mt-3 mb-3">
        <label for="">Produk</label>
        <select name="produk_id" id="">
            @foreach ($data_produk as $produk)
            <option value="{{ $produk->id. '_'. (float)$produk->harga }}">{{ $produk->nama }} - {{ $produk->harga }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-control mt-3 mb-3">
        <label for="">Pelanggan</label>
        <select name="pelanggan_id" id="">
            @foreach ($data_pelanggan as $pelanggan)
            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-control mt-3 mb-3">
        <label for="">Jumlah</label>
        <input type="number" min="0" name="jumlah" id="jumlah" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('penjualan.new', ['nota' => urlencode($nota)]) }}" class="btn btn-warning">Pindah Nota</a>
    </form>
</div>

<div class="container-fluid">
    <div class="">
        <table class="table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_penjualan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->harga_produk }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->subtotal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
