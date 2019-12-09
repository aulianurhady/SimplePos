<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->paginate(10);
        // dd($products);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('nama_kategori', 'ASC')->get();
        // dd($categories);
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        //validasi data
        $this->validate($request, [
            'kode_produk' => 'required|string|max:10|unique:products',
            'nama_produk' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:100',
            'jumlah_tersedia' => 'required|integer',
            'harga_produk' => 'required|integer',
            'kategori_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            //default $photo = null
            $photo = null;
            //jika terdapat file (Foto / Gambar) yang dikirim
            if ($request->hasFile('foto')) {
                //maka menjalankan method saveFile()
                $photo = $this->saveFile($request->nama_produk, $request->file('foto'));
            }


            //Simpan data ke dalam table products
            $product = Product::create([
                'kode_produk' => $request->kode_produk,
                'nama_produk' => $request->nama_produk,
                'deskripsi' => $request->deskripsi,
                'jumlah_tersedia' => $request->jumlah_tersedia,
                'harga_produk' => $request->harga_produk,
                'kategori_id' => $request->kategori_id,
                'foto' => $photo
            ]);

            //jika berhasil direct ke produk.index
            return redirect(route('produk.index'))
                ->with(['success' => '<strong>' . $product->nama_produk . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            //jika gagal, kembali ke halaman sebelumnya kemudian tampilkan error
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($name, $photo)
    {
        //set nama file adalah gabungan antara nama produk dan time(). Ekstensi gambar tetap dipertahankan
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        //set path untuk menyimpan gambar
        $path = public_path('uploads/product');

        //cek jika uploads/product bukan direktori / folder
        Filesystem::makeDirectory($path, 0777, true, true);
        //simpan gambar yang diuplaod ke folrder uploads/produk
        Image::make($photo)->save('public/');
        //mengembalikan nama file yang ditampung divariable $images
        return $images;
    }

    public function destroy($id)
    {
        //query select berdasarkan id
        $products = Product::findOrFail($id);
        //mengecek, jika field photo tidak null / kosong
        if (!empty($products->foto)) {
            //file akan dihapus dari folder uploads/produk
            Filesystem::delete(public_path('uploads/product/' . $products->foto));
        }
        //hapus data dari table
        $products->delete();
        return redirect()->back()->with(['success' => '<strong>' . $products->nama_produk . '</strong> Telah Dihapus!']);
    }

    public function edit($id)
    {
        //query select berdasarkan id
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('nama_kategori', 'ASC')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        //validasi
        $this->validate($request, [
            'kode_produk' => 'required|string|max:10|exists:products,kode_produk',
            'nama_produk' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:100',
            'jumlah_tersedia' => 'required|integer',
            'harga_produk' => 'required|integer',
            'kategori_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            //query select berdasarkan id
            $product = Product::findOrFail($id);
            $photo = $product->foto;

            //cek jika ada file yang dikirim dari form
            if ($request->hasFile('foto')) {
                //cek, jika foto tidak kosong maka file yang ada di folder uploads/product akan dihapus
                !empty($photo) ? Filesystem::delete(public_path('uploads/product/' . $photo)):null;
                //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
                $photo = $this->saveFile($request->nama_produk, $request->file('foto'));
            }

            //perbaharui data di database
            $product->update([
                'nama_produk' => $request->nama_produk,
                'deskripsi' => $request->deskripsi,
                'jumlah_tersedia' => $request->jumlah_tersedia,
                'harga_produk' => $request->harga_produk,
                'kategori_id' => $request->kategori_id,
                'foto' => $photo
            ]);

            return redirect(route('produk.index'))
                ->with(['success' => '<strong>' . $product->nama_produk . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
}
