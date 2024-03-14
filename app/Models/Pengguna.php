<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengguna extends Model
{
    use HasFactory;
    public function readData()
    {
        $data = DB::select("SELECT * FROM pengguna");
        return $data;
    }

    public function createData($request)
    {
        $nama = $request->nama;
        $password = md5($request->password);
        $email = $request->email;

        DB::insert("INSERT INTO pengguna(nama, password, email) VALUES('$nama','$password','$email')");
    }

    public function editData($id)
    {
        $data = DB::select("SELECT * FROM pengguna WHERE id = $id LIMIT 1");
        return $data[0];
    }

    public function updateData($request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $password = md5($request->password);
        $email = $request->email;

        DB::update("UPDATE pengguna SET nama = '$nama', password ='$password', email = '$email' WHERE id = $id");
    }

    public function checkData($id)
    {
        $data = DB::select("SELECT * FROM pengguna WHERE id = $id LIMIT 1");

        if (isset($data)) {
            return true;
        } else {
            false;
        }
    }

    public function deleteData($id)
    {
        return DB::delete("DELETE FROM pengguna WHERE id = ?", [$id]);
    }
}
