<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; 

class QuestionBankExport implements FromCollection, WithHeadings 
{
    public $paper_id;
    public $category_id;
    public $subject_id; 
    public $questionCorrectMark; 
    public $questionWrongMark; 

    function __construct($paper_id, $category_id,$subject_id, $questionCorrectMark = 1, $questionWrongMark = -1)  
    {
        $this->paper_id  = $paper_id;
        $this->category_id = $category_id;
        $this->subject_id = $subject_id;
        $this->questionCorrectMark = $questionCorrectMark; 
        $this->questionWrongMark = $questionWrongMark; 
    }

    
    public function collection()
    {
        return collect([
            [
                $this->paper_id, 
                $this->category_id,
                $this->subject_id, 
                $this->questionCorrectMark, 
                $this->questionWrongMark,
                'Full form of PHP is?',
                '', // explanation
                '', // hints
                '5', // totalOption
                'Hypertext Preprocessor', // option1
                'Hypertext Preprocessor is a scripting language', // option2
                'Hypertext Preprocessor is a programming language', // option3
                'Hypertext Preprocessor is a markup language', // option4
                'None of these', // option5
                '2', // answer
            ],
        ]);
    }

    
    public function headings(): array
    {
        return [
            'paper_id',
            'category_id',
            'subject_id',
            'questioncurrectmark',
            'questionWrongMark',
            'question',
            'explanation',
            'hints',
            'totaloption',
            'option1',
            'option2',
            'option3',
            'option4',
            'option5',
            'answer'
        ];
    }
}
