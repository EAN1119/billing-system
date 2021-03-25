<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;


class AccountsController extends Controller
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
        $accounts = Account::orderBy('created_at', 'desc')->paginate(5);   // 5 per page
           
        return view('accounts.index')->with('accounts', $accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
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
            'company_name' => 'required',            
        ]);
              
        //create account
        $account = new Account;
        
        
        
        $account->account_prefix =  strtoupper($request->input('company_name')[0]);
        
        $account->company_name = $request->input('company_name');
        $account->created_by = auth()->user()->name;
        $account->save();

        //return $account;
        
        return redirect('/accounts')->with('success', 'Account Created!');  //set success msg for messages.blade
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::find($id);

        return view('accounts.show')->with('account', $account);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::find($id);

        //check for correct user
        if (auth()->user()->name !== $account->created_by) {
            return redirect('/accounts')->with('error', 'Unauthorized Page'); //set error msg for messages.blade
        }

        return view('accounts.edit')->with('account', $account);
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
            'company_name' => 'required',            
        ]);

 
        //update account
        $account = Account::find($id);
        $account->company_name = $request->input('company_name');
        
        $account->save();

        return redirect('/accounts')->with('success', 'Account Updated');  //set success msg for messages.blade
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::find($id);

        //check for correct user
        if (auth()->user()->name !== $account->created_by) {
            return redirect('/accounts')->with('error', 'Unauthorized Page'); //set error msg for messages.blade
        }

       

        $account->delete();

        return redirect('/accounts')->with('success', 'Account Deleted');
    }
    
    public function search(Request $request){
        $request->input('q');
        
        //Search for Bil. Acc. ID / Account Number / Company Name / Created By
        
        $search_accounts = Account::where('id', 'LIKE', '%' . $request->input('q') . '%')
                        ->orWhere('account_no', 'LIKE', '%' . $request->input('q') . '%')
                        ->orWhere('company_name', 'LIKE', '%' . $request->input('q') . '%')
                        ->orWhere('created_by', 'LIKE', '%' . $request->input('q') . '%')->get();
        
        if (count($search_accounts) > 0) {
           return view ('accounts.search')->withDetails($search_accounts)->withQuery($request->input('q'));
        } else {
           return redirect('/accounts')->with('error', 'No records found. Try to search again!'); //set error msg for messages.blade
        }
    }
    

}
