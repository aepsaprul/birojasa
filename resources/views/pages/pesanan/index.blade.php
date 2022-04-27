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
                    <h1>Pesanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pesanan</li>
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
                                @foreach ($kategoris as $item)
                                    <a href="{{ route('pesanan.create', [$item->id]) }}" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                        <i class="fas fa-plus"></i> {{ $item->nama }}
                                    </a>
                                @endforeach
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Kategori</th>
                                        <th class="text-center text-indigo">Pelanggan</th>
                                        <th class="text-center text-indigo">Berlaku s/d</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanans as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td><a href="#" class="btn-detail" data-id="{{ $item->id }}">{{ $item->kategori->nama }}</a></td>
                                            <td>{{ $item->pelanggan->nama }}</td>
                                            <td class="text-center">
                                                @if ($item->pkb_berlaku)
                                                    {{ tgl_indo($item->pkb_berlaku) }}
                                                @endif
                                            </td>
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

{{-- detail --}}
<div class="modal fade modal-form-detail" id="modal-default">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form id="form_detail" class="form-detail">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="data_form_detail" class="row">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- create & update --}}
<div class="modal fade modal-form" id="modal-default">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form id="form" class="form-create">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="data_form_edit" class="row">
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

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-delete">
                <input type="hidden" id="delete_id" name="delete_id">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary btn-sm btn-delete-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm btn-delete-yes text-center" style="width: 130px;">
                        Ya
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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

    // detail
    $(document).on('click', '.btn-detail', function (e) {
        e.preventDefault();
        $('#data_form_detail').empty();
        $('.modal-title').empty();

        var id = $(this).attr('data-id');
        var url = '{{ route("pesanan.show", ":id") }}';
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            type: 'get',
            success: function (response) {
                $('.modal-title').append(response.pesanan.kategori.nama);

                let val_detail = "" +
                "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                    "<label class=\"font-weight-normal\">Nama Pelanggan</label>" +
                    "<input type=\"text\" class=\"form-control\" value=\"" + response.pesanan.pelanggan.nama + "\" readonly>" +
                "</div>" +
                "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                    "<label class=\"font-weight-normal\">Pemilik Kendaraan</label>" +
                    "<input type=\"text\" class=\"form-control\" value=\"" + response.pesanan.pemilik + "\" readonly>" +
                "</div>" +
                "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                    "<label class=\"font-weight-normal\">Jenis Kendaraan</label>" +
                    "<input type=\"text\" class=\"form-control\" value=\"" + response.pesanan.jenis + "\" readonly>" +
                "</div>" +
                "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                    "<label class=\"font-weight-normal\">Tahun Kendaraan</label>" +
                    "<input type=\"text\" class=\"form-control\" value=\"" + response.pesanan.tahun + "\" readonly>" +
                "</div>" +
                "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                    "<label for=\"plat_nomor\" class=\"font-weight-normal\">Nomor Polisi</label>" +
                    "<input type=\"text\" class=\"form-control\" value=\"" + response.pesanan.plat_nomor + "\" readonly>" +
                "</div>";

                if (response.pesanan.kategori.id != 6) {
                    val_detail += "" +
                    "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                        "<label class=\"font-weight-normal\">PKB Berlaku s/d</label>" +
                        "<input type=\"date\" class=\"form-control\" value=\"" + response.pesanan.pkb_berlaku + "\" readonly>" +
                    "</div>" +
                    "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                        "<label class=\"font-weight-normal\">Nominal PKB Terakhir</label>" +
                        "<input type=\"text\" class=\"form-control\" value=\"" + response.pesanan.pkb_nominal + "\" readonly>" +
                    "</div>" +
                    "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                        "<label class=\"font-weight-normal\">Nominal SWDKLLJ</label>" +
                        "<input type=\"text\" class=\"form-control\" value=\"" + response.pesanan.swdkllj + "\" readonly>" +
                    "</div>";
                }

                if (response.pesanan.kategori.id == 3 || response.pesanan.kategori.id == 4 || response.pesanan.kategori.id == 5) {
                    val_detail += "" +
                    "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                        "<label class=\"font-weight-normal\">Samsat Asal</label>" +
                        "<input type=\"text\" class=\"form-control\" value=\"" + response.pesanan.samsat_asal.nama + "\" readonly>" +
                    "</div>" +
                    "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                        "<label class=\"font-weight-normal\">Samsat Tujuan</label>" +
                        "<input type=\"text\" class=\"form-control\" value=\"" + response.pesanan.samsat_tujuan.nama + "\" readonly>" +
                    "</div>";
                }

                $('#data_form_detail').append(val_detail);

                $('.modal-form-detail').modal('show');
            }
        })
    })

    // edit
    $('body').on('click', '.btn-edit', function (e) {
        e.preventDefault();
        $('.modal-title').empty();
        $('.modal-btn').empty();
        $('#data_form_edit').empty();

        var id = $(this).attr('data-id');
        var url = '{{ route("pesanan.edit", ":id") }}';
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
                $('.modal-title').append("Ubah Data Pesanan")
                $('.modal-btn').append("Perbaharui");

                let val_form_edit = "" +

                // id
                "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"" + response.pesanan.id + "\">" +

                // kategori id
                "<input type=\"hidden\" name=\"kategori_id\" id=\"kategori_id\" value=\"" + response.pesanan.kategori_id + "\">" +

                "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                    "<label for=\"pelanggan_id\" class=\"font-weight-normal\">Nama Pelanggan</label>" +
                    "<select name=\"pelanggan_id\" id=\"pelanggan_id\" class=\"form-control\">" +
                        "<option value=\"\">--Pilih Pelanggan--</option>" +
                        "<option value=\"tambah_pelanggan_baru\" id=\"tambah_pelanggan_baru\" class=\"font-weight-bold\">Tambah Baru</option>";

                        $.each(response.pelanggans, function (index, value) {
                            val_form_edit += "<option value=\"" + value.id + "\"";
                            if (value.id == response.pesanan.pelanggan_id) {
                                val_form_edit += " selected";
                            }
                            val_form_edit += ">" + value.nama + "</option>";
                        })

                    val_form_edit += "</select>" +
                "</div>" +
                "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                    "<label for=\"pemilik\" class=\"font-weight-normal\">Pemilik Kendaraan</label>" +
                    "<select name=\"pemilik\" id=\"pemilik\" class=\"form-control\">" +
                        "<option value=\"\">--Pilih Pemilik Kendaraan--</option>" +
                        "<option value=\"pribadi\"" + (response.pesanan.pemilik == "pribadi" ? " selected" : "") + ">Pribadi</option>" +
                        "<option value=\"perusahaan\"" + (response.pesanan.pemilik == "perusahaan" ? " selected" : "") + ">Perusahaan</option>" +
                        "<option value=\"niaga\"" + (response.pesanan.pemilik == "niaga" ? " selected" : "") + ">Niaga</option>" +
                    "</select>" +
                "</div>" +
                "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                    "<label for=\"jenis\" class=\"font-weight-normal\">Jenis Kendaraan</label>" +
                    "<select name=\"jenis\" id=\"jenis\" class=\"form-control\">" +
                        "<option value=\"\">--Pilih Jenis Kendaraan--</option>" +
                        "<option value=\"motor\"" + (response.pesanan.jenis == "motor" ? " selected" : "") + ">Motor</option>" +
                        "<option value=\"mobil\"" + (response.pesanan.jenis == "mobil" ? " selected" : "") + ">Mobil</option>" +
                    "</select>" +
                "</div>" +
                "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                    "<label for=\"tahun\" class=\"font-weight-normal\">Tahun Kendaraan</label>" +
                    "<select name=\"tahun\" id=\"tahun\" class=\"form-control\">";

                    var today =  new Date();
                    var year = today.getFullYear();

                    for (let index = year; index > 1995; index--) {
                        val_form_edit += "<option value=\"" + index + "\"" + (response.pesanan.tahun == index ? " selected" : "") + ">" + index + "</option>";
                    }

                    val_form_edit += "</select>" +
                "</div>" +
                "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                    "<label for=\"plat_nomor\" class=\"font-weight-normal\">Nomor Polisi</label>" +
                    "<input type=\"text\" name=\"plat_nomor\" id=\"plat_nomor\" class=\"form-control\" value=\"" + response.pesanan.plat_nomor + "\">" +
                "</div>";

                if (response.pesanan.kategori.id != 6) {

                    val_form_edit += "" +
                    "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                        "<label for=\"pkb_berlaku\" class=\"font-weight-normal\">PKB Berlaku s/d</label>" +
                        "<input type=\"date\" name=\"pkb_berlaku\" id=\"pkb_berlaku\" class=\"form-control\" value=\"" + response.pesanan.pkb_berlaku + "\">" +
                    "</div>" +
                    "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                        "<label for=\"pkb_nominal\" class=\"font-weight-normal\">Nominal PKB Terakhir</label>" +
                        "<input type=\"text\" name=\"pkb_nominal\" id=\"pkb_nominal\" class=\"form-control\" value=\"" + response.pesanan.pkb_nominal + "\">" +
                    "</div>" +
                    "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                        "<label for=\"swdkllj\" class=\"font-weight-normal\">Nominal SWDKLLJ</label>" +
                        "<input type=\"text\" name=\"swdkllj\" id=\"swdkllj\" class=\"form-control\" value=\"" + response.pesanan.swdkllj + "\">" +
                    "</div>";

                }

                if (response.pesanan.kategori.id == 3 || response.pesanan.kategori.id == 4 || response.pesanan.kategori.id == 5) {

                    val_form_edit += "" +
                    "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                        "<label for=\"samsat_asal\" class=\"font-weight-normal\">Samsat Asal</label>" +
                        "<select name=\"samsat_asal\" id=\"samsat_asal\" class=\"form-control\">" +
                            "<option value=\"\">--Pilih Samsat Asal--</option>" +
                            "<option value=\"tambah_samsat_asal\" id=\"tambah_samsat_asal\" class=\"font-weight-bold\">Tambah Baru</option>";

                            $.each(response.kotas, function (index, value) {
                                val_form_edit += "<option value=\"" + value.id + "\"" + (value.id == response.pesanan.samsat_asal.id ? " selected" : "") + ">" + value.nama + "</option>";
                            })

                        val_form_edit += "</select>" +
                    "</div>" +
                    "<div class=\"col-lg-4 col-md-4 col-12 mb-2\">" +
                        "<label for=\"samsat_tujuan\" class=\"font-weight-normal\">Samsat Tujuan</label>" +
                        "<select name=\"samsat_tujuan\" id=\"samsat_tujuan\" class=\"form-control\">" +
                            "<option value=\"\">--Pilih Samsat Tujuan--</option>" +
                            "<option value=\"tambah_samsat_tujuan\" id=\"tambah_samsat_tujuan\" class=\"font-weight-bold\">Tambah Baru</option>";

                            $.each(response.kotas, function (index, value) {
                                val_form_edit += "<option value=\"" + value.id + "\"" + (value.id == response.pesanan.samsat_tujuan.id ? " selected" : "") + ">" + value.nama + "</option>";

                            })

                        val_form_edit += "</select>" +
                    "</div>";

                }
                $('#data_form_edit').append(val_form_edit);

                $('.modal-form').modal('show');
            }
        })
    });

    $(document).on('submit', '.form-edit', function (e) {
        e.preventDefault();

        var formData = new FormData($('#form')[0]);

        $.ajax({
            url: "{{ URL::route('pesanan.update') }}",
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
        var url = '{{ route("pesanan.delete_btn", ":id") }}';
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
            url: "{{ URL::route('pesanan.delete') }}",
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
