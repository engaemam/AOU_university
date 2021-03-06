<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Request as Arequest;
use App\Course;
use App\Contact;
use App\Sign;
use App\Instructor;
use App\Branch;
use App\SubAdmin;
use App\Admin;
use App\Application;
use App\Student;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{

    public function invoices(){
        $pg=100;
        
        return view('admin.invoices',compact(['pg']));
    
    }
    
    public function admin_requests(){
        $reqs=Arequest::where('admin_status','=','0')->get();
        $pg=3;
        return view('admin.requests',compact(['pg','reqs']));
    }
    public function admin_branches(){
        $branches=Branch::all();
        $pg=25;
        return view('admin.branches',compact(['pg','branches']));
    }

    public function admin_instructors(){
        $insts=Instructor::all();
        $pg=28;
        return view('admin.instructors',compact(['pg','insts']));
    }

    public function add_brn(){
        $pg=25;
        return view('admin.add_branch',compact(['pg']));
    }

    public function edit_brn($id){
        $pg=25;
        $brn=Branch::find($id);
        return view('admin.edit_branch',compact(['pg','brn']));
    }


    public function add_inst(){
        $pg=28;
        return view('admin.add_instructor',compact(['pg']));
    }

    public function edit_inst($id){
        $pg=28;
        $inst=Instructor::find($id);
        return view('admin.edit_instructor',compact(['pg','inst']));
    }

    public function edit_sub($id){
        $pg=26;
        $sub=SubAdmin::find($id);
        return view('admin.edit_sub',compact(['pg','sub']));
    }

    public function add_sub(){
        $pg=26;
        return view('admin.add_sub_admin',compact(['pg']));
    }

    public function applicants($id){
        $pg=26;
        $apps=Application::where('course_id','=',$id)->get();
        return view('admin.applicants',compact(['pg','apps']));
    }

    public function student_profile($id){
        $pg=34;
        $profile=Student::find($id);
        return view('sub_admin.student_profile',compact(['profile','pg']));
    }

    



    public function save_sub(Request $request){
        $sub=new SubAdmin();
        $sub->name=$request->name;
        $sub->Address=$request->address;
        $sub->password=Hash::make($request->password);
        $sub->sub_admin_id=SubAdmin::max('sub_admin_id')+1;
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'sub_admins';
        $file->move($path, $filename);
        $sub->img=$filename;
        $sub->save();
        return back()->with('success',' Sub Admin added successfully');
   
    }



    public function save_brn(Request $request){
        $brn=new Branch();
        $brn->name=$request->name;
        $brn->location=$request->location;
        $brn->sub_admin_id=$request->sub_admin_id;
        $brn->save();
        return back()->with('success',' Branch added successfully');
   
    }

    public function ed_sub(Request $request){
        $sub= SubAdmin::find($request->sid);
        $sub->name=$request->name;
        $sub->Address=$request->address;
        $sub->password=Hash::make($request->password);
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'sub_admins';
        $file->move($path, $filename);
        $sub->img=$filename;
        $sub->update();
        return back()->with('success',' Sub Admin updated successfully');
   
    }

    public function ed_inst(Request $request){
        $inst= Instructor::find($request->sid);
        $inst->name=$request->name;
        $inst->Address=$request->address;
        $inst->summary=$request->summary;
        $inst->password=Hash::make($request->password);
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'img';
        $file->move($path, $filename);
        $inst->img=$filename;
        $inst->update();
        return back()->with('success',' Instructor updated successfully');
   
    }

    public function save_inst(Request $request){
        $inst=new Instructor();
        $inst->name=$request->name;
        $inst->Address=$request->address;
        $inst->summary=$request->summary;
        $inst->password=Hash::make($request->password);
        $inst->instructor_id=Instructor::max('instructor_id')+1;
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'img';
        $file->move($path, $filename);
        $inst->img=$filename;
        $inst->save();
        return back()->with('success',' Instructor added successfully');
   
    }

    public function ed_brn(Request $request){
        $brn= Branch::find($request->bid);
        $brn->name=$request->name;
        $brn->location=$request->location;
        $brn->sub_admin_id=$request->sub_admin_id;
        $brn->update();
        return back()->with('success',' Branch updated successfully');
   
    
    }

    public function update_profile(Request $request){
        $admin= Admin::find($request->aid);
        $admin->name=$request->name;
        $admin->Address=$request->address;
        $admin->summary=$request->summary;
        $admin->password=Hash::make($request->password);
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'img';
        $file->move($path, $filename);
        $admin->img=$filename;
        $admin->update();
        return back()->with('success',' Profile updated successfully');
   
    }

    public function del_sub($id){
        $sub=SubAdmin::find($id)->delete();
        return back()->with(['success'=>'successfully deleted...']);
    }

    public function del_inst($id){
        $sub=Instructor::find($id)->delete();
        return back()->with(['success'=>'successfully deleted...']);
    }




    public function del_brn($id){
        $brn=Branch::find($id)->delete();
        return back()->with(['success'=>'successfully deleted...']);
    }

    public function admin_profile($id){
        $pg=24;
        $profile=Admin::find($id);
        return view('admin.profile',compact(['profile','pg']));
    }

    public function sub_profile($id){
        $pg=26;
        $sub=SubAdmin::find($id);
        return view('admin.sub_profile',compact(['sub','pg']));
    }

    public function edit_profile(){
        $pg=24;
        return view('admin.edit_profile',compact(['pg']));
    }

    public function admin_sub_admins(){
        $subs=SubAdmin::all();
        $pg=26;
        return view('admin.sub_admins',compact(['pg','subs']));
    }






    public function signs(){
        $reqs=Sign::where('status','=','0')->get();
        $pg=14;
        return view('admin.signs',compact(['pg','reqs']));
    }

     public function login(){
        $pg=0;
    	return view('admin.login',compact(['pg']));
    }

    public function messages(){
      $contacts=Contact::all();
      $pg=13;
    return view('admin.messages',compact(['contacts','pg']));
      
    }

    public function accept($id){
        $req=Arequest::find($id);
        //dd($req);
        $req->admin_status=1;
        $c=Course::find($req->course_id);
        $c->status=1;
        $req->save();
        $c->save();
        return back();

        
    }


    public function accept_sign($id){
        $sign=Sign::find($id);
        $instructor=new Instructor();
        $instructor->name=$sign->name;
        $instructor->summary=$sign->summary;
        $instructor->instructor_id=$sign->instructor_id;
        $instructor->Address=$sign->Address;
        $instructor->img=$sign->img;
        $instructor->password=Hash::make($sign->password);
        $sign->status=1;
        //dd($sign);
        $sign->save();
        $instructor->save();
        return back();

        
    }

    public function refuse_sign($id){

        $sign=Sign::find($id);
        $sign->status=2;
        $sign->save();
        return back();
    }

    public function check_login(Request $request)
    {   
        $remmberme = $request->remmberme==1?true:false;
        if(auth()->guard('admin')->attempt(['admin_id'=>$request->admin_id,'password'=>$request->password],$remmberme)){
            return redirect('/');
        }else{
            session()->flash('error','please enter valid ID and password');
            return back()->with(['message'=>'please enter valid ID and password']);
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('/admin/login');

    } 
}
