
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Laporan Peminjaman</h1>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Anggota</th>
                <th>Petugas</th>
                <th>Tanggal Pinjam</th>
                <th>Batas Kembali</th>
                <th>Status</th>
                <th>Daftar Buku</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($loans as $loan)
                <tr>
                    <td>{{ $loan['id'] }}</td>
                    <td>{{ $loan['member']['nama'] ?? '-' }}</td>
                    <td>{{ $loan['petugas']['name'] ?? '-' }}</td>
                    <td>{{ $loan['tanggal_pinjam'] }}</td>
                    <td>{{ $loan['tanggal_kembali'] }}</td>
                    <td>{{ $loan['status'] }}</td>
                    <td>
                        @foreach ($loan['books'] ?? [] as $book)
                            {{ $book['judul'] }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
