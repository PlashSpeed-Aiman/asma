<!-- Modal -->
<dialog class="modal" id="assetListModal" aria-labelledby="assetListModalLabel">
    <div class="modal-box">
        <div class="modal-action absolute right-4 top-4">
            <form method="dialog">
                <button class="btn btn-circle btn-ghost btn-sm">✕</button>
            </form>
        </div>
        <h3 class="font-bold text-lg" id="assetListModalLabel">Asset List</h3>
        <div class="py-4">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Asset Name</th>
                            <th>Asset Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assets ?? [] as $index => $asset)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->asset_number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
