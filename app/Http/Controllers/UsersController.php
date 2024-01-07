<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = users::all();
        return view('users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function loginAuth(Request $request){
        // Validasi
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // ambil value dari input dan simpan di sebuah variabel
        $user = $request->only(['email', 'password']);
        // auth::attempt -> memasukan data user yg di input ke fitur auth laravel(Konfirmasi  proses authentication)
        if (Auth::attempt($user)) {
            // Kalau akun sesuai antara email & password nya, dan proses penyimpanan data ke auth nya berhasil dijalankan
            // Redirect: Ambil path routenya, redirect()->route(): Ambil name route
        
            // Get the authenticated user
            $authenticatedUser = Auth::user();
        
            // Check the user role
            if ($authenticatedUser->role == 'admin') {
                return redirect('/home');
            } elseif ($authenticatedUser->role == 'ps') {
                return redirect('/home-ps');
            } else {
                // Handle other roles if needed
                return redirect('/defaultHome');
            }
        } else {
            return redirect()->back()->with('failed', 'Email dan password tidak sesuai! Silahkan coba lagi!');
        }
        
    }
    public function logout() {
        // menghapus session atau data login (auth)
        Auth::logout();
        // setelah di hapus diarah ke 
        return redirect()->route('login');
    }
    public function create()
    {
        return view('users.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function daftar(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'nullable|min:6',
            'role' => 'required',
        ]);
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
    
        // Cek apakah password diisi, jika tidak, isi otomatis
        $password = $request->password ? $request->password : substr($request->email, 0, 3) . substr($request->name, 0, 3);
        $user->password = Hash::make($password);
    
        $user->role = $request->role;
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'Berhasil menambahkan data pengguna dengan password: ' . $password);
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
        $user = users::find($id);
        return view('users.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'nullable|alpha_dash',
        ]);

        $user = users::find($id);

        $password = $request->password ? bcrypt($request->password) : null;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $password,
        ]);

        return redirect()->route('users.index')->with('success', 'Berhasil menambahkan data pengguna dengan password: ' . $password);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $user = users::find($id); 
        // Rayons::where('id', $id)->delete();
        // $user = User::where('id', $id);
        // $user = User::find($id);
        // if (!$user) {
        //     return redirect()->back()->with('error', 'User tidak ditemukan.');
        // }
        // $userName = $user->name; // Sesuaikan dengan nama atribut yang ada di model User
        // $user->delete();
        // return redirect()->back()->with('success', 'Berhasil menghapus akun ' . $userName);
        user::where('id', $id)->delete();
        return redirect()->route('users.index')->with('deleted', 'Berhasil menghapus data!');
        
     }
}