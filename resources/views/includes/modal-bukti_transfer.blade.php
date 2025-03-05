<div class="modal fade" id="buktiTransferModal{{ $transaksi->id }}" tabindex="-1" aria-labelledby="buktiTransferModal{{ $transaksi->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @if ($transaksi->bayar_id)
                <img src="{{ asset('storage/bukti_transfer/' . $transaksi->bayar->bukti_transfer) }}" alt="">
            @else
                <img src="{{ asset('img/empty-bukti_transfer.jpg') }}" alt="">
            @endif
        </div>
    </div>
</div>
