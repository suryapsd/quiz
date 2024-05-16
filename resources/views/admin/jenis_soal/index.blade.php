@extends('layouts_dashboard.app')
@section('content')
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Users List Table -->
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">List Data {{ $title }}</h5>
        <a href="javascript:void(0)" id="addNewData" class="btn btn-primary">
          <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Data
        </a>
      </div>
      <div class="card-datatable table-responsive">
        <table id="{{ $table_id }}" class="datatables-users-account table border-top">
          <thead>
            <tr>
              <th>No</th>
              <th>Pendidikan</th>
              <th>Jenis Soal</th>
              <th>Jumlah Soal</th>
              <th>Keterangan</th>
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
                <div class="">
                  <div class="col mb-3">
                    <label for="nama_jenis_soal" class="form-label">Jenis Soal <span style="color: red">*</span></label>
                    <input type="text" id="nama_jenis_soal" name="nama_jenis_soal" class="form-control"
                      placeholder="Masukkan jenis soal" value="{{ old('nama_jenis_soal') }}" />
                    <span class="invalid-feedback" id="jenis_soal_error"></span>
                  </div>
                  <div class="col mb-3">
                    <label class="form-label" for="id_pendidikan_instansi">Instansi <span
                        style="color: red">*</span></label>
                    <select id="id_pendidikan_instansi" name="id_pendidikan_instansi"
                      class="form-control @error('id_pendidikan_instansi') is-invalid @enderror selectpicker w-100"
                      data-style="btn-default" data-live-search="true">
                      <option value="">Pilih pendidikan instansi</option>
                      @foreach ($pendidikan as $item)
                        <option data-tokens="{{ $item->nama_pendidikan }}" value="{{ $item->id }}"
                          {{ old('id_pendidikan_instansi') == $item->id ? 'selected' : '' }}>
                          {{ $item->nama_pendidikan }}
                        </option>
                      @endforeach
                    </select>
                    <span class="invalid-feedback" id="id_pendidikan_instansi_error"></span>
                  </div>
                  <div class="col mb-3">
                    <label for="jumlah_soal" class="form-label">Jumlah Soal <span style="color: red">*</span></label>
                    <input type="number" id="jumlah_soal" name="jumlah_soal" class="form-control"
                      placeholder="Masukkan jumlah soal" value="{{ old('jumlah_soal') }}" />
                    <span class="invalid-feedback" id="jumlah_soal_error"></span>
                  </div>
                  <div class="col mb-0">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" id="keterangan" name="keterangan" class="form-control"
                      placeholder="masukkan keterangan/deskripsi" value="{{ old('keterangan') }}" />
                    <span class="invalid-feedback" id="keterangan_error"></span>
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
            url: '{{ url('admin/getJenisSoal') }}',
            type: "POST",
            data: function(params) {
              params._token = "{{ csrf_token() }}";
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
              data: 'pendidikan',
              name: 'pendidikan',
              orderable: true,
              searchable: true,
              class: 'text-left'
            },
            {
              data: 'nama_jenis_soal',
              name: 'nama_jenis_soal',
              orderable: true,
              searchable: true,
              class: 'text-left'
            },
            {
              data: 'jumlah_soal',
              name: 'jumlah_soal',
              orderable: true,
              searchable: true,
              class: 'text-left'
            },
            {
              data: 'keterangan',
              name: 'keterangan',
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

      $('#addNewData').click(function() {
        $('#saveBtn').val("create-jenis");
        $('#id').val('');
        $('#modalForm').trigger("reset");
        $('#modelHeading').html("Tambah Data Instansi");
        $('#ajaxModel').modal('show');
      });

      $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');

        // Remove the error handling for the "jenis" and "Nama" fields
        $('#jenis').removeClass('is-invalid');
        $('#jenis-error').remove();

        $.ajax({
          data: $('#modalForm').serialize(),
          url: "{{ url('/admin/jenis-soal') }}",
          type: "POST",
          dataType: 'json',
          success: function(data) {
            $('#modalForm').trigger("reset");
            $('#saveBtn').html('Simpan');
            $('#ajaxModel').modal('hide');
            if (data.success == 1) {
              Swal.fire({
                title: 'Sukses',
                text: data.msg,
                icon: 'success',
                customClass: {
                  confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
              }).then((result) => {
                // Redirect to the edit page
                if (result.isConfirmed) {
                  window.location.href = "{{ url('/admin/jenis-soal') }}/" + data.id + "/edit";
                }
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
            table.draw();
          },
          error: function(data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');

            // Error handling for specific input fields
            if (data.responseJSON.errors) {
              var errors = data.responseJSON.errors;
              $.each(errors, function(key, value) {
                $("#" + key).addClass("is-invalid");
                $("#" + key + "_error").text(value[0]);
              });
            }
          }
        });
      });


      function removeErrors() {
        $(".form-control").removeClass("is-invalid");
        $(".invalid-feedback").text("");
      }

      // Function to reset form and remove errors when modal is closed
      $("#ajaxModel").on("hidden.bs.modal", function() {
        $('#modalForm').trigger("reset");
        removeErrors();
      });

      function deleteData(id) {
        Swal.fire({
          icon: 'warning',
          text: 'Hapus Data Sekolah?',
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
              url: "{{ url('/admin/jenis-soal') }}/" + id,
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
                console.log(error);
              }
            });
          }
        });
      }
    </script>
  @endpush
@endsection
