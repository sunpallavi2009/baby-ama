<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\UserInfo;
use App\Models\Appoinment;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\PrescriptionMedicine;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function  dashboard(){

        $data =[];
          // $users = User::role(['manager','admin','super-admin','staff'])->get();
        $data['doctors']=\App\Models\User::role(['doctor'])->count();
        $data['patients']=\App\Models\User::role(['patient'])->count();
        $data['staffs']=\App\Models\User::role(['pharmacy','admin'])->count();

        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d',strtotime("+1 day"));
        $day_after_tomorrow = date('Y-m-d',strtotime("+2 days"));

        $data['today_appointments']=\App\Models\Appoinment::where('appoinment_date',$today)->count();
        $data['tomorrow_appointments']=\App\Models\Appoinment::where('appoinment_date',$tomorrow)->count();
        $data['day_after_tomorrow_appointments']=\App\Models\Appoinment::where('appoinment_date',$day_after_tomorrow)->count();


        return view('pages.index',compact('data'));
    }

    public function usersCrud($type){

        return view('pages.admin.user.index',compact('type'));
    }

    /*User Save Logic*/

    public function saveUser($user,$user_info, $request){

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if(count($user->roles) == 0){
            // $user->assignUserRole($user,$request->role);
            $user->assignRole($request->role);
        }

        $user_info->user_id = $user->id;
        $user_info->phone = $request->phone;
        // $user_info->specialist_type = ($this->user_role == 'doctor') ? json_encode($request->specialist_type) : null;
        $user_info->save();

        if($user){
            return true;
        }else{
            return false;
        }
    }

    /*Admin user */
    public function addAdmin(User $admin){
        // $name = Route::currentRouteName();
        $role = "admin";
        $data = isset($admin->id) ? $admin : new User;

        return view('pages.admin.user.admin.form',compact('data','role'));
    }


   public function storeAdmin(Request $request)
    {
        $user = User::firstOrNew(['id' => $request->id]);
        $user_info = UserInfo::firstOrNew(['user_id' => $request->id]);

        $validatedData = $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'phone' => 'required|numeric|digits:10|unique:user_infos,phone,' . $user_info->id,
        ]);

         if (!$user->exists || !$user_info->avatar) {
            $validationRules['avatar'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        // Check if an avatar file has been uploaded
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = $avatar->storeAs('avatars', $avatarName, 'public');

            // Log the file information for debugging
            Log::info('Avatar Uploaded: ' . json_encode([
                'original_name' => $avatar->getClientOriginalName(),
                'size' => $avatar->getSize(),
                'path' => $avatarPath,
            ]));

            // Save avatar path in user_info relative to public disk
            $user_info->avatar = 'avatars/' . $avatarName;
        } else {
            Log::info('No Avatar Uploaded');
        }

        $this->saveUser($user, $user_info, $request);

        $getUserCRUDRedirect = getUserCRUDRedirect();
        return redirect()->route($getUserCRUDRedirect)->with('success', 'Admin Updated Successfully');
    }


    public function listAdmin(Request $request){

        $query = User::query();
        $limit = 25;
        $data = $query->paginate($limit);

        return view('pages.admin.user.admin.list',compact('data'));
    }

    public function deleteAdmin(User $admin){

        $getUserCRUDRedirect = getUserCRUDRedirect();

        if($admin){
            $admin->delete();
             return redirect()->route($getUserCRUDRedirect)->with('success','User Deleted Successfully');
        }else{
             return redirect()->route($getUserCRUDRedirect)->with('success','Oops Unable to Delete user');
        }
    }

    /*Pharmacy*/
     public function addPharmacy(User $admin){
        // $name = Route::currentRouteName();

       $data = isset($admin->id) ? $admin : new User;

        return view('pages.admin.user.pharmacy.form',compact('data'));
    }

    // app/Http/Controllers/PatientController.php

  public function destroyPatients(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('admin.patients.list')->with('success', 'Patient deleted successfully');
    }

    public function restorePatients($id)
    {
        $patient = Patient::withTrashed()->findOrFail($id);
        $patient->restore();
        return redirect()->route('admin.patients.list')->with('success', 'Patient restored successfully');
    }


    /*Patients Related Routes*/
    public function listPatients(){

        $query = Patient::query();
    //    $query = $query->orderBy('id', 'DESC');
    //    $query->orderBy('id', 'desc');
        $limit = 25;
        $data = $query->paginate($limit);

        return view('pages.admin.patient.list',compact('data'));

    }

    public function createPatients(Patient $patient){

        $data = isset($patient->id) ? $patient : new Patient;

        return view('pages.admin.patient.form',compact('data'));
    }

    public function updatePatients(Request $request){

    }

    public function storePatients(Request $request, Patient $id){

        $validateArray = [
            'first_name' => 'required',
            // 'last_name' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            // 'mother_name' => 'required',
            // 'father_phone' => 'required|numeric|min:10|unique:patients,father_phone',
            // 'father_phone' => 'required|numeric|min:10|',
            // 'mother_phone' => 'numeric|min:10',
            'address' => 'required',
            // 'weight' => 'required|numeric',
            // 'height' => 'required|numeric',
            'd_o_b' => 'required',
            // 'op_no' => 'required|unique:patients,op_no',
            'father_occupation' => 'required',
            'contact_number' => 'required|numeric',
        ];

        if(!$request->id){
            // $validateArray['op_no']='required|unique:patients,op_no';
            // $validateArray['umr_no']='required|unique:patients,umr_no';
            $validateArray['op_no'] = 'required|unique:patients,op_no|same:umr_no';
            $validateArray['umr_no'] = 'required|unique:patients,umr_no|same:op_no';
        }else{
             $data = Patient::find($request->id);
            if(isset($data->op_no) && $request->op_no!=$data->op_no){
                $check = Patient::where('op_no',$request->op_no)->first();

                if($check){
                    return redirect()->back()->with('error','The give OP number '.$request->op_no.' Already assigned to another patient, kindly try another one');
                }
            }
            if(isset($data->umr_no) && $request->umr_no!=$data->umr_no){
                $check = Patient::where('umr_no',$request->umr_no)->first();

                if($check){
                    return redirect()->back()->with('error','The give UMR number '.$request->umr_no.' Already assigned to another patient, kindly try another one');
                }
            }

        }

        // dd($validateArray);

        $validated = $request->validate($validateArray,
        [
            'd_o_b.required' => 'Date of birth is required',
            'first_name.required' => "Baby's First Name is Required",
            // 'last_name.required' => "Baby's Last Name is Required",
            'father_name.required' => "Father Name is Required",
            // 'mother_name.required' => "Mother Name is Required",
            'address' => "Address is Required",
            'op_no.required' => "OP Number is Required",
            'op_no.unique' => "The given OP Number Already assigned to another patient, kindly try another one",
            'umr_no.required' => "UMR Number is Required",
            'umr_no.unique' => "The given UMR Number Already assigned to another patient, kindly try another one",
            'op_no.same' => 'UMR NUMBER and OP NUMBER must be the same',
            'umr_no.same' => 'UMR NUMBER and OP NUMBER must be the same',

        ]);

        $inputs = $request->except(['_token','id','contact_number','alternate_number']);

        $data = isset($request->id) ? Patient::find($request->id) : new Patient;

        foreach ($inputs as $key => $input) {
             $data->$key = $input;
        }

        // dd($data);
        if($request->contact_number){
            $data->father_phone=$request->contact_number;
        }

        if($request->alternate_number){
            $data->mother_phone=$request->alternate_number;
        }

        if(!isset($data->umr_no)){
            $data->umr_no=getUMRONo();
        }

        $data->save();

        if(!isset($data->user)){
            // if($data->email){

            //     $user = User::firstOrNew(['email' =>  $data->email]);
            //     $user->first_name   = $data->first_name;
            //     $user->last_name    = $data->last_name;
            //     $user->save();

            //     // $data->user_id=$user->id;
            //     // $data->save();


            // }else{

                if(!$data->user_id){

                    $user = new User();
                    $user->first_name   = $data->first_name;
                    $user->last_name    = $data->last_name;
                    $user->save();

                    $data->user_id=$user->id;
                    $data->save();

                }

            // }

        }else{
            $user = User::find($data->user_id);
            $user->first_name   = $data->first_name;
            $user->last_name    = $data->last_name;
            $user->save();
        }

        // Check user have role or not
        if(isset($user->id)){

        $getUserRole = $user->roles->pluck("name")->toArray();
            if(!in_array('patient',$getUserRole)){
                  $user->assignRole('patient');
            }
        }

        return redirect()->route('admin.patients.list')->with('success', 'The Patient Details Updated Successfully');

    }


    public function getAllAppoinments(Request $request){


        $query = Appoinment::query();

        $query->when((isset($request->q)), function ($query) use ($request) {
            $query = $query->where('first_name', 'LIKE', '%'.$request->q.'%')->Orwhere('last_name', 'LIKE', '%'.$request->q.'%');
            // $query = $query->where('first_name', 'LIKE', '%'.$request->title.'%')
        });

        $query->when((isset($request->phone)), function ($query) use ($request) {

            $userIds = Patient::where('father_phone',$request->phone)->orWhere('mother_phone',$request->phone)->pluck('user_id')->toArray();
            $query = $query->whereIN('user_id',$userIds);
        });


        $query->when((isset($request->date)), function ($query) use ($request) {
            $query = $query->where('appoinment_date', 'LIKE',$request->date);
        });

        if(!$request->date){
            $today = date('Y-m-d');
            $query = $query->where('appoinment_date','>=',$today);
        }
        $datas = $query->orderBy('created_at', 'DESC')->paginate(15);

        // dd($datas);
        // foreach ($datas as $key => $data) {
        //     // dd($data->user->id);
        // }




        return view('pages.admin.patient.appoinments',compact('datas'));
    }

    public function getAppoinment(Appoinment $appointment){

        $doctors = User::with("roles","info")->whereHas("roles", function($q) {
                    $q->whereIn("name", ["doctor"]);
                })->orderBy('first_name','ASC')->get();


        // foreach($doctors as $key => $value){


        // }

        $patient = Patient::where('user_id',$appointment->user_id)->first();

        return view('pages.admin.patient.appoinments-single',compact('appointment','doctors','patient'));

    }

    public function editAppoinment(Appoinment $appointment){


        return view('pages.admin.patient.edit-appoinments-single',compact('appointment'));

    }

    public function alterAppoinment(Request $request, Appoinment $appointment){


        $request->validate([
            'appoinment_date' => 'required',
            'appoinment_session' => 'required'
        ]);

        $appointment->appoinment_date    = $request->appoinment_date;
        $appointment->appoinment_session = $request->appoinment_session;
        $appointment->description        = $request->description;

        $appointment->appoinment_time        = $request->appoinment_time;

        if($request->status) {

        $appointment->status        = $request->status;
        }

        $appointment->save();

        return redirect()->route('admin.patients.get.appointment',$appointment->id)->with('success','Appoinment Details updated successfully');
    }

    public function addPatientAppoinments(Patient $patient){


          $doctors = User::with("roles","info")->whereHas("roles", function($q) {
                    $q->whereIn("name", ["doctor"]);
                })->get();

        $appointment = new Appoinment();

        return view('pages.admin.patient.create-appoinments-single',compact('appointment','patient','doctors'));

    }

    public function addStorePatientAppoinments(Request $request, Patient $patient){


        $request->validate([
            'appoinment_date' => 'required',
            'appoinment_session' => 'required'
        ]);

        $appointment = new Appoinment();

        $appointment->user_id            = $patient->user_id;
        $appointment->first_name         = $patient->first_name;
        $appointment->last_name          = $patient->last_name;
        $appointment->specialists        = $request->specialists;
        $appointment->appoinment_date    = $request->appoinment_date;
        $appointment->appoinment_time    = $request->appoinment_time;
        $appointment->appoinment_session = $request->appoinment_session;
        $appointment->description        = $request->description;
        $appointment->status             = 'awaiting';
        $appointment->doctor_id          = ($request->assign_doctor) ? $request->assign_doctor : 0;
        $appointment->save();



        return redirect()->route('admin.patients.get.appointment',$appointment->id)->with('success','Appoinment Created successfully');


    }

    public function declineAppoinment(Appoinment $appointment, $status){
         $getStatus = ($status=='decline') ? -1 : 0;

         $appointment->status    = $getStatus;
         $appointment->save();

         $msg =($status=='decline') ? 'Declined' : 'Enabled';

          return redirect()->route('admin.patients.get.appointment',$appointment->id)->with('success','Appoinment '.$msg.' successfully');
    }

    public function assignDoctor(Request $request){

        $appoinment = Appoinment::find($request->id);

        if($appoinment){
            $appoinment->doctor_id=$request->assign_doctor;

            $appoinment->save();

            $doctor = User::find($request->assign_doctor);
            $doctor_name= $doctor->first_name.' '.$doctor->last_name;
            return redirect()->back()->with('success', 'The Dr. '.$doctor_name.' Assigned for this Appoinment Successfully');
        }else{
            return redirect()->back()->with('error', 'Unable to Doctor Assigned for this Appoinment.');
        }


    }

    public function getPrescriptionDetails($appointment_id = null,$prescription_id = null){
        $appointment = Appoinment::where('id','=',$appointment_id)->first();
        $prescription = Prescription::with(['prescriptionMedicine'])->where('id','=',$prescription_id)->first();
        return view('pages.admin.patient.appoinments-prescription-single',compact('appointment','prescription'));
    }
    public function updatePrescriptionOrderAndPaymentStatus(Request $request){
        $prescription = Prescription::find($request->prescription_id);
        $prescription->order_status = $request->order_status;
        $prescription->payment_status = $request->payment_status;
        $prescription->delivered_at = ($prescription->order_status === 'delivered') ? now() : null;
        $prescription->save();
        return redirect()->back()->with('success', 'Order & Payment Status Updated');
    }

    public function printPrescriptionDetail(Appoinment $appoinment){

        $data = Prescription::where('appointment_id',$appoinment->id)->first();

        return view('pages.admin.patient.printPDF',compact('data'));
        // dd($getPrecription);


    }

    public function appointmentBilling($appointmentId) {
        // Find the appointment
        $appointment = Appoinment::find($appointmentId);

        // Check if the appointment exists
        if (!$appointment) {
            // Redirect the user or show an error message
            return redirect()->back()->with('error', 'Appointment not found.');
        }

        // Find the doctor
        $doctor = User::find($appointment->doctor_id);

        // Check if the doctor exists
        if (!$doctor) {
            // Redirect the user or show an error message
            return redirect()->back()->with('error', 'Doctor not found.');
        }

        // Find the user info
        $userInfo = UserInfo::where('user_id', $doctor->id)->first();

        // Check if the user info exists
        if (!$userInfo) {
            // Redirect the user or show an error message
            return redirect()->back()->with('error', 'User info not found.');
        }

        // Get the specialist types
        $specialistTypes = UserInfo::pluck('specialist_type', 'id')->unique();

        // Get the list of doctors
        $doctorlist = User::with('roles')->whereHas('roles', function($q) {
            $q->where('name', 'doctor');
        })->get()->pluck('full_name', 'id');

        // Check if the doctor list is empty
        if ($doctorlist->isEmpty()) {
            // Redirect the user or show an error message
            return redirect()->back()->with('error', 'No doctors found.');
        }

        // Get the latest prescription data
        $latestPrescription = Prescription::orderBy('id', 'DESC')->first();

        // Initialize an empty array for prescriptions
        $prescriptions = [];

        // Check if a prescription exists
        if ($latestPrescription) {
            // Get prescriptions for the specified type and prescription ID
            $prescriptions = PrescriptionMedicine::where('type', 'pediatric')
                ->where('prescription_id', $latestPrescription->id)
                ->get();
        }

        // Retrieve the latest prescription ID
        $latestPrescriptionId = optional(Prescription::orderBy('id', 'DESC')->first())->id;

        // Initialize variables for prescription and pharmacy bill medicines
        $pres = collect();
        $pharmacyBillMedicines = [];

        // Check if a prescription ID exists
        if ($latestPrescriptionId) {
            // Try to get general type prescriptions
            $pres = PrescriptionMedicine::where('type', 'general')
                ->where('prescription_id', $latestPrescriptionId)
                ->get();

            // If no general type prescriptions found, get pediatric type prescriptions
            if ($pres->isEmpty()) {
                $pres = PrescriptionMedicine::where('type', 'pediatric')
                    ->where('prescription_id', $latestPrescriptionId)
                    ->get();
            }

            // Retrieve medicine IDs from prescriptions
            $medicineIds = $pres->pluck('medicine_id')->toArray();

            // Get pharmacy bill medicines based on medicine IDs
            $pharmacyBillMedicines = Medicine::whereIn('id', $medicineIds)->get();
        }

        // Get invoice details
        $invoice_details = PrescriptionMedicine::where(['prescription_id' => $latestPrescriptionId])
        ->where('appointment_id', $appointmentId)
            ->get();

        // Decode JSON data
        $consultingCharges = json_decode($appointment->consulting_charges, true);
        $feeSummaries = json_decode($appointment->fee_summaries, true);

        // Return the view with the necessary data
        return view('pages.admin.patient.appointment-billing', compact('appointment', 'invoice_details', 'pharmacyBillMedicines', 'pres', 'prescriptions', 'doctor', 'userInfo', 'specialistTypes', 'doctorlist', 'consultingCharges', 'feeSummaries'));
    }

   public function appointmentBillingSave(Request $req)
{
    if ($req->appointment_id) {
        $appointment = Appoinment::find($req->appointment_id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }

        // Generate invoice number only if it's not already set
        if (!$appointment->invoice_number) {
            $lastInvoice = Appoinment::whereNotNull('invoice_number')->orderBy('invoice_number', 'desc')->first();
            $invoiceNumber = $lastInvoice ? ($lastInvoice->invoice_number + 1) : 1;
            $appointment->invoice_number = $invoiceNumber;
        }

        $appointment->doctor_fee = $req->doctor_fee;
        $appointment->consultant_fee = $req->consultant_fee;
        $appointment->notes = $req->notes;
        $appointment->assigned_doctor = $req->doctor_id;
        $appointment->assigned_specialists = $req->specialists;
        // $appointment->fees = $req->fees;

        $appointment->consulting_charges = json_encode($req->consulting_charges);
        $appointment->fee_summaries = json_encode($req->fee_summaries);

        $appointment->payment_method = $req->payment_method;
        $appointment->total_amount = $req->total_amount;
        $appointment->service_total_amount = $req->service_total_amount;

        $overallTotalAmount = $req->service_total_amount + $req->total_amount;
        $appointment->overall_total_amount = $overallTotalAmount;

        $appointment->save();
    }

    return redirect()->route('admin.patients.appointments.billing', ['appoinment' => $appointment->id])
                     ->with('success', 'Appointment Fees Data Updated Successfully');
}



    public function printBillingDetail($appointment){
        $appointment = Appoinment::find($appointment);
        $doctor = User::find($appointment->doctor_id);
        if (!$doctor) {
            return redirect()->back()->with('error', 'Doctor not found.');
        }
        $userInfo = UserInfo::where('user_id', $doctor->id)->first();
        if (!$userInfo) {
            return redirect()->back()->with('error', 'User info not found.');
        }
        $specialistTypes = UserInfo::pluck('specialist_type', 'id')->unique();
        $consultingCharges = json_decode($appointment->consulting_charges, true);
        $feeSummaries = json_decode($appointment->fee_summaries, true);

        return view('pages.admin.patient.printBillingPDF',compact('appointment','doctor','userInfo', 'consultingCharges', 'feeSummaries'));
    }
}
