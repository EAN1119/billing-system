<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Account;
use App\Models\Invoice;
use Carbon\Carbon;

class OrdersController extends Controller
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
        $orders = Order::orderBy('created_at', 'desc')->paginate(5);   // 5 per page
           
        return view('orders.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'account_id' => 'required',    
            'items' => 'required',   
            'delivery_date' => 'nullable',   
        ]);
        
        $account_id = $request->input('account_id');
        $account_id_real = ltrim($account_id, '0');
        
        $account = Account::find($account_id_real);
        if($account == null){
            return redirect('/orders')->with('error', 'Account Does Not Exist'); //set error msg for messages.blade
        }
        
        $quantity_mineral_6l = $request->input('quantity_mineral_6l');
        $mineral_6l_total_price = $quantity_mineral_6l * 14.00;
        
        $quantity_dispenser_6l = $request->input('quantity_dispenser_6l');
        $dispenser_6l_total_price = $quantity_dispenser_6l * 29.00;
        
        $quantity_mineral_1_5l = $request->input('quantity_mineral_1_5l');
        $mineral_1_5l_total_price = $quantity_mineral_1_5l * 9.00;
        
        $quantity_mineral_350ml = $request->input('quantity_mineral_350ml');
        $mineral_350ml_total_price = $quantity_mineral_350ml * 7.00;
        
        $items_quantity = collect([$quantity_mineral_6l, $quantity_dispenser_6l, $quantity_mineral_1_5l, $quantity_mineral_350ml])->implode(',');
        
        $total_price = $mineral_6l_total_price + $dispenser_6l_total_price + $mineral_1_5l_total_price + $mineral_350ml_total_price;
        
        //create order
        $order = new Order;
        $order->account_id = $account_id_real;
        $order->account_no = $account->account_no;
        $order->company_name = $account->company_name;
        $order->delivery_date = $request->input('delivery_date');
        $order->payment_terms = $request->input('payment_terms');
        $order->total_price = $total_price;
        $order->items = $items_quantity.' - '.implode(', ', $request->input('items'));
        $order->created_by = auth()->user()->name;
        
        $order->save();

        return redirect('/orders')->with('success', 'Order Received!');  //set success msg for messages.blade
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);

        //check for correct user
        if (auth()->user()->name !== $order->created_by) {
            return redirect('/orders')->with('error', 'Unauthorized Page'); //set error msg for messages.blade
        }

        return view('orders.edit')->with('order', $order);
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
            'delivery_date' => 'required',            
        ]);

 
        //update order
        $order = Order::find($id);
        $order->delivery_date = $request->input('delivery_date');
        
        if($order->delivery_date != null){
                
            $order->day_of_week = Carbon::parse($order->delivery_date)->format('l');
            $order->invoice_no = 'INV-'.str_pad($order->id, 6, '0', STR_PAD_LEFT);  
            

          
                
                $find_invoice = Invoice::where('invoice_no', $order->invoice_no)->value('invoice_no');
                
                              
                if($find_invoice == $order->invoice_no){
                      
                    //return 'record exist, cannot create invoice';
                    $order->save();

                    return redirect('/orders')->with('success', 'Order Updated');  //set success msg for messages.blade
                    
                }else{
                    //return 'record does not exist, can create invoice';
                    //create invoice
                    $invoice = new Invoice;
                    $invoice->account_id = $order->account_id;
                    $invoice->invoice_no = $order->invoice_no;
                    $invoice->invoice_date = Carbon::now()->format('Y-m-d');
                    $invoice->order_id = $order->id;
                    $invoice->payment_terms = $order->payment_terms;
                    $invoice->total_price = $order->total_price;
                    $invoice->total_paid = 0.00;
                    $invoice->total_unpaid = $order->total_price;
                    $invoice->created_by = auth()->user()->name;
                    $invoice->save();

                    $order->save();
                    return redirect('/orders')->with('success', 'Order Updated & Invoice Created!');  //set success msg for messages.blade
                    
                    
                }
                
            
        }
        
        $order->save();

        return redirect('/orders')->with('success', 'Order Updated');  //set success msg for messages.blade
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        //check for correct user
        if (auth()->user()->name !== $order->created_by) {
            return redirect('/orders')->with('error', 'Unauthorized Page'); //set error msg for messages.blade
        }

       

        $order->delete();

        return redirect('/orders')->with('success', 'Account Deleted');
    }
    
    public function search(Request $request){
        $request->input('q');
        
        //Search for Bil. Acc. ID / Account Number / Company Name / Day of Week / Payment Terms / Invoice Number
        
        $search_orders = Order::where('account_id', 'LIKE', '%' . $request->input('q') . '%')
                        ->orWhere('account_no', 'LIKE', '%' . $request->input('q') . '%')
                        ->orWhere('company_name', 'LIKE', '%' . $request->input('q') . '%')
                        ->orWhere('day_of_week', 'LIKE', '%' . $request->input('q') . '%')
                        ->orWhere('payment_terms', 'LIKE', '%' . $request->input('q') . '%')
                        ->orWhere('invoice_no', 'LIKE', '%' . $request->input('q') . '%')->get();
        
        if (count($search_orders) > 0) {
           return view ('orders.search')->withDetails($search_orders)->withQuery($request->input('q'));
        } else {
           return redirect('/orders')->with('error', 'No records found. Try to search again!'); //set error msg for messages.blade
        }
    }
}
