@extends('shared._layout')
@section('title', 'Asset Management')
@section('content')
    <div class="container mx-auto p-6">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                @if (session('success'))
                    <div x-data="alerts" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div x-data="alerts" class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h2 class="card-title text-2xl mb-4">Asset Details</h2>
                <form method="POST"  action="{{ route('asset-management.update', $asset->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="grid grid-cols-2 form-control mb-4">
                            <label class="label mb-2">
                                <span class="label-text">Asset Name</span>
                            </label>
                            <input type="text" name="name" class="input input-bordered" value="{{ $asset->name }}" />
                        </div>

                        <div class="grid grid-cols-2 form-control mb-4">
                            <label class="label mb-2">
                                <span class="label-text">Asset Number</span>
                            </label>
                            <input type="text" name="asset_number" class="input input-bordered" value="{{ $asset->asset_number ?? '' }}" />
                        </div>

                        <div class=" grid grid-cols-2 form-control mb-4">
                            <label class="label mb-2">
                                <span class="label-text">Purchase Date</span>
                            </label>
                            <input type="date" name="purchase_date" class="input input-bordered" value="{{ $asset->purchase_date ?? '' }}" />
                        </div>

                        <div class="grid grid-cols-2 form-control mb-4">
                            <label class="label mb-2">
                                <span class="label-text">Status</span>
                            </label>
                            <select name="status" class="select select-bordered">
                                <option value="available" {{ $asset->status === 'active' ? 'selected' : '' }}>Available</option>
                                <option value="in_use" {{ $asset->status === 'in_use' ? 'selected' : '' }}>In Use</option>
                                <option value="maintenance" {{ $asset->status === 'Maintenance' ? 'selected' : '' }}>maintenance</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 form-control mb-4">
                            <label class="label mb-2">
                                <span class="label-text">Notes</span>
                            </label>
                            <textarea name="description" class="textarea textarea-bordered h-24">{{ $asset->description }}</textarea>
                        </div>
                    </div>

                    <div class="card-actions justify-end mt-6">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('asset-management.list') }}" class="btn btn-ghost">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('alerts', () => ({
                init() {
                    if (document.querySelector('.alert')) {
                        setTimeout(() => {
                            const alert = document.querySelector('.alert');
                            alert.style.transition = 'opacity 0.5s ease';
                            alert.style.opacity = '0';
                            setTimeout(() => {
                                alert.remove();
                            }, 500);
                        }, 3000);
                    }
                }
            }));
        });
    </script>
@endpush
