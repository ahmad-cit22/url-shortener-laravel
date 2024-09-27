@extends('layouts.master')

@section('content')
    <main class="flex-grow flex flex-col items-center justify-center px-4">
        <section class="bg-white rounded-lg shadow-lg p-8 w-full max-w-4xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Manage Your URLs</h2>
            <table class="w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="p-4 text-left">Short URL</th>
                        <th class="p-4 text-left">Original URL</th>
                        <th class="p-4 text-left">Clicks</th>
                        <th class="p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($urls as $url)
                        <tr class="border-b">
                            <td class="p-4"><a href="{{ route('url.redirect', $url->short_url) }}"
                                    class="text-indigo-600 hover:underline">{{ $url->short_url }}</a></td>
                            <td class="p-4">{{ $url->original_url }}</td>
                            <td class="p-4">{{ $url->clicks }}</td>
                            <td class="p-4">
                                <form action="{{ route('url.delete', $url->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white px-2 py-1 bg-red-600 rounded text-sm hover:bg-red-500">Delete</button>                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
