<?php

namespace App\Livewire;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CalculateUsageComponent extends Component
{

    public $totalUsd = 0;
    public function mount()
    {
    }
    public $date1;
    public $date2;
    public function calc(Request $request)
    {
        $date1 = $request->date1;
        $date2 = $request->date2;
        $userId = Auth::id();
            $str1 = strtotime( $date1);
            $str2 = strtotime( $date2);
            $this->totalUsd = $this->calcTotal($str1, $str2,1.08, $userId);
        return view('livewire.calculate-usage', [
            'totalUsd' => $this->totalUsd,
        ]);
    }

    private function calcTotal($periodStart, $periodEnd, $rate, $userId)
    {
        $payments = DB::table('payments')
            ->join('invoices', 'payments.invoice_id', '=', 'invoices.id')
            ->where('invoices.user_id', $userId)
            ->get();
        $totalEur = 0;
        foreach ($payments as $payment) {
            $date = strtotime( $payment->payment_date);
            if($date<=$periodEnd && $date>=$periodStart) $totalEur+=$payment->amount;
        }
        return  $totalEur * $rate;

        }

    public function render()
    {
        return view('livewire.calculate-usage', ['totalUsd' => $this->totalUsd]);
    }
}
