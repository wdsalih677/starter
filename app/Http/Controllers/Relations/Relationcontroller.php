<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Servic;
use App\Phone;
use App\Scopes\doctorScope;
use App\User;
use Illuminate\Http\Request;

class Relationcontroller extends Controller
{
    public function hasOneRelation(){
        $user = User::with(['phone' => function($q){
            $q -> select('code','phone','user_id');
        }])->find(5);
        return $user -> phone ->phone;
        // return $user ->phone;
        return response()->json($user);
    }
    public function hasOneRelationReverse(){
        //  $phone = Phone::with('user')->find(1);
        $phone = Phone::with(['user'=> function($qqq){
            $qqq->select(['id','name']);
        }])->find(1);
          $phone ->makeVisible(['user_id']);
          //$phone ->makeHidden(['phone']);
         //makeVisible => طريقه لاظهار الحقول المخفيه في المودل
         //makeHidden => طريقة لاخفاء الحقول الظاهره في المودل
         return $phone;
    }
    public function hasOneRelationWhereHas(){
        return User::whereHas('phone')->get();
        // return User::whereHas('phone',function($q){
        //     $q -> where('code',24);
        // })->get();
           
    }
    public function hasOneRelationWhereNotHas(){
        return User::whereDoesntHave('phone')->get();
    }
        ##### one To many #####

    public function getHospitalDoctor(){
          $hospital = Hospital::with('doctor')->find(1);
         $doctors = $hospital -> doctor;
         foreach($doctors as $doctor){
            echo $doctor ->name."<br>";
         }
         $doctor = Doctor::find(3);
         return $doctor -> hospital;
    }
    public function hospital(){
        $hospitals = Hospital::select('id','name','address')->get();
        return view('Doctors.hospital',compact('hospitals'));
    }
    public function doctor($hospital_id){
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital -> doctor;
        return view('Doctors.doctor',compact('doctors'));
    }
    public function delete($id){
        $doctor = Doctor::find($id);
        if(!$doctor){
            return redirect()->back();
        }
        $doctor ->delete();
        return redirect()->back()->with(['sucess' => "Doctor Deleted Successfully"]);
    }
    public function hospitalHasDoctor(){
        return  $hospital = Hospital::WhereHas('doctor')->get();
        
    }
    public function hospitalNotHasDoctor(){
        return  $hospital = Hospital::whereDoesntHave('doctor')->get();
        
    }
    public function hospitalMale(){
        return  $hospital = Hospital::with('doctor')->WhereHas('doctor',function($qqq){
            $qqq->where('gender',2);
        })->get();

    }
    public function deleteHospital($hospita_id){
        $hospital = Hospital::find($hospita_id);
        if(!$hospital){
            return abort(404);
        }
        $hospital ->doctor() ->delete();
        $hospital -> delete();
        redirect()->back()->with(['success'=>"Hospital Deleted Successfully"]);
    }
        ##### one To many #####
        ################ Many 2 Many ##################
        public function doctorServiec(){
            $doctors = Doctor::with('service',function($q){
                $q->select('name');
            })->find(3);
            //    $services-> name;
            //  foreach($services as $service){
            //      echo  $service -> name;
            //  } 
            
        }
        public function serviecDoctor(){
            return $services = Servic::with(['doctor'=> function($q){
                $q->select('doctors.id','name','title');
            }])->find(2);
        }
        public function getDoctorServices($doctor_id){
            $doctor = Doctor::find($doctor_id);
            $services = $doctor -> service;
            $doctors = Doctor::select('id','name')->get();
            $allServices = Servic::select('id','name')->get();
            return view('Doctors.services',compact('services','doctors','allServices'));
        }
        public function saveServicesToDoctor(Request $request){
            $doctor = Doctor::find($request -> doctor_id);
            if(!$doctor){
                return abort('404');
            }
            // $doctor -> service() -> attach($request -> services_id); //تحفظ في قاعدة البيانات حتى لو كان العنر موجود بتحفظو تاني
            // $doctor -> service() -> sync($request -> services_id); //"updateتعمل عمل المثود"
            // و تحذف بقيت العناصر الموجوده في قاعدة البيانات
            $doctor -> service() -> syncWithoutDetaching($request -> services_id);
            // syncWithoutDetaching
            /*
               تقوم بإضافة عنصر جديد لقاعة البيانات دون تكرار العنصر او حذف بقية العناصر واضافة العنصر الجديد

             */
            return 'success';
        }
        ################ Many 2 Many ##################
        ################ Has 1 through ##################
        public function getHasOneThrough(){
            $patients = Patient::find(2);
            return $patients -> doctor;
        }
        public function getInactive(){
            // return Doctor::Inactive()->get();
            // return Doctor::get();withoutGlobalScope
            return Doctor::withoutGlobalScope(doctorScope::class)->get();
        }
        ################ Has 1 through ##################

}
