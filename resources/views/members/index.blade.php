@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')

    <h1>Daftar Anggota</h1>

    <p>
        <a href="{{ route('members.create') }}" class="btn">
            + Tambah Anggota
        </a>
    </p>

    <form action="{{ route('members.index') }}" method="GET">
        <label for="search">Cari Nama Anggota</label>

        <input
            type="text"
            name="search"
            id="search"
            value="{{ request('search') }}"
            placeholder="Masukkan nama anggota"
        >

        <button type="submit">Cari</button>

        @if(request('search'))
            <a href="{{ route('members.index') }}">
                Reset
            </a>
        @endif
    </form>

    <br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->nim }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->nomor_telepon }}</td>
                    <td>{{ $member->status }}</td>

                    <td>
                        <a href="{{ route('members.show', $member->id) }}">
                            Detail
                        </a>

                        |

                        <a href="{{ route('members.edit', $member->id) }}">
                            Edit
                        </a>

                        |

                        <form
                            class="inline"
                            action="{{ route('members.destroy', $member->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7">
                        Data anggota tidak ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $members->appends(request()->query())->links() }}

@endsection