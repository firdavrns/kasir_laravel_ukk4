<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penjualan extends Model
{
    use HasFactory;
    public function readData()
    {
        $nota = $this->readNota();
        if (session('isNew') || session('error')) {
            $where = "WHERE p.nomor_nota = '0'";
        } else {
            $where = "WHERE p.nomor_nota = '$nota'";
        }
        return DB::select(
            "SELECT pr.nama as nama_produk,
            pr.harga as harga_produk,
            dp.jumlah,
            dp.subtotal,
            pl.nama as nama_pelanggan,
            p.tanggal,
            p.nomor_nota

            FROM penjualan as p
            join detail_penjualan as dp on p.id = dp.penjualan_id
            join pelanggan as pl on p.pelanggan_id = pl.id
            join produk as pr on dp.produk_id = pr.id
            $where"
        );
    }

    public function readNota()
    {
        return DB::select(
            "SELECT nomor_nota AS nota FROM penjualan ORDER BY id DESC LIMIT 1;"
        )[0]->nota ?? 0;
    }

    public function storeDataPenjualan($data)
    {
        $exploded = explode('_', $data->produk_id);
        $produk_id = $exploded[0];
        $jumlah = $data->jumlah;

        $checkStok = DB::select(
            "SELECT stok FROM produk
            WHERE id = $produk_id
            LIMIT 1"
        )[0]->stok ?? 0;

        if ($jumlah > $checkStok) {
            return false;
        }

        $pelanggan_id = $data->pelanggan_id;
        $tanggal = now('Asia/Jakarta');
        $nota = $data->nota ? $data->nota : "KSR#" . date('Ymd') . str_pad(
            rand(1, 1000),
            4,
            "0",
            STR_PAD_LEFT
        );

        if (!isset($data->nota)) {
            if (
                DB::insert(
                    "INSERT INTO penjualan (tanggal, total, pelanggan_id, nomor_nota)
                    VALUES('$tanggal', 0, $pelanggan_id, '$nota')"
                )
            ) {
                $penjualan_id = DB::select("select last_insert_id() as id")[0]->id;
                $this->storeDataDetailPenjualan($penjualan_id, $data);
            } else {
                return;
            }

        } else {
            $penjualan_id = DB::select(
                "SELECT id FROM penjualan WHERE nomor_nota = '$nota'"
            )[0]->id;
            $this->storeDataDetailPenjualan($penjualan_id, $data);
        }
        return true;
    }

    public function storeDataDetailPenjualan($penjualan_id, $data)
    {
        $exploded = explode('_', $data->produk_id);
        $produk_id = $exploded[0];
        $harga = $exploded[1];
        $jumlah = $data->jumlah;
        $subtotal = $harga * $jumlah;

        DB::insert(
            "INSERT INTO detail_penjualan(
                penjualan_id,
                produk_id,
                jumlah,
                subtotal)
                VALUES(
                    $penjualan_id,
                    $produk_id,
                    $jumlah,
                    $subtotal
            );"
        );
        DB::update(
            "UPDATE produk SET stok = stok - $jumlah
            WHERE id = $produk_id;"
        );
    }

    public function updateTotalPenjualan($nota)
    {
        $penjualan_id = DB::select(
            "SELECT id
            FROM penjualan WHERE nomor_nota = '$nota'"
        )[0]->id ?? 0;
        $total = (float) DB::select(
            "SELECT sum(subtotal) AS total
            FROM detail_penjualan
            WHERE penjualan_id = '$penjualan_id'"
        )[0]->total ?? 0;

        DB::update(
            "UPDATE penjualan SET total = $total
            WHERE id = $penjualan_id"
        );
    }
}
