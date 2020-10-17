<?php

namespace App\Exports;

use App\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class StatusExport implements FromView, ShouldAutoSize, WithEvents
{
     private $data;
     private $clas;
     private $sem;
	    public function __construct($data,$clas,$sem)
	    {
	        $this->data = $data;
	        $this->clas = $clas;
	        $this->sem = $sem;
	    }

	    public function view(): View
	    {
	        return view('statusexport', [
	            'data' => $this->data,
	            'clas' => $this->clas,
	            'sem' => $this->sem
	        ]);
	    }

	    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A2:G2')->getFont()->setSize(21);
            },
        ];
    }
}
