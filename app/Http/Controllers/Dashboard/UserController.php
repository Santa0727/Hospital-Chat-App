<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\ClinicInfo;
use App\Models\Categories;
use App\Models\FavouriteDoctor;
use App\Models\Friends;

use Carbon\Carbon;
use Config;

class UserController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Contracts\Support\Renderable
  */
  public function profile() {
      abort_if((auth()->user()->user_type == '1'), 404, 'you are not a doctor or patient');
      $this->bladeContent['active']       = 'profile';
      $this->bladeContent['user']         = User::where('id',auth()->user()->id)->first();
      $this->bladeContent['gender']       = Config::get('enums.Gender');
      $this->bladeContent['googleMapKey'] = Config::get('enums.GoogleMapKey');
      if(auth()->user()->user_type == '2'){
          return view('pages.dashboard.user.profile', $this->bladeContent);
      }
      return view('pages.dashboard.user.profile', $this->bladeContent);
  }

  public function updateProfile(Request $request) {
      abort_if((auth()->user()->user_type == '1'), 404, 'you are not a doctor or patient');
      $userId = auth()->user()->id;
      $rules =[
          'username'      => ['required', 'string', 'max:200'],
          'firstName'     => ['required', 'string', 'max:200'],
          'lastName'      => ['required', 'string', 'max:200'],
          'email'         => ['required', 'string', 'email', 'max:200', 'unique:users,email,'.$userId]
      ];
      $this->validate($request, $rules);
      $updateData = [
          'name'       => $request->username,
          'first_name' => $request->firstName,
          'last_name'  => $request->lastName,
          'email'      => $request->email,
          'phone'      => $request->phoneNumber,
          'gender'     => $request->gender,
      ];
      if($request->dateOfBirth){
          $updateData['dob']   = Carbon::createFromFormat('d/m/Y', $request->dateOfBirth)->format('Y-m-d');
      }
      if($request->clinicAddress){
          $updateData['address']   = $request->clinicAddress;
          $updateData['latitude']  = $request->latitude;
          $updateData['longitude'] = $request->longitude;
      }
      if($request->clinicCity){
         $updateData['city'] = $request->clinicCity;
      }
      $file = $request->file('userImage');
      if($file){
          $path    = 'storage/images/';
          $date    = date('Y-m-d');
          $newDate = explode('-',$date);
          if (!file_exists($path.$newDate[0].'/'.$newDate[1])) {
              mkdir($path.$newDate[0].'/'.$newDate[1], 0777, true);
          }
          $newDir = $path.$newDate[0].'/'.$newDate[1];
          $filename = time() . "_" . str_replace(" ","_",$file->getClientOriginalName());
          $file->move($newDir, $filename);
          $updateData['profile_img'] = url($newDir.'/'.$filename);
      }
      //profile_img
      User::where('id',$userId)->update($updateData);
      //clinic info update
      $clinicInfo = ClinicInfo::where('userId',$userId)->first();
      $clinicInfoData = [
          'userId'      => $userId,
          'biography'   => $request->biography,
          'name'        => $request->clinicName,
          'address'     => $request->address,
          'address1'    => $request->address1,
          'city'        => $request->city,
          'state'       => $request->state,
          'country'     => $request->country,
          'postal_code' => $request->postalCode
      ];

      if($clinicInfo){
          ClinicInfo::where('id',$clinicInfo->id)->update($clinicInfoData);
      }
      else{
          ClinicInfo::create($clinicInfoData);
      }
      session()->flash('success' ,'Profile successfully updated.');
      return redirect('profile');
  }

  public function setProfile() {
      return view('pages.dashboard.user.settings');
  }


  public function doctorProfile($id) {
      $doctor = User::where('id',$id)->first();
      $this->bladeContent['active'] = 'profile';
      $this->bladeContent['doctor'] = $doctor;
      return view('pages.dashboard.doctor.profile', $this->bladeContent);
  }

  public function getDoctors() {
    $this->bladeContent['doctors'] = User::where('user_type', 2)->get();
    $this->bladeContent['categories'] = Categories::where('parent', 0)->get();
    $this->bladeContent['active'] = 'doctors';
    return view('pages.dashboard.doctor.list', $this->bladeContent);
  }

  public function getPatients() {
    if (auth()->user()->user_type == 3) {
        $this->bladeContent['patients'] = User::where('user_type', 3)->get();
        $this->bladeContent['active'] = 'patients';
        return view('pages.dashboard.patient.list', $this->bladeContent);
    }
  }

  public function likeUser(Request $request) {
    $status = FavouriteDoctor::where('user_id', auth()->user()->id)->where('doctor_id', $request->id);
    if ($status->count()) {
        $editData = FavouriteDoctor::where('user_id', auth()->user()->id)->where('doctor_id', $request->id)->first();
        $editData->status = !$editData->status;
        $editData->save();
        return response()->json(['status' => $editData->status]);
    } else {
        $newData = new FavouriteDoctor();
        $newData->doctor_id = $request->id;
        $newData->user_id = auth()->user()->id;
        $newData->save();
        return response()->json(['status' => 1]);
    }
  }

  public function searchUser(Request $request) {
      if($request->type == 'doctor') {
        $this->bladeContent['doctors'] = User::where('user_type', 2)->where('name', 'like', '%' . $request->data . '%')->get();

        $view = view('components.view.searchDoctorView', $this->bladeContent)->render();
      } else {
        $this->bladeContent['doctors'] = User::where('user_type', 3)->where('name', 'like', '%' . $request->data . '%')->get();
        
        $view = view('components.view.searchPatientView', $this->bladeContent)->render();
      }

    return response()->json(compact('view'));
  }
}
