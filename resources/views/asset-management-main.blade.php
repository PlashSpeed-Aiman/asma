@extends('shared._layout')
@section('title', 'Asset Management')
@section('content')
    <!-- Dashboard Stats -->
    <div x-data="viewModal" class="container mx-auto p-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif (session('error'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!-- Stats Cards -->
            <div class="stats shadow stats-vertical lg:stats-horizontal w-full mb-4">
                <div class="stat">
                    <div class="stat-title">Total Assets</div>
                    <div class="stat-value">{{ $totalAssets ?? 0 }}</div>
                </div>
                <div class="stat">
                    <div class="stat-title">Available</div>
                    <div class="stat-value text-success">{{ $availableAssets ?? 0 }}</div>
                </div>
                <div class="stat">
                    <div class="stat-title">In Use</div>
                    <div class="stat-value text-warning">{{ $inUseAssets ?? 0 }}</div>
                </div>
                <div class="stat">
                    <div class="stat-title">Maintenance</div>
                    <div class="stat-value text-error">{{ $maintenanceAssets ?? 0 }}</div>
                </div>
            </div>

            <!-- Action Menu -->
            <div class="card bg-base-100 shadow-xl mb-4">
                <div class="card-body">
                    <h2 class="card-title">Asset Management</h2>
                    <div class="menu bg-base-200 rounded-box">
                        <ul  class="menu-horizontal gap-2 p-2">
                            <li>
                                <button class="btn btn-primary"
                                        onclick="document.getElementById('create_asset_modal').showModal()">
                                    <i class="fas fa-plus"></i> Add Asset
                                </button>
                            </li>
                            <li>
                                <a id="asset-view-button" href="{{ route('asset-management.list')  }}"
                                   class="btn btn-info">
                                    <i class="fas fa-list"></i> View Assets
                                </a>
                            </li>
                            <li>
                                <button class="btn btn-success"
                                        onclick="document.getElementById('import_modal').showModal()">
                                    <i class="fas fa-file-import"></i> Import
                                </button>
                            </li>
                            <li>
                                <a class="btn">
                                    <i class="fas fa-file-export"></i> Export
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Recent Assets Table -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Recent Assets</h2>
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                            <tr>
                                <th>Asset ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($recentAssets ?? [] as $asset)
                                <tr>
                                    <td>{{ $asset->id }}</td>
                                    <td>{{ $asset->name }}</td>
                                    <td>{{ $asset->description }}</td>
                                    <td>
                                        <div
                                            class="badge badge-{{ $asset->status === 'available' ? 'success' : ($asset->status === 'in_use' ? 'warning' : 'error') }}">
                                            {{ $asset->status }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ $asset->created_at->format('Y-m-d H:i:s') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No assets found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>

    <div id="asset-view-modal" class="modal">

    </div>
    @include('modals.asset-create-modal')
    <!-- Import Modal -->
    <dialog id="import_modal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Import Assets</h3>
            <form method="POST" action="{{ route('asset.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Choose File</span>
                    </label>
                    <input type="file" class="file-input file-input-bordered w-full" name="file" accept=".csv"
                           required/>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Import</button>
                    <button type="button" class="btn" onclick="import_modal.close()">Close</button>
                </div>
            </form>
        </div>
    </dialog>
@endsection
@push('scripts')
    <script>
        // JavaScript to handle modal opening and closing
        const assetCreateModal = document.getElementById('asset-create-modal');
        document.addEventListener('alpine:init', () => {
            Alpine.data('viewModal', () => ({
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
                },
                showModal: false,
                openModal() {
                    fetch('/assets/view/partial', {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'text/html'
                        },
                    }).then(response => response.text())
                        .then(html => {
                            document.getElementById('asset-view-modal').innerHTML = html;
                            (document.getElementById('assetListModal')).showModal();
                        });

                },
                closeModal() {
                    this.showModal = false;
                }
            }))
        })

    </script>
@endpush
