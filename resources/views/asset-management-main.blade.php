@extends('shared._layout')
@section('content')
    <!-- Dashboard Stats -->
    <div class="container mx-auto p-4">
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
                    <ul x-data="viewModal" class="menu-horizontal gap-2 p-2">
                        <li>
                            <button class="btn btn-primary"
                                    onclick="document.getElementById('create_asset_modal').showModal()">
                                <i class="fas fa-plus"></i> Add Asset
                            </button>
                        </li>
                        <li>
                            <a id="asset-view-button" href="{{ route('asset-management.list')  }}" class="btn btn-info">
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
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recentAssets ?? [] as $asset)
                            <tr>
                                <td>{{ $asset->asset_id }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->category }}</td>
                                <td>
                                    <div class="badge badge-{{ $asset->status_color }}">
                                        {{ $asset->status }}
                                    </div>
                                </td>
                                <td>
                                    <div class="join">
                                        <a class="btn btn-info btn-sm join-item">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm join-item">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
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
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Choose File</span>
                    </label>
                    <input type="file" class="file-input file-input-bordered w-full" name="file" required/>
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
