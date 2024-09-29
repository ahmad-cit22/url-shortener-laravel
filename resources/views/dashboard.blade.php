@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <main class="flex-grow flex flex-col items-center justify-center px-4">
        <section class="bg-white rounded-lg shadow-lg p-8 w-full max-w-5xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Manage Your URLs</h2>

            <!-- URL table -->
            <div class="overflow-x-auto">
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
                            <tr class="border-b text-sm lg:text-base">
                                <td class="p-4 flex items-center space-x-2 truncate">
                                    <a href="{{ route('url.redirect', $url->short_url) }}"
                                        class="text-indigo-600 hover:underline block truncate">
                                        {{ route('url.redirect', $url->short_url) }}</a>
                                    <button id="copyBtn-{{ $url->id }}"
                                        onclick="copyToClipboardDashboard('{{ route('url.redirect', $url->short_url) }}', {{ $url->id }})"
                                        class="bg-indigo-500 text-white py-1 px-2 text-xs lg:text-sm rounded-md hover:bg-indigo-600 flex items-center space-x-1"
                                        title="Copy">
                                        <svg id="copyIcon-{{ $url->id }}" xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 16h8M8 12h8m-6 4h6M6 20h12M8 8h8M6 4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                        </svg>
                                    </button>
                                </td>
                                <td class="p-4 truncate text-indigo-600 hover:underline"
                                    style="max-width: 250px !important;">
                                    <a href="{{ $url->original_url }}" target="_blank">{{ $url->original_url }}</a>
                                </td>
                                <td class="p-4">{{ $url->clicks }}</td>
                                <td class="p-4 flex items-center space-x-1">
                                    <button
                                        class="text-white px-2 py-1 bg-indigo-600 rounded text-xs lg:text-sm hover:bg-indigo-500"
                                        onclick="openEditModal({{ $url->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button
                                        class="text-white px-2 py-1 bg-green-600 rounded text-xs lg:text-sm hover:bg-green-500"
                                        onclick="openViewModal({{ $url->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button
                                        class="text-white px-2 py-1 bg-red-600 rounded text-xs lg:text-sm hover:bg-red-500"
                                        onclick="confirmDelete({{ $url->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
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
            </div>
        </section>
    </main>

@endsection

@push('modals')
    <!-- delete modal -->
    <div id="deleteModal"
        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center transition-opacity duration-300 ease-in-out opacity-0 transform scale-75">
        <div
            class="bg-white rounded-lg shadow-lg w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg p-6 transition-transform duration-300 ease-in-out">
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

    <!-- edit modal -->
    <div id="editModal"
        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center transition-opacity duration-300 ease-in-out opacity-0 transform scale-75">
        <div
            class="bg-white rounded-lg shadow-lg w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg p-6 transition-transform duration-300 ease-in-out">
            <h2 class="text-lg font-bold mb-4">Edit URL</h2>
            <form id="editForm" action="{{ route('url.update') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" id="editUrlId" name="id">
                <div class="mb-4">
                    <label for="editOriginalUrl" class="block text-gray-700 text-sm font-bold mb-2">Original URL:</label>
                    <input type="text" id="editOriginalUrl" name="original_url"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mt-4 flex justify-end">
                    <button id="cancelEdit" type="button"
                        class="text-indigo-600 hover:text-indigo-500 px-4 py-2 rounded-md mr-2"
                        onclick="closeEditModal()">Cancel</button>
                    <button id="saveEdit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-md"
                        onclick="saveEdit()">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- view modal -->
    <div id="viewModal"
        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center transition-opacity duration-300 ease-in-out opacity-0 transform scale-75">
        <div
            class="bg-white rounded-lg shadow-lg w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg p-6 transition-transform duration-300 ease-in-out">
            <h2 class="text-lg font-bold mb-4">View URL</h2>
            <div id="viewUrlDetails" class="text-gray-700 font-bold mb-2"></div>
            <div class="mt-2 flex justify-end">
                <button id="closeView" class="text-indigo-600 hover:text-indigo-500 px-4 rounded-md"
                    onclick="closeViewModal()">Close</button>
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

        function openEditModal(urlId) {
            const modal = document.getElementById('editModal');
            modal.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0', 'scale-75');
            }, 10);
            document.getElementById('editUrlId').value = urlId;

            fetch(`{{ route('url.show', '') }}/${urlId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editOriginalUrl').value = data.original_url;
                });
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('opacity-0', 'scale-75');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
            modal.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        }

        function openViewModal(urlId) {
            const modal = document.getElementById('viewModal');
            modal.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0', 'scale-75');
            }, 10);

            fetch(`{{ route('url.show', '') }}/${urlId}`)
                .then(response => response.json())
                .then(data => {
                    const viewUrlDetails = document.getElementById('viewUrlDetails');
                    if (data.original_url) {
                        viewUrlDetails.innerHTML = `
                        <p class="text-gray-600 mb-2">
                            Original URL:
                            <a href="${data.original_url}"
                                class="text-indigo-600 hover:underline break-all truncate max-w-xs"
                                target="_blank"
                                rel="noopener noreferrer"
                                title="${data.original_url}">
                                ${data.original_url.length > 35 ? data.original_url.slice(0, 35) + '...' : data.original_url}
                            </a>
                        </p>
                        <p class="text-gray-600 mb-2">
                            Short URL:
                            <a href="${data.short_url}"
                                class="text-indigo-600 hover:underline break-all truncate max-w-xs"
                                target="_blank"
                                rel="noopener noreferrer">
                                ${data.short_url}
                            </a>
                        </p>
                        <p class="text-gray-600">
                            Clicks:
                            <span class="font-semibold">${data.clicks}</span>
                        </p>
                    `;
                    } else {
                        viewUrlDetails.innerHTML = `<p class="text-red-600">${data.error}</p>`;
                    }
                });
        }

        function closeViewModal() {
            const modal = document.getElementById('viewModal');
            modal.classList.add('opacity-0', 'scale-75');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
            modal.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        }
    </script>
@endpush
