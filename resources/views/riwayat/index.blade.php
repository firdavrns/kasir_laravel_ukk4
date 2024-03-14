@extends('layout.layout')
@section('content')
<div class="container-fluid">
    <div class="">
        <table class="table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Nota</th>
                    <th>Tanggal</th>
                    <th>Nama Produk</th>
                    <th>Nama Pelanggan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nomor_nota }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->nama_pelanggan ?? 'Umum' }}</td>
                    <td>{{ $item->harga }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->subtotal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
