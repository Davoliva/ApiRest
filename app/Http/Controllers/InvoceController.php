<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoceRequest;
use App\Http\Requests\UpdateInvoceRequest;
use App\Http\Requests\BulkStoreInvoiceRequest;
use App\Http\Resources\InvoiceCollection;
use App\Models\Invoce;
use App\Filters\InvoiceFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        //se agrega filtros
        $filter = new InvoiceFilter();
        $queryItems = $filter->trasnform($request);
        if (count($queryItems) == 0) {
            return new InvoiceCollection(Invoce::paginate());
        }else{
            //
            $Invoices = Invoce::where($queryItems)->paginate();
            return new InvoiceCollection($Invoices->appends($request->query()));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoceRequest $request)
    {
        //
    }

    //bulk para crear invoices de form masiva
    public function bulkStore(BulkStoreInvoiceRequest $request){
        $bulk = collect($request->all())->map(function($arr, $key){
            return Arr::except($arr,['customerId','billedDate','paidDate']);
        });
        Invoce::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoce $invoce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoce $invoce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoceRequest $request, Invoce $invoce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoce $invoce)
    {
        //
    }
}
