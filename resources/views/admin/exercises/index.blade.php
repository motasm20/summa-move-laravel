@extends('layouts.admin')

@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Oefeningenbeheer') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
    <a href="{{ route('admin.exercises.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        ➕ Nieuwe oefening
    </a>
</div>

            <table class="table-auto w-full mt-4 border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Titel</th>
                        <th class="border px-4 py-2">NL Instructie</th>
                        <th class="border px-4 py-2">EN Instructie</th>
                        <th class="border px-4 py-2">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exercises as $exercise)
                        <tr>
                            <td class="border px-4 py-2">{{ $exercise->title }}</td>
                            <td class="border px-4 py-2">{{ $exercise->instruction_nl }}</td>
                            <td class="border px-4 py-2">{{ $exercise->instruction_en }}</td>
                            <td class="border px-4 py-2 flex gap-2">
                                <a href="{{ route('admin.exercises.edit', $exercise) }}" class="text-blue-600">✏️</a>

                                <form action="{{ route('admin.exercises.destroy', $exercise) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')" class="text-red-600">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
