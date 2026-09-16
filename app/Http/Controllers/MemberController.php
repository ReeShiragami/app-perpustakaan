<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
// File: app/Http/Controllers/MemberController.php
    private array $members = [
        ['id' => 1, 'nama' => 'Siti Aminah', 'nim' => '2310501001', 'email' => 'siti.aminah@pens.ac.id', 'nomor_telepon' => '081234567890', 'status' => 'aktif'],
        ['id' => 2, 'nama' => 'Budi Santoso', 'nim' => '2310501002', 'email' => 'budi.santoso@pens.ac.id', 'nomor_telepon' => '081298765432', 'status' => 'aktif'],
        ['id' => 3, 'nama' => 'Dewi Lestari', 'nim' => '2310501003', 'email' => 'dewi.lestari@pens.ac.id', 'nomor_telepon' => '081211122233', 'status' => 'nonaktif'],
    ];

    public function index()
    {
    $members = $this->members;

    return view('members.index', compact('members'));
    }
    
    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telepon' => 'required|string|max:20',
        ]);

        return redirect()
            ->route('members.index')
            ->with('success', "Member {$validated['nama']} berhasil ditambahkan.");
    }
}