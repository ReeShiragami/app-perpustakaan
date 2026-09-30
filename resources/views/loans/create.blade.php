@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')


<h1>Tambah Peminjaman</h1>

<form action="{{ route('loans.store') }}" method="POST">
    @csrf

    <div>
        <label for="member_id">Anggota</label>
        <select name="member_id" id="member_id" required>
            <option value="">-- Pilih Anggota --</option>

            @foreach ($members as $member)
                <option value="{{ $member->id }}">
                    {{ $member->nama }} - {{ $member->nim }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label for="user_id">Petugas</label>
        <select name="user_id" id="user_id" required>
            @foreach (\App\Models\User::all() as $user)
                <option value="{{ $user->id }}">
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label for="tanggal_pinjam">Tanggal Pinjam</label>
        <input
            type="date"
            name="tanggal_pinjam"
            id="tanggal_pinjam"
            value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
            required
        >
    </div>

    <br>

    <div>
        <label for="tanggal_kembali">Tanggal Kembali</label>
        <input
            type="date"
            name="tanggal_kembali"
            id="tanggal_kembali"
            value="{{ old('tanggal_kembali') }}"
            required
        >
    </div>

    <br>
    <div>
        <label>Buku yang Dipinjam</label>

        <div class="checkbox-list">
            @forelse ($books as $book)
                <label>
                    <input
                        type="checkbox"
                        name="book_ids[]"
                        value="{{ $book->id }}"
                        @checked(in_array($book->id, old('book_ids', [])))
                    >
                    {{ $book->judul }} (stok: {{ $book->stok }})
                </label>
            @empty
                <p>Belum ada data buku.</p>
            @endforelse
        </div>

        @error('book_ids')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>
    <br>

    <button type="submit">Simpan</button>
    <a href="{{ route('loans.index') }}">Batal</a>
</form>

@endsection
