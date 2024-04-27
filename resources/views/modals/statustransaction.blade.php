<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h2 class="modal-title">Submit Transaksi</h2>
        </div>
        <div class="modal-body">
            Transaksi tidak akan bisa diubah setelah disimpan kedalam status "Disubmit" dan akan ditindaklanjuti pengolahannya oleh Penanggung Jawab
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
            <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
        </div>
    </div>
</div>

<script>
        $("#submitBtn").click(function(){$("#create-form").submit()});
</script>