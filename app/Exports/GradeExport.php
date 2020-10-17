<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class GradeExport implements FromView, ShouldAutoSize, WithEvents
{
    private $data;
    private $siso;
    private $grade;
    private $semester;
    private $subsem;
    public function __construct($data,$siso,$grade,$semester,$subsem)
    {
        $this->data = $data;
        $this->siso = $siso;
        $this->grade = $grade;
        $this->semester = $semester;
        $this->subsem = $subsem;
    }

    public function view(): View
    {
        return view('gradeexport', [
            'data' => $this->data,
            'siso' => $this->siso,
            'grade' => $this->grade,
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
