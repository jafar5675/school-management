<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WeekModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Models\ClassSubjectModel;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSubjectTimetableModel;

class ClassTimetableController extends Controller
{
    public function list(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();

        if(!empty($request->class_id))
        {
            $data['getSubject'] = ClassSubjectModel::MySubject($request->class_id);
        }

        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach($getWeek as $value)
        {
            $dataW = array();
            $dataW['week_day_id'] = $value->id;
            $dataW['week_day_name'] = $value->name;

            if(!empty($request->class_id) && !empty($request->subject_id))
            {
                $classSubject = ClassSubjectTimetableModel::getRecordClassSubject($request->class_id,$request->subject_id,$value->id);
                if(!empty($classSubject))
                {
                   $dataW['start_time'] = $classSubject->start_time;
                   $dataW['end_time'] = $classSubject->end_time;
                   $dataW['room_number'] = $classSubject->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
            }
            else
            {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }
            $week[] = $dataW;
        }
        $data['week'] = $week;
        $data['header_title'] = "Class Timetable";
        return view('admin.class_timetable.list',$data);
    }

    public function get_subject(Request $request)
    {
        $getSubject = ClassSubjectModel::MySubject($request->class_id);
        $html = "<option value=''>Select</option>";
        foreach($getSubject as $value)
        {
            $html .="<option value='".$value->subject_id."'>".$value->subject_name."</option>";
        }

        $json['html'] = $html;
        echo json_encode($json);
    }

    public function insert_update(Request $request)
    {
        // how to delete database table data
        // ClassSubjectTimetableModel::where('class_id','=',$request->class_id)->where('subject_id','=',$request->subject_id)->delete();
       foreach($request->timetable as $timetable)
       {
            if(!empty($timetable['week_day_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number']))
            {
                $save = new ClassSubjectTimetableModel;
                $save->class_id = $request->class_id;
                $save->subject_id = $request->subject_id;
                $save->week_day_id = $timetable['week_day_id'];
                $save->start_time = $timetable['start_time'];
                $save->end_time = $timetable['end_time'];
                $save->room_number = $timetable['room_number'];
                $save->save();
            }
       }

       return redirect()->back()->with('success',"Class Subject Timetabel Successfully Added");
    }

    public function MyTimetable()
    {
        $result = array();

        // $data = array();
        // $data['name'] = "rafi";
        // $data1 = array();
        // $data1['habiba'] = 'Umme Habiba';
        // $data1['aklima'] = 'Aklima Akter';
        // $data['rakib'] = "Rakib Hossain";
        // $data2 = array();
        // $data2['aysha'] = "Aysha Khanm";
        // $data2['mahmuda'] = "Mahmuda Khanm";
        // $data1['e']= $data2;
        // $data['d'] = $data1;
        // $result['c']= $data;
        // dd($result);
        $getRecord = ClassSubjectModel::MySubject(Auth::user()->class_id);
        foreach($getRecord as $value)
        {
            $dataS['name'] = $value->subject_name;
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach($getWeek as $valueW)
            {
                $dataW = array();
                $classSubject = ClassSubjectTimetableModel::getRecordClassSubject($value->class_id,$value->subject_id,$valueW->id);
                if(!empty($classSubject))
                {
                   $dataW['start_time'] = $classSubject->start_time;
                   $dataW['end_time'] = $classSubject->end_time;
                   $dataW['room_number'] = $classSubject->room_number;
                }
                else
                {
                   $dataW['start_time'] = '';
                   $dataW['end_time'] = '';
                   $dataW['room_number'] = '';
                }
                $dataW['week_day_name'] = $valueW->name;
                $week[] = $dataW;
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $data['getRecord'] = $result;
        $data['header_title'] = "My Timetable";
        return view('student.my_timetable',$data);
    }

    public function MyTimetableTeacher($class_id,$subject_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getSubject'] = SubjectModel::getSingle($subject_id);
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach($getWeek as $valueW)
            {
                $dataW = array();
                $dataW['week_day_name'] = $valueW->name;

                $classSubject = ClassSubjectTimetableModel::getRecordClassSubject($class_id,$subject_id,$valueW->id);

                if(!empty($classSubject))
                {
                   $dataW['start_time'] = $classSubject->start_time;
                   $dataW['end_time'] = $classSubject->end_time;
                   $dataW['room_number'] = $classSubject->room_number;
                }
                else
                {
                   $dataW['start_time'] = '';
                   $dataW['end_time'] = '';
                   $dataW['room_number'] = '';
                }

                $result[] = $dataW;
            }

        $data['getRecord'] = $result;

        $data['header_title'] = "My Timetable";
        return view('teacher.my_timetable',$data);
    }
    public function MyTimetableParent($class_id,$subject_id,$student_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getSubject'] = SubjectModel::getSingle($subject_id);
        $data['getStudent'] = User::getSingle($student_id);
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach($getWeek as $valueW)
            {
                $dataW = array();
                $dataW['week_day_name'] = $valueW->name;

                $classSubject = ClassSubjectTimetableModel::getRecordClassSubject($class_id,$subject_id,$valueW->id);

                if(!empty($classSubject))
                {
                   $dataW['start_time'] = $classSubject->start_time;
                   $dataW['end_time'] = $classSubject->end_time;
                   $dataW['room_number'] = $classSubject->room_number;
                }
                else
                {
                   $dataW['start_time'] = '';
                   $dataW['end_time'] = '';
                   $dataW['room_number'] = '';
                }

                $result[] = $dataW;
            }

        $data['getRecord'] = $result;

        $data['header_title'] = "My Timetable";
        return view('parent.my_timetable',$data);
    }

}