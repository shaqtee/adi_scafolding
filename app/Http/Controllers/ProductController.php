<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //$data = request()->toArray();
        $validator = $request->validate([
            'nama_produk' => 'required|max:50|string|unique:products',
            'harga' => 'required|numeric|max:10000000000',
            'deskripsi' => 'required|max:100|string',
            'kategori' => 'required|max:20|string',
            'foto' => 'required|image|unique:products'
        ], [
            'nama_produk.max' => 'Maksimal 50 digit.',
            'nama_produk.string' => 'Harus termasuk tipe data string.',
            'nama_produk.unique' => 'Nama tersebut sudah ada.',
            'harga.max' => 'Tidak boleh lebih dari 10 digit.',
            'deskripsi.max' => 'Tidak boleh lebih dari 100 karakter.',
            'deskripsi.string' => 'Harus termasuk tipe data string',
            'kategori.max' => 'Tidak boleh lebih dari 20 karakter.',
            'kategori.string' => 'Harus termasuk tipe data string.',
            'foto.required' => 'Harus upload foto.',
            'foto.image' => 'File ini tidak termasuk tipe data picture.'
        ]);

        //upload foto produk ke public.
        $dataFotoProduk = $request->file('foto');
        $encNamaImage = mb_substr(base64_encode($dataFotoProduk->getClientOriginalName()), 0, 12);
        $extImage = $dataFotoProduk->getClientOriginalExtension();
        $namaFoto = "prod_{$encNamaImage}.{$extImage}";
        $folderImageProduct = 'images/produk';
        $dataFotoProduk->move($folderImageProduct, $namaFoto);

        //insert db.
        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'foto' => $namaFoto
        ]);

        return redirect('product/create')->with('status', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //dd($product['foto']);
        $id = $product->toArray()['id'];
        $request->validate([
            'nama_produk' => 'required|max:50|string',
            'harga' => 'required|numeric|max:10000000000',
            'deskripsi' => 'required|max:100|string',
            'kategori' => 'required|max:20|string',
            'foto' => 'required|image|unique:products'
        ], [
            'nama_produk.max' => 'Maksimal 50 digit.',
            'nama_produk.string' => 'Harus termasuk tipe data string.',
            'nama_produk.unique' => 'Nama tersebut sudah ada.',
            'harga.max' => 'Tidak boleh lebih dari 10 digit.',
            'deskripsi.max' => 'Tidak boleh lebih dari 100 karakter.',
            'deskripsi.string' => 'Harus termasuk tipe data string',
            'kategori.max' => 'Tidak boleh lebih dari 20 karakter.',
            'kategori.string' => 'Harus termasuk tipe data string.',
            'foto.required' => 'Harus upload foto.',
            'foto.image' => 'File ini tidak termasuk tipe data picture.'
        ]);

        //hapus foto produk di public.
        unlink('images/produk/' . $product['foto']);

        //upload foto produk ke public.
        $dataFotoProduk = $request->file('foto');
        $encNamaImage = mb_substr(base64_encode($dataFotoProduk->getClientOriginalName()), 0, 12);
        $extImage = $dataFotoProduk->getClientOriginalExtension();
        $namaFoto = "prod_{$encNamaImage}.{$extImage}";
        $folderImageProduct = 'images/produk';
        $dataFotoProduk->move($folderImageProduct, $namaFoto);

        //insert db.
        Product::where('id', $id)->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'foto' => $namaFoto
        ]);

        return redirect('product/create')->with('status', 'Data berhasil di update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //hapus foto produk di public.
        if (file_exists(asset('image/produk/' . $product['foto']))) {
            unlink('images/produk/' . $product['foto']);
        }

        //hapus data di DB.
        Product::where('id', $product->id)->delete();
        return redirect('product/create')->with('status', 'Data berhasil di hapus.');
    }

    public function searchproducts(Request $request)
    {

        $key = $request->keyword;
        $searchProducts = Product::where('nama_produk', 'LIKE', '%' . $key . '%')
            ->orwhere('harga', 'LIKE', '%' . $key . '%')
            ->orwhere('deskripsi', 'LIKE', '%' . $key . '%')
            ->orwhere('kategori', 'LIKE', '%' . $key . '%')
            ->orwhere('foto', 'LIKE', '%' . $key . '%')
            ->limit(6)->get();
        return Response::json($searchProducts);
    }

    public function tampil(Request $request)
    {
        $product = $request->id;
        $searchResult = (Product::where('id', $product)->get())->toArray()[0];
        return Response::json($searchResult);
    }
}
