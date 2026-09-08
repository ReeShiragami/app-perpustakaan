<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Member</title>
</head>
<body>

    <h1>Daftar Member</h1>

    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <p>
        <a href="{{ route('members.create') }}">
            Tambah Member
        </a>
    </p>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member['id'] }}</td>
                    <td>{{ $member['nama'] }}</td>
                    <td>{{ $member['email'] }}</td>
                    <td>{{ $member['telepon'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>