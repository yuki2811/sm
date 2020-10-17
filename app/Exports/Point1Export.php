<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class Point1Export implements FromView, ShouldAutoSize, WithEvents
{
     private $data;
     private $classes;
     private $semester;
     private $subject;
     private $subsem;
    public function __construct($data,$classes,$semester,$subject,$subsem)
    {
        $this->data = $data;
        $this->classes = $classes;
        $this->semester = $semester;
        $this->subject = $subject;
        $this->subsem = $subsem;
    }

    public function view(): View
    {
        return view('hk1', [
            'data' => $this->data,
            'classes' => $this->classes,
            'semester' => $this->semester,
            'subject' => $this->subject,
            'subsem' => $this->subsem
        ]);
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A2:M2')->getFont()->setSize(21);
            },
        ];
    }
}
