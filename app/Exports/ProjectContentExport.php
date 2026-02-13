<?php

namespace App\Exports;

use App\Models\ProjectContent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProjectContentExport implements FromCollection, WithHeadings, WithMapping
{
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function collection()
    {
        return ProjectContent::where('year_range', $this->year)->orderBy('page_number')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Page Number',
            'Section Title',
            'Type',
            'Content (JSON)',
            'Source',
            'Year Range'
        ];
    }

    public function map($content): array
    {
        return [
            $content->id,
            $content->page_number,
            $content->section_title,
            $content->type,
            json_encode($content->content),
            $content->source,
            $content->year_range,
        ];
    }
}
