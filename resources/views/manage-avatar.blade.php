<x-layout>

    <div class="container py-md-5 d-flex flex-column align-items-center justify-content-center"
        style="min-height: 80vh;">
        <h2 class="text-center mb-1" style="color: #083358;">File Upload</h2>
        <form action="/profile/manage-avatar" method="POST" enctype="multipart/form-data"
            class="w-100 d-flex flex-column align-items-center">
            @csrf
            <div class="border rounded p-5 mb-3 d-flex flex-column align-items-center"
                style="max-width: 500px; width: 100%; background: #fff; border-color: #083358;">
                <i class="fas fa-download fa-3x mb-3" style="color: #083358;"></i>
                <div class="mb-3 w-100 text-center">
                    <span class="d-block text-secondary mb-2">Select a file "Avatar"</span>
                    <input type="file" class="d-none" id="avatar" name="avatar">
                    <label for="avatar" class="btn btn-custom-blue">Select a file</label>
                </div>
                @error('avatar')
                    <p class="m-0 small alert alert-danger shadow-sm">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <button class="btn btn-custom-blue mx-auto">Save Your Avatar</button>
        </form>
    </div>

</x-layout>
