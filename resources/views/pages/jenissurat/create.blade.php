@extends('layouts.app')

@section('content')
    <style>
        form label {
            font-weight: bold;
        }
        .tox-tinymce {
            min-height: 500px;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Jenis Surat Baru</h3>
                        <a href="{{ route('jenissurat.index') }}" class="btn btn-sm btn-secondary float-right">Kembali</a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('jenissurat.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="jenis_surat" class="form-label">Jenis Surat</label>
                                    <input type="text" class="form-control @error('jenis_surat') is-invalid @enderror"
                                        id="jenis_surat" name="jenis_surat" value="{{ old('jenis_surat') }}" required>
                                    @error('jenis_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                        id="keterangan" name="keterangan" value="{{ old('keterangan') }}" required>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="template" class="form-label">Template</label>
                                    <textarea class="ckeditor @error('template') is-invalid @enderror"
                                        id="ckeditor" name="template" required>{{ old('template') }}</textarea>
                                    @error('template')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <!-- Include TinyMCE -->
    <!-- Place the first <script> tag in your HTML's <head> -->
{{-- <script src="https://cdn.tiny.cloud/1/jnt0tqtrwvsqwm6nn18f3ywilicfmjyucs7b8rctwycj5x9m/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script> --}}

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
  tinymce.init({
    selector: 'textarea',
    plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      // Your account includes a free trial of TinyMCE premium features
      // Try the most popular premium features until Aug 19, 2025:
      'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'ai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    uploadcare_public_key: '89d69363d40cc0757ba8',
    setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        tinymce.triggerSave();
    });
  });
</script> --}}

@endsection