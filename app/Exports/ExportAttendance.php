<?php

namespace App\Exports;

use App\Models\StudentAttendanceModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportAttendance implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array
    {
        return [
            "Student Id",
            "Student Name",
            "Class Name",
            "Attendance Type",
            "Attendance Date",
            "Created By",
            "Created Date"
        ];
    }

    public function map($value):array
    {
        $student_name = $value->student_name.' '.$value->student_last_name;

        $attendance_type = '';
        if($value->attendance_type == 1)
        {
            $attendance_type = 'Present';
        }
        if($value->attendance_type == 2)
        {
            $attendance_type = 'Absent';
        }
        if($value->attendance_type == 3)
        {
            $attendance_type = 'Late';
        }
        if($value->attendance_type == 4)
        {
            $attendance_type = 'Half Day';
        }

        return [
            $value->student_id,
            $student_name,
            $value->class_name,
            $attendance_type,
            date('d-m-Y', strtotime($value->attendance_date)),
            $value->created_name,
            date('d-m-Y', strtotime($value->created_at))
        ];
    }
    public function collection()
    {
        $remove_pagination = 1;
        return StudentAttendanceModel::getRecord($remove_pagination);
    }
}