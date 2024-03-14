@extends('layout.layout')
@section('content')
@if (session('berhasil'))
<div class="alert alert-success">{{ session('berhasil') }}</div>
@elseif(session('gagal'))
<div class="alert alert-danger">{{ session('gagal') }}</div>
@endif

<h3 class="text-center">Produk</h3>
<div class="container mb-3">
    <form action="{{ route('produk.create') }}" method="post">
    @csrf
        <div class="form-control mt-3 mb-3">
        <label for="">Nama</label>
        <input type="text" name="nama" id="nama" required>
    </div>
    <div class="form-control mt-3 mb-3">
        <label for="">Harga</label>
        <input type="number" min="0" name="harga" id="harga" required>
    </div>
    <div class="form-control mt-3 mb-3">
        <label for="">Stok</label>
        <input type="number" min="0" name="stok" id="stok" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
</div>

<div class="container-fluid">
    <div class="">
        <table class="table-bordered">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Harga</td>
                    <td>Stok</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->harga }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>
                        <a href="{{ route('produk.edit', ['id'=>$item->id]) }}" class="btn btn-warning mb-1">Edit</a>
                        <form action="{{ route('produk.delete', $item->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
