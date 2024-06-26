<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Models\ClassSubjectModel;
use Illuminate\Support\Facades\Auth;

class ClassSubjectControlloer extends Controller
{
    public function list()
    {
        $data['getRecord'] = ClassSubjectModel::getRecord();
        $data['header_title'] = "Subject Assign list";
        return view('admin.assign_subject.list',$data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "Add New Assign Subject";
        return view('admin.assign_subject.add', $data);
    }

    public function insert(Request $request)
    {
       if(!empty($request->subject_id))
       {
        foreach($request->subject_id as $subject_id)
        {
            $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);
            if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else {
                    $save = new ClassSubjectModel;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
        }
        return redirect('admin/assign_subject/list')->with('success', "Subject Successfully Assign to Class");
       }else{
        return redirect()->back()->with('error','Due to error pls try again');
       }
    }

    public function edit($id)
    {
        $getRecord = ClassSubjectModel::getSingle($id);

        if(!empty($getRecord))
        {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectID'] = ClassSubjectModel::getAssignSubjectID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = "Edit Assign Subject";

            $data['header_title'] = "Edit Class";
            return view('admin.assign_subject.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update(Request $request,$id)
    {
        ClassSubjectModel::deleteSubject($request->class_id);

        if(!empty($request->subject_id))
       {
            foreach($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);
                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else {
                    $save = new ClassSubjectModel;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
        }
        return redirect('admin/assign_subject/list')->with('success', "Subject Successfully Assign to Class");

    }

    public function delete($id)
    {
        $user = ClassSubjectModel::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect()->back()->with('success','Class Successfully deleted');
    }

    public function edit_single($id)
    {
        $getRecord = ClassSubjectModel::getSingle($id);

        if(!empty($getRecord))
        {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = "Edit Assign Subject";
            $data['header_title'] = "Edit Class";
            return view('admin.assign_subject.edit_single', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update_single(Request $request,$id)
    {
        $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $request->subject_id);
        if(!empty($getAlreadyFirst))
        {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
            return redirect('admin/assign_subject/list')->with('success', "Status Successfully Updated");
        }
        else {
            $save = ClassSubjectModel::getSingle($id);
            $save->class_id = $request->class_id;
            $save->subject_id = $request->subject_id;
            $save->status = $request->status;
            $save->save();
            return redirect('admin/assign_subject/list')->with('success', "Subject Successfully Assign to Class");
        }

    }
}
