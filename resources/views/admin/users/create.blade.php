@extends('layouts.admin')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Nieuwe gebruiker toevoegen</h2>

    <form method="POST" action="{{ route('admin.users.store') }}" class="bg-white p-6 rounded shadow max-w-md">
        @csrf

        <div class="mb-4">
            <label class="block">Naam</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block">E-mail</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block">Wachtwoord</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block">Rol</label>
            <select name="role" class="w-full border px-3 py-2 rounded">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Aanmaken</button>
    </form>
@endsection
