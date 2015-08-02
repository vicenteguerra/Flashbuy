<?php

namespace App\Http\Controllers\Api;

use Input;
use Validator;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        echo "Hola";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firsname' => 'min:1|max:255',
            'lastname' => 'min:1|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => '',
            'password' => 'required|min:6|max:25',
            'birthday' => '|date',
            'gender' => 'in:F,M',
            'customer_type_id' => 'required|exists:customers_type,customer_type_id',
        ]);

        if ($validator->fails()) {
            //var_dump($validator->messages());die;   
            return response()->json($validator->messages());
        }

        $input = Input::all();
        Customer::create($request->all());
        return response()->json('create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return json_encode(['customer' =>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
