<?php

namespace App\Http\Controllers;

use App\Models\BankSwift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BankSwiftController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if (empty($search)) {
            $bankSwifts = BankSwift::orderBy('name', 'asc')
                ->select('name', 'code')
                ->limit(15)
                ->get();
        } else {
            $bankSwifts = BankSwift::orderBy('name', 'asc')
                ->where('name', 'like', '%' . $search . '%')
                ->select('name', 'code')
                ->limit(15)
                ->get();
        }

        $response = [];
        foreach ($bankSwifts as $bank) {
            $response[] = [
                'id' => $bank->code,
                'text' => $bank->name
            ];
        }
        return Response::json($response);
    }
}
