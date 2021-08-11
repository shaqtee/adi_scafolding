<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Province;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function pengiriman()
    {
        $role = auth()->user()->roles->first->name['name'];
        $province = app('App\Http\Controllers\WelcomeController')->getProvince();
        $getAddress = (User::find(auth()->user()->id)->load('pengirimans'))->toArray()['pengirimans'];
        $address = last($getAddress);
        //dd($address);
        return view('product.pengiriman', compact('role', 'province', 'address'));
    }

    public function pengirimanStore(Request $request)
    {

        $province = (Province::select('title')
            ->where('code', $request->province_origin)
            ->get())
            ->toArray()[0]['title'];

        $city = (City::select('title')
            ->where('code', $request->city_origin)
            ->get())
            ->toArray()[0]['title'];

        $city_id = (City::select('id')
            ->where('code', $request->city_origin)
            ->get())
            ->toArray()[0]['id'];

        $user = User::find(auth()->user()->id);
        $user->pengirimans()->updateOrCreate(
            ['alamat' => $request->alamat],
            [
                'alamat' => $request->alamat,
                'kode_pos' => $request->kode_pos,
                'kota' => $city,
                'code' => $city_id,
                'propinsi' => $province
            ]
        );

        return redirect('/pengiriman')->with('status', 'Berhasil Tersimpan!');
    }
}
