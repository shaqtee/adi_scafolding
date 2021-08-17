<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\File as PhotoFile;
use App\Models\Product;
use App\Models\Taggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $tags = (Tag::orderBy('id', 'ASC')->get())->toArray();
        $prodToAttach = (Product::orderBy('id', 'ASC')->get())->toArray();

        $photos = (PhotoFile::orderBy('fileable_id', 'ASC')->get())->toArray();
        return view('product.create', compact('tags', 'prodToAttach', 'photos'));
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
            'deskripsi' => 'required|max:100|string',
            'kategori' => 'required|max:20|string'
        ], [
            'nama_produk.max' => 'Maksimal 50 digit.',
            'nama_produk.string' => 'Harus termasuk tipe data string.',
            'nama_produk.unique' => 'Nama tersebut sudah ada.',
            'deskripsi.max' => 'Tidak boleh lebih dari 100 karakter.',
            'deskripsi.string' => 'Harus termasuk tipe data string',
            'kategori.max' => 'Tidak boleh lebih dari 20 karakter.',
            'kategori.string' => 'Harus termasuk tipe data string.'
        ]);


        if (!empty($request->file('foto'))) {
            //upload foto produk ke public.
            $dataFotoProduk = $request->file('foto');
            $encNamaImage = mb_substr(base64_encode($dataFotoProduk->getClientOriginalName()), 0, 12);
            $extImage = $dataFotoProduk->getClientOriginalExtension();
            $namaFoto = "prod_{$encNamaImage}.{$extImage}";
            $folderImageProduct = 'images/produk';
            $dataFotoProduk->move($folderImageProduct, $namaFoto);
        } else {
            $namaFoto = $request->link;
        }

        $discount = $request->disc / 100;
        $harga = $request->price_before_disc - ($request->price_before_disc * $discount);

        //insert db.
        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $harga,
            'berat' => $request->berat,
            'disc' => $request->disc,
            'price_before_disc' => $request->price_before_disc,
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
            'deskripsi' => 'required|max:100|string',
            'kategori' => 'required|max:20|string'
        ], [
            'nama_produk.max' => 'Maksimal 50 digit.',
            'nama_produk.string' => 'Harus termasuk tipe data string.',
            'nama_produk.unique' => 'Nama tersebut sudah ada.',
            'deskripsi.max' => 'Tidak boleh lebih dari 100 karakter.',
            'deskripsi.string' => 'Harus termasuk tipe data string',
            'kategori.max' => 'Tidak boleh lebih dari 20 karakter.',
            'kategori.string' => 'Harus termasuk tipe data string.'
        ]);

        if (!empty($request->file('foto'))) {
            //hapus foto produk di public.
            unlink('images/produk/' . $product['foto']);

            //upload foto produk ke public.
            $dataFotoProduk = $request->file('foto');
            $encNamaImage = mb_substr(base64_encode($dataFotoProduk->getClientOriginalName()), 0, 12);
            $extImage = $dataFotoProduk->getClientOriginalExtension();
            $namaFoto = "prod_{$encNamaImage}.{$extImage}";
            $folderImageProduct = 'images/produk';
            $dataFotoProduk->move($folderImageProduct, $namaFoto);
        } else {
            $namaFoto = $request->link;
        }

        $discount = $request->disc / 100;
        $harga = $request->price_before_disc - ($request->price_before_disc * $discount);

        //insert db.
        Product::where('id', $id)->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $harga,
            'berat' => $request->berat,
            'disc' => $request->disc,
            'price_before_disc' => $request->price_before_disc,
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

    /**
     * Taggable.
     */
    public function createTag(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags',
        ], [
            'name.required' => 'inputan tidak boleh kosong',
            'name.unique' => 'nama Tag tidak boleh sama'
        ]);

        Tag::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', 'Tag ' . $request->name . ' masuk!');
    }

    public function deleteTag(Tag $id)
    {
        $id->delete();
        return redirect()->back()->with('status', 'Berhasil dihapus.');
    }

    public function showTag(Request $request)
    {
        $show = Tag::find($request->id);
        return Response::json($show);
    }

    public function updateTag(Request $request, Tag $id)
    {

        $request->validate([
            'name' => 'required|unique:tags'
        ]);

        Tag::find($id->id)->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', 'Updated!');
    }

    public function attachTag(Request $request)
    {
        $checkAttach =  Taggable::where('tag_id', $request->tagid)
            ->where('taggable_id', $request->prodid)->get();

        if (count($checkAttach) > 0) {
            $response = 'double exec is failed';
        } else {
            Product::find($request->prodid)
                ->tags()
                ->attach($request->tagid);
            $response = 'Successfully Attached!';
        }

        return Response::json($response);
    }

    public function detachTag(Request $request)
    {
        $checkAttach =  Taggable::where('tag_id', $request->tagid)
            ->where('taggable_id', $request->prodid)->get();

        if (count($checkAttach) > 0) {
            Product::find($request->prodid)
                ->tags()
                ->detach($request->tagid);

            $response = 'Detaching Success!';
        } else {

            $response = 'There is no such as attached...';
        }

        return Response::json($response);
    }

    /**
     * PHOTO PLUS.
     */
    public function photoCreate(Request $request)
    {

        Product::find($request->produkId)
            ->files()->create([
                'name' => $request->nama_foto
            ]);
        return redirect()->back()->with('status', 'Photo plus berhasil ditambahkan');
    }

    public function photoUpdate(Request $request, $photo)
    {
        PhotoFile::find($photo)->update([
            'name' => $request->nama_foto
        ]);
        return redirect()->back()->with('status', 'Photo plus berhasil diupdate');
    }

    public function photoDelete(Request $request)
    {
        PhotoFile::find($request->fotoId)->delete();
        return Response::json($request);
    }
}
