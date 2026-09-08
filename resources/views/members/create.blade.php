<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Member</title>

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <h1>Tambah Member</h1>

    <p>
        <a href="{{ route('members.index') }}">
            Kembali
        </a>
    </p>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama</label><br>

            <input
                type="text"
                name="nama"
                value="{{ old('nama') }}"
            >

            @error('nama')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <br>

        <div>
            <label>Email</label><br>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
            >

            @error('email')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <br>

        <div>
            <label>Telepon</label><br>

            <input
                type="text"
                name="telepon"
                value="{{ old('telepon') }}"
            >

            @error('telepon')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <br>

        <button type="submit">
            Simpan
        </button>

    </form>

</body>
</html>