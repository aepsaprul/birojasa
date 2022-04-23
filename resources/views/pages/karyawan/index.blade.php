@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Karyawan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button id="button-create" type="button" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama</th>
                                        <th class="text-center text-indigo">Email</th>
                                        <th class="text-center text-indigo">Telepon</th>
                                        <th class="text-center text-indigo">Jabatan</th>
                                        <th class="text-center text-indigo">Status</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawans as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="nama_lengkap_{{ $item->id }}"><a href="#" class="btn-detail" data-id="{{ $item->id }}">{{ $item->nama_lengkap }} </a></td>
                                        <td class="email_{{ $item->id }}">{{ $item->email }}</td>
                                        <td class="telepon_{{ $item->id }} text-center">{{ $item->telepon }}</td>
                                        <td class="jabatan_{{ $item->id }}">
                                            @if ($item->jabatan)
                                                {{ $item->jabatan->nama }}
                                            @else
                                                Jabatan kosong
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-switch custom-switch-on-success">
                                                <input
                                                    type="checkbox"
                                                    name="status"
                                                    class="custom-control-input"
                                                    id="status_{{ $item->id }}"
                                                    data-id="{{ $item->id }}"
                                                    {{ $item->status == "aktif" ? "checked" : "" }}>
                                                <label class="custom-control-label" for="status_{{ $item->id }}"></label>
                                                <span class="status_title_{{ $item->id }} text-uppercase" style="font-size: 12px;">{{ $item->status }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a
                                                    class="dropdown-toggle"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false">
                                                            <i class="fa fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a
                                                        class="dropdown-item btn-edit"
                                                        href="#"
                                                        data-id="{{ $item->id }}">
                                                            <i class="fa fa-pencil-alt px-2"></i> Ubah
                                                    </a>
                                                    <a
                                                        class="dropdown-item btn-delete"
                                                        href="#"
                                                        data-id="{{ $item->id }}">
                                                            <i class="fa fa-trash px-2"></i> Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- create & update --}}
<div class="modal fade modal-form" id="modal-default">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="form" class="form-create">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Karyawan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    {{-- id --}}
                    <input type="hidden" name="id" id="id">

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" maxlength="30" >
                                <small id="error_nama_lengkap" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="nama_panggilan">Nama Panggilan</label>
                                <input type="text" id="nama_panggilan" name="nama_panggilan" class="form-control form-control-sm" maxlength="15" >
                                <small id="error_nama_panggilan" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control form-control-sm">
                                    <option value="l">L (Laki - laki)</option>
                                    <option value="p">P (Perempuan)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"></textarea>
                                <small id="error_alamat" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="jabatan_id">Jabatan</label>
                                <select name="jabatan_id" id="jabatan_id" class="form-control form-control-sm" >

                                </select>
                                <small id="error_jabatan_id" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" id="telepon" name="telepon" class="form-control form-control-sm" maxlength="15" >
                                <small id="error_telepon" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control form-control-sm" maxlength="15" >
                                <small id="error_email" class="form-text text-danger"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-save" style="width: 130px;">
                        <i class="fas fa-save"></i> <span class="modal-btn"> Simpan </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- detail --}}
<div class="modal fade modal-detail" id="modal-default">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Data Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="detail_nama_lengkap">Nama Lengkap</label>
                            <input type="text" id="detail_nama_lengkap"class="form-control form-control-sm" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="detail_nama_panggilan">Nama Panggilan</label>
                            <input type="text" id="detail_nama_panggilan" class="form-control form-control-sm" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="detail_gender">Gender</label>
                            <select id="detail_gender" class="form-control form-control-sm" disabled>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="detail_alamat">Alamat</label>
                            <textarea id="detail_alamat" cols="30" rows="3" class="form-control" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="detail_jabatan">Jabatan</label>
                            <input type="text" id="detail_jabatan" class="form-control form-control-sm" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="detail_telepon">Telepon</label>
                            <input type="text" id="detail_telepon" class="form-control form-control-sm" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="detail_email">Email</label>
                            <input type="text" id="detail_email" class="form-control form-control-sm" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-delete">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-delete">
                <input type="hidden" id="delete_id" name="delete_id">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary btn-delete-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-delete-yes text-center" style="width: 130px;">
                        Ya
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('public/themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $("#datatable").DataTable({
            'responsive': true
        });

        // ubath status
        $(document).on('change', 'input[name="status"]', function () {
            let id = $(this).attr('data-id');
            let val_state;

            if ($('#status_' + id).is(":checked")) {
                val_state = "aktif";
            } else {
                val_state = "nonaktif";
            }

            $('.status_title_' + id).empty();

            var formData = {
                id: $(this).attr('data-id'),
                status: val_state
            }

            $.ajax({
                type: "post",
                url: "{{ URL::route('karyawan.status') }}",
                data: formData,
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Status Karyawan berhasil diubah'
                    });

                    $('.status_title_' + response.id).append(response.title);
                }
            });
        });

        // create
        $('#button-create').on('click', function() {
            $.ajax({
                url: "{{ URL::route('karyawan.create') }}",
                type: "GET",
                success: function (response) {
                    var value_jabatan = "<option value=\"\">--Pilih Jabatan--</option>";
                    $.each(response.jabatans, function (index, value) {
                         value_jabatan += "<option value=\"" + value.id + "\">" + value.nama + "</option>";
                    });
                    $('#jabatan_id').append(value_jabatan);

                    $('.modal-form').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '.modal-form', function() {
            $('#nama_lengkap').focus();
        });

        $(document).on('submit', '.form-create', function (e) {
            e.preventDefault();

            $('#error_telepon').empty();
            $('#error_email').empty();
            $('#error_nama_lengkap').empty();
            $('#error_nama_panggilan').empty();
            $('#error_gender').empty();
            $('#error_alamat').empty();
            $('#error_jabatan_id').empty();

            let formData = new FormData($('#form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ URL::route('karyawan.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-spinner').removeClass('d-none');
                    $('.btn-save').addClass('d-none');
                },
                success: function (response) {
                    if (response.status == 400) {
                        $('#error_telepon').append(response.errors.telepon);
                        $('#error_email').append(response.errors.email);
                        $('#error_nama_lengkap').append(response.errors.nama_lengkap);
                        $('#error_nama_panggilan').append(response.errors.nama_panggilan);
                        $('#error_gender').append(response.errors.gender);
                        $('#error_alamat').append(response.errors.alamat);
                        $('#error_jabatan_id').append(response.errors.jabatan_id);

                        setTimeout(() => {
                            $('.btn-spinner').addClass('d-none');
                            $('.btn-save').removeClass('d-none');
                        }, 1000);
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data behasil ditambah'
                        });

                        setTimeout(() => {
                            window.location.reload(1);
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // detail
        $(document).on('click', '.btn-detail', function (e) {
            e.preventDefault();

            $('.modal-btn').empty();
            $('#gender').empty();
            $('#jabatan_id').empty();

            var id = $(this).attr('data-id');
            var url = "{{ route('karyawan.show', ':id') }}";
            url = url.replace(':id', id);

            var formData = {
                id: id
            }

            $.ajax({
                type: "get",
                url: url,
                success: function (response) {
                    console.log(response);
                    $('#detail_nama_lengkap').val(response.nama_lengkap);
                    $('#detail_nama_panggilan').val(response.nama_panggilan);
                    $('#detail_telepon').val(response.telepon);
                    $('#detail_email').val(response.email);
                    $('#detail_alamat').val(response.alamat);
                    $('#detail_jabatan').val(response.jabatan);

                    let value_gender = "" +
                        "<option value=\"l\""; if (response.gender == "l") { value_gender += " selected"; } value_gender += ">L (Laki - laki)</option>" +
                        "<option value=\"p\""; if (response.gender == "p") { value_gender += " selected"; } value_gender += ">P (Perempuan)</option>";
                    $('#detail_gender').append(value_gender);

                    // modal
                    $('.modal-detail').modal('show');
                }
            });
        });

        // edit
        $(document).on('click', '.btn-edit', function (e) {
            e.preventDefault();

            $('.modal-btn').empty();
            $('#gender').empty();
            $('#jabatan_id').empty();

            var id = $(this).attr('data-id');
            var url = "{{ route('karyawan.edit', ':id') }}";
            url = url.replace(':id', id);

            var formData = {
                id: id
            }

            $.ajax({
                type: "get",
                url: url,
                success: function (response) {
                    $('#form').removeClass('form-create');
                    $('#form').addClass('form-edit');
                    $('.modal-btn').append("Perbaharui");

                    $('#id').val(response.id);
                    $('#nama_lengkap').val(response.nama_lengkap);
                    $('#nama_panggilan').val(response.nama_panggilan);
                    $('#telepon').val(response.telepon);
                    $('#email').val(response.email);
                    $('#alamat').val(response.alamat);

                    let value_gender = "" +
                        "<option value=\"l\""; if (response.gender == "l") { value_gender += " selected"; } value_gender += ">L (Laki - laki)</option>" +
                        "<option value=\"p\""; if (response.gender == "p") { value_gender += " selected"; } value_gender += ">P (Perempuan)</option>";
                    $('#gender').append(value_gender);

                    let value_jabatan = "";
                    $.each(response.jabatans, function (index, value) {
                         value_jabatan += "<option value=\"" + value.id + "\""; if (value.id == response.jabatan_id) { value_jabatan += " selected"; } value_jabatan += ">" + value.nama + "</option>";
                    });
                    $('#jabatan_id').append(value_jabatan);

                    // modal
                    $('.modal-form').modal('show');
                }
            });
        });

        $(document).on('submit', '.form-edit', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form')[0]);

            $.ajax({
                url: "{{ URL::route('karyawan.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-spinner').removeClass('d-none');
                    $('.btn-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data behasil ditambah'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        $('body').on('click', '.btn-delete', function(e) {
            e.preventDefault()
            $('.delete_title').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("karyawan.delete_btn", ":id") }}';
            url = url.replace(':id', id );

            var formData = {
                id: id
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function(response) {
                    console.log(response);
                    $('.delete_title').append(response.nama_lengkap);
                    $('#delete_id').val(response.id);
                    $('.modal-delete').modal('show');
                }
            });
        });

        $('#modal-delete').submit(function(e) {
            e.preventDefault();

            var formData = {
                id: $('#delete_id').val()
            }

            $.ajax({
                url: "{{ URL::route('karyawan.delete') }}",
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.btn-delete-spinner').removeClass("d-none");
                    $('.btn-delete-yes').addClass("d-none");
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus.'
                    });
                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + error
                    alert('Error - ' + errorMessage);
                }
            });
        });
    } );
</script>
@endsection
