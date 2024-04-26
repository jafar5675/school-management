<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTeacher implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array
    {
        return [
        "Id",
        "Teacher Name",
        "Email",
        "Gender",
        "Birth Date",
        "Date of Joining",
        "Mobile",
        "Marital Status",
        "Current Address",
        "Permanent Address",
        "Qualification",
        "Work Experience",
        "Note",
        "Status",
        "Created Date"
        ];
    }

    public function map($value):array
    {
        $teacher_name = $value->name.' '.$value->last_name;
        $parent_name = $value->parent_name.' '.$value->parent_last_name;
        $date_of_birth = '';
        if (!empty($value->date_of_birth))
        {
            $date_of_birth = date('d-m-Y', strtotime($value->date_of_birth));
        }
        $admission_date = '';
        if (!empty($value->admission_date))
        {
            $admission_date = date('d-m-Y', strtotime($value->admission_date));
        }

        $status = $value->status == 0 ? 'Active' : 'Inactive';
        return [
            $value->id,
            $teacher_name,
            $value->email,
            $value->gender,
            $date_of_birth,
            $admission_date,
            $value->mobile_number,
            $value->marital_status,
            $value->address,
            $value->permanent_address,
            $value->qualification,
            $value->experience,
            $value->note,
            $status,
            date('d-m-Y', strtotime($value->created_at))
        ];
    }
    public function collection()
    {
        $remove_pagination = 1;
        return User::getTeacher($remove_pagination);
    }
}