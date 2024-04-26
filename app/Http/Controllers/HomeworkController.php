<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\HomeworkModel;
use App\Models\ClassSubjectModel;
use App\Models\HomeworkSubmitModel;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignClassTeacherModel;

class HomeworkController extends Controller
{
    public function homeworkReport()
    {
        $data['getRecord'] = HomeworkSubmitModel::getHomeworkReport();
        $data['header_title'] = 'Homework Report';
        return view('admin.homework.report', $data);
    }
    public function homework()
    {
        $data['getRecord'] = HomeworkModel::getRecord();
        $data['header_title'] = 'Homework';
        return view('admin.homework.list', $data);
    }
    public function homeworkAdd()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Add Homework';
        return view('admin.homework.add', $data);
    }

    public function ajax_get_subject(Request $request)
    {
        $class_id = $request->class_id;
        $getSubject = ClassSubjectModel::MySubject($class_id);
        $html = '';
        $html .= '<option value="">Select Subject</option>';
        foreach($getSubject as $value)
        {
            $html .= '<option value="'.$value->subject_id.'">'.$value->subject_name.'</option>';
        }

        $json['success'] = $html;
        echo json_encode($json);
    }

    public function insert(Request $request)
    {
        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;
        if(!empty($request->file('document_file'))){

            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }
        $homework->save();

        return redirect('admin/homework/homework')->with('success','Homework Successfully Created');
    }

    public function edit($id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getClass'] = ClassModel::getClass();
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['header_title'] = 'Edit Homework';
        return view('admin.homework.edit', $data);
    }

    public function update($id, Request $request)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if(!empty($request->file('document_file'))){

            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }
        $homework->save();

        return redirect('admin/homework/homework')->with('success','Homework Successfully Updated');
    }

    public function delete($id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->is_delete = 1;
        $homework->save();
        return redirect('admin/homework/homework')->with('success','Homework Successfully Deleted');
    }

    public function submitted($homework_id)
    {
       $homework = HomeworkModel::getSingle($homework_id);
       if(!empty($homework))
       {
        $data['homework_id'] = $homework_id;
        $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
        $data['header_title'] = 'Submitted Homework';
        return view('admin.homework.submitted',$data);
       }
       else
       {
        abort(404);
       }
    }

    // teacher side
    public function HomeworkTeacher()
    {
        $class_ids = array();
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);

        foreach($getClass as $class)
        {
            $class_ids[]=$class->class_id;
        }

        $data['getRecord'] = HomeworkModel::getRecordTeacher($class_ids);
        $data['header_title'] = 'Homework';
        return view('teacher.homework.list', $data);
    }

    public function homeworkAddTeacher()
    {
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = 'Add Homework';
        return view('teacher.homework.add', $data);
    }

    public function insertTeacher(Request $request)
    {
        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;
        if(!empty($request->file('document_file'))){

            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }
        $homework->save();

        return redirect('teacher/homework/homework')->with('success','Homework Successfully Created');
    }

    public function editTeacher($id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = 'Edit Homework';
        return view('teacher.homework.edit', $data);
    }

    public function updateTeacher($id, Request $request)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if(!empty($request->file('document_file'))){

            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }
        $homework->save();

        return redirect('teacher/homework/homework')->with('success','Homework Successfully Updated');
    }

    public function submittedTeacher($homework_id)
    {
       $homework = HomeworkModel::getSingle($homework_id);
       if(!empty($homework))
       {
        $data['homework_id'] = $homework_id;
        $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
        $data['header_title'] = 'Submitted Homework';
        return view('teacher.homework.submitted',$data);
       }
       else
       {
        abort(404);
       }
    }

    // student side
    public function StudentHomework()
    {
        $data['getRecord'] = HomeworkModel::getRecordStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title'] = 'Student Homework';
        return view('student.homework.list', $data);
    }
    public function SubmitHomework($homework_id)
    {
        $data['getRecord'] = HomeworkModel::getSingle($homework_id);
        $data['header_title'] = 'Submit Homework';
        return view('student.homework.submit', $data);
    }

    public function SubmitHomeworkInsert(Request $request, $homework_id)
    {
        $homework = new HomeworkSubmitModel;
        $homework->homework_id = $homework_id;
        $homework->student_id = Auth::user()->id;
        $homework->description = trim($request->description);

        if(!empty($request->file('document_file'))){

            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }
        $homework->save();

        return redirect('student/my_homework')->with('success','Homework Successfully Submitted');

    }

    public function HomeworkSubmittedByStudent(Request $request)
    {
        $data['getRecord'] = HomeworkSubmitModel::getRecordStudent(Auth::user()->id);
        $data['header_title'] = 'My Submitted Homework';
        return view('student.homework.submitted_list', $data);
    }

    // parent side
    public function HomeworkStudentParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = HomeworkModel::getRecordStudent($getStudent->class_id,$getStudent->id);
        $data['header_title'] = 'My Student Homework';
        $data['getStudent'] = $getStudent;
        return view('parent.homework.list',$data);
    }

    public function SubmittedHomeworkStudentParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = HomeworkSubmitModel::getRecordStudent($getStudent->id);
        $data['header_title'] = 'Student Submitted Homework';
        $data['getStudent'] = $getStudent;
        return view('parent.homework.submitted_list', $data);
    }
}