<?php

namespace App\Http\Controllers;

use App\Models\Rayons;
use App\Models\user;
use Illuminate\Http\Request;

class RayonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //panggil data yang mau di tampilkan 
        $rayon = Rayons::all();
        //html yang di munculkan di index.balde.php folder rayon, lalu kirim data yang di ambil malalui (isi compact dengan nama variabel)
        return view('rayons.index', compact('rayon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = user::where('role', 'ps')->get();
        return view('rayons.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'rayon' => 'required|min:3',
            'user_id' => 'required',
        ]);

        Rayons::create([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        // Redirect back with a success flash message
        return redirect()->back()->with('success', 'Berhasil menambah data rayon!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rayons $rayons)
    {
        //
    }

public function edit($id)
{
    $rayons = Rayons::with('user')->findOrFail($id);
    $user = User::all();

    return view('rayons.edit', compact('rayons', 'user'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'rayon' => 'required|min:3',
        'user_id' => 'required',
    ]);

    $rayon = Rayons::findOrFail($id);

    $rayon->update([
        'rayon' => $request->rayon,
        'user_id' => $request->user_id,
    ]);

    return redirect()->route('rayons.index')->with('success', 'Data updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari pengguna berdasarkan ID
        Rayons::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Pengguna!');
    }
}
