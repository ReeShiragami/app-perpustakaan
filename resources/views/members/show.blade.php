@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')

    <h1>Detail Anggota</h1>

    <table>
        <tr>
            <th>ID</th>
            <td>{{ $member->id }}</td>
        </tr>

        <tr>
            <th>Nama</th>
            <td>{{ $member->nama }}</td>
        </tr>

        <tr>
            <th>NIM</th>
            <td>{{ $member->nim }}</td>
        </tr>

        <tr>
            <th>Email</th>
            <td>{{ $member->email }}</td>
        </tr>

        <tr>
            <th>Nomor Telepon</th>
            <td>{{ $member->nomor_telepon }}</td>
        </tr>

        <tr>
            <th>Alamat</th>
            <td>{{ $member->alamat }}</td>
        </tr>

        <tr>
            <th>Status</th>
            <td>{{ $member->status }}</td>
        </tr>
    </table>

    <h2>Riwayat Peminjaman</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($member->loans as $loan)
                <tr>
                    <td>{{ $loan->id }}</td>
                    <td>{{ $loan->tanggal_pinjam }}</td>
                    <td>{{ $loan->tanggal_kembali }}</td>
                    <td>{{ $loan->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada riwayat peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p>
        <a href="{{ route('members.index') }}">
            Kembali
        </a>
    </p>

@endsection