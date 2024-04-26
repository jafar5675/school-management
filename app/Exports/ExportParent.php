<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportParent implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array
    {
        return [
        "Id",
        "Name",
        "Email",
        "Gender",
        "Mobile",
        "Occupation",
        "Address",
        "Status",
        "Created Date"
        ];
    }

    public function map($value):array
    {
        $parent_name = $value->name.' '.$value->last_name;

        $status = $value->status == 0 ? 'Active' : 'Inactive';
        return [
            $value->id,
            $parent_name,
            $value->email,
            $value->gender,
            $value->mobile_number,
            $value->occupation,
            $value->address,
            $status,
            date('d-m-Y', strtotime($value->created_at))
        ];
    }
    public function collection()
    {
        $remove_pagination = 1;
        return User::getParent($remove_pagination);
    }
}