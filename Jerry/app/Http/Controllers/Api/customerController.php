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
    private $_response = [];
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
            $this->_response = [
                'error' => true,
                'customer' => $validator->messages()
            ];
            return response()->json($this->_response);
        }

        try {
            $hasher = app()->make('hash');
            $input = $request->all();
            $input['password'] = $hasher->make($request->input('password'));
            $customer = Customer::create($input);

            $this->_response = [
                'error' => false,
                'msg' => 'The customer has been created successfully',
                'customer' => $customer->customer_id,
            ];
        } catch (Exception $e) {
            $this->_response = [
                'error' => 'true',
                'msg' => $e->getMessage(),
                'customer' => null,
            ];
        }
        return response()->json($this->_response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if(is_numeric($id)) {
            $customer = Customer::find($id);
            if(!empty($customer)) {
                $this->_response = [
                    'error' => false,
                    'customer' => $customer
                ];
            } else {
                $this->_response = [
                    'error' => false,
                    'customer' => 'Customer not found',
                ];
            }
        } else {
            $this->_response = [
                'error' => true,
                'customer' => 'Customer id is invalid',
            ];
        }

        return response()->json($this->_response);
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
            $this->_response = [
                'error' => true,
                'customer' => $validator->messages()
            ];
            return response()->json($this->_response);
        }

        $customer = Customer::find($id);
        if($customer) {

            $hasher = app()->make('hash');
            
            $customer->firsname = $request->input('firsname');
            $customer->lastname = $request->input('lastname');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->password = $hasher->make($request->input('password'));
            $customer->nationality = $request->input('nationality');
            $customer->birthday = $request->input('birthday');
            $customer->gender = $request->input('gender');
            $customer->customer_type_id = $request->input('customer_type_id');
            
            try {
                $customer->save();
                $this->_response = [
                    'error' => false,
                    'msg' => 'The client has been updated correctly',
                    'customer' => $customer->customer_id,
                ];
            } catch (Exception $e) {
                $this->_response = [
                    'error' => true,
                    'msg' => $e->getMessage(),
                ];                
            }
        } else {
            $this->_response = [
                'error' => true,
                'msg' => 'The client was not found',
            ];
        }
        return response()->json($this->_response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if($customer) {
            try {
                $customer->delete();
                $this->_response = [
                    'error' => false,
                    'msg' => 'The client has been removed successfully',
                ];
            } catch (Exception $e) {
                $this->_response = [
                    'error' => true,
                    'msg' => $e->getMessage(),
                ];
            }            
        } else {
            $this->_response = [
                'error' => true,
                'msg' => 'The client was not found',
            ];
        }
        return response()->json($this->_response);
    }
}
