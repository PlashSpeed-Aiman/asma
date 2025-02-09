
@extends('shared._layout')
@section('content')
<div class="container  mx-auto">
    <div class="badge badge-outline">
        Borrow an Asset
    </div>
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
    <div id="form-borrow">
        <form  method="POST" action="{{ route('loan.create') }}">
            @csrf
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Select Asset</span>
                </label>
                <select name="asset_id" class="select select-bordered">
                    <option disabled selected>Pick an asset</option>
                    @foreach ($assets as $asset)
                    <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Borrower Name</span>
                    </label>
                <input type="text" name="borrower_name" class="input input-bordered w-full max-w-xs" />
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Telephone Number</span>
                </label>
                <input type="number" name="telephone_number" class="input input-bordered w-full max-w-xs" />
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Description</span>
                </label>
                <input type="text" name="description" placeholder="Reason for borrowing etc" class="input input-bordered w-full max-w-xs" />
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Start Date</span>
                </label>
                <input type="date" name="start_date" class="input input-bordered w-full max-w-xs" />
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">End Date</span>
                </label>
                <input type="date" name="end_date" class="input input-bordered w-full max-w-xs" />
            </div>

            <div class="form-control w-full max-w-xs mt-4">
                <button type="submit" class="btn btn-primary">Submit Borrow Request</button>
            </div>
            </form>

</div>
@endsection
@push(
    'scripts'
)
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
