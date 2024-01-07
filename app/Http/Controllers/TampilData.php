<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rayons;
use App\Models\rombels;
use App\Models\students;
use App\Models\users;
use Illuminate\Support\Facades\Auth;

class TampilData extends Controller
{

    public function index()
    {
        // Mengambil data dari Database Pertama
        $data_rayons = rayons::all();
        $jumlah_data_rayons = $data_rayons->count();

        // Mengambil data dari Database Kedua
        $data_rombels = rombels::all();
        $jumlah_data_rombels = $data_rombels->count();

        // Mengambil data dari Database Ketiga
        $data_students = students::all();
        $jumlah_data_students = $data_students->count();

        $data_users = users::all();
        // Menghitung jumlah data berdasarkan tipe 'admin'
        $jumlah_data_users1 = 0;

        // Menghitung jumlah data berdasarkan tipe 'ps'
        $jumlah_data_users2 = 0;

        foreach ($data_users as $user) {
            if ($user['type'] === 'admin') {
                $jumlah_data_users1++;
            } elseif ($user['type'] === 'ps') {
                $jumlah_data_users2++;
            }
        }



        // push data ke view
        return view('home', compact('jumlah_data_rayons', 'jumlah_data_rombels', 'jumlah_data_students', 'jumlah_data_users1', 'jumlah_data_users2', 'data_users'));
    }
    /**
     * Display a listing of the resource.
     */

    public function indexSiswa()
    {
        $userIdLogin = Auth::id();
        $rayonIdLogin = rayons::where('user_id', $userIdLogin)->value('id');
        $totalStudents = students::where('rayon_id', $rayonIdLogin)->count();
        // $totalLates = students::where('rayonIdLogin', $rayonIdLogin)->with('lates')->get()->sum(function ($studentent) {
        //     return $studentent->lates->count();
        // });
        $todayLates = students::where('rayon_id', $rayonIdLogin)->whereHas('lates', function ($query) {
            $query->whereDate('created_at', now()->toDateString());
        })->count();

        return view('homePs', compact('totalStudents', 'todayLates', 'rayonIdLogin'));
    }

    public function tampil()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
