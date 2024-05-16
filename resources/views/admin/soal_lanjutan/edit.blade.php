@extends('layouts_dashboard.app')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <a href="/admin/soal-lanjutan/{{ $id_pendidikan_instansi }}/tambah-soal" class="btn btn-outline-primary mb-3">
      <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Kembali
    </a>
    <!-- Multi Column with Form Separator -->
    <div class="card mb-4">
      <h5 class="card-header">Edit Soal Lanjutan Pendidikan {{ $pendidikan->nama_pendidikan }} </h5>
      <form class="card-body" action="/admin/soal-lanjutan/{{ $id_pendidikan_instansi }}/tambah-soal/{{ $soal->id }}"
        method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group mb-3">
          <label for="soal">Soal</label>
          <textarea name="soal" id="soal" cols="5" rows="5"
            class="form-control @error('soal') is-invalid @enderror" required>{!! $soal->soal !!}</textarea>
          @error('soal')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="row g-3 mb-2">
          <div class="col-md-6 mb-2">
            <div class="form-group">
              <label for="jawaban_a">Jawaban A</label>
              <textarea name="jawaban_a" id="jawaban_a" cols="5" rows="5"
                class="form-control @error('jawaban_a') is-invalid @enderror" required>{!! $soal->jawaban_a !!}</textarea>
              @error('jawaban_a')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group">
              <label for="jawaban_b">Jawaban B</label>
              <textarea name="jawaban_b" id="jawaban_b" cols="5" rows="5"
                class="form-control @error('jawaban_b') is-invalid @enderror" required>{!! $soal->jawaban_b !!}</textarea>
              @error('jawaban_b')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group">
              <label for="jawaban_c">Jawaban C</label>
              <textarea name="jawaban_c" id="jawaban_c" cols="5" rows="5"
                class="form-control @error('jawaban_c') is-invalid @enderror" required>{!! $soal->jawaban_c !!}</textarea>
              @error('jawaban_c')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group">
              <label for="jawaban_d">Jawaban D</label>
              <textarea name="jawaban_d" id="jawaban_d" cols="5" rows="5"
                class="form-control @error('jawaban_d') is-invalid @enderror" required>{!! $soal->jawaban_d !!}</textarea>
              @error('jawaban_d')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="kunci_jawaban">Kunci Jawaban</label>
              <select class="form-select @error('kunci_jawaban') is-invalid @enderror" name="kunci_jawaban"
                aria-label="Default select example">
                <option value="">Pilih Kunci Jawaban</option>
                <option value="A" {{ old('kunci_jawaban', $soal->kunci_jawaban) === 'A' ? 'selected' : '' }}>A
                </option>
                <option value="B" {{ old('kunci_jawaban', $soal->kunci_jawaban) === 'B' ? 'selected' : '' }}>B
                </option>
                <option value="C" {{ old('kunci_jawaban', $soal->kunci_jawaban) === 'C' ? 'selected' : '' }}>C
                </option>
                <option value="D" {{ old('kunci_jawaban', $soal->kunci_jawaban) === 'D' ? 'selected' : '' }}>D
                </option>
              </select>
              @error('kunci_jawaban')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        <div class="pt-4">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Simpan Soal</button>
        </div>
    </div>
    </form>
  </div>
  @push('script')
    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function() {
        CKEDITOR.replace(`soal`, {
          filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
          filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace(`jawaban_a`, {
          filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
          filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace(`jawaban_b`, {
          filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
          filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace(`jawaban_c`, {
          filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
          filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace(`jawaban_d`, {
          filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
          filebrowserUploadMethod: 'form'
        });
      });
    </script>
  @endpush
@endsection
