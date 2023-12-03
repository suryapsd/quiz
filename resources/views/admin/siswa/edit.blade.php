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
              <form action="" method="post">
                @csrf
                <div class="col mb-2">
                  <label for="nik" class="form-label">Nama Siswa</label>
                  <input type="text" id="nama" name="nama" class="form-control"
                    placeholder="Masukkan nama instansi" value="{{ $siswa->nama }}" />
                  <span class="invalid-feedback" id="nama_error"></span>
                </div>
                <div class="col mb-2">
                  <label for="id_sekolah" class="form-label">Sekolah</label>
                  <select id="id_sekolah" name="id_sekolah" class="selectpicker w-100" data-style="btn-default"
                    data-live-search="true">
                  </select>
                  <span class="invalid-feedback" id="id_sekolah_error"></span>
                </div>
                <div class="col mb-2">
                  <label for="email" class="form-label">No Whatsapp</label>
                  <input type="text" id="no_wa" name="no_wa" class="form-control" placeholder="1xx"
                    value="{{ $siswa->no_wa }}" />
                  <span class="invalid-feedback" id="no_wa_error"></span>
                </div>
                <div class="col mb-2">
                  <label for="email" class="form-label">Tinggi Badan</label>
                  <input type="text" id="tinggi_badan" name="tinggi_badan" class="form-control" placeholder="1xx"
                    value="{{ $siswa->tinggi_badan }}" />
                  <span class="invalid-feedback" id="tinggi_badan_error"></span>
                </div>
                <div class="col mb-3">
                  <label for="email" class="form-label">Jenis Kelamin</label>
                  <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control" placeholder="1xx"
                    value="{{ $siswa->jenis_kelamin }}" />
                  <span class="invalid-feedback" id="jenis_kelamin_error"></span>
                </div>
                <div class="d-flex justify-content-left">
                  <button type="submit" class="btn btn-primary me-3">Edit</button>
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
          <h5 class="card-header">User's Projects List</h5>
          <div class="table-responsive mb-3">
            <table class="table datatable-project border-top">
              <thead>
                <tr>
                  <th></th>
                  <th>Project</th>
                  <th class="text-nowrap">Total Task</th>
                  <th>Progress</th>
                  <th>Hours</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <!-- /Project table -->

        <!-- Activity Timeline -->
        <div class="card mb-4">
          <h5 class="card-header">User Activity Timeline</h5>
          <div class="card-body pb-0">
            <ul class="timeline mb-0">
              <li class="timeline-item timeline-item-transparent">
                <span class="timeline-point timeline-point-primary"></span>
                <div class="timeline-event">
                  <div class="timeline-header mb-1">
                    <h6 class="mb-0">12 Invoices have been paid</h6>
                    <small class="text-muted">12 min ago</small>
                  </div>
                  <p class="mb-2">Invoices have been paid to the company</p>
                  <div class="d-flex">
                    <a href="javascript:void(0)" class="me-3">
                      <img src="{{ asset('admin/img/icons/misc/pdf.png') }}" alt="PDF image" width="15"
                        class="me-2" />
                      <span class="fw-semibold text-heading">invoices.pdf</span>
                    </a>
                  </div>
                </div>
              </li>
              <li class="timeline-item timeline-item-transparent">
                <span class="timeline-point timeline-point-warning"></span>
                <div class="timeline-event">
                  <div class="timeline-header mb-1">
                    <h6 class="mb-0">Client Meeting</h6>
                    <small class="text-muted">45 min ago</small>
                  </div>
                  <p class="mb-2">Project meeting with john @10:15am</p>
                  <div class="d-flex flex-wrap">
                    <div class="avatar me-3">
                      <img src="{{ asset('admin/img/avatars/3.png') }}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div>
                      <h6 class="mb-0">Lester McCarthy (Client)</h6>
                      <small>CEO of Pixinvent</small>
                    </div>
                  </div>
                </div>
              </li>
              <li class="timeline-item timeline-item-transparent">
                <span class="timeline-point timeline-point-info"></span>
                <div class="timeline-event">
                  <div class="timeline-header mb-1">
                    <h6 class="mb-0">Create a new project for client</h6>
                    <small class="text-muted">2 Day Ago</small>
                  </div>
                  <p class="mb-2">5 team members in a project</p>
                  <div class="d-flex align-items-center avatar-group">
                    <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                      data-bs-placement="top" title="Vinnie Mostowy">
                      <img src="{{ asset('admin/img/avatars/5.png') }}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                      data-bs-placement="top" title="Marrie Patty">
                      <img src="{{ asset('admin/img/avatars/12.png') }}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                      data-bs-placement="top" title="Jimmy Jackson">
                      <img src="{{ asset('admin/img/avatars/9.png') }}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                      data-bs-placement="top" title="Kristine Gill">
                      <img src="{{ asset('admin/img/avatars/6.png') }}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                      data-bs-placement="top" title="Nelson Wilson">
                      <img src="{{ asset('admin/img/avatars/4.png') }}" alt="Avatar" class="rounded-circle" />
                    </div>
                  </div>
                </div>
              </li>
              <li class="timeline-item timeline-item-transparent border-0">
                <span class="timeline-point timeline-point-success"></span>
                <div class="timeline-event">
                  <div class="timeline-header mb-1">
                    <h6 class="mb-0">Design Review</h6>
                    <small class="text-muted">5 days Ago</small>
                  </div>
                  <p class="mb-0">Weekly review of freshly prepared design for our new app.</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- /Activity Timeline -->

        <!-- Invoice table -->
        <div class="card mb-4">
          <div class="table-responsive mb-3">
            <table class="table datatable-invoice border-top">
              <thead>
                <tr>
                  <th></th>
                  <th>ID</th>
                  <th><i class="ti ti-trending-up"></i></th>
                  <th>Total</th>
                  <th>Issued Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <!-- /Invoice table -->
      </div>
      <!--/ User Content -->
    </div>
  </div>
  <!-- / Content -->
@endsection
