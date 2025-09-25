<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $collection = Customer::with(['address'])->paginate();
        return response()->json($collection, Response::HTTP_OK);
    }

    public function store()
    {
        $validated = request()->validate([
            'name' => 'string|required|min:3|max:150',
            'email' => 'string|required|email|unique:App\Models\Customer,email|max:150',
            'cnpj' => 'string|required|unique:App\Models\Customer,cnpj|max:20',
            'observation' => 'string|nullable',
            'contract_value' => 'required|numeric|decimal:0,99999999',
            'address' => 'required|array',
            'address.street' => 'required|string|min:3|max:150',
            'address.number' => 'required|numeric',
            'address.cep' => 'required|numeric',
            'address.complement' => 'nullable|string|max:150',
            'address.neighborhood' => 'required|string|min:1|max:9999',
            'address.city' => 'required|string|min:3|max:100',
        ]);

        $customer = DB::transaction(function () use ($validated) {
            $customer = Customer::create(Arr::except($validated, ['address']));
            $customer->address()->create($validated['address']);
            $customer->address;
            return $customer;
        });

        return response()->json([
            'success' => true,
            'customer' => $customer
        ], Response::HTTP_OK);
    }
}