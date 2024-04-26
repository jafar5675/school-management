<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Models\ClassSubjectModel;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SubjectModel::getRecord();
        $data['header_title'] = "Subject List";
        return view('admin.subject.list',$data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Class";
        return view('admin.subject.add',$data);
    }

    public function insert(Request $request)
    {
        $save  = new SubjectModel;
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('admin/subject/list')->with('success', 'Subject Successfully created');
    }

    public function edit($id)
    {
        $data['getRecord'] = SubjectModel::getSingle($id);
        if(!empty($data['getRecord'])){
        $data['header_title'] = "Edit Class";
        return view('admin.subject.edit', $data);
    }
    else{
        abort(404);
    }
    }

    public function update(Request $request,$id)
    {
        // request()->validate([
        //     'email' => 'required|email|unique:users,email,'.$id
        // ]);
       $user = SubjectModel::getSingle($id);
       $user->name = trim($request->name);
       $user->type = trim($request->type);
       $user->status = trim($request->status);

       $user->save();
       return redirect('admin/subject/list')->with('success','Subject Successfully updated');
    }

    public function delete($id)
    {
        $user = SubjectModel::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect()->back()->with('success','Subject Successfully deleted');
    }
      // student side
    public function MySubject()
    {
        $data['getRecord'] = ClassSubjectModel::MySubject(Auth::user()->class_id);
        $data['header_title'] = "My Subject";
        return view('student.my_subject',$data);
    }
    // Parent side
    public function ParentStudentSubject($student_id)
    {
        $user = User::getSingle($student_id);
        $data['getUser'] = $user;
        $data['getRecord'] = ClassSubjectModel::MySubject($user->class_id);
        $data['header_title'] = "My Subject";
        return view('parent.my_student_subject',$data);
    }

}