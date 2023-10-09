<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VendorUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Session;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function stripePaymentcallback(Request $request)
    {

        return response()->json(array('success' => true, 'data' => $request->all()));
    }

    public function takeawayOption(Request $request)
    {

        $takeawayOption = $request->input('takeawayOption');
        if ($takeawayOption) {
            /*$request->session()->put('takeawayOption', $takeawayOption);*/
            Session::put('takeawayOption', $takeawayOption);
            Session::save();

            if ($takeawayOption == "true") {
                $cart = Session::get('cart', []);
                $cart['delivery_option'] = "takeaway";
                $cart['deliverycharge'] = 0;
                $cart['tip_amount'] = 0;
                Session::put('cart', $cart);
                Session::save();
            } else {
                $cart = Session::get('cart', []);
                $cart = array();
                $cart['delivery_option'] = "delivery";
                if (@$cart['deliverychargemain']) {
                    $cart['deliverycharge'] = $cart['deliverychargemain'];
                }
                Session::put('cart', $cart);
                Session::save();
            }
            $res = array('status' => true, 'data' => $takeawayOption, 'message' => 'success');
            echo json_encode($res);
            exit;
            /*return $takeawayOption;*/
        }

    }

    public function checkCartData()
    {
        $item_count = 0;

        if (isset($_COOKIE['service_type'])) {

            if ($_COOKIE['service_type'] == "Parcel Delivery Service") {
                $parcel_cart = Session::get('parcel_cart', []);

                if (is_array($parcel_cart) && !empty($parcel_cart)) {
                    $item_count++;
                }
            } else if ($_COOKIE['service_type'] == "Rental Service") {
                $rentalCarsData = Session::get('rentalCarsData', []);
                if (is_array($rentalCarsData) && !empty($rentalCarsData)) {
                    $item_count++;
                }
            } else {
                $cart = Session::get('cart', []);

                if (@$cart['item']) {
                    foreach ($cart['item'] as $key => $value_vendor) {

                        if (!empty($value_vendor)) {
                            $item_count++;
                        }
                    }
                }
            }
        }

        return json_encode($item_count);

    }

    public function removeCartData(Request $request)
    {
        $cart = Session::get('cart', []);
        $parcel_cart = Session::get('parcel_cart', []);
        $rentalCarsData = Session::get('rentalCarsData', []);

        $item_count = 0;

        if (@$cart['item']) {
            foreach ($cart['item'] as $key => $value_vendor) {
                $item_count++;
            }
        }
        Session::put('cart', []);
        Session::put('parcel_cart', []);
        Session::put('rentalCarsData', []);
        Session::save();

        return true;
    }

}