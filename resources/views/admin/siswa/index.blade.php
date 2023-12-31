@extends('layouts_dashboard.app')
@section('content')
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Users List Table -->
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">List Data {{ $title }}</h5>
        {{-- <a href="javascript:void(0)" id="addNewData" class="btn btn-primary">
          <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Data
        </a> --}}
        <div class="mb-3">
          <label for="filterSchool" class="form-label">Filter by School:</label>
          <select id="filterSchool" class="selectpicker" data-style="btn-default" data-live-search="true">
            <option value="" selected>All Schools</option>
            @foreach ($sekolahs as $sekolah)
              <option value="{{ $sekolah->id }}">{{ $sekolah->nama_sekolah }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="card-datatable table-responsive">
        <table id="{{ $table_id }}" class="datatables-users-account table border-top">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Sekolah</th>
              <th>No Whatsapp</th>
              <th>Tinggi Badan</th>
              <th>Jenis Kelamin</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="ajaxModel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modelHeading">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:void(0)" id="modalForm" name="modalForm" method="POST" class="form-horizontal">
              @csrf
              <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="id_user" id="id_user">
                <div class="">
                  <div class="col mb-3">
                    <label for="nik" class="form-label">Nama Siswa</label>
                    <input type="text" id="nama" name="nama" class="form-control"
                      placeholder="Masukkan nama instansi" />
                    <span class="invalid-feedback" id="nama_error"></span>
                  </div>
                  <div class="col mb-3">
                    <label for="id_sekolah" class="form-label">Sekolah</label>
                    <select id="id_sekolah" name="id_sekolah" class="selectpicker w-100" data-style="btn-default"
                      data-live-search="true">
                    </select>
                    <span class="invalid-feedback" id="id_sekolah_error"></span>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col">
                    <label for="email" class="form-label">No Whatsapp</label>
                    <input type="text" id="no_wa" name="no_wa" class="form-control" placeholder="1xx" />
                    <span class="invalid-feedback" id="no_wa_error"></span>
                  </div>
                  <div class="col">
                    <label for="email" class="form-label">Tinggi Badan</label>
                    <input type="text" id="tinggi_badan" name="tinggi_badan" class="form-control" placeholder="1xx" />
                    <span class="invalid-feedback" id="tinggi_badan_error"></span>
                  </div>
                  <div class="col">
                    <label for="email" class="form-label">Jenis Kelamin</label>
                    <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control"
                      placeholder="1xx" />
                    <span class="invalid-feedback" id="jenis_kelamin_error"></span>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                  Close
                </button>
                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- / Content -->
  @push('script')
    <script type="text/javascript">
      var table;
      $(document).ready(function() {
        $('#filterSchool').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
          // Redraw the DataTable when the school filter changes
          table.ajax.reload();
        });

        table = $('#{{ $table_id }}').DataTable({

          "language": {
            "lengthMenu": "_MENU_",
            /* 'loadingRecords': '&nbsp;',
            'processing': '<img src="{{ asset('assets/img/loader-sm.gif') }}"/>' */
          },
          processing: true,
          autoWidth: true,
          ordering: true,
          serverSide: true,
          ajax: {
            url: '{{ url('admin/getSiswa') }}',
            type: "POST",
            data: function(params) {
              params._token = "{{ csrf_token() }}";
              params.id_sekolah = $('#filterSchool').val(); // Add selected school ID from the filter
            }
          },

          language: {
            search: "",
            searchPlaceholder: "Type in to Search",
            lengthMenu: "<div class='d-flex justify-content-start form-control-select'> _MENU_ </div>",
            // info: "_START_ -_END_ of _TOTAL_",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_",
            infoEmpty: "No records found",
            infoFiltered: "( Total _MAX_  )",
            paginate: {
              "first": "First",
              "last": "Last",
              "next": "Next",
              "previous": "Prev"
            }
          },
          columns: [{
              data: 'DT_RowIndex',
              name: 'DT_RowIndex',
              orderable: false,
              searchable: false,
              class: 'text-left'
            },
            {
              data: 'sekolah',
              name: 'sekolah',
              orderable: true,
              searchable: true,
              class: 'text-left'
            },
            {
              data: 'nama',
              name: 'nama',
              orderable: true,
              searchable: true,
              class: 'text-left'
            },
            {
              data: 'no_wa',
              name: 'no_wa',
              orderable: true,
              searchable: true,
              class: 'text-left'
            },
            {
              data: 'tinggi_badan',
              name: 'tinggi_badan',
              orderable: true,
              searchable: true,
              class: 'text-left'
            },
            {
              data: 'jenis_kelamin',
              name: 'jenis_kelamin',
              orderable: true,
              searchable: true,
              class: 'text-left'
            },
            {
              data: 'action',
              name: 'id',
              orderable: false,
              searchable: false,
              class: 'text-center'
            }
          ]
        });

        $("#{{ $table_id }}").DataTable().processing(true);
        $('#{{ $table_id }}_filter input').unbind();
        $('#{{ $table_id }}_filter input').bind('keyup', function(e) {
          if (e.keyCode == 13) {
            table.search(this.value).draw();
          }
        });
        $('.dataTables_filter').html(
          '<div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping"><i class="tf-icons ti ti-search"></i></span><input type="search" class="form-control form-control-sm" placeholder="Type in to Search" aria-label="Type in to Search" aria-describedby="addon-wrapping"></div>'
        );

        // Handle search input changes using DataTables API
        $('#{{ $table_id }}_filter input').on('keyup', function() {
          table.search(this.value).draw();
        });
      });

      function deleteData(id) {
        Swal.fire({
          icon: 'warning',
          text: 'Hapus Data Instansi?',
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
              url: "{{ url('/admin/siswa') }}/" + id,
              data: {
                _method: "DELETE",
                _token: "{{ csrf_token() }}"
              },
              type: "POST",
              dataType: "JSON",
              success: function(data) {
                if (data.success == 1) {
                  table.draw();
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
