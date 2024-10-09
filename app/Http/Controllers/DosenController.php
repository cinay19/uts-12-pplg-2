<?php
namespace App\Http\Controllers;

use App\Models\LiaNaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DosenExport;
use PDF;


class DosenController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $utp = LiaNaya::where('nama_dosen', 'LIKE', "%{$query}%")
                    ->orWhere('nidn', 'LIKE', "%{$query}%")
                    ->orWhere('bidang_keilmuan', 'LIKE', "%{$query}%")
                    ->paginate(10); 

        return view('informasi', compact('utp'));
    }

    public function info() {
        $utp = LiaNaya::paginate(10);
        return view('informasi', compact('utp'));
    }
    public function index()
    {
        $utp = LiaNaya::paginate(10);
        return view('crud.index', compact('utp'));
    }

    public function create()
    {
        return view('crud.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|string|max:255|unique:lia_nayas',
            'nama_dosen' => 'required|string|max:255',
            'tgl_mulai_tugas' => 'required|date',
            'jenjang_pendidikan' => 'required|string|max:255',
            'bidang_keilmuan' => 'required|string|max:255',
            'foto_dosen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_dosen')) {
            // Store the uploaded image
            $data['foto_dosen'] = $request->file('foto_dosen')->store('dosen_images', 'public');
        }

        LiaNaya::create($data);

        return redirect()->route('index')->with('success', 'Dosen created successfully.');
    }

    public function edit(LiaNaya $utp)
{
    return view('crud.edit', compact('utp'));
}

    public function update(Request $request, LiaNaya $utp)
    {
        $request->validate([
            'nidn' => 'required|string|max:255|unique:lia_nayas,nidn,' . $utp->id, // Avoid error on unique check
            'nama_dosen' => 'required|string|max:255',
            'tgl_mulai_tugas' => 'required|date',
            'jenjang_pendidikan' => 'required|string|max:255',
            'bidang_keilmuan' => 'required|string|max:255',
            'foto_dosen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_dosen')) {
            // Delete old image if it exists
            if ($utp->foto_dosen) {
                Storage::disk('public')->delete($utp->foto_dosen);
            }

            // Store new image
            $data['foto_dosen'] = $request->file('foto_dosen')->store('dosen_images', 'public');
        }

        $utp->update($data);

        return redirect()->route('index')->with('success', 'Dosen updated successfully.');
    }

    public function destroy(LiaNaya $utp)
    {
        // Delete image from storage if it exists
        if ($utp->foto_dosen) {
            Storage::disk('public')->delete($utp->foto_dosen);
        }

        $utp->delete();

        return redirect()->route('index')->with('success', 'Dosen deleted successfully.');
    }

}

