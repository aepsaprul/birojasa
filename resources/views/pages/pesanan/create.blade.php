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
                        <form action="">
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
                                            <input type="text" name="pkb_berlaku" id="pkb_berlaku" class="form-control">
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
                                            <input type="text" name="samsat_asal" id="samsat_asal" class="form-control">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12 mb-2">
                                            <label for="samsat_tujuan" class="font-weight-normal">Samsat Tujuan</label>
                                            <input type="text" name="samsat_tujuan" id="samsat_tujuan" class="form-control">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-sm btn-primary px-4"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>
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

    });
</script>

@endsection
