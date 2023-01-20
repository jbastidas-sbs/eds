<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Customer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Customers/Index',[
            'filters' => Request::all('search', 'trashed'),
            'customers' => Customer::orderByName()
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($customer) => [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'fiscal_identification' => $customer->fiscal_identification,
                    'telephone' => $customer->telephone,
                    'email' => $customer->email,
                    'deleted_at' => $customer->deleted_at,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Customers/Create');
    }

    public function store()
    {
        Customer::create(
            Request::validate([
                'name' => ['required', 'max:50'],
                'fiscal_identification' => ['required', 'max:9'],
                'telephone' => ['nullable', 'max:50'],
                'email' => ['nullable', 'max:50', 'email'],
                'address' => ['nullable', 'max:150'],
            ])
        );

        return Redirect::route('customers')->with('success', 'Cliente registrado.');
    }

    public function edit(Customer $customer)
    {
        return Inertia::render('Customers/Edit', [
            'customer' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'fiscal_identification' => $customer->fiscal_identification,
                'telephone' => $customer->telephone,
                'email' => $customer->email,
                'address' => $customer->address,
                'deleted_at' => $customer->deleted_at,
            ],
        ]);
    }

    public function update(Customer $customer)
    {
        $customer->update(
            Request::validate([
                'name' => ['required', 'max:50'],
                'fiscal_identification' => ['required', 'max:9'],
                'telephone' => ['nullable', 'max:50'],
                'email' => ['nullable', 'max:50', 'email'],
                'address' => ['nullable', 'max:150'],
            ])
        );

        return Redirect::back()->with('success', 'Cliente actualizado.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return Redirect::back()->with('success', 'Cliente borrado.');
    }

    public function restore(Customer $customer)
    {
        $customer->restore();

        return Redirect::back()->with('success', 'Cliente restaurado.');
    }
    // Api
    public function indexApi()
    {
        $customers = Customer::orderByName()->get();
        return response()->json(['customers' => $customers]);
    }

    public function storeApi(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'max:50'],
            'fiscal_identification' => ['required', 'max:9'],
            'telephone' => ['nullable', 'max:50'],
            'email' => ['nullable', 'max:50', 'email'],
            'address' => ['nullable', 'max:150'],
        ])->validate();
        Customer::create([
                'name' => $input['name'],
                'fiscal_identification' => $input['fiscal_identification'],
                'telephone' => $input['telephone'],
                'email' => $input['email'],
                'address' => $input['address'],
        ]);
        return response()->json(['success' => 'Cliente registrado.']);
    }

    public function updateApi(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'max:50'],
            'fiscal_identification' => ['required', 'max:9'],
            'telephone' => ['nullable', 'max:50'],
            'email' => ['nullable', 'max:50', 'email'],
            'address' => ['nullable', 'max:150'],
        ])->validate();
        $customer = Customer::find($input['id']);
        $customer->update([
                'name' => $input['name'],
                'fiscal_identification' => $input['fiscal_identification'],
                'telephone' => $input['telephone'],
                'email' => $input['email'],
                'address' => $input['address'],
            ]);
        return response()->json(['success' => 'Cliente actualizado.']);
    }

    public function destroyApi(array $input)
    {
        $customer = Customer::find($input['id']);
        $customer->delete();
        return response()->json(['success' => 'Cliente borrado.']);
    }
}
