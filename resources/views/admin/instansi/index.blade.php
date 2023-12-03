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
              <th>Instansi</th>
              <th>Tinggi Badan</th>
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
                    <label for="nik" class="form-label">Nama Instansi</label>
                    <input type="text" id="nama_instansi" name="nama_instansi" class="form-control"
                      placeholder="Masukkan nama instansi" />
                    <span class="invalid-feedback" id="nama_instansi_error"></span>
                  </div>
                  <div class="col mb-0">
                    <label for="email" class="form-label">Tinggi Badan Minimal</label>
                    <input type="text" id="min_tinggi_badan" name="min_tinggi_badan" class="form-control"
                      placeholder="1xx" />
                    <span class="invalid-feedback" id="min_tinggi_badan_error"></span>
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
            url: '{{ url('admin/getInstansi') }}',
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
              data: 'nama_instansi',
              name: 'nama_instansi',
              orderable: true,
              searchable: true,
              class: 'text-left'
            },
            {
              data: 'min_tinggi_badan',
              name: 'min_tinggi_badan',
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

      $('body').on('click', '.editData', function() {
        var id = $(this).data('id');
        $.get("{{ url('/admin/instansi') }}" + '/' + id + '/edit', function(data) {
          $('#modelHeading').html("Edit Data Instansi");
          $('#saveBtn').val("edit-jenis");
          $('#ajaxModel').modal('show');
          $('#id').val(data.id);
          $('#nama_instansi').val(data.nama_instansi);
          $('#min_tinggi_badan').val(data.min_tinggi_badan);
        })
      });

      $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');

        // Remove the error handling for the "jenis" and "Nama" fields
        $('#jenis').removeClass('is-invalid');
        $('#jenis-error').remove();

        $.ajax({
          data: $('#modalForm').serialize(),
          url: "{{ url('/admin/instansi') }}",
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
              url: "{{ url('/admin/instansi') }}/" + id,
              data: {
                _method: "DELETE",
                _token: "{{ csrf_token() }}"
              },
              type: "POST",
              dataType: "JSON",
              success: function(data) {
                if (data.success == 1) {
                  table.ajax.reload();
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