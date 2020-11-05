<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Produk',
            'data' => $produks
        ], 200);
    }

    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nama_produk'     => 'required',
            'harga_produk'   => 'required',
            'kategori_produk'   => 'required',
            'keterangan_produk'   => 'required',
            'status_produk'   => 'required'
        ],
            [
                'nama_produk.required' => 'Masukkan Nama Produk !',
                'harga_produk.required' => 'Masukkan Harga Produk !',
                'kategori_produk.required' => 'Masukkan Kategori Produk !',
                'keterangan_produk.required' => 'Masukkan Keterangan Produk !',
                'status_produk.required' => 'Masukkan Status Produk !'
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Kolom Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $produk = Produk::create([
                'nama_produk'     => $request->input('nama_produk'),
                'harga_produk'   => $request->input('harga_produk'),
                'kategori_produk'   => $request->input('kategori_produk'),
                'keterangan_produk'   => $request->input('keterangan_produk'),
                'status_produk'   => $request->input('status_produk')
            ]);


            if ($produk) {
                return response()->json([
                    'success' => true,
                    'message' => 'Produk Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk Gagal Disimpan!',
                ], 400);
            }
        }
    }

    public function show($id)
    {
        $produk = Produk::whereId($id)->first();

        if ($produk) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Produk!',
                'data'    => $produk
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Produk Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nama_produk'     => 'required',
            'harga_produk'   => 'required',
            'kategori_produk'   => 'required',
            'keterangan_produk'   => 'required',
            'status_produk'   => 'required'
        ],
            [
                'nama_produk.required' => 'Masukkan Nama Produk !',
                'harga_produk.required' => 'Masukkan Harga Produk !',
                'kategori_produk.required' => 'Masukkan Kategori Produk !',
                'keterangan_produk.required' => 'Masukkan Keterangan Produk !',
                'status_produk.required' => 'Masukkan Status Produk !'
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $produk = Produk::whereId($request->input('id'))->update([
                'nama_produk'     => $request->input('nama_produk'),
                'harga_produk'   => $request->input('harga_produk'),
                'kategori_produk'   => $request->input('kategori_produk'),
                'keterangan_produk'   => $request->input('keterangan_produk'),
                'status_produk'   => $request->input('status_produk')
            ]);


            if ($produk) {
                return response()->json([
                    'success' => true,
                    'message' => 'Produk Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk Gagal Diupdate!',
                ], 500);
            }

        }

    }


    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        if ($produk) {
            return response()->json([
                'success' => true,
                'message' => 'Produk Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Produk Gagal Dihapus!',
            ], 500);
        }

    }



}
