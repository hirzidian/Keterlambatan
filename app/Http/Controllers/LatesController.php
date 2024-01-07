<?php

namespace App\Http\Controllers;

use App\Models\lates;
use Illuminate\Http\Request;
use App\Models\students;
use App\Models\rayons;
use App\Models\rombels;
// use App\Models\User;
use Excel;
use PDF;
use App\Exports\LatesExport;


class LatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lates = lates::all();
        $students = lates::with('student')->simplePaginate(10);
        return view('lates.index', compact('lates', 'students'));
    }

    public function rekap()
    {
        $lates = lates::all();
        $students = lates::with('student')->simplePaginate(10);
        $grup = $lates->groupBy('student.nis');
        return view('lates.rekap', compact('lates', 'students', 'grup'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        $lates = lates::all();
        $students = lates::with('student')->simplePaginate(10);
        // $request->session()->put('search_query', $query);
        $latesearch = lates::whereHas('student', function ($studentQuery) use ($searchQuery) {
            $studentQuery->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('nis', 'like', '%' . $searchQuery . '%');
        })
            ->orWhere('date_time_late', 'like', '%' . $searchQuery . '%')
            ->orWhere('information', 'like', '%' . $searchQuery . '%')
            ->get();

        return view('lates.index', compact('latesearch', 'lates', 'students', 'searchQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = students::all();
        $lates = lates::all();
        return view('lates.create', compact('students', 'lates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'student_id' => 'required',
        ]);
        $imageName = time() . '.' . $request->bukti->extension();

        $request->bukti->move(public_path('images'), $imageName);

        lates::create([
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $imageName,
            'student_id' => $request->student_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data keterlambatan!');
    }

    /**
     * Display the specified resource.
     */
    public function detail($nis)
    {
        $students = students::all();
        $lates = Lates::whereHas('student', function ($query) use ($nis) {
            $query->where('nis', $nis);
        })->get();
        $grup = $lates->groupBy('student.nis');
        $totalKeterlambatan = $lates->count();
        $rombels = rombels::all();
        $rayons = rayons::all();
        return view('lates.detail', compact('lates', 'students', 'grup', 'totalKeterlambatan', 'rombels', 'rayons'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $students = students::all();
        $lates = lates::find($id);
        return view('lates.edit', compact('students', 'lates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'student_id' => 'required',
        ]);

        $imageName = time() . '.' . $request->bukti->extension();

        $request->bukti->move(public_path('images'), $imageName);

        lates::where('id', $id)->update([
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $imageName,
            'student_id' => $request->student_id
        ]);

        return redirect()->route('lates.index')->with('success', 'Berhasil mengubah data!');
    }

    public function exportExcel()
    {
        $file_name = 'data_pembelian' . '.xlsx';
        return Excel::download(new LatesExport, $file_name);
    }

    public function createPDF($studentId)
    {
        $student = students::with('rombels', 'rayons')->find($studentId);

        $lates = lates::whereHas('student', function ($query) use ($studentId) {
            $query->where('student_id', $studentId);
        })->get();

        $grup = $lates->groupBy('student.nis');

        $pdf = PDF::loadView('lates.print.download', compact('student', 'grup'));
        $pdfFileName = 'terlambat_' . $studentId . 'pdf';

        return $pdf->download($pdfFileName);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        lates::where('id', $id)->delete();
        return redirect()->back()->with('Deleted', 'Berhasil menghapus data');
    }
}
