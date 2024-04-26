<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeworkModel extends Model
{
    use HasFactory;

    protected $table = 'homework';


    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getRecord()
    {
        $return = self::select('homework.*','class.name as class_name','subject.name as subject_name','users.name as created_by_name')
                  ->join('users','users.id', '=', 'homework.created_by')
                  ->join('class','class.id', '=','homework.class_id')
                  ->join('subject','subject.id', '=', 'homework.subject_id')
                  ->where('homework.is_delete','=', 0);
                  if(!empty(Request::get('class_name')))
                  {
                    $return = $return->where('class.name','like', '%'.Request::get('class_name').'%');
                  }
                  if(!empty(Request::get('subject_name')))
                  {
                    $return = $return->where('subject.name','like', '%'.Request::get('subject_name').'%');
                  }
                  if(!empty(Request::get('homework_date_from')))
                  {
                    $return = $return->where('homework.homework_date','>=',Request::get('homework_date_from'));
                  }
                  if(!empty(Request::get('homework_date_to')))
                  {
                    $return = $return->where('homework.homework_date','<=',Request::get('homework_date_to'));
                  }
                  if(!empty(Request::get('submission_date_from')))
                  {
                    $return = $return->where('homework.submission_date','>=',Request::get('submission_date_from'));
                  }
                  if(!empty(Request::get('submission_date_to')))
                  {
                    $return = $return->where('homework.submission_date','<=',Request::get('submission_date_to'));
                  }
                  if(!empty(Request::get('created_date_from')))
                  {
                    $return = $return->whereDate('homework.created_at','>=',Request::get('created_date_from'));
                  }
                  if(!empty(Request::get('created_date_to')))
                  {
                    $return = $return->whereDate('homework.created_at','<=',Request::get('created_date_to'));
                  }
        $return = $return->orderBy('homework.id','asc')
                  ->paginate(20);
                  return $return;
    }
    static public function getRecordTeacher($class_ids)
    {
        $return = self::select('homework.*','class.name as class_name','subject.name as subject_name','users.name as created_by_name')
                  ->join('users','users.id', '=', 'homework.created_by')
                  ->join('class','class.id', '=','homework.class_id')
                  ->join('subject','subject.id', '=', 'homework.subject_id')
                  ->whereIn('homework.class_id', $class_ids)
                  ->where('homework.is_delete','=', 0);
                  if(!empty(Request::get('class_name')))
                  {
                    $return = $return->where('class.name','like', '%'.Request::get('class_name').'%');
                  }
                  if(!empty(Request::get('subject_name')))
                  {
                    $return = $return->where('subject.name','like', '%'.Request::get('subject_name').'%');
                  }
                  if(!empty(Request::get('homework_date_from')))
                  {
                    $return = $return->where('homework.homework_date','>=',Request::get('homework_date_from'));
                  }
                  if(!empty(Request::get('homework_date_to')))
                  {
                    $return = $return->where('homework.homework_date','<=',Request::get('homework_date_to'));
                  }
                  if(!empty(Request::get('submission_date_from')))
                  {
                    $return = $return->where('homework.submission_date','>=',Request::get('submission_date_from'));
                  }
                  if(!empty(Request::get('submission_date_to')))
                  {
                    $return = $return->where('homework.submission_date','<=',Request::get('submission_date_to'));
                  }
                  if(!empty(Request::get('created_date_from')))
                  {
                    $return = $return->whereDate('homework.created_at','>=',Request::get('created_date_from'));
                  }
                  if(!empty(Request::get('created_date_to')))
                  {
                    $return = $return->whereDate('homework.created_at','<=',Request::get('created_date_to'));
                  }
        $return = $return->orderBy('homework.id','asc')
                  ->paginate(20);
                  return $return;
    }
    static public function getRecordStudent($class_id, $student_id)
    {
        $return = self::select('homework.*','class.name as class_name','subject.name as subject_name','users.name as created_by_name')
                  ->join('users','users.id', '=', 'homework.created_by')
                  ->join('class','class.id', '=','homework.class_id')
                  ->join('subject','subject.id', '=', 'homework.subject_id')
                  ->where('homework.class_id', '=', $class_id)
                  ->where('homework.is_delete','=', 0)
                  ->whereNotIn('homework.id',function($query) use ($student_id){
                    $query->select('homework_submit.homework_id')
                    ->from('homework_submit')
                    ->where('homework_submit.student_id', '=', $student_id);
                  });
                  if(!empty(Request::get('class_name')))
                  {
                    $return = $return->where('class.name','like', '%'.Request::get('class_name').'%');
                  }
                  if(!empty(Request::get('subject_name')))
                  {
                    $return = $return->where('subject.name','like', '%'.Request::get('subject_name').'%');
                  }
                  if(!empty(Request::get('homework_date_from')))
                  {
                    $return = $return->where('homework.homework_date','>=',Request::get('homework_date_from'));
                  }
                  if(!empty(Request::get('homework_date_to')))
                  {
                    $return = $return->where('homework.homework_date','<=',Request::get('homework_date_to'));
                  }
                  if(!empty(Request::get('submission_date_from')))
                  {
                    $return = $return->where('homework.submission_date','>=',Request::get('submission_date_from'));
                  }
                  if(!empty(Request::get('submission_date_to')))
                  {
                    $return = $return->where('homework.submission_date','<=',Request::get('submission_date_to'));
                  }
                  if(!empty(Request::get('created_date_from')))
                  {
                    $return = $return->whereDate('homework.created_at','>=',Request::get('created_date_from'));
                  }
                  if(!empty(Request::get('created_date_to')))
                  {
                    $return = $return->whereDate('homework.created_at','<=',Request::get('created_date_to'));
                  }
        $return = $return->orderBy('homework.id','asc')
                  ->paginate(20);
                  return $return;
    }
    static public function getRecordStudentCount($class_id, $student_id)
    {
        return self::select('homework.id')
                  ->join('users','users.id', '=', 'homework.created_by')
                  ->join('class','class.id', '=','homework.class_id')
                  ->join('subject','subject.id', '=', 'homework.subject_id')
                  ->where('homework.class_id', '=', $class_id)
                  ->where('homework.is_delete','=', 0)
                  ->whereNotIn('homework.id',function($query) use ($student_id){
                    $query->select('homework_submit.homework_id')
                    ->from('homework_submit')
                    ->where('homework_submit.student_id', '=', $student_id);
                  })
                  ->orderBy('homework.id','asc')
                  ->count();

    }

    public function getDocument()
    {
        if(!empty($this->document_file) && file_exists('upload/homework/'. $this->document_file))
        {
            return url('upload/homework/'. $this->document_file);
        }
        else
        {
            return "";
        }
    }
}
