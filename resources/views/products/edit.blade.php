@extends('layouts.master')
​
@section('title')
    <title>Edit Data Produk</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')

                            @endslot

                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
                            <form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Kode Produk</label>
                                    <input type="text" name="kode_produk" required
                                        maxlength="10"
                                        readonly
                                        value="{{ $product->kode_produk }}"
                                        class="form-control {{ $errors->has('kode_produk') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('kode_produk') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="nama_produk" required
                                        value="{{ $product->nama_produk }}"
                                        class="form-control {{ $errors->has('nama_produk') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('nama_produk') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi"
                                        cols="5" rows="5"
                                        class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}">{{ $product->deskripsi }}</textarea>
                                    <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="number" name="jumlah_tersedia" required
                                        value="{{ $product->jumlah_tersedia }}"
                                        class="form-control {{ $errors->has('jumlah_tersedia') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('jumlah_tersedia') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="number" name="harga_produk" required
                                        value="{{ $product->harga_produk }}"
                                        class="form-control {{ $errors->has('harga_produk') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('harga_produk') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select name="kategori_id" id="kategori_id"
                                        required class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($categories as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $product->kategori_id ? 'selected':'' }}>
                                                {{ ucfirst($row->nama_kategori) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('kategori_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="foto" class="form-control">
                                    <p class="text-danger">{{ $errors->first('foto') }}</p>
                                    @if (!empty($product->foto))
                                        <hr>
                                        <img src="{{ asset('uploads/product/' . $product->foto) }}"
                                            alt="{{ $product->name }}"
                                            width="150px" height="150px">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-refresh"></i> Update
                                    </button>
                                </div>
                            </form>
                            @slot('footer')
​
                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
