@extends('layouts.master')
​
@section('title')
    <title>Transaksi</title>
@endsection
​
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content" id="dw">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        @card
                            @slot('title')

                            @endslot
​
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Produk</label>
                                        <select name="product_id" id="product_id" class="form-control" required width="100%">
                                            <option value="">Pilih</option>
                                            @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->kode_produk }} - {{ $product->nama_produk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Qty</label>
                                        <input type="number" name="qty" id="qty" value="1" min="1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-shopping-cart"></i> Ke Keranjang
                                        </button>
                                    </div>
                                </div>

                                <!-- MENAMPILKAN DETAIL PRODUCT -->
                                <div class="col-md-5">
                                    <h4>Detail Produk</h4>
                                    <div v-if="product.name">
                                        <table class="table table-stripped">
                                            <tr>
                                                <th>Kode</th>
                                                <td>:</td>
                                                <td>@{{ product.kode_produk }}</td>
                                            </tr>
                                            <tr>
                                                <th width="3%">Produk</th>
                                                <td width="2%">:</td>
                                                <td>@{{ product.nama_produk }}</td>
                                            </tr>
                                            <tr>
                                                <th>Harga</th>
                                                <td>:</td>
                                                <td>@{{ product.harga_produk | currency }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- MENAMPILKAN IMAGE DARI PRODUCT -->
                                <div class="col-md-3" v-if="product.photo">
                                    <img :src="'/uploads/product/' + product.photo"
                                        height="150px"
                                        width="150px"
                                        :alt="product.name">
                                </div>
                            </div>
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
​
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    <script src="{{ asset('js/transaksi.js') }}"></script>
@endsection
