<!-- Modal -->
  <div class="modal fade" id="confirmationTolak-{{ $surat->id }}" tabindex="-1" aria-labelledby="confirmationTolakLabel" aria-hidden="true">
    <div class="modal-dialog">
       
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="confirmationTolakLabel">Konfirmasi Tolak</h1>
          <button type="button" class="btn btn-default btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin tolak
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
          <a style="font-size: 17px" href="{{ route('surat.tolak', $surat->id) }}"
            class="d-inline-block mr-1 mr-sm-2 btn btn-sm btn-danger" title="Tolak Surat">
            <i class="fas fa-times"></i>
            <span class="">Tolak Surat</span>
        </a>
        </div>
      </div>
    </div>
  </div>