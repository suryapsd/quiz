@extends('layouts_dashboard.app')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <!-- User Sidebar -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        <!-- User Card -->
        <div class="card mb-4">
          <div class="card-body">
            <div class="user-avatar-section">
              <div class="d-flex align-items-center flex-column">
                <img class="img-fluid rounded mb-3 pt-1 mt-4" src="{{ asset('admin/img/avatars/15.png') }}" height="100"
                  width="100" alt="User avatar" />
                <div class="user-info text-center">
                  <h4 class="mb-2">{{ $siswa->nama }}</h4>
                  <span class="badge bg-label-secondary mt-1">Siswa</span>
                </div>
              </div>
            </div>
            <hr>
            <p class="mt-4 small text-uppercase text-muted">Details</p>
            <div class="info-container">
              <form action="/admin/siswa/{{ $siswa->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="col mb-2">
                  <label for="nik" class="form-label">Nama Siswa</label>
                  <input type="text" id="nama" name="nama"
                    class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama instansi"
                    value="{{ $siswa->nama }}" />
                  @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col mb-2">
                  <label for="id_sekolah" class="form-label">Sekolah</label>
                  <select id="id_sekolah" name="id_sekolah"
                    class="form-control selectpicker w-100 @error('id_sekolah') is-invalid @enderror"
                    data-style="btn-default" data-live-search="true">
                    <option value="">Pilih Instansi</option>
                    @foreach ($sekolahs as $item)
                      <option data-tokens="{{ $item->nama_sekolah }}" value="{{ $item->id }}"
                        @if ($siswa->id_sekolah == $item->id) selected @endif>{{ $item->nama_sekolah }}
                      </option>
                    @endforeach
                  </select>
                  @error('id_sekolah')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col mb-2">
                  <label for="email" class="form-label">No Whatsapp</label>
                  <input type="text" id="no_wa" name="no_wa"
                    class="form-control @error('no_wa') is-invalid @enderror" placeholder="1xx"
                    value="{{ $siswa->no_wa }}" />
                  @error('no_wa')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col mb-2">
                  <label for="email" class="form-label">Tinggi Badan</label>
                  <input type="text" id="tinggi_badan" name="tinggi_badan"
                    class="form-control @error('tinggi_badan') is-invalid @enderror" placeholder="1xx"
                    value="{{ $siswa->tinggi_badan }}" />
                  @error('tinggi_badan')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col mb-3">
                  <label for="email" class="form-label">Jenis Kelamin</label>
                  <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                    aria-label="Default select example">
                    <option value="Laki-laki"
                      {{ old('jenis_kelamin', $siswa->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan"
                      {{ old('jenis_kelamin', $siswa->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                  </select>
                  @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="d-flex justify-content-left">
                  <button type="submit" class="btn btn-primary me-3">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /User Card -->
      </div>
      <!--/ User Sidebar -->

      <!-- User Content -->
      <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        <!-- Project table -->
        <div class="card mb-4">
          <h5 class="card-header">Aktivitas Siswa</h5>
          <div class="table-responsive mb-3">
            <table class="table datatable-project border-top">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Soal Ujian</th>
                  <th>Benar</th>
                  <th>Salah</th>
                  <th>Nilai</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <!-- /Project table -->
      </div>
      <!--/ User Content -->
    </div>
  </div>
  <!-- / Content -->
@endsection
