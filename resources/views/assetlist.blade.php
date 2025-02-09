@extends('shared._layout')
@section('content')
    <div class="container mx-auto">
        <div>
            <small class="badge badge-outline"> Track and manage your assets efficiently</small>
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Asset Name</th>
                        <th>Borrower</th>
                        <th>Telephone Number</th>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($assets ?? [] as $asset)
                        <tr>
                            <td>{{ $asset->id }}</td>
                            <td>{{ $asset->asset->name }}</td>
                            <td>{{ $asset->name}}</td>
                            <td>{{ $asset->telephone_number }}</td>
                            <td>{{ $asset->status }}</td>
                            <td>{{ $asset->description }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="join mt-4">
                @for($i = 1; $i <= $totalPage; $i++)
                    <button class="join-item btn ">{{ $i }}</button>
                @endfor
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        // Your JavaScript code here
        document.addEventListener('alpine:init', () => {
            Alpine.data('buttonState', () => ({
                isActive: false,
                toggleActive() {
                    this.isActive = !this.isActive
                    if (this.isActive) {
                        document.getElementById('button-active').classList.add('btn-active')
                    } else {
                        document.getElementById('button-active').classList.remove('btn-active')
                    }
                }
            }))
        })

    </script>

@endpush
