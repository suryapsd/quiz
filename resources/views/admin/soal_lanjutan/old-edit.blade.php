@extends('layouts_dashboard.app')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (Session::has('success'))
      <div class="alert alert-success text-center">
        <p>{{ Session::get('success') }}</p>
      </div>
    @endif
    <!-- Multi Column with Form Separator -->
    <div class="card mb-4">
      @if ($soal_count > 0)
        <h5 class="card-header">Tambah Soal Awalan Instansi {{ $instansi->instansi->nama_instansi }}</h5>
      @else
        <h5 class="card-header">Tambah Soal Awalan Instansi {{ $instansi->nama_instansi }}</h5>
      @endif
      <form class="card-body" action="/admin/jumlah-soal-awalan/{{ $id_instansi }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <h6>1. Jumlah Soal</h6>
        <div class="row g-3">
          <div class="col">
            <label class="form-label" for="jumlah_soal">Jumlah Soal</label>
            <input type="number" id="jumlah_soal" name="jumlah_soal"
              class="form-control  @error('jumlah_soal') is-invalid @enderror" placeholder="Masukkan jumlah soal"
              value="{{ $soal_count }}" min="1" />
            @error('jumlah_soal')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
      </form>
      <hr class="my-4 mx-n4" />
      <form class="card-body" action="/admin/soal-awalan" method="post" enctype="multipart/form-data">
        @csrf
        <h6>2. Soal</h6>
        @php
          $i = 0;
        @endphp
        @foreach ($soal as $item)
          @php
            $i++;
          @endphp
          <input type="hidden" name="inputs[{{ $i }}][id_soal]" id="inputs[{{ $i }}][id_soal]"
            value="{{ $item->id }}">
          <div class="row">
            <div class="col-md-6 d-flex align-items-center">
              <h5 class="mb-0">Soal {{ $i }}</h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
              <a href='javascript:void(0)' onclick='deleteData({{ $item->id }})' data-id='{$item->id}'
                class="btn btn-label-danger mt-4">
                <i class="ti ti-x ti-xs me-1"></i>
                <span class="align-middle">Delete</span>
              </a>
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="soal">Soal</label>
            <textarea name="inputs[{{ $i }}][soal]" id="soal_{{ $i }}" cols="5" rows="5"
              class="form-control ckeditor @error('inputs[' . $i . '][soal]') is-invalid @enderror" required>{!! $item->soal !!}</textarea>
            @error('inputs[' . $i . '][soal]')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="row g-3 mb-2">
            <div class="col-md-6 mb-2">
              <div class="form-group">
                <label for="jawaban_a">Jawaban A</label>
                <textarea name="inputs[{{ $i }}][jawaban_a]" id="jawaban_a_{{ $i }}" cols="5"
                  rows="5" class="form-control ckeditor @error('inputs[' . $i . '][jawaban_a]') is-invalid @enderror" required>{!! $item->jawaban_a !!}</textarea>
                @error('inputs[' . $i . '][jawaban_a]')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <div class="form-group">
                <label for="jawaban_b">Jawaban B</label>
                <textarea name="inputs[{{ $i }}][jawaban_b]" id="jawaban_b_{{ $i }}" cols="5"
                  rows="5" class="form-control ckeditor @error('inputs[' . $i . '][jawaban_b]') is-invalid @enderror" required>{!! $item->jawaban_b !!}</textarea>
                @error('inputs[' . $i . '][jawaban_b]')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <div class="form-group">
                <label for="jawaban_c">Jawaban C</label>
                <textarea name="inputs[{{ $i }}][jawaban_c]" id="jawaban_c_{{ $i }}" cols="5"
                  rows="5" class="form-control ckeditor @error('jawaban_c') is-invalid @enderror" required>{!! $item->jawaban_c !!}</textarea>
                @error('jawaban_c')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <div class="form-group">
                <label for="jawaban_d">Jawaban D</label>
                <textarea name="inputs[{{ $i }}][jawaban_d]" id="jawaban_d_{{ $i }}" cols="5"
                  rows="5" class="form-control ckeditor @error('inputs[' . $i . '][jawaban_d]') is-invalid @enderror" required>{!! $item->jawaban_d !!}</textarea>
                @error('inputs[' . $i . '][jawaban_d]')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="kunci_jawaban">Kunci Jawaban</label>
                <select class="form-select @error('inputs[' . $i . '][kunci_jawaban]') is-invalid @enderror"
                  name="inputs[{{ $i }}][kunci_jawaban]" aria-label="Default select example">
                  <option value="">Pilih Kunci Jawaban</option>
                  <option value="A"
                    {{ old('inputs.' . $i . '.kunci_jawaban', $item->kunci_jawaban) === 'A' ? 'selected' : '' }}>A
                  </option>
                  <option value="B"
                    {{ old('inputs.' . $i . '.kunci_jawaban', $item->kunci_jawaban) === 'B' ? 'selected' : '' }}>B
                  </option>
                  <option value="C"
                    {{ old('inputs.' . $i . '.kunci_jawaban', $item->kunci_jawaban) === 'C' ? 'selected' : '' }}>C
                  </option>
                  <option value="D"
                    {{ old('inputs.' . $i . '.kunci_jawaban', $item->kunci_jawaban) === 'D' ? 'selected' : '' }}>D
                  </option>
                </select>
                @error('inputs[' . $i . '][kunci_jawaban]')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <script>
            document.addEventListener("DOMContentLoaded", function() {
              CKEDITOR.replace(`soal_{{ $i }}`, {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
              });
              CKEDITOR.replace(`jawaban_a_{{ $i }}`, {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
              });
              CKEDITOR.replace(`jawaban_b_{{ $i }}`, {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
              });
              CKEDITOR.replace(`jawaban_c_{{ $i }}`, {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
              });
              CKEDITOR.replace(`jawaban_d_{{ $i }}`, {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
              });
            });
          </script>
          <hr class="my-4 mx-n4" />
        @endforeach
        <div id="repeater-container" class="repeater-container">
          <!-- Tombol Tambah Formulir -->
        </div>
        <div class="pt-4">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Simpan Soal</button>
          <a href="/admin/jenis-soal" class="btn btn-label-secondary">Kembali</a>
        </div>
      </form>
    </div>
  </div>
  <!-- / Content -->
  @push('script')
    <script type="text/javascript">
      function deleteData(id) {
        Swal.fire({
          icon: 'warning',
          text: 'Hapus Data Soal?',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
          },
          buttonsStyling: false
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            $.ajax({
              url: "{{ url('/admin/soal-awalan') }}/" + id,
              data: {
                _method: "DELETE",
                _token: "{{ csrf_token() }}"
              },
              type: "POST",
              dataType: "JSON",
              success: function(data) {
                if (data.success == 1) {
                  location.reload();
                  Swal.fire({
                    title: 'Sukses',
                    text: data.msg,
                    icon: 'success',
                    customClass: {
                      confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                  });
                } else {
                  Swal.fire({
                    title: 'Gagal',
                    text: data.msg,
                    icon: 'error',
                    customClass: {
                      confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                  });
                }
              },
              error: function(error) {
                Swal.fire('Gagal', 'terjadi kesalahan sistem', 'error');
                console.log(error.XMLHttpRequest);
              }
            });
          }
        });
      }
    </script>
  @endpush
@endsection
