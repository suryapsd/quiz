@extends('layouts_dashboard.app')
@section('content')
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-12 mb-4 order-0">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <h1 class="fw-semibold d-block mb-1 fs-4 d-flex align-items-center">
                <span class="d-block text-primary">Dashboard</span>
              </h1>
            </div>
            <div class="mt-4">
              <p>QUIZ Website ini dirancang khusus untuk membantu calon peserta tes ujian mempersiapkan diri
                dengan baik sebelum mengikuti tes resmi. Website ini menawarkan berbagai fitur dan materi latihan yang
                dapat meningkatkan pemahaman dan kemampuan calon peserta.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-4 mb-4">
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left">
                <span>Instansi</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $instansi }}</h4>
                </div>
                <span>---</span>
              </div>
              <span class="badge bg-label-primary rounded p-2">
                <i class="ti ti-building-bank ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left">
                <span>Sekolah</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $sekolah }}</h4>
                </div>
                <span>---</span>
              </div>
              <span class="badge bg-label-danger rounded p-2">
                <i class="ti ti-school ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left">
                <span>Siswa</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $siswa }}</h4>
                </div>
                <span>---</span>
              </div>
              <span class="badge bg-label-success rounded p-2">
                <i class="ti ti-users ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left">
                <span>Jenis Soal</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $jenis_soal }}</h4>
                </div>
                <span>---</span>
              </div>
              <span class="badge bg-label-warning rounded p-2">
                <i class="ti ti-quote ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->
@endsection
