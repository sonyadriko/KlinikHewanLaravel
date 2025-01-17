<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hewan;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    // Controller Method for Index
public function index()
{
    // Get the logged-in user
    $user = Auth::user();

    // Fetch the user's animals
    $animals = $user->hewan; // Assuming there's a relationship defined in the User model like:
                              // public function hewan() { return $this->hasMany(Hewan::class, 'users_id'); }

    // Return the profile view with user and animal data
    return view('patient.profile.index', compact('user', 'animals'));
}

// Controller Method for Edit
public function edit()
{
    // Get the logged-in user
    $user = Auth::user();

    // If user is not authenticated, redirect to login with error message
    if (!$user) {
        return redirect()->route('login')->with('error', 'Data pengguna tidak ditemukan.');
    }

    // Return the edit view with the user data
    return view('patient.profile.edit', compact('user'));
}

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:255',
            'notelp' => 'required|string|max:15',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Data pengguna tidak ditemukan.');
        }

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
        ]);

        return redirect()->route('profile.index')->with('success', 'Data profil berhasil diubah!');
    }

    public function createHewan()
    {
        return view('patient.profile.add-hewan');
    }

    public function storeHewan(Request $request)
    {
        $request->validate([
            'nama_hewan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'jenis_hewan' => 'required|string',
            'ras_hewan' => 'nullable|string|max:255',
        ]);

        // $user = auth()->id();
        // dd($user);

        Hewan::create([
            'user_id' => auth()->id(),
            'nama_hewan' => $request->nama_hewan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jenis_hewan' => $request->jenis_hewan,
            'ras_hewan' => $request->ras_hewan,
        ]);

        return redirect()->route('profile.index')->with('success', 'Data hewan berhasil ditambahkan!');
    }

    public function editHewan($id)
    {
        // Retrieve the animal data by ID and ensure it belongs to the logged-in user
        $hewan = $this->getHewanByUser($id);
        return view('patient.profile.edit-hewan', compact('hewan'));
    }


    public function updateHewan(Request $request, $id)
    {
        $this->validateHewan($request);
        $hewan = $this->getHewanByUser($id);
        $hewan->update($request->only(['nama_hewan', 'jenis_kelamin', 'jenis_hewan', 'ras_hewan']));
        return redirect()->route('profile.index', $id)->with('success', 'Data hewan berhasil diubah!');
    }

    // Helper method to retrieve the animal by ID and user
    private function getHewanByUser($id)
    {
        return Hewan::where('id_hewan', $id)
                    ->where('users_id', auth()->id())
                    ->firstOrFail();
    }

    // Separate validation logic in a reusable method
    private function validateHewan(Request $request)
    {
        return $request->validate([
            'nama_hewan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'jenis_hewan' => 'required|in:Kucing,Anjing',
            'ras_hewan' => 'required|string|max:255',
        ]);
    }

    public function deleteHewan($id)
    {
        $hewan = $this->getHewanByUser($id);

        if (!$hewan) {
            return redirect()->route('profile.index')->with('error', 'Data hewan tidak ditemukan atau tidak memiliki izin untuk menghapusnya.');
        }

        // Delete the animal
        $hewan->delete();

        // Redirect back to the profile page with a success message
        return redirect()->route('profile.index')->with('success', 'Data hewan berhasil dihapus!');
    }




}
