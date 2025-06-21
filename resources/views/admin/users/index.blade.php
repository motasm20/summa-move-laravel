@extends('layouts.admin')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Gebruikersbeheer</h2>
    <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
    ➕ Nieuwe gebruiker
    </a>


    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    

    <table class="table-auto w-full bg-white shadow rounded">
        <thead>
            <tr>
                <th class="border px-4 py-2">Naam</th>
                <th class="border px-4 py-2">E-mail</th>
                <th class="border px-4 py-2">Rol</th>
                <th class="border px-4 py-2">Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ $user->role }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="inline-flex">
                            @csrf
                            @method('PUT')
                            <select name="role" class="mr-2 border rounded px-2 py-1 text-sm">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <button type="submit" class="bg-blue-500 border text-white text-sm px-2 py-1 rounded">Opslaan</button>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 border text-white text-sm px-2 py-1 rounded">
                                    Verwijderen
                                </button>
                            </form>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
