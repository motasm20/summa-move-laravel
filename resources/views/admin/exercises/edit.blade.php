@extends('layouts.admin')

@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Oefening bewerken') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('admin.exercises.update', $exercise) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block">Titel</label>
                    <input type="text" name="title" value="{{ $exercise->title }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">Instructie NL</label>
                    <textarea name="instruction_nl" class="w-full border rounded px-3 py-2" required>{{ $exercise->instruction_nl }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block">Instructie EN</label>
                    <textarea name="instruction_en" class="w-full border rounded px-3 py-2" required>{{ $exercise->instruction_en }}</textarea>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Bijwerken</button>
                <a href="{{ route('admin.exercises.index') }}" class="ml-4 text-gray-600">Annuleren</a>
            </form>
        </div>
    </div>
@endsection
