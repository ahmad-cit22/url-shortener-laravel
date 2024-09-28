@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <main class="flex-grow flex flex-col items-center justify-center px-4">
        <section class="bg-white rounded-lg shadow-lg p-8 w-full max-w-4xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Manage Your URLs</h2>

            <!-- url table -->
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
                    @forelse ($urls as $url)
                        <tr class="border-b">
                            <td class="p-4 flex items-center space-x-2">
                                <a href="{{ route('url.redirect', $url->short_url) }}"
                                    class="text-indigo-600 hover:underline">
                                    {{ route('url.redirect', $url->short_url) }}</a>
                                <button id="copyBtn-{{ $url->id }}"
                                    onclick="copyToClipboardDashboard('{{ route('url.redirect', $url->short_url) }}', {{ $url->id }})"
                                    class="bg-indigo-500 text-white py-1 px-2 text-sm rounded-md hover:bg-indigo-600 flex items-center space-x-1"
                                    title="Copy">
                                    <svg id="copyIcon-{{ $url->id }}" xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 16h8M8 12h8m-6 4h6M6 20h12M8 8h8M6 4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                    </svg>
                                </button>
                            </td>
                            <td class="p-4 truncate max-w-xs">{{ $url->original_url }}</td>
                            <td class="p-4">{{ $url->clicks }}</td>
                            <td class="p-4">
                                <button class="text-white px-2 py-1 bg-red-600 rounded text-sm hover:bg-red-500"
                                    onclick="confirmDelete({{ $url->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500 font-semibold">No URLs shortened yet
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>
@endsection

@push('modals')
    <!-- delete modal -->
    <div id="deleteModal"
        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center transition-opacity duration-300 ease-in-out opacity-0 transform scale-75">
        <div class="bg-white rounded-lg shadow-lg w-1/3 p-6 transition-transform duration-300 ease-in-out">
            <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
            <p>Are you sure you want to delete this URL?</p>
            <div class="mt-4 flex justify-end">
                <button id="cancelDelete" class="text-indigo-600 hover:text-indigo-500 px-4 py-2 rounded-md mr-2"
                    onclick="closeDeleteModal()">Cancel</button>
                <button id="confirmDelete" class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded-md"
                    onclick="">Delete</button>
            </div>
        </div>
    </div>
@endpush

@push('custom-js')
    <script>
        let currentUrlId = null;

        function confirmDelete(urlId) {
            currentUrlId = urlId;
            const modal = document.getElementById('deleteModal');
            modal.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0', 'scale-75');
            }, 10);
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('opacity-0', 'scale-75');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);

            modal.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        }

        document.getElementById('confirmDelete').onclick = function() {
            var form = document.createElement('form');
            form.action = "{{ route('url.delete', '') }}/" + currentUrlId;
            form.method = "POST";
            form.innerHTML = `
        @csrf
        @method('DELETE')
        `;
            document.body.appendChild(form);
            form.submit();
            closeDeleteModal();
        };


        function copyToClipboardDashboard(text, urlId) {
            navigator.clipboard.writeText(text).then(function() {
                document.getElementById('copyIcon-' + urlId).outerHTML = `
                <svg id="checkIcon-${urlId}" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>`;

                setTimeout(() => {
                    document.getElementById('checkIcon-' + urlId).outerHTML = `
                    <svg id="copyIcon-${urlId}" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8M8 12h8m-6 4h6M6 20h12M8 8h8M6 4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>`;
                }, 2000);
                showAlert();
            }, function(err) {
                console.error('Failed to copy text: ', err);
            });
        }
    </script>
@endpush
