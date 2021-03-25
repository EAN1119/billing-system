<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Account;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() 
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $invoices = Invoice::orderBy('created_at', 'desc')->paginate(5);   // 5 per page
           
        return view('invoices.index')->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);

        return view('invoices.show')->with('invoice', $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);

        //check for correct user
        if (auth()->user()->name !== $invoice->created_by) {
            return redirect('/invoices')->with('error', 'Unauthorized Page'); //set error msg for messages.blade
        }

        return view('invoices.edit')->with('invoice', $invoice);
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
        $this->validate($request, [
            'total_paid' => 'required',            
        ]);
        
        //update invoice
        $invoice = Invoice::find($id);
        $invoice->total_paid = $request->input('total_paid');
        $invoice->total_unpaid = $invoice->total_price - $request->input('total_paid');
        
        $invoice->save();

        return redirect('/invoices')->with('success', 'Invoice Updated');  //set success msg for messages.blade
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        //check for correct user
        if (auth()->user()->name !== $invoice->created_by) {
            return redirect('/invoices')->with('error', 'Unauthorized Page'); //set error msg for messages.blade
        }

       

        $invoice->delete();

        return redirect('/invoices')->with('success', 'Invoice Deleted');
    }
    
    public function search(Request $request){
        $request->input('q');
        
        //Search for Bil. Acc. ID / Invoice Number / Order ID / Order Created By
        
        $search_invoices = Invoice::where('account_id', 'LIKE', '%' . $request->input('q') . '%')
                        ->orWhere('invoice_no', 'LIKE', '%' . $request->input('q') . '%')
                        ->orWhere('order_id', 'LIKE', '%' . $request->input('q') . '%')
                        ->orWhere('created_by', 'LIKE', '%' . $request->input('q') . '%')->get();
        
        if (count($search_invoices) > 0) {
           return view ('invoices.search')->withDetails($search_invoices)->withQuery($request->input('q'));
        } else {
           return redirect('/invoices')->with('error', 'No records found. Try to search again!'); //set error msg for messages.blade
        }
    }
}
