<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\Services\Transaction\TransactionService;


class MonthController extends Controller
{
    private $transactionService;
    /**
     * @return void
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $monthDates = $this->transactionService->getMonthDates(12, 2019);
        $monthTransactions = $this->transactionService->getMonthTransaction(12, 2019);

        return view('home', [
            'monthDates' => $monthDates,
            'monthTransactions' => $monthTransactions
        ]);
    }
}
