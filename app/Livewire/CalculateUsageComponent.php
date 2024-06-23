<?php

namespace App\Livewire;

use App\Models\Payment;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CalculateUsageComponent extends Component
{
    private $key = "9228e5ebde005b5ec4a021da";
    public $usdrate;
    public $totalUsd;
    public $items = [];
    public function mount()
    {
        $invoices = DB::table('invoices')->pluck('id');

        $this->items = $invoices->toArray();
        $url = 'https://v6.exchangerate-api.com/v6/' . $this->key . '/latest/EUR';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        $this -> usdrate = $data['conversion_rates']['USD'];
    }
    public function calc(Request $request)
    {
        $date1 = $request->date1;
        $date2 = $request->date2;
        $userId = Auth::id();
            $str1 = strtotime( $date1);
            $str2 = strtotime( $date2);
            $this->totalUsd = $this->calcTotal($str1, $str2,$this->usdrate, $userId);
        return view('livewire.calculate-usage', [
            'totalUsd' => $this->totalUsd,
        ]);
    }

    public function calcTotal($periodStart, $periodEnd, $rate, $userId)
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
        return view('livewire.calculate-usage',
            ['totalUsd' => $this->totalUsd,
             'payments' => Payment::all(),
             'rateUsd' => $this->usdrate,
             'items' => $this->items
            ],
        );
    }
}
