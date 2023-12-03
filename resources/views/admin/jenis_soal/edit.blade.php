@extends('layouts_dashboard.app')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Multi Column with Form Separator -->
    <div class="card mb-4">
      <h5 class="card-header">Tambah Soal</h5>
      <form class="card-body" action="/admin/jenis-soal/{{ $jenis_soal->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <h6>1. Jenis Soal</h6>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label" for="nama_jenis_soal">Jenis Soal</label>
            <input type="text" id="nama_jenis_soal" name="nama_jenis_soal"
              class="form-control form-control-sm @error('nama_jenis_soal') is-invalid @enderror"
              placeholder="Masukkan jenis soal" value="{{ $jenis_soal->nama_jenis_soal }}" />
            @error('nama_jenis_soal')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label" for="multicol-email">Instansi</label>
            <select id="id_pendidikan_instansi" name="id_pendidikan_instansi" class="orm-control selectpicker w-100"
              data-style="btn-default" data-live-search="true">
              <option value="">Pilih Instansi</option>
              @foreach ($pendidikan as $item)
                <option data-tokens="{{ $item->nama_pendidikan }}" value="{{ $item->id }}"
                  @if ($jenis_soal->id_pendidikan_instansi == $item->id) selected @endif>{{ $item->nama_pendidikan }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $jenis_soal->keterangan }}</textarea>
        </div>
        <hr class="my-4 mx-n4" />
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
          </div>
          <div class="form-group mb-3">
            {{-- <label for="soal">Soal</label> --}}
            <textarea name="inputs[{{ $i }}][soal]" id="soal_{{ $i }}" cols="5" rows="5"
              class="form-control @error('inputs[' . $i . '][soal]') is-invalid @enderror" required>{!! $item->soal !!}</textarea>
            @error('inputs[' . $i . '][soal]')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="row g-3 mb-2">
            <div class="col-md-6 mb-2">
              <div class="form-group">
                <label for="jawaban_a">Jawaban A</label>
                <textarea name="inputs[{{ $i }}][jawaban_a]" id="jawaban_a_{{ $i }}" cols="5"
                  rows="5" class="form-control @error('inputs[' . $i . '][jawaban_a]') is-invalid @enderror" required>{!! $item->jawaban_a !!}</textarea>
                @error('inputs[' . $i . '][jawaban_a]')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <div class="form-group">
                <label for="jawaban_b">Jawaban B</label>
                <textarea name="inputs[{{ $i }}][jawaban_b]" id="jawaban_b_{{ $i }}" cols="5"
                  rows="5" class="form-control @error('inputs[' . $i . '][jawaban_b]') is-invalid @enderror" required>{!! $item->jawaban_b !!}</textarea>
                @error('inputs[' . $i . '][jawaban_b]')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <div class="form-group">
                <label for="jawaban_c">Jawaban C</label>
                <textarea name="inputs[{{ $i }}][jawaban_c]" id="jawaban_c_{{ $i }}" cols="5"
                  rows="5" class="form-control @error('jawaban_c') is-invalid @enderror" required>{!! $item->jawaban_c !!}</textarea>
                @error('jawaban_c')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <div class="form-group">
                <label for="jawaban_d">Jawaban D</label>
                <textarea name="inputs[{{ $i }}][jawaban_d]" id="jawaban_d_{{ $i }}" cols="5"
                  rows="5" class="form-control @error('inputs[' . $i . '][jawaban_d]') is-invalid @enderror" required>{!! $item->jawaban_d !!}</textarea>
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
        <div class="text-start mt-3">
          <button type="button" onclick="addRepeater()" class="btn btn-label-primary">Tambah Form Soal</button>
        </div>
        <hr class="my-4 mx-n4" />
        <div class="pt-4">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
          <button type="reset" class="btn btn-label-secondary">Cancel</button>
        </div>
      </form>
    </div>
  </div>
  <!-- / Content -->
  @push('script')
    <script type="text/javascript">
      var i = 0; // Inisialisasi variabel i

      function addRepeater() {
        var newForm = `
        <div class="repeater-item">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
            <h5 class="mb-0">Soal ${i}</h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
            <button class="btn btn-label-danger mt-4" type="button" onclick="removeRepeater(this)">
                <i class="ti ti-x ti-xs me-1"></i>
                <span class="align-middle">Delete</span>
            </button>
            </div>
        </div>
        <div class="form-group">
            <input type="hidden" name="inputs[{{ $i }}][id_soal]" id="inputs[{{ $i }}][id_soal]">
            <label for="soal">Soal</label>
            <textarea name="inputs[${i}][soal]" id="soal_${i}" cols="5" rows="5"
            class="form-control @error('inputs[${i}][soal]') is-invalid @enderror" required></textarea>
            @error('inputs[${i}][soal]')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="row g-3 mb-2">
            <div class="col-md-6 mb-2">
            <div class="form-group">
                <label for="jawaban_a">Jawaban A</label>
                <textarea name="inputs[${i}][jawaban_a]" id="jawaban_a_${i}" cols="5" rows="5"
                class="form-control @error('inputs[${i}][jawaban_a]') is-invalid @enderror" required></textarea>
                @error('inputs[${i}][jawaban_a]')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            </div>
            <div class="col-md-6 mb-2">
            <div class="form-group">
                <label for="jawaban_b">Jawaban B</label>
                <textarea name="inputs[${i}][jawaban_b]" id="jawaban_b_${i}" cols="5" rows="5"
                class="form-control @error('inputs[${i}][jawaban_b]') is-invalid @enderror" required></textarea>
                @error('inputs[${i}][jawaban_b]')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            </div>
            <div class="col-md-6 mb-2">
            <div class="form-group">
                <label for="jawaban_c">Jawaban C</label>
                <textarea name="inputs[${i}][jawaban_c]" id="jawaban_c_${i}" cols="5" rows="5"
                class="form-control @error('inputs[${i}][jawaban_c]') is-invalid @enderror" required></textarea>
                @error('inputs[${i}][jawaban_c]')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            </div>
            <div class="col-md-6 mb-2">
            <div class="form-group">
                <label for="jawaban_d">Jawaban D</label>
                <textarea name="inputs[${i}][jawaban_d]" id="jawaban_d_${i}" cols="5" rows="5"
                class="form-control @error('inputs[${i}][jawaban_d]') is-invalid @enderror" required></textarea>
                @error('inputs[${i}][jawaban_d]')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            </div>
            <div class="col">
            <div class="form-group">
                <label for="kunci_jawaban">Kunci Jawaban</label>
                <select class="form-select @error('inputs[${i}][kunci_jawaban]') is-invalid @enderror"
                name="inputs[${i}][kunci_jawaban]" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                </select>
                @error('inputs[${i}][kunci_jawaban]')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            </div>
            </div>
            <hr />
        </div>
        `;
        $("#repeater-container").append(newForm);
        CKEDITOR.replace(`soal_${i}`, {
          filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
          filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace(`jawaban_a_${i}`, {
          filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
          filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace(`jawaban_b_${i}`, {
          filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
          filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace(`jawaban_c_${i}`, {
          filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
          filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace(`jawaban_d_${i}`, {
          filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
          filebrowserUploadMethod: 'form'
        });
        i++;
      }

      function removeRepeater(button) {
        $(button).closest(".repeater-item").remove(); // Hapus formulir saat tombol "Hapus" diklik
      }
    </script>
  @endpush
@endsection
