@extends('layouts.app')


@section('content')

    <div class="transaksi">
        <div class="container" style="margin-top: 100px">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="card p-2 mb-3" style="background-color: #000000cd; backdrop-filter: blur(5px);">
                        <div class="card-header fs-4 fw-bold">Informasi Mobil</div>
                        <div class="card-body">
                            <span class="float-end fw-bold">{{ $armada->mobil->type_mobil }}</span>
                            <p class="my-0 fs-5">Type Mobil</p>
                            <span class="float-end fw-bold">{{ $armada->nama_mobil }}</span>
                            <p class="my-0 fs-5">Nama Mobil</p>
                            <span class="float-end fw-bold">{{ $armada->plat_nomor }}</span>
                            <p class="my-0 fs-5">Plat Nomor</p>
                            <span class="float-end fw-bold">{{ $armada->mobil->bensin }}</span>
                            <p class="my-0 fs-5">Bensin</p>
                            <span class="float-end fw-bold">Rp.{{ $armada->harga }} / Hari</span>
                            <p class="my-0 fs-5">Harga</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card p-3" style="background-color: #000000cd; backdrop-filter: blur(5px);">
                        <form action="{{ route('transaksi.store', $armada->id) }}" class="form-border" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    {{-- Nama --}}
                                    <div class="form-group">
                                        <label for="nama">Nama :</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ auth()->user()->name }}" required readonly>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Lama Sewa --}}
                                    <div class="form-group">
                                        <label for="waktu">Lama Sewa :</label>
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="number" class="form-control @error('waktu') is-invalid @enderror" id="waktu" name="waktu" value="{{ old('waktu') }}" required>
                                            </div>
                                            <div class="col-3">
                                                <input class="form-control" type="text" value="Hari" disabled readonly>
                                            </div>
                                        </div>
                                        @error('waktu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    {{-- Tipe Peminjaman --}}
                                    <div class="form-group">
                                        <label for="tipe_peminjaman">Tipe Peminjaman</label>
                                        <select class="form-control" id="tipe_peminjaman" name="tipe_peminjaman">
                                            <option class="text-dark" value="0">Tanpa Supir</option>
                                            <option class="text-dark" value="1">Dengan Supir</option>
                                        </select>
                                        @error('tipe_peminjaman')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tanggal Sewa --}}
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Sewa :</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                        @error('tanggal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- Harga --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="harga">Harga :</label>
                                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ $armada->harga }}" required readonly>
                                        @error('harga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- Supir --}}
                                <div class="col-md-6">
                                    <div class="form-group" id="supir-form" style="display: none;">
                                        <label>Supir :</label>
                                        <div class="p-3" style="border: solid 1px #eeeeee5a; background: rgba(0, 0, 0, .025); border-radius: 8px">
                                            <div id="supir-info" class="text-center py-5">Tidak ada sopir yang dipilih</div>
                                            <div id="selectedSupir" style="display: none;"></div>
                                            <input type="hidden" name="supir_id" id="supir_id" value="">
                                            
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalSupir">Pilih Supir</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark mt-3">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Select Suoir --}}
    <div class="modal fade" id="modalSupir" tabindex="-1" aria-labelledby="modalSupirLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSupirLabel">Pilih Supir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center align-items-stretch">
                        @forelse ($supirs as $supir)
                            @if ($supir->status == 'Tersedia')
                                <div class="col-md-6 my-2">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div>
                                                <div class="d-flex justify-content-center">
                                                    @if ($supir->supir_photo)
                                                        <img src="{{ asset('storage/supir_photo/' . $supir->supir_photo) }}" class="rounded rounded-circle shadow" alt="User Image" style="object-fit: cover; width: 80px; height: 80px; border: 3px solid rgb(150, 150, 150);">
                                                    @else
                                                        <img src="{{ asset('img/user-profile-default.jpg') }}" class="rounded rounded-circle shadow" alt="User Image" width="80" height="80" style="border: 3px white solid">
                                                    @endif
                                                </div>
                                    
                                                {{-- Profile Detail --}}
                                                <div class="pb-3">
                                                    <div class="card-title text-bold fs-5 my-2 text-center">{{ $supir->nama }}</div>
                                                    <div class="card-text text-muted">{{ $supir->jenis_kelamin }} | {{ $supir->usia }} Tahun</div>
                                                    <div class="card-text alamat" style="font-size: 10px">{{ $supir->alamat }}</div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-sm btn-danger float-end select-supir" data-bs-dismiss="modal" data-supir-id="{{ $supir->id }}">Pilih</button>
                                        </div>
                                    </div>                    
                                </div>
                            @endif
                        @empty
                            <div class="text-center fs-4 text-bold">Supir sedang tidak ada!</div>
                        @endforelse
                    </div>                    
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

    <script>
        var tipePeminjamanSelect = document.getElementById('tipe_peminjaman');
        var supirForm = document.getElementById('supir-form');
        var modalSupir = new bootstrap.Modal(document.getElementById('modalSupir'), {});

        tipePeminjamanSelect.addEventListener('change', function() {
            if (this.value == 1) {
                supirForm.style.display = 'block';
            } else {
                supirForm.style.display = 'none';
            }
        });

        document.querySelectorAll('.select-supir').forEach(button => {
            button.addEventListener('click', function() {
                // Mendapatkan ID supir dari tombol yang diklik
                var supirId = this.getAttribute('data-supir-id');

                // Memperbarui nilai input form dengan ID supir yang dipilih
                var supirInput = document.getElementById('supir_id');
                supirInput.value = supirId;

                // Memperbarui tampilan informasi supir yang dipilih
                var supirInfo = document.getElementById('supir-info');
                var selectedSupir = document.getElementById('selectedSupir');

                // Mendapatkan informasi supir yang dipilih
                var selectedSupirName = this.closest('.card-body').querySelector('.card-title').textContent;
                var selectedSupirDetails = this.closest('.card-body').querySelector('.card-text').textContent;
                var selectedSupirAlamat = this.closest('.card-body').querySelector('.alamat').textContent;

                // Membuat HTML baru untuk informasi supir yang dipilih
                var newSupirInfoHTML = `
                    <div class="p-3 m-3" style="border: solid 1px #eeeeee5a; background: rgba(0, 0, 0, .025); border-radius: 10px;">
                        <div class="d-flex justify-content-center">
                            @if ($supir->supir_photo)
                                <img src="{{ asset('storage/supir_photo/' . $supir->supir_photo) }}" class="rounded rounded-circle shadow" alt="User Image" style="object-fit: cover; width: 80px; height: 80px; border: 3px solid rgb(150, 150, 150);">
                            @else
                                <img src="{{ asset('img/user-profile-default.jpg') }}" class="rounded rounded-circle shadow" alt="User Image" width="80" height="80" style="border: 3px white solid">
                            @endif
                        </div>

                        <div>
                            <div class="card-title text-bold fs-5 my-2 text-center">${selectedSupirName}</div>
                            <div class="card-text text-muted">${selectedSupirDetails}</div>
                            <div class="card-text" style="font-size: 10px">${selectedSupirAlamat}</div>
                        </div>
                    </div>
                `;

                selectedSupir.innerHTML = newSupirInfoHTML;

                supirInfo.style.display = 'none';
                selectedSupir.style.display = 'block';

                // Menutup modal supir
                modalSupir.hide();
            });
        });
    </script>

    <script>
        // Mendapatkan elemen-elemen yang diperlukan
        var hargaInput = document.getElementById('harga');
        var waktuInput = document.getElementById('waktu');
        var tipePeminjamanSelect = document.getElementById('tipe_peminjaman');

        // Mengatur harga default
        hargaInput.value = {{ $armada->harga }};

        // Fungsi untuk menghitung harga berdasarkan waktu dan tipe peminjaman
        function hitungHarga() {
            var hargaDefault = {{ $armada->harga }};
            var waktu = parseInt(waktuInput.value);
            var tipePeminjaman = parseInt(tipePeminjamanSelect.value);
            var hargaTotal = hargaDefault * waktu;

            // Menambahkan harga jika tipe peminjaman adalah "Dengan Supir"
            if (tipePeminjaman === 1) {
                hargaTotal += 200000;
            }

            // Mengupdate nilai input harga
            hargaInput.value = hargaTotal;
        }

        // Memanggil fungsi hitungHarga() setiap kali nilai input waktu atau tipe peminjaman berubah
        waktuInput.addEventListener('input', hitungHarga);
        tipePeminjamanSelect.addEventListener('change', hitungHarga);
    </script>

@endpush
