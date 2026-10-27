{{-- File: resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard - Perpustakaan Digital')

@section('content')    
    <p style="margin-top: 24px;">
        <a href="{{ route('loans.report') }}" class="btn">
            Lihat Laporan Peminjaman
        </a>
    </p>
    <h1>Dashboard Perpustakaan</h1>
    <p>Ringkasan statistik perpustakaan digital kampus.</p>

    <div class="stats-container">
        <div class="stat-card">
            <h3>Total Buku</h3>
            <p>{{ $stats['total_buku'] ?? 0 }}</p>
        </div>

        <div class="stat-card">
            <h3>Total Anggota</h3>
            <p>{{ $stats['total_anggota'] ?? 0 }}</p>
        </div>

        <div class="stat-card">
            <h3>Peminjaman Aktif</h3>
            <p>{{ $stats['peminjaman_aktif'] ?? 0 }}</p>
        </div>
    </div>

    <p>
        <a href="{{ route('books.index') }}" class="btn">Kelola Buku</a>
        <a href="{{ route('loans.index') }}" class="btn">Lihat Peminjaman</a>
    </p>
@endsection
