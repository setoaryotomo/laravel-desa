<!-- Modal -->
<div class="modal fade" id="confirmationReject-{{ $user->id }}" tabindex="-1" aria-labelledby="confirmationRejectLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/account-request/approval/{{ $user->id }}" method="post">
            @csrf
            @method('POST')
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="confirmationRejectLabel">Konfirmasi Non-aktif</h1>
          <button type="button" class="btn btn-default btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="for" value="deactivate">
          Apakah Anda yakin akan menon-aktifkan akun ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-outline-danger">Ya</button>
        </div>
      </div>
    </form>
    </div>
  </div>