<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;

class ApiController extends Controller
{
    // list endpoint for both customers and invoices
    public function list(Request $request)
    {
        $module = $request->get('module');
        
        switch ($module) {
            case 'customer':
                $data = Customer::select('id', 'name', 'phone', 'email', 'address')
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;
            case 'invoice':
                $data = Invoice::with('customer:id,name')
                    ->select('id', 'customer_id', 'date', 'amount', 'status')
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;
            default:
                return response()->json(['error' => 'Invalid module'], 400);
        }

        return response()->json($data);
    }

    // create endpoint for both customers and invoices
    public function create(Request $request)
    {
        $module = $request->get('module');
        
        switch ($module) {
            case 'customer':
                $request->validate([
                    'name' => 'required|string|max:255',
                    'phone' => 'nullable|string|max:255',
                    'email' => 'nullable|email|max:255',
                    'address' => 'nullable|string',
                ]);

                $customer = Customer::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                ]);

                return response()->json($customer, 201);

            case 'invoice':
                $request->validate([
                    'customer_id' => 'required|exists:customers,id',
                    'date' => 'required|date',
                    'amount' => 'required|numeric|min:0',
                    'status' => 'required|in:unpaid,paid,cancelled',
                ]);

                $invoice = Invoice::create([
                    'customer_id' => $request->customer_id,
                    'date' => $request->date,
                    'amount' => $request->amount,
                    'status' => $request->status,
                ]);

                return response()->json($invoice->load('customer'), 201);

            default:
                return response()->json(['error' => 'Invalid module'], 400);
        }
    }

    // update endpoint for both customers and invoices
    public function update(Request $request, $id)
    {
        $module = $request->get('module');
        
        switch ($module) {
            case 'customer':
                $request->validate([
                    'name' => 'required|string|max:255',
                    'phone' => 'nullable|string|max:255',
                    'email' => 'nullable|email|max:255',
                    'address' => 'nullable|string',
                ]);

                $customer = Customer::findOrFail($id);
                $customer->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                ]);

                return response()->json($customer);

            case 'invoice':
                $request->validate([
                    'customer_id' => 'required|exists:customers,id',
                    'date' => 'required|date',
                    'amount' => 'required|numeric|min:0',
                    'status' => 'required|in:unpaid,paid,cancelled',
                ]);

                $invoice = Invoice::findOrFail($id);
                $invoice->update([
                    'customer_id' => $request->customer_id,
                    'date' => $request->date,
                    'amount' => $request->amount,
                    'status' => $request->status,
                ]);

                return response()->json($invoice->load('customer'));

            default:
                return response()->json(['error' => 'Invalid module'], 400);
        }
    }
}
