<?php
namespace Res\Http\Controllers\User;
use Illuminate\Support\Facades\Session;
use Res\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Res\Http\Requests;
use DB;
use Hash;
class UserController extends Controller{

    public function insertOrder(Request $request){
        $input = $request->except('_token');
        dd($input);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request){
        $info = $request->all();
        $cId = $this->randomNumber(4);
        $currentDate = date('Y-m-d');
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $name = $firstName.' '.$lastName;
        $phoneNumber = $request->input('phone');
        if (!isset($name)){
            $name="";
        }
        $sbsCode = DB::table('z_users')->whereCctt($cId)->first();
        if (isset($sbsCode)){
            $cId = $this->randomNumber(4);
        }
        $userId= DB::table('z_users')->insertGetId(['name'=>$name,'phone'=>$phoneNumber,'cctt'=>$cId,'submit_date'=>$currentDate,'last_visit'=>$currentDate]);
        foreach($info as $key=>$value){
            $field = DB::table('z_user_fields')->whereEnName($key)->first();
            if (isset($field)){
                DB::table('z_user_fields_map')->insert(['user_id'=>$userId,'user_fields_id'=>$field->id,'value'=>$value]);
            }
        }
        Session::put('userid',$userId);
        /*$user = DB::table('z_users')->wherePhone($info['phone'])->first();
        if (isset($user)){
          $data['login']="شماره تلفن وارد شده در سیستم موجود است.";
          return view('user.loginpage',$data);
        }else{
          $name = $info['name'];
          $phone = $info['phone'];
          $cId = $this->randomNumber(4);
          $currentDate = date('Y-m-d');
          $sbsCode = DB::table('z_users')->whereCctt($cId)->first();
          if (isset($sbsCode)){
            $cId = $this->randomNumber(4);
          }
          $id = DB::table('z_users')->insertGetId(['name'=>$name,'phone'=>$phone,'cctt'=>$cId,'submit_date'=>$currentDate,'last_visit'=>$currentDate]);
          Session::put('userid',$id);*/
        return redirect('/food/preorderform');
        //}
    }


    private function randomNumber($length) {
        $result = '';
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    public function emailValidator(Request $request){
        $req = $request->input('email');
        $emails = DB::table('z_users')->whereEmail($req)->first();
        if (isset($emails)){
            return response()->json('0');
        }else{
            if (preg_match('/^[A-z0-9_\-\.]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/',$req)){
                return response()->json('1');
            }else{
                return response()->json('0');
            }
        }
    }

    public function login(){
        $data['socials'] = DB::table('z_social_sites')->get();
        $data['fields'] =DB::table('z_user_fields')->whereEnabled(1)->get();
        $fieldNames=array();
        foreach($data['fields'] as $field){
            $fieldNames[] = DB::table('z_field_types')->whereId($field->field_type_id)->first();
        }
        $data['fieldNames'] = $fieldNames;
        return view('user.loginpage',$data);
    }

    public function forget(Request $request){
        $name = $request->input('name');
        if (isset($name)){
            return $this->sendValidation($name);
        }else{
            return view('user.forget');
        }
    }

    private function sendValidation($name){
        $user = DB::table('z_users')->wherePhone($name)->first();
        if (!isset($user)){
            return redirect('/user/login');
        }else{

        }
    }

    public function logout(){
        Session::flush();
        return redirect('/user/login');
    }

    public function loginCheck(Request $request){
        $user = $request->all();
        $sbs = $user['cid'];
        $validator = DB::table('z_users')->wherePhone($user['name'])->first();
        $hash= $validator->cctt;
        if ($sbs == $hash){
            $userid = $validator->id;
            Session::put('userid',$userid);
            $currentDate = getCurrentDate();
            DB::table('z_users')->whereId($userid)->update(['last_visit'=>$currentDate]);
            return redirect('/food/preorderform');
        }else{
            $data['login'] = 'شماره تلفن یا کد اشتراک وارد شده صحیح نمی باشد';
            return view('user.loginpage',$data);
        }
    }

    public function profile($id){
        $user = DB::table('z_users')->whereId($id)->first();
        $data['address'] = $user->address;
        $data['name']=$user->name;
        $data['id'] = $user->id;
        $discount_id = $user->discount_id;
        $discounts = DB::table('z_discounts')->where('z_discounts.id',$discount_id)->orWhere('z_discounts.for_all',1)->whereEnabled(1)->get();
        $data['discounts']=$discounts;
        return view('user.profile',$data);
    }

    public function insertProfile(Request $request){
        $id = $request->input('id');
        $address = $request->input('address');
        $birthday = $request->input('birthday');
        $marriage = $request->input('marriage');
        $birthday = explode('/',$birthday);
        $marriage=explode('/',$marriage);
        $gBirthday = jalali_to_gregorian($birthday[0],$birthday[1],$birthday[2],'-');
        $gMarriage = jalali_to_gregorian($marriage[0],$marriage[1],$marriage[2],'-');
        DB::table('z_users')->whereId($id)->update(['address'=>$address,'birthday'=>$gBirthday,'marriage'=>$gMarriage]);
        return redirect('/page/home');
    }

    public function transactions($id){
        $user_id = Session::get('userid');
        if ($id != $user_id){
            $id=$user_id;
        }
        $data['transactions'] = DB::table('z_orders')->whereUserId($id)->get();
        $data['total'] = DB::table('z_orders')->whereUserId($id)->sum('total_fee');
        return view('user.transactions',$data);
    }

    public function vote(Request $request){
        $questionId = $request->input('q_id');
        $userId = $request->input('user_id');
        $answerId = $request->input('answer');
        $is_voted = DB::table('z_votes')->whereQId($questionId)->whereUserId($userId)->first();
        if (isset($is_voted)){
            return;
        }
        $currentDate = getCurrentDate();
        $currentTime = getCurrentTime();
        DB::table('z_votes')->insert(['q_id'=>$questionId,'user_id'=>$userId,'answer_id'=>$answerId,'date'=>$currentDate,'time'=>$currentTime]);
    }
}