<!-- Modal for creating new asset -->
<dialog id="create_asset_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Create New Asset</h3>

        <form method="POST">
            @csrf

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Asset Name</span>
                </label>
                <input type="text" name="name" placeholder="Enter asset name" class="input input-bordered w-full" required />
            </div>

            <div class="form-control w-full mt-4 flex flex-col">
                <label class="label">
                    <span class="label-text">Description</span>
                </label>
                <textarea name="description" class="textarea textarea-bordered h-24" placeholder="Enter asset description"></textarea>
            </div>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="button" class="btn" onclick="create_asset_modal.close()" >Cancel</button>
            </div>
        </form>
    </div>
</dialog>
