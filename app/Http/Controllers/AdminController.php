<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;

class AdminController extends Controller
{
    
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Customer methods
     */
    public function customers()
    {
        return view('admin.customers.index');
    }

    /**
     * Show the form for creating a new customer.
     */
    public function createCustomer()
    {
        return view('admin.customers.create');
    }

    /**
     * Show the form for editing an existing customer.
     */
    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);

        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Invoice methods
     */
    public function invoices()
    {
        return view('admin.invoices.index');
    }
    /**
     * Show the form for creating a new invoice.
     */
    public function createInvoice()
    {
        $customers = Customer::all();
        
        return view('admin.invoices.create', compact('customers'));
    }

    /**
     * Show the form for editing an existing invoice.
     */
    public function editInvoice($id)
    {
        $invoice = Invoice::with('customer')->findOrFail($id);
        $customers = Customer::all();

        return view('admin.invoices.edit', compact('invoice', 'customers'));
    }
}
