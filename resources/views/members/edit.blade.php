@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')

    <h1>Edit Anggota</h1>

    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nama">Nama</label>
        <input
            type="text"
            name="nama"
            value="{{ old('nama', $member->nama) }}"
        >

        @error('nama')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="nim">NIM</label>
        <input
            type="text"
            name="nim"
            value="{{ old('nim', $member->nim) }}"
        >

        @error('nim')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="email">Email</label>
        <input
            type="email"
            name="email"
            value="{{ old('email', $member->email) }}"
        >

        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="nomor_telepon">Nomor Telepon</label>
        <input
            type="text"
            name="nomor_telepon"
            value="{{ old('nomor_telepon', $member->nomor_telepon) }}"
        >

        <label for="alamat">Alamat</label>
        <textarea
            name="alamat"
            rows="4"
        >{{ old('alamat', $member->alamat) }}</textarea>

        <label for="status">Status</label>
        <select name="status">
            <option
                value="aktif"
                @selected(old('status', $member->status) == 'aktif')
            >
                Aktif
            </option>

            <option
                value="nonaktif"
                @selected(old('status', $member->status) == 'nonaktif')
            >
                Nonaktif
            </option>
        </select>

        <br><br>

        <button type="submit" class="btn">
            Perbarui
        </button>
    </form>

@endsection