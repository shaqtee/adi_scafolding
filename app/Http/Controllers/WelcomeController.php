<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\City;
use App\Models\Courier;
use App\Models\Product;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Kavist\RajaOngkir\Facades\RajaOngkir;


class WelcomeController extends Controller
{
    public function index()
    {
        $roleNavigator = $this->searchArr();

        //kategori 1 (thumbnail)
        $prodAds = Product::latest()->where('kategori', 'Barang Bekas')->get()[0];
        $products = (Product::latest()->where('kategori', 'Barang Bekas')->get())->toArray();
        unset($products[0]);

        //kategori 2 (thumbnail)
        $prodAds2 = Product::latest()->where('kategori', 'Bahan Kue')->get()[0];
        $products2 = (Product::latest()->where('kategori', 'Bahan Kue')->get())->toArray();
        unset($products2[0]);

        //kategori 3 (thumbnail)
        $prodAds3 = Product::latest()->where('kategori', 'Produk Digital')->get()[0];
        $products3 = (Product::latest()->where('kategori', 'Produk Digital')->get())->toArray();
        unset($products3[0]);

        //kategori 4 (thumbnail)
        $prodAds4 = Product::latest()->where('kategori', 'Fashion')->get()[0];
        $products4 = (Product::latest()->where('kategori', 'Fashion')->get())->toArray();
        unset($products4[0]);

        //kategori 5 (thumbnail)
        $prodAds5 = Product::latest()->where('kategori', 'Kesehatan')->get()[0];
        $products5 = (Product::latest()->where('kategori', 'Kesehatan')->get())->toArray();
        unset($products5[0]);

        //kategori 6 (thumbnail)
        $prodAds6 = Product::latest()->where('kategori', 'Sembako')->get()[0];
        $products6 = (Product::latest()->where('kategori', 'Sembako')->get())->toArray();
        unset($products6[0]);

        //kategori 7 (thumbnail)
        $prodAds7 = Product::latest()->where('kategori', 'Snack')->get()[0];
        $products7 = (Product::latest()->where('kategori', 'Snack')->get())->toArray();
        unset($products7[0]);

        return view('welcome', compact(
            'prodAds',
            'products',
            'prodAds2',
            'products2',
            'prodAds3',
            'products3',
            'prodAds4',
            'products4',
            'prodAds5',
            'products5',
            'prodAds6',
            'products6',
            'prodAds7',
            'products7',
            'roleNavigator'
        ));
    }
    public function showProductBy($key)
    {

        if (!(Tag::where('name', $key)->get())->isEmpty()) {
            $products = (Tag::with('products')
                ->where('name', $key)
                ->get())
                ->toArray()[0]['products'];
            $showCase = "Tag";
        } else {

            $products = Product::where('kategori', $key)->paginate(10);
            $showCase = "Ketegori";
        }

        return view('display', compact('products', 'key', 'showCase'));
    }

    public function cart()
    {
        //request()->session()->flush();
        if (request()->session()->get('select')) {
            $dataOngkir = request()->session()->get('ongkir')['result'];
            $kc = request()->session()->get('select')[0];
            $kcp = request()->session()->get('select')[1];
            $searchForOngkir = $this->searchForOngkir($kc, $kcp, $dataOngkir);
        } else {
            $searchForOngkir['kurir'] = '-';
            $searchForOngkir['service'] = '-';
            $searchForOngkir['price'] = 0;
            $searchForOngkir['etd'] = '-';
        }


        if (request()->session()->get('myCart') != []) {
            $getRaw = request()->session()->get('myCart');

            for ($i = 0; $i < count($getRaw); $i++) {
                $produk[] = [
                    (Product::where('id', $getRaw[$i]['id'])->first())->toArray(),
                    $getRaw[$i]
                ];
            }
        } else {
            $produk = [
                [
                    [
                        'id' => "-",
                        'nama_produk' => "Tidak Ada Produk di Keranjang",
                        'foto' => "https://place-hold.it/100x100",
                        'harga' => 0
                    ],
                    [
                        'id' => "-",
                        'qty' => 0
                    ]
                ]
            ];
        }

        $province = $this->getProvince();
        $couriers = $this->getCourier();
        //dd($searchForOngkir);
        return view('cart', compact('produk', 'province', 'couriers', 'searchForOngkir'));
    }

    public function cartUpdateAction(Request $request)
    {
        $arr = $request->au;
        $request->session()->put(['myCart' => $arr]);
        $res = $request->session()->get('myCart');
        return Response::json($res);
    }

    public function cartDisAction(Request $request)
    {
        $getRaw = $request->session()->get('myCart');
        unset($getRaw[$request->key]);
        $arr = array_values($getRaw);
        $request->session()->put(['myCart' => $arr]);
        $res = $request->session()->get('myCart');

        return Response::json($res);
    }

    public function cartAction(Request $request)
    {
        if ($request->session()->has('myCart')) {
            $arr = request()->session()->get('myCart');
            $updateArr = [$request->mark => $request->id, $request->qty => $request->qb];
            array_push($arr, $updateArr);
            $request->session()->put(['myCart' => $arr]);
            $res = $request->session()->get('myCart');
        } else {
            $arr = [];
            $updateArr = [$request->mark => $request->id, $request->qty => $request->qb];
            array_push($arr, $updateArr);
            $request->session()->put(['myCart' => $arr]);
            $res = $request->session()->get('myCart');
        }

        return Response::json($res);
    }

    public function single(Product $key)
    {
        //dd(request()->session()->all());
        $fotoOptional = $key->files->isEmpty() ? 'https://place-hold.it/100x100' : $key->files;
        $tagProduk = $key->tags->isEmpty() ? '-' : $key->tags[0]->name;

        return view('single', compact('key', 'fotoOptional', 'tagProduk'));
    }

    public function wishlistAction(Request $request)
    {
        if ($request->at === 'false') {
            if ($request->session()->has('myWishlist')) {
                $arr = $request->session()->get('myWishlist');
                array_push($arr, $request->id);
                $request->session()->put(['myWishlist' => $arr]);
                $res = $request->session()->get('myWishlist');
            } else {
                $arr = [];
                array_push($arr, $request->id);
                $request->session()->put(['myWishlist' => $arr]);
                $res = $request->session()->get('myWishlist');
            }
        } else {
            if ($request->session()->has('myWishlist')) {
                $a1 = $request->cs;
                $a2 = [$request->cp];
                $arr = array_values(array_diff($a1, $a2));
                $request->session()->put(['myWishlist' => $arr]);
                $res = $request->session()->get('myWishlist');
            } else {
                $res = 'gotcha!';
            }
        }

        return Response::json($res);
    }

    public function wishlistDisAction(Request $request)
    {
        $a1 = $request->session()->get('myWishlist');
        $a2 = [$request->id];
        $arr = array_values(array_diff($a1, $a2));
        $request->session()->put(['myWishlist' => $arr]);
        $res = $request->session()->get('myWishlist');
        return Response::json($a2);
    }

    public function wishlist(Request $request)
    {

        $roleNavigator = $this->searchArr();

        $getWishlist = $request->session()->has('myWishlist') ? $request->session()->get('myWishlist') : [];

        $arr = array_map(
            'intval',
            $getWishlist
        );

        $wishlist = Product::whereIn('id', $arr)->get();

        return view('wishlist', compact('wishlist', 'roleNavigator'));
    }

    public function wishlistAddTocart(Request $request)
    {
        $arr = $request->session()->get('myCart');
        $updateArr = ['id' => $request->id, 'qty' => "0"];
        array_push($arr, $updateArr);
        $request->session()->put(['myCart' => $arr]);
        $ress = $request->session()->get('myCart');

        return Response::json($ress);
    }

    public function store(Request $request)
    {
        //$courier = $request->input('courier');
        $courier = $request->courier;

        $id_origin = City::where('code', $request->city_origin)->first();
        $desty = City::find($request->city_destination);

        if ($courier) {
            $data = [
                'origin'        => $id_origin,
                'destination'   => City::find($request->city_destination),
                'weight'        => 1300,
                'result'       => []
            ];

            foreach ($courier as $row) {
                $ongkir = RajaOngkir::ongkosKirim([
                    'origin'        => $request->city_origin,     // ID kota/kabupaten asal
                    'destination'   => $desty->code,      // ID kota/kabupaten tujuan
                    'weight'        => $data['weight'],    // berat barang dalam gram
                    'courier'       => $row    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
                ])->get();

                $data['result'][] = $ongkir;
            }
            $request->session()->put(['ongkir' => $data]);
            return Response::json($data);
        }
        return redirect()->back();
    }

    public function getCourier()
    {
        return Courier::all();
    }

    public function getProvince()
    {
        return Province::pluck('title', 'code');
    }

    public function getCities($id)
    {
        return City::where('province_code', $id)->pluck('title', 'code');
    }

    public function searchCities(Request $request)
    {
        $search = $request->search;

        if (empty($search)) {
            $cities = City::orderBy('title', 'asc')
                ->select('id', 'title')
                ->limit(5)
                ->get();
        } else {
            $cities = City::orderBy('title', 'asc')
                ->where('title', 'like', '%' . $search . '%')
                ->select('id', 'title')
                ->limit(5)
                ->get();
        }

        $response = [];
        foreach ($cities as $city) {
            $response[] = [
                'id' => $city->id,
                'text' => $city->title
            ];
        }

        return json_encode($response);
    }

    public function selectongkir(Request $request)
    {
        $kc = $request->kc;
        $kcp = $request->kcp;
        $arr = [$kc, $kcp];
        $request->session()->put(['select' => $arr]);
        $ress = $request->session()->get('select');

        return Response::json($ress);
    }

    public function searchForOngkir($key1, $key2, $array)
    {
        $tampung = [];
        foreach ($array as $val) {
            if ($val[0]['code'] === $key1) {
                $costs = $val[0]['costs'];
                $kurir = $val[0]['code'];
                $tampung['kurir'] = $kurir;
                foreach ($costs as $key => $cost) {
                    if ($cost['service'] === $key2) {
                        $service = $cost['service'];
                        $tampung['service'] = $service;
                        foreach ($cost as $c);
                        $tampung['price'] = $c[0]['value'];
                        $tampung['etd'] = $c[0]['etd'];
                        return $tampung;
                    }
                }
            }
        }
        return null;
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function searchArr()
    {
        $arr = empty(auth()->user()->roles) ? [] : auth()->user()->roles->toArray();
        //dd($arr);
        $id = empty(auth()->user()->id) ? [] : auth()->user()->id;
        $anggota = [];
        foreach ($arr as $a) {
            if ($a['pivot']['user_id'] === $id) {
                $anggota[] = $a['pivot']['role_id'];
            }
        }
        return $anggota;
    }
}
