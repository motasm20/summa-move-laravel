@extends('layouts.admin')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Prestaties</h2>

    <table class="table-auto w-full bg-white shadow rounded">
        <thead>
            <tr>
                <th class="border px-4 py-2">Gebruiker</th>
                <th class="border px-4 py-2">Oefening</th>
                <th class="border px-4 py-2">Resultaat</th>
                <th class="border px-4 py-2">Datum</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($performances as $p)
                <tr>
                    <td class="border px-4 py-2">{{ $p->user->name ?? 'Onbekend' }}</td>
                    <td class="border px-4 py-2">{{ $p->exercise->title ?? 'Verwijderd' }}</td>
                    <td class="border px-4 py-2">{{ $p->result }}</td>
                    <td class="border px-4 py-2">{{ $p->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
