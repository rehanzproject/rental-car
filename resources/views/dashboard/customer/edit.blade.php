<form action="{{ route('customer.edit', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
    @method('put')
    @csrf

    <div class="modal fade" id="editCustomerModal{{ $user->id }}" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Images --}}
                    <label for="images">{{ __('Foto Profile') }}</label>
                    <div class="input-group">
                        <div class="card p-2 mb-1 me-2">
                            @if ($user->images)
                                <img id="profile" src="{{ asset('storage/images/' . $user->images) }}" alt="{{ $user->images }}" class="img-circle elevation-2" style="object-fit: cover; width: 50px; height: 50px; border: 1px solid rgb(150, 150, 150);">
                            @else
                                <img id="profile" src="{{ asset('img/user-profile-default.jpg') }}" alt="User Image" class="img-circle elevation-2" style="object-fit: cover; width: 50px; height: 50px; border: 1px solid rgb(150, 150, 150);">
                            @endif
                        </div>
                        <div class="mt-1">
                            <input id="images" type="file" class="form-control @error('images') is-invalid @enderror" name="images" value="{{ old('images', $user->images) }}" accept="image/*" onchange="loadFile(event)">
                            <small for="images" class="form-label">Upload Your Profile Photo</small>
                        </div>
                        @error('images')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="form-group">
                        <label for="tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                        <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
                        @error('tanggal_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="form-group">
                        <label for="jenis_kelamin">{{ __('Jenis Kelamin') }}</label>
                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                            <option {{ $user->jenis_kelamin === 'Laki-Laki' ? 'selected' : '' }} value="Laki-Laki">Laki-Laki</option>
                            <option {{ $user->jenis_kelamin === 'Perempuan' ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group">
                        <label for="alamat">{{ __('Alamat') }}</label>
                        <textarea id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat">{{ old('alamat', $user->alamat) }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Role  --}}
                    <div class="form-group">
                        <label for="role" class="me-3">Role :</label>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            {{-- Member --}}
                            <input type="radio" class="btn-check" name="role" id="role1{{ $user->id }}" value="Member" @if ($user->role == 'Member') checked @endif autocomplete="off">
                            <label class="btn btn-outline-warning me-2" for="role1{{ $user->id }}">Member</label>

                            {{-- Admin --}}
                            <input type="radio" class="btn-check" name="role" id="role2{{ $user->id }}" value="Admin" @if ($user->role == 'Admin') checked @endif autocomplete="off">
                            <label class="btn btn-outline-success" for="role2{{ $user->id }}">Admin</label>
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
        var images = document.getElementById('profile');
        images.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
