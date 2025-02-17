@extends('shared._layout')
@section('title', 'Asset Management')
@section('content')
    <div class="container mx-auto p-6">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody x-data="dropdown">
                @foreach ($assets as $asset)
                    <tr class="hover">
                        <td>{{ $asset->id }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>
                            <div class="badge {{ $asset->status === 'active' ? 'badge-success' : 'badge-warning' }}">
                                {{ $asset->status }}
                            </div>
                        </td>
                        <td class="flex gap-2 justify-center">
                            <a href="{{ route('asset-management.show', $asset->id) }}"
                               class="btn btn-sm btn-primary text-center">
                                Edit
                            </a>
                            <button id="btn-delete-{{ $asset->id }}" x-on:click="deleteObject" class="btn btn-sm btn-primary">
                                Delete
                            </button>
                        </td>
                        <td>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false,

                deleteObject(e) {
                    let id = e.target.id.replace("btn-delete-", "");
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(x => {
                        if (x.isConfirmed) {
                            fetch(`/asset-management/delete/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            }).then(response => {
                                if (response.ok) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your asset has been deleted.',
                                        'success'
                                    ).then(() => {
                                        window.location.reload();
                                    });
                                }
                            });
                        }
                    })
                },
            }))
        })
    </script>
@endpush
