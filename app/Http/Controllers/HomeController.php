<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Car;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Charts;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Dashboard";
        $menu = 0;
        return view('home', compact('title', 'menu'));
    }

    // public function downloadPDF($start,$end,$type)
    // {
    //     // dd($start,$end,$type);
    //     $data['menu'] = 7;
    // 	$data['title'] = "Report Transcation";
    //     $data['no'] = 1;
    //     // dd($data);

    //     switch ($type) {
    //         case 'all':
    //             $data['bookings'] = Booking::whereBetween('order_date', [$start, $end])
    //             ->join('clients', 'clients.client_id', '=', 'bookings.client_id')
    //             ->join('cars', 'cars.car_id', '=', 'bookings.car_id')
    //             ->get();
    //             break;
    //         case 'process' :
    //             $data['bookings'] = Booking::where('status', 'process')->whereBetween('order_date', [$start, $end])
    //             ->join('clients', 'clients.client_id', '=', 'bookings.client_id')
    //             ->join('cars', 'cars.car_id', '=', 'bookings.car_id')
    //             ->get();
    //             break;
    //         case 'paid' :
    //             $data['bookings'] = Booking::where('status', 'paid')->whereBetween('order_date', [$start, $end])
    //             ->join('clients', 'clients.client_id', '=', 'bookings.client_id')
    //             ->join('cars', 'cars.car_id', '=', 'bookings.car_id')
    //             ->get();
    //             break;
    //     }
    // 	$data['data'] = [
    //         "start_date" => $start,
    //         "end_date" => $end,
    //         "type" => $type,
    //     ];
    //     $pdf = PDF::loadView('report/transaction', $data);
    //     return $pdf->stream();
	// 	// $pdf->save(storage_path().'_laporan.pdf');
    //     // Finally, you can download the file using download function
    //     // return $pdf->download('laporan.pdf');

    // }

    // public function downloadPDF()

    // {
    //     $data['menu'] = 7;
    // 	$data['title'] = "Report Transcation";
    // 	$data['no'] = 1;
    //     $now = \Carbon\Carbon::now()->format('m');
    //     $data['data'] = Booking::where('status', 'paid')->whereMonth('bookings.created_at', '=', $now)
    //     ->join('clients', 'clients.client_id', '=', 'bookings.client_id')
    //     ->join('cars', 'cars.car_id', '=', 'bookings.car_id')
    //     ->get();

    // 	$pdf = PDF::loadView('report.pdfView',$data);

	// 	return $pdf->download('laporan.pdf');

    // }
    public function downloadPDF($start,$end,$type)
    {
        $data['menu'] = 7;
        $data['no'] = 1;
        $data['data'] = [
            "start_date" => $start,
            "end_date" => $end,
        ];
        switch ($type) {
            case 'all':
                $data['bookings'] = Booking::whereBetween('order_date', [$start, $end])
                ->join('clients', 'clients.client_id', '=', 'bookings.client_id')
                ->join('cars', 'cars.car_id', '=', 'bookings.car_id')
                ->get();
                break;
            case 'process' :
                $data['bookings'] = Booking::where('status', 'process')->whereBetween('order_date', [$start, $end])
                ->join('clients', 'clients.client_id', '=', 'bookings.client_id')
                ->join('cars', 'cars.car_id', '=', 'bookings.car_id')
                ->get();
                break;
            case 'paid' :
                $data['bookings'] = Booking::where('status', 'paid')->whereBetween('order_date', [$start, $end])
                ->join('clients', 'clients.client_id', '=', 'bookings.client_id')
                ->join('cars', 'cars.car_id', '=', 'bookings.car_id')
                ->get();
                break;
        }
        // dd($data);
        $pdf = PDF::loadView('report.pdfView',$data);

		return $pdf->download('laporan.pdf');
    }
    public function chart()
    {
        $cars = Car::all();
        $i = [];
        foreach ($cars as $row) {
           array_push($i,$row->car_name);
        }
        asort($i);
        $data['title'] = 'Chart';
        $d = [];
        foreach ($i as $value) {
            $car = $cars = DB::table('cars')
            ->join('brands', 'cars.brand_id', '=', 'brands.brand_id')
            ->join('bookings', 'cars.car_id', '=', 'bookings.car_id')
            ->where("status","paid")->where(DB::raw("(DATE_FORMAT(return_date,'%m'))"),date('m'))
            ->where('car_name',$value)->get();
            array_push($d,count($car));
        }
        $car = $cars = DB::table('cars')
        ->join('brands', 'cars.brand_id', '=', 'brands.brand_id')
        ->join('bookings', 'cars.car_id', '=', 'bookings.car_id')
        ->where("status","paid")->where(DB::raw("(DATE_FORMAT(return_date,'%m'))"),date('m'))->first();
        $monthName = date('m', strtotime($car->return_date));
        $dateObj   = DateTime::createFromFormat('!m', $monthName);
        $monthName = $dateObj->format('F'); // March

        $chart = Charts::create('bar', 'highcharts')
        ->title('Rent Car Month '.$monthName)
        ->elementLabel('My nice label')
        ->labels($i)
        ->values($d)
        ->dimensions(1000,500)
        ->responsive(false);
        // dd(compact('users'),$data);
        $data['menu'] = 8;
        return view('charts',compact('chart'),$data);
    }

}
