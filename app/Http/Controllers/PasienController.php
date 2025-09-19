<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PasienController extends Controller
{
    protected string $baseUrl = 'https://mockapi.pkuwsb.id/api/patient';
    protected array $headers = [
        'X-username' => 'admin',
        'X-password' => 'secret',
    ];

    public function index(Request $request)
    {
        $response = Http::withHeaders($this->headers)
                        ->get($this->baseUrl, [
                            'search' => $request->get('search'),
                        ]);

        if ($response->failed()) {
            return back()->with('error', 'Gagal mengambil data pasien');
        }

        $patients = $response->json();
        return view('patients.index', [
            'patients' => $patients['data'] ?? []
        ]);
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rm_number'  => 'required|string',
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'gender'     => 'required|in:male,female',
        ]);

        $response = Http::withHeaders($this->headers)
                        ->post($this->baseUrl, $validated);

        return $response->successful()
            ? redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan')
            : back()->with('error', 'Gagal menambahkan pasien');
    }

    public function edit($id)
    {
        $response = Http::withHeaders($this->headers)
                        ->get($this->baseUrl . '/' . $id);

        if ($response->failed()) {
            return back()->with('error', 'Gagal mengambil data pasien');
        }

        $patient = $response->json();
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'rm_number'  => 'required|string',
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'gender'     => 'required|in:male,female',
        ]);

        // Pakai PATCH agar sesuai dengan kebanyakan mock API
        $response = Http::withHeaders($this->headers)
                        ->patch($this->baseUrl . '/' . $id, $validated);

        return $response->successful()
            ? redirect()->route('patients.index')->with('success', 'Data pasien berhasil diperbarui')
            : back()->with('error', 'Gagal memperbarui pasien');
    }

    public function destroy($id)
    {
        $response = Http::withHeaders($this->headers)
                        ->delete($this->baseUrl . '/' . $id);

        return $response->successful()
            ? redirect()->route('patients.index')->with('success', 'Data pasien berhasil dihapus')
            : back()->with('error', 'Gagal menghapus pasien');
    }
}
