<div class="modal fade" id="editTransaksiModal{{ $transaksi->id }}" tabindex="-1" aria-labelledby="editTransaksiModal{{ $transaksi->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('bayar.store', [($transaksiId = $transaksi->id)]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="editTransaksiModal{{ $transaksi->id }}Label">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Transfer --}}
                    <div class="row mb-5 justify-content-center">
                        <p class="col-md-12 col-md-4 fw-bold fs-4 text-center text-light">Transfer Kesini :</p>
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('img/QR.jpg') }}" alt="Transfer" width="150">
                        </div>
                    </div>

                    {{-- Jumlah yang harus ditransfer --}}
                    <div class="row justify-content-center">
                        <div class="col-8 mb-3">
                            <label for="jumlah-harga" class="form-label text-secondary">Harga yang harus dibayar</label>
                            <input type="email" class="form-control" value="{{ $transaksi->harga }}" id="jumlah-harga" readonly>
                        </div>

                        {{-- Bukti Transfer --}}
                        <div class="col-8 mb-3">
                            <label for="bukti_transfer" class="form-label text-secondary">Bukti Transfer</label>
                            <div class="mb-2">
                                <input name="bukti_transfer" class="form-control @error('bukti_transfer') is-invalid @enderror" value="{{ old('bukti_transfer') }}" type="file" accept="bukti_transfer/*" id="formFile" onchange="loadFile(event, {{ $transaksi->id }})">
                            </div>
                        </div>
                        @error('bukti_transfer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="col-8 mb-3">
                            <div class="card p-2">
                                <div class="row justify-content-center">
                                    <img id="image{{ $transaksi->id }}" src="{{ asset('img/bukti-transfer-default.png') }}" class="img-thumbnail" width="150">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Bayar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function loadFile(event, transaksiId) {
        var image = document.getElementById('image' + transaksiId);
        image.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
