<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;

class SellerController extends Controller
{


    // public function sellerIndex() {
    //     return view('seller.index');
    // }
    public function createSeller() {
        return view('seller.createSeller');
    }


    public function storeSeller(Request $request) {
        $data= $request->validate([
            'sellerUsername' => 'required',
            'sellerPassword' => 'required|numeric',
          ]);
          $newSeller = Seller::create($data);
          return redirect(route('seller.createSeller'));
    }
       

}
    

