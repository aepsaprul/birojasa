@extends('layouts.app')

@section('style')

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Tambah Pesanan</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Pesanan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form id="form_create">

                            {{-- kategori id --}}
                            <input type="hidden" name="kategori_id" id="kategori_id" value="{{ $kategori->id }}">

                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">{{ $kategori->nama }}</h3>
                                <div class="card-tools">
                                    <a href="{{ route('pesanan.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12 mb-2">
                                        <label for="pelanggan_id" class="font-weight-normal">Nama Pelanggan</label>
                                        <select name="pelanggan_id" id="pelanggan_id" class="form-control">
                                            <option value="">--Pilih Pelanggan--</option>
                                            <option value="tambah_pelanggan_baru" id="tambah_pelanggan_baru" class="font-weight-bold">Tambah Baru</option>
                                            @foreach ($pelanggans as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 mb-2">
                                        <label for="pemilik" class="font-weight-normal">Pemilik Kendaraan</label>
                                        <select name="pemilik" id="pemilik" class="form-control">
                                            <option value="">--Pilih Pemilik Kendaraan--</option>
                                            <option value="pribadi">Pribadi</option>
                                            <option value="perusahaan">Perusahaan</option>
                                            <option value="niaga">Niaga</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 mb-2">
                                        <label for="jenis" class="font-weight-normal">Jenis Kendaraan</label>
                                        <select name="jenis" id="jenis" class="form-control">
                                            <option value="">--Pilih Jenis Kendaraan--</option>
                                            <option value="motor">Motor</option>
                                            <option value="mobil">Mobil</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 mb-2">
                                        <label for="tahun" class="font-weight-normal">Tahun Kendaraan</label>
                                        <select name="tahun" id="tahun" class="form-control">
                                            @for ($i = date('Y'); $i > 1995; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 mb-2">
                                        <label for="plat_nomor" class="font-weight-normal">Nomor Polisi</label>
                                        <input type="text" name="plat_nomor" id="plat_nomor" class="form-control">
                                    </div>

                                    @if ($kategori->id != 6)
                                        <div class="col-lg-4 col-md-4 col-12 mb-2">
                                            <label for="pkb_berlaku" class="font-weight-normal">PKB Berlaku s/d</label>
                                            <input type="date" name="pkb_berlaku" id="pkb_berlaku" class="form-control">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12 mb-2">
                                            <label for="pkb_nominal" class="font-weight-normal">Nominal PKB Terakhir</label>
                                            <input type="text" name="pkb_nominal" id="pkb_nominal" class="form-control">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12 mb-2">
                                            <label for="swdkllj" class="font-weight-normal">Nominal SWDKLLJ</label>
                                            <input type="text" name="swdkllj" id="swdkllj" class="form-control">
                                        </div>
                                    @endif

                                    @if ($kategori->id == 3 || $kategori->id == 4 || $kategori->id == 5)
                                        <div class="col-lg-4 col-md-4 col-12 mb-2">
                                            <label for="samsat_asal" class="font-weight-normal">Samsat Asal</label>
                                            <select name="samsat_asal" id="samsat_asal" class="form-control">
                                                <option value="">--Pilih Samsat Asal--</option>
                                                <option value="tambah_samsat_asal" id="tambah_samsat_asal" class="font-weight-bold">Tambah Baru</option>
                                                @foreach ($kotas as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12 mb-2">
                                            <label for="samsat_tujuan" class="font-weight-normal">Samsat Tujuan</label>
                                            <select name="samsat_tujuan" id="samsat_tujuan" class="form-control">
                                                <option value="">--Pilih Samsat Tujuan--</option>
                                                <option value="tambah_samsat_tujuan" id="tambah_samsat_tujuan" class="font-weight-bold">Tambah Baru</option>
                                                @foreach ($kotas as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer text-right">
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
        </div>
    </section>
</div>

{{-- create pelanggan --}}
<div class="modal fade modal-form-create-pelanggan" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_pelanggan" class="form-create-pelanggan">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    {{-- id --}}
                    <input type="hidden" name="id" id="id">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control form-control-sm" id="nama" name="nama" maxlength="30" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control form-control-sm" id="telepon" name="telepon" maxlength="15" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control form-control-sm" id="email" name="email" maxlength="50" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"></textarea>
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

{{-- create kota --}}
<div class="modal fade modal-form-create-kota" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_kota" class="form-create-kota">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Kota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    {{-- id --}}
                    <input type="hidden" name="id" id="id">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kota</label>
                        <input type="text" class="form-control form-control-sm" id="nama" name="nama" maxlength="30" required>
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

@endsection

@section('script')

<script>
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

        // create pelanggan
        $(document).on('change', '#pelanggan_id', function (e) {
            if ($('#pelanggan_id').val() == "tambah_pelanggan_baru") {
                $('.modal-form-create-pelanggan').modal('show');
            }
        })

        $(document).on('shown.bs.modal', '.modal-form-create-pelanggan', function() {
            $('#nama').focus();
        });

        $(document).on('submit', '.form-create-pelanggan', function (e) {
            e.preventDefault();

            var formData = new FormData($('#form_pelanggan')[0]);

            $.ajax({
                url: "{{ URL::route('pesanan.pelanggan_store') }}",
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
                        title: 'Data berhasil ditambah'
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

        // create kota
        $(document).on('change', '#samsat_asal', function (e) {
            if ($('#samsat_asal').val() == "tambah_samsat_asal") {
                $('.modal-form-create-kota').modal('show');
            }
        })

        $(document).on('change', '#samsat_tujuan', function (e) {
            if ($('#samsat_tujuan').val() == "tambah_samsat_tujuan") {
                $('.modal-form-create-kota').modal('show');
            }
        })

        $(document).on('shown.bs.modal', '.modal-form-create-kota', function() {
            $('#nama').focus();
        });

        $(document).on('submit', '.form-create-kota', function (e) {
            e.preventDefault();

            var formData = new FormData($('#form_kota')[0]);

            $.ajax({
                url: "{{ URL::route('pesanan.kota_store') }}",
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
                        title: 'Data berhasil ditambah'
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

        // create form
        $(document).on('submit', '#form_create', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form_create')[0]);

            $.ajax({
                url: "{{ URL::route('pesanan.tambah_simpan') }}",
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
            })
        })
    });
</script>

@endsection
