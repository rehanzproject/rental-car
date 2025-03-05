<form action="{{ route('supir.edit', ['supir' => $supir->id]) }}" method="POST" enctype="multipart/form-data">
    @method('put')
    @csrf

    <div class="modal fade" id="editSupirModal{{ $supir->id }}" tabindex="-1" aria-labelledby="editSupirModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSupirModalLabel">Edit Master Supir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Supir Photo --}}
                    <label for="supir_photo">{{ __('Foto supir') }}</label>
                    <div class="input-group">
                        <div class="card p-2 mb-1 me-2">
                            @if ($supir->supir_photo)
                                <img id="supir{{ $supir->id }}" src="{{ asset('storage/supir_photo/' . $supir->supir_photo) }}" alt="{{ $supir->supir_photo }}" class="img-circle elevation-2" style="object-fit: cover; width: 30px; height: 30px; border: 1px solid rgb(150, 150, 150);">
                            @else
                                <img id="supir{{ $supir->id }}" src="{{ asset('img/Car.png') }}" alt="supir image" class="img-circle elevation-2" style="object-fit: cover; width: 30px; height: 30px; border: 1px solid rgb(150, 150, 150);">
                            @endif
                        </div>
                        <div class="mt-1">
                            <input id="supir_photo" type="file" class="form-control @error('supir_photo') is-invalid @enderror" name="supir_photo" value="{{ old('supir_photo', $supir->supir_photo) }}" accept="image/*" onchange="loadFile{{ $supir->id }}(event, {{ $supir->id }})">
                        </div>
                    </div>
                    @error('supir_photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- Nama --}}
                    <div class="form-group">
                        <label for="nama">{{ __('Nama :') }}</label>
                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $supir->nama) }}" autocomplete="off" autofocus required>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Usia --}}
                    <div class="form-group">
                        <label for="usia">{{ __('Usia :') }}</label>
                        <input id="usia" type="number" class="form-control @error('usia') is-invalid @enderror" name="usia" value="{{ old('usia', $supir->usia) }}" autocomplete="off" autofocus required>
                        @error('usia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="form-group">
                        <label for="jenis_kelamin">{{ __('Jenis Kelamin :') }}</label>
                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" aria-label="Default select example" name="jenis_kelamin">
                            <option value="Laki-Laki" @if ($supir->jenis_kelamin == 'Laki-laki') selected @endif>Laki-Laki</option>
                            <option value="Perempuan" @if ($supir->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
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
                        <textarea class="form-control @error('alamat', $supir->alamat) is-invalid @enderror" name="alamat" id="floatingTextarea2 alamat" value="{{ old('alamat') }}" placeholder="Leave a alamat here" style="height: 100px" autocomplete="off">{{ $supir->alamat }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Status  --}}
                    <div class="form-group">
                        <label for="status" class="me-3">Status :</label>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            {{-- Tersedia --}}
                            <input type="radio" class="btn-check" name="status" id="status1{{ $supir->id }}" value="Tersedia" @if ($supir->status == 'Tersedia') checked @endif autocomplete="off">
                            <label class="btn btn-outline-success me-2" for="status1{{ $supir->id }}">Tersedia</label>

                            {{-- Disewa --}}
                            <input type="radio" class="btn-check" name="status" id="status2{{ $supir->id }}" value="Disewa" @if ($supir->status == 'Disewa') checked @endif autocomplete="off">
                            <label class="btn btn-outline-danger" for="status2{{ $supir->id }}">Disewa</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Change</button>
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
