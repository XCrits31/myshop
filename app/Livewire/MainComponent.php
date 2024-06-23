<?php
namespace App\Livewire;

use Auth;
use DB;
use Livewire\Component;
use App\Livewire\CalculateUsageComponent;
class MainComponent extends Component
{
    public $items = [];
    public $rate;
    public $selectedItem = null;
    public $generatedList = [];

    public function mount($items, $rate)
    {
        $this->items = $items;
        $this->rate = $rate;
    }

    public function submit()
    {
        $this->generateList($this->selectedItem);
    }

    public function generateList($value)
    {
        $this->generatedList = [];
        $invoice = DB::table('invoices')->where('id', $value)->first();
        $periodStart = strtotime($invoice->date);
        $periodFullEnd = strtotime($invoice->date_end);
        $periodEnd = strtotime('+' . $invoice->duration_months. 'months', $periodStart);
        $now = strtotime('+1 month', $periodStart);;
        $userId = Auth::id();
        while($now < $periodEnd){
            $cont_int = $this->calcTotal($periodStart, $now, $this->rate, $userId);
            $temp1 =  date('Y-m-d',$periodStart);
            $temp2 =  date('Y-m-d',$now);
            $this->generatedList[] = "period from $temp1 to $temp2 -> payment = $cont_int USD";
            $periodStart = strtotime('+1 month', $periodStart);
            $now = strtotime('+1 month', $now);
        }
        $cont_int = $this->calcTotal($periodStart, $periodFullEnd, $this->rate, $userId);
        $temp1 =  date('Y-m-d',$periodStart);
        $temp2 =  date('Y-m-d',$periodFullEnd);
        $this->generatedList[] = "period from $temp1 to $temp2 -> payment = $cont_int USD";
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
        return  round($totalEur * $rate,2);
    }


    public function render()
    {
        return view('livewire.main-component');
    }
}
