@extends('shared._layout')
@section('content')
<div class="container mx-auto p-6">
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assets as $asset)
                    <tr class="hover">
                        <td>{{ $asset->id }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>
                            <div class="badge {{ $asset->status === 'active' ? 'badge-success' : 'badge-warning' }}">
                                {{ $asset->status }}
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('asset-management.show', $asset->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
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
