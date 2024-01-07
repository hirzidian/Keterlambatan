<?php

namespace App\Http\Controllers;

use App\Models\students;
use Illuminate\Http\Request;
use App\Models\rombels;
use App\Models\rayons;
use Illuminate\Support\Facades\Auth;


class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = students::with('rayons', 'rombels')->get();
        return view('students.index', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengganti variabel $rombel_id dan $rayon_id dengan data yang sesuai
        $rombel = rombels::all();
        $rayon = rayons::all();
        return view('students.create', compact('rombel', 'rayon'));
    }
    
    public function siswa(Request $request)
    {
        $userIdLogin = Auth::id();
        $rayonIdLogin = rayons::where('user_id', $userIdLogin)->value('id');

        $perPage = $request->input('perPage', 5);
        $search = $request->input('search');

        $students = students::with('rayons', 'rombels')
            ->where('rayon_id', $rayonIdLogin)
            ->when($search, function ($query) use ($search) {
                $query->where('nis', 'LIKE', '%' . $search . '%')
                    ->orWhere('name', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('created_at', 'ASC')
            ->paginate($perPage);

        return view('students.ps.data_user_ps', compact('students', 'perPage', 'search'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required|string',
            'rayon_id' => 'required|string',
        ]);


        students::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Berhasil menambahkan data student!');
    }


    /**
     * Display the specified resource.
     */
    public function show(students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $students = Students::find($id);
        $rombels = rombels::all();
        $rayons = rayons::all();
    
        return view('students.edit', compact('students', 'rombels', 'rayons'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required|string',
            'rayon_id' => 'required|string',
        ]);


        Students::where('id', $id)->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Berhasil menambahkan data student!');
    }

    /**
     * Delete the specified resource.
     */
    public function delete($id)
    {
        // $student=Students::findOrFail($id);
        // $student->delete();
        Students::where('id', $id)->delete();

        return redirect()->route('students.index')->with('deleted', 'Berhasil menghapus data!');
    }

    // public function destroy($id)
    // {
    //     Students::where('id', $id)->delete();

    //     return redirect()->back()->with('success', 'Anda berhasil menghapus data');
    // }
}