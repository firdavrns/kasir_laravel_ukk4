@extends('layout.layout')
@section('content')
<div class="container mb-3">
    <form action="{{ route('produk.update') }}" method="post">
    @csrf
    <input type="text"value="{{ $data->id }}" name="id" id="id" readonly hidden>
        <div class="form-control mt-3 mb-3">
        <label for="">Nama</label>
        <input value="{{ $data->nama }}" type="text" name="nama" id="nama" required>
    </div>
    <div class="form-control mt-3 mb-3">
        <label for="">Harga</label>
        <input value="{{ $data->harga }}" type="number" min="0" name="harga" id="harga" required>
    </div>
    <div class="form-control mt-3 mb-3">
        <label for="">Stok</label>
        <input value="{{ $data->stok }}" type="number" min="0" name="stok" id="stok" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    {{-- <button type="submit" class="btn btn-secondary">Reset</button> --}}
    </form>
</div>
@endsection
