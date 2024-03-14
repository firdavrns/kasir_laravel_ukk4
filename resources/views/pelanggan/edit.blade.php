@extends('layout.layout')
@section('content')
@if (session('berhasil'))
<div class="alert alert-success">{{ session('berhasil') }}</div>
@elseif(session('gagal'))
<div class="alert alert-danger">{{ session('gagal') }}</div>
@endif

<h3 class="text-center"> Edit pelanggan</h3>
<div class="container mb-3">
    <form action="{{ route('pelanggan.update') }}" method="post">
    @csrf
    <input type="text" value="{{ $data->id }}" name="id" id="id" readonly hidden>
        <div class="form-control mt-3 mb-3">
        <label for="">Nama</label>
        <input type="text" value="{{ $data->nama }}" name="nama" id="nama" required>
    </div>
    <div class="form-control mt-3 mb-3">
        <label for="">Alamat</label>
        <input type="text" value="{{ $data->alamat }}" name="alamat" id="alamat" required>
    </div>
    <div class="form-control mt-3 mb-3">
        <label for="">No .Telp</label>
        <input type="number" value="{{ $data->nomor_telepon }}" min="0" name="nomor_telepon" id="nomor_telepon" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
</div>

@endsection
