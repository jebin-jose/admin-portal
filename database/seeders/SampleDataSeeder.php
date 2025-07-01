<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\CustomField;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample customers
        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '123-1234',
                'address' => '123 Main St, City, State 12345'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '567-5678',
                'address' => '456  Ave, City, State 12345'
            ],
        ];

        foreach ($customers as $customerData) {
            Customer::create($customerData);
        }

        // Create sample invoices
        $invoices = [
            [
                'customer_id' => 1,
                'date' => '2024-01-15',
                'amount' => 1250.00,
                'status' => 'paid'
            ],
            [
                'customer_id' => 2,
                'date' => '2024-01-20',
                'amount' => 750.50,
                'status' => 'unpaid'
            ],
        ];

        foreach ($invoices as $invoiceData) {
            Invoice::create($invoiceData);
        }

        // Create sample custom fields
        $customFields = [
            [
                'module' => 'customer',
                'name' => 'Company',
                'type' => 'text',
                'is_required' => false
            ],
            [
                'module' => 'customer',
                'name' => 'Registration Date',
                'type' => 'date',
                'is_required' => true
            ],
            [
                'module' => 'customer',
                'name' => 'Customer Type',
                'type' => 'dropdown',
                'options' => ['Individual', 'Business', 'Corporate'],
                'is_required' => false
            ],
            [
                'module' => 'invoice',
                'name' => 'Tax Rate',
                'type' => 'decimal',
                'is_required' => false
            ],
            [
                'module' => 'invoice',
                'name' => 'Related Customer',
                'type' => 'lookup',
                'lookup_module' => 'customer',
                'is_required' => false
            ]
        ];

        foreach ($customFields as $fieldData) {
            CustomField::create($fieldData);
        }
    }
}
