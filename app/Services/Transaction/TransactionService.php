<?php

namespace App\Services\Transaction;

use App\Transaction,
    App\Category,
    Carbon\Carbon,
    Auth;

class TransactionService
{
    private $arMonth;
    private $categories;

    public function __construct()
    {
    }

    public function getMonthDates($month, $year)
    {
        $arMonthDates = [];
        $needDate = new Carbon('01.'. $month . '.' . $year);
        $days = date('t', strtotime($needDate->lastOfMonth()->format('Y-m-d')));
        $needDate->subDays($days-1);
        foreach (range(0, $days - 1) as $day) {
            $arMonthDates[]['date'] = $needDate->copy()->addDays($day)->format('d.m.Y');
        }

        return $arMonthDates;
    }

    public function getMonthTransaction($month, $year)
    {
        $needDate = new Carbon('01.'. $month . '.' . $year);
        $from = $needDate->format('Y-m-d');
        $to = $needDate->lastOfMonth()->format('Y-m-d');

        $arMonthDates = $this->getMonthDates($month, $year);

        $this->categories = Category::where('userid', Auth::user()->id)->get();
        foreach ($this->categories as $category) {
            $this->arMonth[$category->id]['name'] = $category->name;
            $this->arMonth[$category->id]['type'] = $category->typeid;
            foreach ($arMonthDates as $month) {
                $this->arMonth[$category->id]['dates'][] = [
                    'date' => $month['date'],
                    'sum' => 0,
                ];
            }
        }

        $monthTransactions = Transaction::where('userid', Auth::user()->id)
            ->whereBetween('date', [$from, $to])
            ->get();

        foreach ($monthTransactions as $transaction) {
            $transactionDate = Carbon::parse($transaction->date)->format('d.m.Y');
            $tranSum = 0;
            foreach ($this->arMonth[$transaction->categoryid]['dates'] as $key => $value) {
                if($transactionDate == $value['date']) {
                    $this->arMonth[$transaction->categoryid]['dates'][$key]['sum'] += $transaction->sum;
                    $tranSum += $transaction->sum;
                }
            }
            $this->arMonth[$transaction->categoryid]['itogo'] = $tranSum;
        }

        return $this->arMonth;
    }
}
