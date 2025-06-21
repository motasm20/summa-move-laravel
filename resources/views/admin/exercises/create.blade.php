@extends('layouts.admin')

@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe oefening toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('admin.exercises.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block">Titel</label>
                    <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">Instructie NL</label>
                    <textarea name="instruction_nl" class="w-full border rounded px-3 py-2" required></textarea>
                </div>

                <div class="mb-4">
                    <label class="block">Instructie EN</label>
                    <textarea name="instruction_en" class="w-full border rounded px-3 py-2" required></textarea>
                </div>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Opslaan</button>
                <a href="{{ route('admin.exercises.index') }}" class="ml-4 text-gray-600">Annuleren</a>
            </form>
        </div>
    </div>
@endsection
