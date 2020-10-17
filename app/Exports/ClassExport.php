<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class ClassExport implements FromView, ShouldAutoSize, WithEvents
{
    private $data;
    private $siso;
    private $classes;
    private $semester;
    private $subsem;
	    public function __construct($data,$siso,$classes,$semester,$subsem)
	    {
	        $this->data = $data;
	        $this->siso = $siso;
	        $this->classes = $classes;
	        $this->semester = $semester;
	        $this->subsem = $subsem;
	    }

	    public function view(): View
	    {
	        return view('classexport', [
	            'data' => $this->data,
	            'siso' => $this->siso,
	            'classes' => $this->classes,
	            'semester' => $this->semester,
	            'subsem' => $this->subsem
	        ]);
	    }
	    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A2:Q2')->getFont()->setSize(21);
            },
        ];
    }
}
