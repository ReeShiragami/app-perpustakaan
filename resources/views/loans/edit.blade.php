@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')


<h1>Edit Peminjaman</h1>

<p>
    <a href="{{ route('loans.index') }}">
        &larr; Kembali ke daftar peminjaman
    </a>
</p>

<div>
    <strong>Anggota:</strong>
    {{ $loan->member->nama }} ({{ $loan->member->nim }})
</div>

<br>

<div>
    <strong>Petugas:</strong>
    {{ $loan->user->name }}
</div>

<br>

<div>
    <strong>Buku:</strong>
    @forelse ($loan->loanItems as $item)
        {{ $item->book->judul }}@if (!$loop->last), @endif
    @empty
        Tidak ada buku
    @endforelse
</div>

<br>

<form action="{{ route('loans.update', $loan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input
        type="hidden"
        name="tanggal_pinjam"
        value="{{ $loan->tanggal_pinjam }}"
    >

    <div>
        <label for="tanggal_kembali">Tanggal Kembali</label>
        <input
            type="date"
            name="tanggal_kembali"
            id="tanggal_kembali"
            value="{{ old('tanggal_kembali', $loan->tanggal_kembali) }}"
        >

        @error('tanggal_kembali')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>

    <div>
        <label for="status">Status</label>

        <select name="status" id="status">
            <option value="dipinjam"
                @selected(old('status', $loan->status) === 'dipinjam')>
                Dipinjam
            </option>

            <option value="dikembalikan"
                @selected(old('status', $loan->status) === 'dikembalikan')>
                Dikembalikan
            </option>

            <option value="terlambat"
                @selected(old('status', $loan->status) === 'terlambat')>
                Terlambat
            </option>
        </select>

        @error('status')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>

    <button type="submit">Perbarui</button>
</form>

@endsection
