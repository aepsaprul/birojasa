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
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
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
                        <div class="card-body">
                            <form id="form" method="post" enctype="multipart/form-data" class="form-create">
                                {{-- id --}}
                                <input type="hidden" id="id" name="id" value="{{ $karyawan->id }}">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-primary card-outline pb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="nama_lengkap">Nama Lengkap</label>
                                                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" value="{{ $karyawan->nama_lengkap }}" maxlength="30" >
                                                            <small id="error_nama_lengkap" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="nama_panggilan">Nama Panggilan</label>
                                                            <input type="text" id="nama_panggilan" name="nama_panggilan" class="form-control form-control-sm" value="{{ $karyawan->nama_panggilan }}" maxlength="15" >
                                                            <small id="error_nama_panggilan" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="gender">Gender</label>
                                                            <select name="gender" id="gender" class="form-control form-control-sm">
                                                                <option value="l" @if ($karyawan->gender == "l") selected @endif>L (Laki - laki)</option>
                                                                <option value="p" @if ($karyawan->gender == "p") selected @endif>P (Perempuan)</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="alamat_asal">Alamat</label>
                                                            <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control">{{ $karyawan->alamat }}</textarea>
                                                            <small id="error_alamat" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="jabatan_id">Jabatan</label>
                                                            <input type="text" name="jabatan_id" id="jabatan_id" class="form-control form-control-sm" value="{{ $karyawan->jabatan->nama }}" readonly>
                                                            <small id="error_jabatan_id" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="telepon">Telepon</label>
                                                            <input type="text" id="telepon" name="telepon" class="form-control form-control-sm" value="{{ $karyawan->telepon }}" maxlength="15" >
                                                            <small id="error_telepon" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="text" id="email" name="email" class="form-control form-control-sm" value="{{ $karyawan->email }}" maxlength="15" >
                                                            <small id="error_email" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                </div>
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
                                        <i class="fas fa-save"></i> <span class="modal-btn">Perbaharui</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

        $(document).on('submit', '.form-create', function (e) {
            e.preventDefault();

            $('#error_telepon').empty();
            $('#error_email').empty();
            $('#error_nama_lengkap').empty();
            $('#error_nama_panggilan').empty();
            $('#error_gender').empty();
            $('#error_alamat').empty();

            let formData = new FormData($('#form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ URL::route('profile.store') }}",
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

                        setTimeout(() => {
                            $('.btn-spinner').addClass('d-none');
                            $('.btn-save').removeClass('d-none');
                        }, 1000);
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data behasil diperbaharui'
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
    });
</script>

@endsection
