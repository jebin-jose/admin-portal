<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomField;
use App\Http\Requests\StoreCustomFieldRequest;

class CustomFieldController extends Controller
{
    /**
     * Display a listing of the custom fields.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customFields = CustomField::orderBy('created_at', 'desc')->paginate();

        return view('admin.custom-fields.index', compact('customFields'));
    }

    /**
     * Show the form for creating a new custom field.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.custom-fields.create');
    }

    /**
     * Store a newly created custom field in storage.
     *
     * @param \App\Http\Requests\StoreCustomFieldRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCustomFieldRequest $request)
    {
        try {

            $data = [
                'module' => $request->module,
                'name' => $request->name,
                'type' => $request->type,
                'is_required' => $request->has('is_required'),
            ];

            if ($request->type === 'dropdown' && $request->options) {
                $filteredOptions = array_filter($request->options, function($option) {
                    return !empty(trim($option));
                });
                $data['options'] = array_values($filteredOptions);
            }

            if ($request->type === 'lookup' && $request->lookup_module) {
                $data['lookup_module'] = $request->lookup_module;
            }
            $customField = CustomField::create($data);


            return redirect()->route('admin.custom-fields')->with('success', 'Custom field created successfully.');

        } catch (\Exception $e) {
            report($e);
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the custom field. Please try again.');
        }
    }

    // TODO: Add methods for edit, update, and delete operations
}
