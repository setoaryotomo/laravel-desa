<!-- Modal -->
  <div class="modal fade" id="confirmationDelete-{{ $gallery->id }}" tabindex="-1" aria-labelledby="confirmationDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/gallery/{{ $gallery->id }}" method="post">
            @csrf
            @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="confirmationDeleteLabel">Konfirmasi Hapus</h1>
          <button type="button" class="btn btn-default btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin hapus
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-primary">Ya, Hapus</button>
        </div>
      </div>
    </form>
    </div>
  </div>