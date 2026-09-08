<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    private array $members = [
        [
            'id' => 1,
            'nama' => 'Andi',
            'email' => 'andi@example.com',
            'telepon' => '081234567890',
        ],
        [
            'id' => 2,
            'nama' => 'Budi',
            'email' => 'budi@example.com',
            'telepon' => '081298765432',
        ],
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