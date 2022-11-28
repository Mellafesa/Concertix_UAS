<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pembayaran;

class pembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = pembayaran::all();
        return $pembayaran;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = pembayaran::create([
            "ewallet_tujuan" => $request->ewallet_tujuan,
            "jumlah" => $request->jumlah,
            "ewallet_pengirim" => $request->ewallet_pengirim,
            "nama_pengirim" => $request->nama_pengirim,
            "tanggal_transfer" => $request->tanggal_transfer,
            "waktu_transfer" => $request->waktu_transfer,
        ]);

        return response()->json([
           'success' => 201,
           'message' => "Data pembayaran berhasil disimpan",
           'data' => $table
        ],
        201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembayaran = pembayaran::find($id);
        if ($pembayaran) {
            return response()->json([
                'status' => 200,
                'data' => $pembayaran
            ], 200);
        } else {
            return response()->json([
                'status'=> 404,
                'message' => 'id atas ' . $id . ' tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pembayaran = pembayaran::find($id);
        if($pembayaran){
            $pembayaran->ewallet_tujuan = $request->ewallet_tujuan ? $request->ewallet_tujuan : $pembayaran->ewallet_tujuan;
            $pembayaran->jumlah = $request->jumlah ? $request->jumlah : $pembayaran->jumlah;
            $pembayaran->ewallet_pengirim = $request->ewallet_pengirim ? $request->ewallet_pengirim : $pembayaran->ewallet_pengirim;
            $pembayaran->nama_pengirim = $request->nama_pengirim ? $request->nama_pengirim : $pembayaran->nama_pengirim;
            $pembayaran->tanggal_transfer = $request->tanggal_transfer ? $request->tanggal_transfer : $pembayaran->tanggal_transfer;
            $pembayaran->waktu_transfer = $request->waktu_transfer ? $request->waktu_transfer : $pembayaran->waktu_transfer;
            $pembayaran->save();
            return response()->json([
                'status' => 200,
                'data' => $pembayaran
            ],200);

        }else{
            return response()->json([
                'status'=>404,
                'message'=> $id . 'tidak ditemukan'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembayaran = pembayaran::where('id', $id)->first();
        if($pembayaran){
            $pembayaran->delete();
            return response()->json([
                'status' =>200,
                'data' => $pembayaran
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'id' .$id .'tidak ditemukan'
            ],404);
        }
    }
}
