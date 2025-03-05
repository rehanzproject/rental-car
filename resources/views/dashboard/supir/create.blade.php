<form action="{{ route('supir.create') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Supir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Supir Photo --}}
                    <label for="supir_photo">Foto Supir</label>
                    <div class="input-group">
                        <div class="card p-2 mb-1 me-2">
                            <img id="supir" src="{{ asset('img/user-profile-default.jpg') }}" class="img-circle elevation-2" alt="supir image" style="object-fit: cover; width: 50px; height: 50px; border: 1px solid rgb(150, 150, 150);">
                        </div>
                        <div class="mt-1">
                            <input id="supir_photo" type="file" class="form-control @error('supir_photo') is-invalid @enderror" name="supir_photo" value="{{ old('supir_photo') }}" accept="image/*" onchange="loadFile(event)">
                        </div>
                        @error('supir_photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div class="form-group">
                        <label for="nama">{{ __('Nama :') }}</label>
                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" autocomplete="off" autofocus required>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Usia --}}
                    <div class="form-group">
                        <label for="usia">{{ __('Usia :') }}</label>
                        <input id="usia" type="number" class="form-control @error('usia') is-invalid @enderror" name="usia" value="{{ old('usia') }}" autocomplete="off" autofocus required>
                        @error('usia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="form-group">
                        <label for="jenis_kelamin">{{ __('Jenis Kelamin :') }}</label>
                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                            <option {{ auth()->user()->jenis_kelamin === 'Laki-Laki' ? 'selected' : '' }} value="Laki-Laki">Laki-Laki</option>
                            <option {{ auth()->user()->jenis_kelamin === 'Perempuan' ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group">
                        <label for="alamat">{{ __('Alamat :') }}</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="floatingTextarea2 alamat" value="{{ old('alamat') }}" placeholder="Leave a address here" style="height: 100px" autocomplete="off"></textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Create</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    let loadFile = function(event) {
        var images = document.getElementById('supir');
        images.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
