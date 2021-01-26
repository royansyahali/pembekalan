<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use App\Car;
use App\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Rule;

class CarController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Cars";
        $data['menu'] = 1;

        $cars = DB::table('cars')
                        ->join('brands', 'cars.brand_id', '=', 'brands.brand_id')
                        ->join('bookings', 'cars.car_id', '=', 'bookings.car_id')
                        ->where('available',"1")
                        ->get();

        $data['cars'] = json_decode(json_encode($cars), true);
        $data['no'] = 1;
        $data["jumlah"] = count($cars);
        return view('car.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Add New Cars";
        $data['menu'] = 1;
        $data['brands'] = Brand::all();

        return view('car.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'car_name' => 'required',
            'year' => 'required|numeric',
            'license_plat' => 'required|max:10|unique:cars,license_plat',
            'price' => 'required|numeric',
            'type' => 'required',
            'brand_id' => 'required'
        ]);

        $insert = Car::create($request->toArray());

        return redirect()->route('car.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Edit Cars";
        $data['menu'] = 1;
        $data['car'] = Car::find($id);
        $data['brands'] = Brand::all();

        return view('car.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'car_name' => 'required',
            'year' => 'required|numeric',
            'license_plat' => 'required|max:10|'.Rule::unique('cars')->ignore($id,"car_id"),
            'price' => 'required|numeric',
            'type' => 'required',
            'brand_id' => 'required'
        ];
        $validator = FacadesValidator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back();
        }
        $update = Car::find($id)->update($request->toArray());
        return redirect()->route('car.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Car::destroy($id);
        return redirect()->route('car.index');
    }
}
