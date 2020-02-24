<?php

namespace App\Http\Controllers;

use Auth,
    App\Transaction,
    App\Category,
    Illuminate\Http\Request;


class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = [];
        foreach (Category::where('userid', Auth::user()->id)->get() as $category) {
            $categories[$category->id] = $category->name;
        }

        return view('transactions.index', [
            'transactions' => Transaction::where('userid', Auth::user()->id)->paginate(20),
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = [];
        foreach (Category::where('userid', Auth::user()->id)->get() as $category) {
            $categories[$category->id] = $category->name;
        }
        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'=>'required',
            'categoryid'=>'required',
            'sum'=>'required'
        ]);

        $transaction = new Transaction([
            'userid' => Auth::user()->id,
            'date' => $request->get('date'),
            'categoryid' => $request->get('categoryid'),
            'sum' => $request->get('sum')
        ]);
        $transaction->save();

        return redirect('/transactions')->with('success', 'Transaction added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = [];
        foreach (Category::where('userid', Auth::user()->id)->get() as $category) {
            $categories[$category->id] = $category->name;
        }
        return view('transactions.edit', [
            'transaction' => Transaction::find($id),
            'categories' => $categories,
        ]);
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
        $request->validate([
            'date'=>'required',
            'categoryid'=>'required',
            'sum'=>'required'
        ]);

        $transaction = Transaction::find($id);
        $transaction->userid = Auth::user()->id;
        $transaction->date = $request->get('date');
        $transaction->categoryid = $request->get('categoryid');
        $transaction->sum = $request->get('sum');
        $transaction->save();

        return redirect('/transactions')->with('success', 'Transaction updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();

        return redirect('/transactions')->with('success', 'Transaction deleted!');
    }
}
