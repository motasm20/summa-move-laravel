<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Beheer</title>
    @vite('resources/css/app.css') {{-- Zorg dat Vite draait met `npm run dev` --}}
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navigatiebalk -->
    <nav class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <a href="{{ route('admin.exercises.index') }}" class="text-lg font-bold text-blue-600">
                    🏋️ SummaMove Admin
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-700 hover:text-blue-600">
                    Gebruikers
                </a>

                <a href="{{ route('admin.exercises.index') }}" class="text-sm text-gray-700 hover:text-blue-600">
                    Oefeningen
                </a>

                <a href="{{ route('admin.performances.index') }}" class="text-sm text-gray-700 hover:text-blue-600">
                    Prestaties
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:underline">Uitloggen</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Pagina-inhoud -->
    <main class="max-w-7xl mx-auto px-4">
        @yield('content')
    </main>

</body>
</html>
