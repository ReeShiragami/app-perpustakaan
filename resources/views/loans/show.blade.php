@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')

```
<h1>Detail Peminjaman</h1>

<table>
    <tr>
        <th>ID</th>
        <td>{{ $loan->id }}</td>
    </tr>

    <tr>
        <th>Anggota</th>
        <td>{{ $loan->member->nama }}</td>
    </tr>

    <tr>
        <th>NIM</th>
        <td>{{ $loan->member->nim }}</td>
    </tr>

    <tr>
        <th>Petugas</th>
        <td>{{ $loan->user->name }}</td>
    </tr>

    <tr>
        <th>Tanggal Pinjam</th>
        <td>{{ $loan->tanggal_pinjam }}</td>
    </tr>

    <tr>
        <th>Tanggal Kembali</th>
        <td>{{ $loan->tanggal_kembali }}</td>
    </tr>

    <tr>
        <th>Tanggal Dikembalikan</th>
        <td>{{ $loan->tanggal_dikembalikan ?? '-' }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>
            <span class="status-badge status-{{ $loan->status }}">
                {{ ucfirst($loan->status) }}
            </span>
        </td>
    </tr>
</table>
<h2>Buku yang Dipinjam</h2>

<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($loan->loanItems as $item)
            <tr>
                <td>{{ $item->book->judul }}</td>
                <td>{{ $item->book->penulis }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">Tidak ada buku pada transaksi ini.</td>
            </tr>
        @endforelse
    </tbody>
</table>
<p>
    <a href="{{ route('loans.index') }}">
        &larr; Kembali ke daftar peminjaman
    </a>
</p>
```

@endsection
