<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;

class PaymentController extends Controller
{
    public function index(){
    	$data['menu'] = 6;
    	$data['title'] = 'Payments';
    	return view('payment.index', $data);
    }
}
