@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Estimasi Biaya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Estimasi Biaya</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Kategori</th>
                                        <th class="text-center text-indigo">Antar & Jemput</th>
                                        <th class="text-center text-indigo">Jasa</th>
                                        <th class="text-center text-indigo">Administrasi</th>
                                        <th class="text-center text-indigo">BPKB</th>
                                        <th class="text-center text-indigo">STNK</th>
                                        <th class="text-center text-indigo">TNKB</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estimasi_biayas as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->kategori->nama }}</td>
                                            <td>{{ rupiah($item->antar + $item->jemput) }}</td>
                                            <td>{{ rupiah($item->jasa) }}</td>
                                            <td>{{ rupiah($item->administrasi) }}</td>
                                            <td>{{ rupiah($item->bpkb) }}</td>
                                            <td>{{ rupiah($item->stnk) }}</td>
                                            <td>{{ rupiah($item->tnkb) }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a
                                                        href="#"
                                                        class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                            <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a
                                                            href="#"
                                                            class="dropdown-item border-bottom btn-edit"
                                                            data-id="{{ $item->id }}">
                                                                <i class="fas fa-pencil-alt pr-1"></i> Ubah
                                                        </a>
                                                        <a
                                                            href="#"
                                                            class="dropdown-item btn-delete"
                                                            data-id="{{ $item->id }}">
                                                                <i class="fas fa-minus-circle pr-1"></i> Hapus
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
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <form id="form" class="form-create">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Biaya</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    {{-- id --}}
                    <input type="hidden" name="id" id="id">

                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                            <label for="antar" class="form-label">Biaya Antar</label>
                            <input type="text" class="form-control form-control-sm" id="antar" name="antar" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                            <label for="jemput" class="form-label">Biaya Jemput</label>
                            <input type="text" class="form-control form-control-sm" id="jemput" name="jemput" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                            <label for="jasa" class="form-label">Biaya Jasa</label>
                            <input type="text" class="form-control form-control-sm" id="jasa" name="jasa" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                            <label for="administrasi" class="form-label">Biaya Administrasi</label>
                            <input type="text" class="form-control form-control-sm" id="administrasi" name="administrasi" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                            <label for="bpkb" class="form-label">Biaya BPKB</label>
                            <input type="text" class="form-control form-control-sm" id="bpkb" name="bpkb" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                            <label for="stnk" class="form-label">Biaya STNK</label>
                            <input type="text" class="form-control form-control-sm" id="stnk" name="stnk" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                            <label for="tnkb" class="form-label">Biaya TNKB</label>
                            <input type="text" class="form-control form-control-sm" id="tnkb" name="tnkb" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
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

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-delete">
                <input type="hidden" id="delete_id" name="delete_id">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary btn-delete-spinner" disabled style="width: 130px; display: none;">
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

$(function () {
    $("#example1").DataTable();
});
$(document).ready(function () {
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

    // create
    $('#btn-create').on('click', function() {
        $.ajax({
            url: "{{ URL::route('estimasi_biaya.create') }}",
            type: 'get',
            success: function (response) {
                let val_kategori = "<option value=\"\">--Pilih Kategori--</option>";
                $.each(response.kategoris, function (index, value) {
                    val_kategori += "<option value=\"" + value.id + "\">" + value.nama + "</option>";
                })
                $('#kategori_id').append(val_kategori);

                $('.modal-form').modal('show');
            }
        })
    });

    $(document).on('shown.bs.modal', '.modal-form', function() {
        $('#nama').focus();

        var antar = document.getElementById("antar");
        antar.addEventListener("keyup", function(e) {
            antar.value = formatRupiah(this.value, "");
        });

        var jemput = document.getElementById("jemput");
        jemput.addEventListener("keyup", function(e) {
            jemput.value = formatRupiah(this.value, "");
        });

        var jasa = document.getElementById("jasa");
        jasa.addEventListener("keyup", function(e) {
            jasa.value = formatRupiah(this.value, "");
        });

        var administrasi = document.getElementById("administrasi");
        administrasi.addEventListener("keyup", function(e) {
            administrasi.value = formatRupiah(this.value, "");
        });

        var bpkb = document.getElementById("bpkb");
        bpkb.addEventListener("keyup", function(e) {
            bpkb.value = formatRupiah(this.value, "");
        });

        var stnk = document.getElementById("stnk");
        stnk.addEventListener("keyup", function(e) {
            stnk.value = formatRupiah(this.value, "");
        });

        var tnkb = document.getElementById("tnkb");
        tnkb.addEventListener("keyup", function(e) {
            tnkb.value = formatRupiah(this.value, "");
        });
    });

    $(document).on('submit', '.form-create', function (e) {
        e.preventDefault();

        var formData = new FormData($('#form')[0]);

        $.ajax({
            url: "{{ URL::route('estimasi_biaya.store') }}",
            type: 'POST',
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

    // edit
    $('body').on('click', '.btn-edit', function (e) {
        e.preventDefault();
        $('.modal-title').empty();
        $('.modal-btn').empty();
        $('#kategori_id').empty();

        var id = $(this).attr('data-id');
        var url = '{{ route("estimasi_biaya.edit", ":id") }}';
        url = url.replace(':id', id);

        var formData = {
            id: id
        }

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            success: function (response) {
                $('#form').removeClass('form-create');
                $('#form').addClass('form-edit');
                $('.modal-title').append("Ubah Data Biaya")
                $('.modal-btn').append("Perbaharui");

                $('#id').val(response.estimasi_biaya.id);
                $('#antar').val(format_rupiah(response.estimasi_biaya.antar));
                $('#jemput').val(format_rupiah(response.estimasi_biaya.jemput));
                $('#jasa').val(format_rupiah(response.estimasi_biaya.jasa));
                $('#administrasi').val(format_rupiah(response.estimasi_biaya.administrasi));
                $('#bpkb').val(format_rupiah(response.estimasi_biaya.bpkb));
                $('#stnk').val(format_rupiah(response.estimasi_biaya.stnk));
                $('#tnkb').val(format_rupiah(response.estimasi_biaya.tnkb));

                let val_kategori = "<option value=\"\">--Pilih Kategori--</option>";
                $.each(response.kategoris, function (index, value) {
                    val_kategori += "<option value=\"" + value.id + "\"";
                    if (value.id == response.estimasi_biaya.kategori_id) {
                        val_kategori += " selected";
                    }
                    val_kategori += ">" + value.nama + "</option>";
                })
                $('#kategori_id').append(val_kategori);

                $('.modal-form').modal('show');
            }
        })
    });

    $(document).on('submit', '.form-edit', function (e) {
        e.preventDefault();

        var formData = new FormData($('#form')[0]);

        $.ajax({
            url: "{{ URL::route('estimasi_biaya.update') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.btn-spinner').removeClass("d-none");
                $('.btn-save').addClass("d-none");
            },
            success: function (response) {
                Toast.fire({
                    icon: 'success',
                    title: 'Data berhasil diperbaharui'
                });

                setTimeout( () => {
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

    // delete
    $('body').on('click', '.btn-delete', function (e) {
        e.preventDefault();

        var id = $(this).attr('data-id');
        var url = '{{ route("estimasi_biaya.delete_btn", ":id") }}';
        url = url.replace(':id', id);

        var formData = {
            id: id
        }

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            success: function (response) {
                $('#delete_id').val(response.id);
                $('.modal-delete').modal('show');
            }
        });
    });

    $('#form-delete').submit(function (e) {
        e.preventDefault();

        var formData = {
            id: $('#delete_id').val()
        }

        $.ajax({
            url: "{{ URL::route('estimasi_biaya.delete') }}",
            type: 'POST',
            data: formData,
            beforeSend: function () {
                $('.btn-delete-spinner').css('display', 'block');
                $('.btn-delete-yes').css('display', 'none');
            },
            success: function (response) {
                Toast.fire({
                    icon: 'success',
                    title: 'Data berhasil dihapus'
                });

                setTimeout( () => {
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
});

</script>

@endsection
