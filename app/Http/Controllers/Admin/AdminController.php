<?php
namespace Res\Http\Controllers\Admin;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Input;
use Maatwebsite\Excel\Facades\Excel;
use Res\food;
use Res\Http\Controllers\Auth;
use Res\Http\Controllers\Controller;
use Res\Http\Requests;
use Response;

class AdminController extends Controller{

    public function __construct(){
        if (!$this->isAdmin()){
            return redirect('/admin/z.admin');
        }
    }

    public function login(Request $request){
        if ($request->has('username')){
            return $this->loginCheck($request);
        }else{
            return $this->loginForm();
        }
    }

    private function loginForm($data=null){
        if ($data==null){
            return view('admin.login');
        }else{
            return view('admin.login',$data);
        }
    }

    private function loginCheck(Request $request){
        $input = $request->all();
        $admin = DB::table('z_admins')->whereUsernameAndPassword($input['username'],$input['password'])->first();
        if ($admin == null){
            $data=array('login'=>'نام کاربری یا رمز عبور وارد شده اشتباه است');
            return $this->loginForm($data);
        }else{
            Session::put('admin_enter', $admin->username);
            Session::put('admin_name', $admin->name);
            Session::put('admin_id', $admin->id);
            $accessLevels=DB::table('z_access_group')->whereAdminId($admin->id)->first();
            $access = $accessLevels->access_list;
            $access = explode('|',$access);
            foreach($access as $mAccess){
                if ($mAccess != ""){
                    $data[$mAccess] = 1;
                }
            }
            Session::put('access_level',$data);
            return redirect('/admin/dashboard');
        }
    }

    public function editAdminAccount(Request $request){
        $pass = $request->input('newPass');
        $user_name = $request->input('user_name');
        if ($user_name!="" && $user_name!=null){
            DB::table('z_admins')->whereId(Session::get('admin_id'))->update(['username'=>$user_name]);
        }

        if ($pass!="" && $pass!=null){
            DB::table('z_admins')->whereId(Session::get('admin_id'))->update(['password'=>$pass]);
        }

    }

    public function dashboard(){
        $adminId = Session::get('admin_id');
        if (!isset($adminId)){
            return redirect ('/admin/z.admin');
        }else{
//            $discounts= DB::table('z_discounts')->where('exp_date','<',getCurrentDate())->get();
//            if (count($discounts) > 0){
//                foreach($discounts as $discount){
//                    DB::table('z_discounts')->whereId($discount->id)->update(['enabled'=>0]);
//                }
//            }
            $persianFirstWeek = date('w',strtotime(getCurrentDate()));
            if ($persianFirstWeek == 6){
                $days['شنبه'] = date('Y-m-d',strtotime('saturday this week'));
                $days['یکشنبه'] =date('Y-m-d',strtotime('sunday this week'));
                $days['دوشنبه'] = date('Y-m-d',strtotime('monday next week'));
                $days['سه شنبه'] = date('Y-m-d',strtotime('tuesday next week'));
                $days['چهارشنبه'] = date('Y-m-d',strtotime('wednesday next week'));
                $days['پنجشنبه'] = date('Y-m-d',strtotime('thursday next week'));
                $days['جمعه'] = date('Y-m-d',strtotime('friday next week'));
            }else if ($persianFirstWeek == 0){
                $days['شنبه'] = date('Y-m-d',strtotime('last saturday'));
                $days['یکشنبه'] =getCurrentDate();
                $days['دوشنبه'] = date('Y-m-d',strtotime('monday next week'));
                $days['سه شنبه'] = date('Y-m-d',strtotime('tuesday next week'));
                $days['چهارشنبه'] = date('Y-m-d',strtotime('wednesday next week'));
                $days['پنجشنبه'] = date('Y-m-d',strtotime('thursday next week'));
                $days['جمعه'] = date('Y-m-d',strtotime('friday next week'));
            }else{
                $days['شنبه'] = date('Y-m-d',strtotime('last saturday'));
                $days['یکشنبه'] = date('Y-m-d',strtotime('last sunday'));
                $days['دوشنبه'] = date('Y-m-d',strtotime('monday this week'));
                $days['سه شنبه'] = date('Y-m-d',strtotime('tuesday this week'));
                $days['چهارشنبه'] = date('Y-m-d',strtotime('wednesday this week'));
                $days['پنجشنبه'] = date('Y-m-d',strtotime('thursday this week'));
                $days['جمعه'] = date('Y-m-d',strtotime('friday this week'));
            }


            foreach($days as $day=>$index){
                $data['profits'][$day] = DB::table('z_orders')->where('date','=',$index)->sum('total_fee');
                $data['profits'][$day] += DB::table('z_transactions')
                                                    ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                                                    ->leftJoin('z_trans_type','z_trans_sub_type.parent_id','=','z_trans_type.id')
                                                    ->whereIn('z_trans_type.id',[2,4])
                                                    ->where('date','=',$index)->sum('cash');

                $data['costs'][$day] = DB::table('z_transactions')
                                                ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                                                ->leftJoin('z_trans_type','z_trans_sub_type.parent_id','=','z_trans_type.id')
                                                ->whereIn('z_trans_type.id',[1,3,5])
                                                ->where('date','=',$index)->sum('cash');
                $data['costs'][$day] += DB::table('z_staff_orders')->where('date','=',$index)->sum('cost');
            }

            $data['vacations'] = DB::table('z_vacation')->orderBy('from_date','DESC')->take(5)->get();
            $staffName=array();
            $conditions = array();
            $colors=array();
            foreach($data['vacations'] as $field){
                $staffName[] = DB::table('z_staff')->whereId($field->staff_id)->first();
                $conditions[] = DB::table('z_vacation_condition')->whereId($field->condition)->first();
                if ($field->condition == '1'){
                    $colors[] = '#ff0';
                }else if ($field->condition == '2'){
                    $colors[] = '#0f0';
                }else if($field->condition == '3'){
                    $colors[] = '#f00';
                }
            }
            $data['staff_name'] = $staffName;
            $data['condition'] = $conditions;


            $data['staffOrders'] = DB::table('z_staff_orders')->orderBy('date','desc')->get();
            $foodnames=array();
            $dates = array();
            foreach ($data['staffOrders'] as $order) {
                $foodnames[] = DB::table('z_foods')->whereId($order->food_id)->first();
                $gDate = explode('-',$order->date);
                $dates[]  = gregorian_to_jalali($gDate[0],$gDate[1],$gDate[2],'/');
            }
            $data['foodNames']=$foodnames;
            $data['dates']=$dates;


            $data['expired'] = DB::table('z_materials') ->where('exp_date','<',getCurrentDate())->get();
            foreach($data['expired'] as $exp){
                $notifications[] ='<span class="jsup-status">'. "منقضی شده: ".$exp->name.'</span>'.' <span class="jmode"> '. 'تاریخ انقضا: '.\g2j($exp->exp_date).'</span>';
                $class[] = "jerror";
            }

            $data['stEnd'] = DB::table('z_materials')->where('amount','<','10')->get();
            foreach($data['stEnd'] as $ste){
                if ($ste->amount != 0){
                    continue;
                }
                $unit = DB::table('z_material_unit')->whereId($ste->unit_id)->where('status',0)->first();
                $notifications[]='<span class="jsup-status">'."اتمام موجودی: ".$ste->name.'</span>'.' <span class="jmode"> '.$ste->amount.' '.$unit->title.' مانده '.'</span>';
                $units[]=DB::table('z_material_unit')->whereId($ste->unit_id)->where('status',0)->first();
                $class[] = "jerror";
            }

            $nextGoalDate = date('Y-m-d',strtotime('+7 day'));
            $data['exps'] = DB::table('z_materials') ->whereBetween('exp_date',array(getCurrentDate(),$nextGoalDate))->get();
            foreach($data['exps'] as $exp){
                if ($exp->exp_date == getCurrentDate()){
                    continue;
                }
                $notifications[] ='<span class="jsup-status">'. "در حال انقضا : ".$exp->name.'</span>'.' <span class="jmode"> '. 'تاریخ انقضا: '.g2j($exp->exp_date).'</span>';
                $class[] = "jwarning";
            }

//            $data['storageEnd'] = DB::table('z_materials')->where('amount','<','10')->get();
//            foreach($data['storageEnd'] as $ste){
//                if ($ste->amount == 0){
//                    continue;
//                }
//                $unit = DB::table('z_material_unit')->whereId($ste->unit_id)->first();
//                $notifications[]='<span class="jsup-status">'."در حال اتمام : ".$ste->name.'</span>'.' <span class="jmode"> '.$ste->amount.' '.$unit->title.' مانده '.'</span>';
//                $units[]=DB::table('z_material_unit')->whereId($ste->unit_id)->where('status',0)->first();
//                $class[] = "jwarning";
//            }
//            $data['stUnits'] = $units;
//
//
            $data['clubUsers'] = DB::table('z_users')->orderBy('id','desc')->take(5)->get();
//            $data['lastCoopens'] = DB::table('z_discounts')->take(5)->get();
//            foreach($data['lastCoopens'] as $field){
//                $gDate = $field->exp_date;
//                $gDate = explode('-',$gDate);
//                $jDates[] = gregorian_to_jalali($gDate[0],$gDate[1],$gDate[2],'/');
//            }
            $tomorrow = date('Y-m-d',strtotime('+1 day'));
            $loans = DB::table('z_staff_loan')->whereBetween('payback_date',array(getCurrentDate(),$tomorrow))
                                    ->join('z_staff','z_staff.id','=','z_staff_loan.staff_id')
                                    ->select('z_staff.name','z_staff_loan.amount','z_staff_loan.payback_date')
                                    ->wherePayed(0)
                                    ->get();
            $loanMessages=array();
            foreach($loans as $loan){
                $loanMessages[] = "<span>سررسید بازپرداخت وام ".$loan->name."</span>"."<span>مبلغ:".$loan->amount."</span>"."<span> تاریخ: ".g2j($loan->payback_date)."</span>";
            }
            $salaryReminder = DB::table('z_staff')->get();
            $salaries = array();
            $year = getCurrentJalaliDate();
            $year = explode('/',$year);
            foreach($salaryReminder as $slr){
                $currentDate = getCurrentJalaliDate();
                $currentDate = explode('/',$currentDate);
                if ($slr->payday-2 == $currentDate[2] || $slr->payday-1 == $currentDate[2] || $slr->payday == $currentDate[2]){
                    $salaries[] = "<span>موعد پرداخت حقوق : ".$slr->name."</span>"."<span> تاریخ: ".$year[0].'/'.$year[1].'/'.$slr->payday."</span>";
                }
            }
            $data['loans'] = $loanMessages;
            //$data['dates'] = $jDates;
            //$data['notifications'] = $notifications;
            //$data['class']= $class;
            $data['salaries'] = $salaries;
            return view('admin.index',$data);
        }

    }

    public function ordersNewLoadSbs(Request $request){
        if (!$this->isAdmin()){
            return redirect('/admin/z.admin');
        }
        $req = $request->input('content');
        $user = DB::table('z_users')->whereCctt($req)->first();
        return response()->json($user);
    }

    public function ajaxCore(Request $request){
        if (!$this->isAdmin()){
            return response()->json(['content'=>'expired']);
        }
        $elementId =$request->input('elementId');
        if ($elementId == "insert-new-food") {
            $data['food'] = DB::table('z_foods')->get();
            $data['foodcat'] = DB::table('z_food_cats')->get();
            echo json_encode(array('content' => view('admin.setting.add-food',$data)->render()));
        }else if ($elementId == "food-category"){
            $data['subsets'] = DB::table('z_res_subset')->where('status',0)->get();
            $data['foodcat'] = DB::table('z_food_cats')->get();
            echo json_encode(array('content' => view('admin.setting.food-category',$data)->render()));
        }else if($elementId=="orders"){
            $data['fields'] = $this->loadOrders();
            return response()->json(['content'=>view('admin.orders.orders-main',$data)->render()]);
        }else if($elementId=="neworders"){
            $now =date('Y-m-d');
            $data['status'] =DB::table('z_order_status')->orderBy('isdefault','DESC')->get();
            $getstatus = DB::table('z_order_status')->where('isdefault',1)->first();
            $now = date('Y-m-d');
            $data['fields'] = DB::table('z_orders')->where('date',$now)->where('status',$getstatus->id)->get();
            return response()->json(['content'=>view('admin.orders.new-orders-main',$data)->render()]);
        }else if ($elementId == 'order'){
            $menus[] = DB::table('z_menu')->get();
            foreach($menus as $menu){
                foreach($menu as $bar){
                    $foods[] = DB::table('z_food_menu')->where('menu_name',$bar->menu_name)->get();
                }
            }
            $data=array('menu'=>$menu,'foods'=>$foods);
            echo json_encode(array('content'=>view('admin.order',$data)->render()));
        }else if($elementId == "reportOrder"){
            $reports['thisWeekSales'] = $this->countWeekSales();
            $reports['thisMonthSales'] = $this->countMonthSales();
            $reports['totalOrders']=$this->getTotalOrdersCount();
            $reports['restaurants'] = DB::table('z_res_subset')->get();
            $reports['orderTypes'] = DB::table('z_order_types')->get();
            $reports['paymentTypes'] = DB::table('z_payments')->get();
            return response()->json(['content'=>view('admin.reporting.orders-filters',$reports)->render()]);
        }else if ($elementId == "personelList"){
            $data['staff'] = DB::table('z_staff')->get();
            return response()->json(['content'=>view('admin.hr.personel_list',$data)->render()]);
        }else if($elementId == "new-leave"){
            $data = $this->getStaffVacations();
            return response()->json(['content'=>view('admin.hr.new-leave',$data)->render()]);
        }else if($elementId == "reporting-club-users"){
            $data['coupons'] = DB::table('z_coupons')->get();
            return response()->json(['content'=>view('admin.reporting.users-club-filters',$data)->render()]);
        }else if ($elementId == "mat-cat"){
            $data['fields'] = DB::table('z_material_cat')->where('status',0)->get();
            return response()->json(['content'=>view('admin.warehousing.material_cat',$data)->render()]);
        }else if($elementId == "add-mat"){
            $data['fields'] = DB::table('z_material_cat')->where('status',0)->get();
            $data['units'] = DB::table('z_material_unit')->where('status',0)->get();
            $data['materials'] = DB::table('z_materials')->get();
            $data['storages'] = DB::table('z_storages')->where('status',0)->get();
            $data['accounts'] = DB::table('z_bank_account')->where('status',0)->get();
            $groups=array();
            $units=array();
            foreach($data['materials'] as $mat){
                $groups[] = DB::table('z_material_cat')->whereId($mat->cat_id)->first();
                $units[] = DB::table('z_material_unit')->whereId($mat->unit_id)->first();
            }
            $data['groups']= $groups;
            $data['eachUnit'] = $units;
            return response()->json(['content'=>view('admin.warehousing.add-material',$data)->render()]);
        }else if($elementId == "add-account") {
            $data['accounts'] = DB::table('z_bank_account')->where('status',0)->get();
            return response()->json(['content'=>view('admin.accounting.account-list',$data)->render()]);
        }else if($elementId == "back-accounting") {
            $data['accounts'] = DB::table('z_bank_account')->where('status',1)->get();
            return response()->json(['content'=>view('admin.accounting.back-account-list',$data)->render()]);
        }else if ($elementId == "add-cost-type"){
            $data['fields'] = DB::table('z_trans_sub_type')->whereParentId(1)->where('status',0)->get();
            return response()->json(['content'=>view('admin.accounting.add-cost-type',$data)->render()]);
        }else if ($elementId == "back-cost-type"){
            $data['fields'] = DB::table('z_trans_sub_type')->whereParentId(1)->where('status',1)->get();
            return response()->json(['content'=>view('admin.accounting.back-cost-type',$data)->render()]);
        }else if ($elementId == "add-money-type"){
            $data['fields'] = DB::table('z_trans_sub_type')->whereParentId(2)->where('status',0)->get();
            return response()->json(['content'=>view('admin.accounting.add-money-type',$data)->render()]);
        }else if ($elementId == "back-money-type"){
            $data['fields'] = DB::table('z_trans_sub_type')->whereParentId(2)->where('status',1)->get();
            return response()->json(['content'=>view('admin.accounting.back-money-type',$data)->render()]);
        }else if($elementId == "accounting-add-cost"){
            $data['fields'] = DB::table('z_transactions')
                                    ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                                    ->leftJoin('z_bank_account','z_transactions.account_id','=','z_bank_account.id')
                                    ->select('z_transactions.id','z_transactions.cash','z_transactions.desc','z_transactions.date',
                                             'z_transactions.time','z_trans_sub_type.title',
                                             'z_bank_account.name as account_name')
                                    ->where('z_trans_sub_type.parent_id',1)
                                    ->get();
            return response()->json(['content'=>view('admin.accounting.add-cost',$data)->render()]);
        }else if ($elementId == "accounting-add-income"){
            $data['fields'] = DB::table('z_transactions')
                                    ->leftJoin('z_bank_account','z_transactions.account_id','=','z_bank_account.id')
                                    ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                                    ->select('z_transactions.id','z_transactions.cash','z_transactions.date','z_transactions.time'
                                             ,'z_transactions.desc','z_trans_sub_type.title',
                                              'z_bank_account.name as account_name')
                                    ->where('z_trans_sub_type.parent_id',2)
                                    ->orderBy('z_transactions.date','desc')
                                    ->get();
            return response()->json(['content'=>view('admin.accounting.add-income',$data)->render()]) ;
        }else if($elementId == "account-transaction"){
            $data['fields'] = DB::table('z_account_transaction')->orderBy('date','desc')->get();
            $sourceAccounts = array();
            $destAccounts = array();
            $jDate = array();
            foreach($data['fields'] as $field){
                $sourceAccounts[] = DB::table('z_bank_account')->whereId($field->source_account)->first();
                $destAccounts[] = DB::table('z_bank_account')->whereId($field->dest_account)->first();
                $gDate = $field->date;
                $gDate = explode('-',$gDate);
                $jDate[] = gregorian_to_jalali($gDate[0],$gDate[1],$gDate[2],'/');
            }
            $data['sourceAccounts'] = $sourceAccounts;
            $data['destAccounts'] = $destAccounts;
            $data['dates'] = $jDate;
            return response()->json(['content'=>view('admin.accounting.account-transaction',$data)->render()]);
        }else if ($elementId == "warehouse-inventory"){
            $data['fields']=DB::table('z_materials')->leftJoin('z_material_unit','z_materials.unit_id','=','z_material_unit.id')
                                                    ->leftJoin('z_storages','z_materials.storage_id','=','z_storages.id')
                                                    ->select('z_materials.id','z_materials.name','z_materials.amount',
                                                             'z_material_unit.title','z_storages.title as storageName')->where('z_materials.amount','!=',0)
                                                    ->get();
            $data['storages'] =DB::table('z_storages')->where('status',0)->get();
            return response()->json(['content'=>view('admin.warehousing.warehouse-inventory',$data)->render()]);
        }else if ($elementId == "add-unit"){
            $data['fields'] = DB::table('z_material_unit')->where('status',0)->get();
            return response()->json(['content'=>view('admin.warehousing.add-unit',$data)->render()]);
        }else if ($elementId == "new-loan"){
            $data['fields'] = DB::table('z_staff')->get();
            return response()->json(['content'=>view('admin.hr.loan',$data)->render()]);
        }else if ($elementId == "personel-food"){
            $data['foods'] = DB::table('z_foods')->get();
            $data['materials'] = DB::table('z_materials')->get();
            $data['accounts'] = DB::table('z_bank_account')->get();
            $data['staff_orders'] = DB::table('z_staff_orders')->get();
            return response()->json(['content'=>view('admin.hr.submit-personel-food',$data)->render()]);
        }else if ($elementId == 'report-personel-food'){
            $data['orderTypes'] = DB::table('z_staff_order_type')->get();
            return response()->json(['content'=>view('admin.reporting.personel-food-filters',$data)->render()]);
        }else if ($elementId == "votes-report"){
            $data['questions'] = DB::table('z_vote_question')->get();
            $questions = array();
            foreach($data['questions'] as $vote){
                $questions[] = DB::table('z_votes')->whereId($vote->id)->first();
            }
            $data['votes'] = $questions;
            return response()->json(['content'=>view('admin.reporting.votes',$data)->render()]);
        }else if($elementId == 'access-group'){
            $data['users'] = DB::table('z_admins')->get();
            return response()->json(['content'=>view('admin.setting.access-group',$data)->render()]);
        }else if ($elementId == 'coupon'){
            $data['coupon'] = DB::table('z_coupons')->where('amount','!=',0)->get();
            return response()->json(['content'=>view('admin.userclub.add-coupon',$data)->render()]);
        }else if ($elementId == 'after-buy-coopens'){
          $data['coupons'] = DB::table('z_coupons_after_buy')->orderBy('expire','desc')->get();
            return response()->json(['content'=>view('admin.userclub.after_buy_coupons',$data)->render()]);
        }else if ($elementId == 'area-image'){
            return response()->json(['content'=>view('admin.area-image')->render()]);
        }else if ($elementId == "social-medias"){
            $data['fields'] = DB::table('z_social_sites')->get();
            return response()->json(['content'=>view('admin.userclub.social-media',$data)->render()]);
        }else if ($elementId == 'register-fields'){
            $data['fields']=DB::table('z_field_types')->get();
            $data['user_fields'] = DB::table('z_user_fields')->get();
            foreach($data['user_fields'] as $user_field){
                $fieldTypes[]=DB::table('z_field_types')->whereId($user_field->field_type_id)->first();
            }
            $data['field_types'] = $fieldTypes;
            return response()->json(['content'=>view('admin.userclub.register-fields',$data)->render()]);
        }else if ($elementId == "new-user"){
            return response()->json(['content'=>view('admin.setting.new-admin-user')->render()]);
        }else if ($elementId =="website-info"){
            $data['fields'] = DB::table('z_site_info')->first();
            return response()->json(['content'=>view('admin.setting.website_info',$data)->render()]);
        }else if ($elementId == "order-settings"){
            return response()->json(['content'=>view('admin.setting.order_settings')->render()]);
        }else if ($elementId == "service-settings"){
            $data['fields']=DB::table('z_service_settings')->first();
            return response()->json(['content'=>view('admin.setting.service_settings',$data)->render()]);
        }else if ($elementId == "google-map"){
            $data['info']=DB::table('z_google_map')->first();
            return response()->json(['content'=>view('admin.setting.google_map',$data)->render()]);
        }else if ($elementId == "storage-report"){
            return response()->json(['content'=>view('admin.reporting.warehouse-filters')->render()]);
        }else if ($elementId == "pay-salary"){
            $data['staffs']=DB::table('z_staff')->get();
            return response()->json(['content'=>view('admin.accounting.salary',$data)->render()]);
        }else if ($elementId == "user-field-report"){
            $data['fields'] = DB::table('z_user_fields')->get();
            $data['items'] = DB::table('z_user_fields_map')->get();
            $data['users'] = DB::table('z_users')->get();
            foreach ($data['users'] as $user) {
                $userInFields[]=DB::table('z_user_fields_map')->whereUserId($user->id)->get();
            }
            $data['userInFields'] = $userInFields;
            return response()->json(['content'=>view('admin.reporting.user_fields_report',$data)->render()]);
        }else if ($elementId == 'phonebook'){
            $data['contacts'] = DB::table('z_phonebook')->get();
            return response()->json(['content'=>view('admin.phone_book',$data)->render()]);
        }else if ($elementId == "subsets"){
            $data['fields'] = DB::table('z_res_subset')->where('status',0)->get();
            return response()->json(['content'=>view('admin.setting.res-subset',$data)->render()]);
        }else if ($elementId == "storages"){
            $data['fields'] = DB::table('z_storages')->where('status',0)->get();
            return response()->json(['content'=>view('admin.warehousing.warehouse-warehouses',$data)->render()]);
        }else if ($elementId == "reportingFoods"){
            $data['restaurants'] = DB::table('z_res_subset')->get();
            $data['foods']= DB::table('z_foods')->get();
            $data['menus'] = DB::table('z_food_cats')->get();
            $data['paymentTypes'] = DB::table('z_payments')->get();
            $data['orderTypes'] = DB::table('z_order_types')->get();
            return response()->json(['content'=>view('admin.reporting.foods-filters',$data)->render()]);
        }else if ($elementId == "reporting-order-delivery"){
            $data['restaurants'] = DB::table('z_res_subset')->get();
            $data['foods']= DB::table('z_foods')->get();
            $data['menus'] = DB::table('z_food_cats')->get();
            return response()->json(['content'=>view('admin.reporting.delivery-filters',$data)->render()]);
        }else if ($elementId == "reporting-order-pay"){
            $data['restaurants'] = DB::table('z_res_subset')->get();
            $data['foods']= DB::table('z_foods')->get();
            $data['menus'] = DB::table('z_food_cats')->get();
            return response()->json(['content'=>view('admin.reporting.paymentType-filters',$data)->render()]);
        }else if ($elementId == "reporting-transactions"){
            $data['types'] = DB::table('z_trans_type')->get();
            $data['subTypes'] = DB::table('z_trans_sub_type')->get();
            $data['accounts'] = DB::table('z_bank_account')->get();
            return response()->json(['content'=>view('admin.reporting.transactions-filters',$data)->render()]);
        }else if ($elementId == "reporting-costs"){
            $data['subTypes'] = DB::table('z_trans_sub_type')->whereParentId(1)->get();
            $data['accounts'] = DB::table('z_bank_account')->get();
            return response()->json(['content'=>view('admin.reporting.costs-filters',$data)->render()]);
        }else if ($elementId == "reporting-salary"){
            $data['accounts'] = DB::table('z_bank_account')->get();
            $data['staffs'] = DB::table('z_staff')->get();
            return response()->json(['content'=>view('admin.reporting.salary-filters',$data)->render()]);
        }else if ($elementId == "reporting-side-income"){
            $data['subTypes'] = DB::table('z_trans_sub_type')->whereParentId(2)->get();
            $data['accounts'] = DB::table('z_bank_account')->get();
            return response()->json(['content'=>view('admin.reporting.income-filters',$data)->render()]);
        }else if ($elementId == "loan-report"){
            return response()->json(['content'=>view('admin.reporting.loan-filters')->render()]);
        }else if ($elementId == "admin-account-settings"){
            return response()->json(['content'=>view('admin.admin.account-settings')->render()]);
        }else if ($elementId == "vacation-report"){
            return response()->json(['content'=>view('admin.reporting.vacation-filters')->render()]);
        }else if($elementId == "customers"){
          $data['customers']=DB::table('z_users')->where('status',0)->orderBy('submit_date','desc')->get();
          $data['query'] = 'SELECT * FROM z_users';
          return response()->json(['content'=>view('admin.userclub.customers_list',$data)->render()]);
        }else if($elementId == "c-coupon"){
            $data['fields']=DB::table('z_coupons_on_after_buy')->get();
            return response()->json(['content'=>view('admin.userclub.c-coupon',$data)->render()]);
        }
    }


    public function addCCoupon(Request $request){
        $isEdit = $request->input('edit');
        if(isset($isEdit) && $isEdit!=""){
            DB::table('z_coupons_on_after_buy')->whereId($isEdit)->update(['expire'=>j2g($request->dates),'type'=>$request->dis_type,'max_per_user'=>$request->max_per_user,
                'amount'=>$request->discount,'type_type'=>$request->type,'from_fee'=>$request->from_fee,'to_fee'=>$request->to_fee]);
        }else{
            DB::table('z_coupons_on_after_buy')->insert(['expire'=>j2g($request->dates),'type'=>$request->dis_type,'max_per_user'=>$request->max_per_user,
                'amount'=>$request->discount,'type_type'=>$request->type,'from_fee'=>$request->from_fee,'to_fee'=>$request->to_fee]);
        }
    }

    public function addfoodcategory(Request $request){
        $isEdit = $request->input('edit');
        if(isset($isEdit) && $isEdit!=""){
            DB::table('z_food_cats')->whereId($isEdit)->update(['title'=>$request->title,'parent_id'=>$request->parent_id,'desc'=>$request->desc,'sort'=>$request->sort]);
        }else{
            DB::table('z_food_cats')->insert(['title'=>$request->title,'parent_id'=>$request->parent_id,'desc'=>$request->desc,'sort'=>$request->sort]);
        }
    }

    public function addressubset(Request $request){
        $isEdit = $request->input('edit');
        if(isset($isEdit) && $isEdit!=""){
            DB::table('z_res_subset')->whereId($isEdit)->update(['title'=>$request->title,'desc'=>$request->desc]);
        }else{
            DB::table('z_res_subset')->insert(['title'=>$request->title,'desc'=>$request->desc]);
        }
    }

    public function insertCoupon(Request $request){
        $code = $request->coupon_code;
        $expire = $request->expire;
        $type = $request->type;
        $amount = $request->amount;
        $max = $request->max_per_user;
        if(empty($code)){
            $code=$this->randomNumber(8);
        }
        if(empty($max)){
            $max = 1;
        }
        $isEdit = $request->input('edit');
        if(isset($isEdit) && $isEdit!=""){
            DB::table('z_coupons')->whereId($isEdit)->update(['expire'=>j2g($expire),'type'=>$type,'max_per_user'=>$max,'amount'=>$amount]);
        }else{
            DB::table('z_coupons')->insert(['code'=>$code,'expire'=>j2g($expire),'type'=>$type,'max_per_user'=>$max,'amount'=>$amount]);
        }


    }

    public function filterCustomers(Request $request){
      $name = $request->input('user_name');
      $cctt = $request->input('cctt');
      $submit_date = $request->input('su_date');
      $lv_date = $request->input('lv_date');

      $query = DB::table('z_users')->where('name','like',$name);

      if(!empty($name)){
        $string = "SELECT * FROM z_users WHERE name LIKE '%".$name."%'";
        $nothing = false;
      }else{
        $nothing = true;
        $string = "SELECT * FROM z_users";
    }

      if (isset($cctt) && !empty($cctt)){
        $query->orWhere('cctt',$cctt);
        if(!$nothing){
            $string .=" OR WHERE cctt=$cctt";
        }else{
            $string .=" WHERE cctt=$cctt";
        }
      }

      if (isset($submit_date) && !empty($submit_date)){
        $query->orWhere('submit_date',j2g($submit_date));
        if(!$nothing){
            $string .=" OR WHERE submit_date=".j2g($submit_date);
        }else{
            $string .=" OR WHERE submit_date=".j2g($submit_date);
        }
      }

      if(isset($lv_date) && !empty($lv_date)){
        $query->orWhere('last_visit',j2g($lv_date));
        if(!$nothing){
            $string .=" OR WHERE last_visit=".j2g($lv_date);
        }else{
            $string .=" OR WHERE last_visit=".j2g($lv_date);
        }
      }
      $data['query'] = $string;
      $data['customers'] = $query->get();
      $view = view('admin.userclub.customers_list',$data)->renderSections();
      return response()->json(['content'=>$view['customers']]);
    }

    public function attachCoupon(Request $request){
        $id = $request->input('coupon');
        $query = $request->input('ids');



        if(!empty($query)){
            $query = explode('|',$query);
            foreach ($query as $value) {
                if(isset($value) && $value!=""){
                    DB::table('z_user_coupons')->insert(['code'=>$id,'user_id'=>$value,'user_group'=>'']);
                }
            }
        }else{
            DB::table('z_user_coupons')->insert(['code'=>$code,'user_id'=>'','user_group'=>'']);
        }


        //    $users = DB::select($query);
        //     foreach ($users as $user) {
        //         DB::table('z_user_coupons')->insert(['code'=>$id,'user_id'=>$user->id,'user_group'=>'']);
        //     }
        // }else{
        //     DB::table('z_user_coupons')->insert(['code'=>$code,'user_id'=>'','user_group'=>'']);
        // }

        return response()->json(['content'=>'با موفقیت انجام شد']);
    }

    public function deleteCoupon(Request $request){
      DB::table('z_coupons')->whereId($request->itemId)->delete();
    }

    public function deleteAfterBuyCoupon(Request $request){
      DB::table('z_coupons')->whereId($request->itemId)->delete();
    }

    public function showEvidence($id){
        $data['images']=DB::table('z_staff_evidence')->whereStaffId($id)->get();
        $data['id']=$id;
        return view('admin.hr.evidences',$data);
    }

    public function foodcategoryphoto($id){
        $data['images']=DB::table('z_food_cats')->whereId($id)->get();
        $data['id']=$id;
        return view('admin.setting.food-category-photo',$data);
    }

    public function deleteEve($id){
        DB::table('z_staff_evidence')->whereId($id)->delete();
        return redirect()->back();
    }

    public function addEvidence(Request $request,$id){
        $file = $request->file('eve');
        $path = $this->uploadFile($file,'staff');
        DB::table('z_staff_evidence')->insert(['staff_id'=>$id,'location'=>'/uploads/staff/'.$path]);
        return redirect()->back();
    }
    public function addfoodcategoryphoto(Request $request,$id){
        $file = $request->file('image');
        $filethumb = $request->file('thumb');
        $path = $this->uploadFile($file,'cat_img');
        $paththumb = $this->uploadFile($filethumb,'cat_thumb');
        DB::table('z_food_cats')->whereId($id)->update(['image'=>'/uploads/cat_img/'.$path,'thumb'=>'/uploads/cat_thumb/'.$paththumb]);
        return redirect()->back();
    }

    public function submitEditVote(Request $request){
        $questionId = $request->input('question');
        $answers = $request->input('answers');
        $newAns = $request->input('ans');
        $qKey = key($questionId);
        DB::table('z_vote_question')->whereId($qKey)->update(['title'=>$questionId[$qKey]]);
        foreach($answers as $answer){
            $key = key($answer);
            $ans = DB::table('z_vote_answer')->where('id',$key)->first();
            if (isset($ans) && count($ans) > 0 ){
                DB::table('z_vote_answer')->whereId($key)->update(['title'=>$answer[$key]]);
            }else{
                DB::table('z_vote_answer')->insert(['q_id'=>$qKey,'title'=>$answer[$key]]);
            }
        }

        if (isset($newAns) && $newAns!=""){
            foreach($newAns as $an){
                if ($an!="" && $ans!=null) {
                    DB::table('z_vote_answer')->insert(['q_id' => $qKey, 'title' => $an]);
                }
            }
        }

    }

    public function editVote(Request $request){
        $questionId = $request->input('qid');
        $data['question']=DB::table('z_vote_question')->whereId($questionId)->first();
        $data['vote_answers'] = DB::table('z_vote_answer')->whereQId($questionId)->get();
        return response()->json(['content'=>view('admin.userclub.edit-vote',$data)->render()]);
    }

    public function editregisterfields($id){
        $data['fields']=DB::table('z_field_types')->get();
        $data['user_fields'] = DB::table('z_user_fields')->whereId($id)->first();
//        foreach($data['user_fields'] as $user_field){
//            $fieldTypes[]=DB::table('z_field_types')->whereId($user_field->field_type_id)->first();
//        }
//        $data['field_types'] = $fieldTypes;
        return response()->json(['content'=>view('admin.userclub.edit-register-fields',$data)->render()]);
    }

    public function deleteCoopen($id){
        DB::table('z_discounts')->whereId($id)->delete();
        DB::table('z_users')->whereDiscountId($id)->update(['discount_id'=>null]);
    }

    public function editMoneyType($id){
        $data['income'] = DB::table('z_trans_sub_type')->whereId($id)->first();
        return response()->json(['content'=>view('admin.accounting.new-money-type-form',$data)->render()]);
    }

    public function editCostType($id){
        $data['cost']=DB::table('z_trans_sub_type')->whereId($id)->first();
        return response()->json(['content'=>view('admin.accounting.new-cost-type-form',$data)->render()]);
    }
    public function changestatusorder($id){
        $data['filed'] =DB::table('z_orders')->where('id',$id)->first();
        $data['status']= DB::table('z_order_status')->orderBy('isdefault','DESC')->get();
        return response()->json(['content'=>view('admin.orders.change-status-order',$data)->render()]);
    }
    public function sallarypayed($id){
        $data['accounts'] = DB::table('z_bank_account')->where('status',0)->get();
        $data['salarygrid'] = DB::table('z_salary')->where('id',$id)->first();
        return response()->json(['content'=>view('admin.accounting.new_salary_info',$data)->render()]);
    }

    public function editIncome($id){
        $data['incomes']=DB::table('z_transactions')->where('z_transactions.id',$id)->leftJoin('z_bank_account','z_transactions.account_id','=','z_bank_account.id')
                                                        ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                                                        ->select('z_transactions.id','z_transactions.trans_id','z_transactions.cash',
                                                            'z_transactions.date','z_transactions.time','z_transactions.desc',
                                                            'z_transactions.type as subType','z_transactions.account_id as acc_id')
                                                        ->first();
        $data['fields'] = DB::table('z_trans_sub_type')->whereParentId(2)->get();
        $data['accounts'] = DB::table('z_bank_account')->get();
        return response()->json(['content'=>view('admin.accounting.new-income-form',$data)->render()]);
    }

    public function editCost($id){
        $data['transactions']=DB::table('z_transactions')->where('z_transactions.id',$id)->leftJoin('z_bank_account','z_transactions.account_id','=','z_bank_account.id')
                                                ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                                                ->select('z_transactions.id','z_transactions.trans_id','z_transactions.cash',
                                                         'z_transactions.date','z_transactions.time','z_transactions.desc',
                                                         'z_transactions.type as subType','z_transactions.account_id as acc_id')
                                                ->first();
        $data['fields'] = DB::table('z_trans_sub_type')->whereParentId(1)->get();
        $data['accounts'] = DB::table('z_bank_account')->get();
        return response()->json(['content'=>view('admin.accounting.new-cost-form',$data)->render()]);
    }

    public function deleteStaff(Request $request){
        $id = $request->input('itemId');
        DB::table('z_staff')->whereId($id)->delete();
    }

    public function neweditpersonel($id){
        $data['staff'] = DB::table('z_staff')->whereId($id)->first();
        return response()->json(['content'=>view('admin.hr.new_personel',$data)->render()]);
    }

    public function deleteUnit(Request $request){
        $id = $request->input('itemId');
        DB::table('z_material_unit')->whereId($id)->update(['status'=>1]);
    }

    public function loadMat(Request $request){
        $id = $request->input('id');
        $data['materials'] = DB::table('z_materials')->whereStorageId($id)->get();
        $data['menus'] = food::getMenuList();
        $data['units'] = food::getAllUnits();
        $data['storages'] = DB::table('z_storages')->get();
        $view = view('admin.setting.add-food',$data)->renderSections();
        return response()->json(['content'=>$view['mats'] ]);
    }


    public function exchangeMaterials(Request $request){
        $toStroage = $request->secondWarehouse;
        $amount = $request->amount;
        $firstMat = $request->firstMaterials;

        $mat = DB::table('z_materials')->whereMatRef($firstMat)->first();
        if ($mat->amount < $amount){
            return response()->json(['content'=>'میزان وارد شده بیش از موجودی کالا در انبار می باشد.']);
        }else{
            $finalAmount = $mat->amount - $amount;
            DB::table('z_materials')->whereMatRef($firstMat)->update(['amount'=>$finalAmount]);
            $totalPrice = $mat->unit_price * $amount;
            $mat_ref= $this->randomNumber(6);
            DB::table('z_materials')->insert(['name'=>$mat->name,'amount'=>$amount,'cat_id'=>$mat->cat_id,'unit_id'=>$mat->unit_id,'exp_date'=>$mat->exp_date,'price'=>$totalPrice,'unit_price'=>$mat->unit_price,'storage_id'=>$toStroage,'mat_ref'=>$mat_ref]);
        }
    }

    public function loadMaterials(Request $request){
        $id = $request->input('id');
        $target = $request->input('target');
        $data['storages'] = DB::table('z_storages')->where('status',0)->get();
        $data['materials']=DB::table('z_materials')->where('amount','!=',0)->whereStorageId($id)->get();
        $view = view('admin.warehousing.mat-exchange',$data)->renderSections();
        if ($target == "first") {
            return response()->json(['content' => $view['firstMaterials']]);
        }else{
            return response()->json(['content' => $view['secondMaterials']]);
        }
    }

    public function deleteMaterial(Request $request){
        $id = $request->input('itemId');
        DB::table('z_materials')->whereId($id)->delete();
        DB::table('z_food_material')->where('material_id',$id)->delete();
    }

    public function filterMatByStorage(Request $request){
        $storageId = $request->input('storage_id');
        if ($storageId == 0){
            $data['fields']=DB::table('z_materials')->leftJoin('z_material_unit','z_materials.unit_id','=','z_material_unit.id')
                                            ->leftJoin('z_storages','z_materials.storage_id','=','z_storages.id')
                                            ->select('z_materials.id','z_materials.name','z_materials.amount',
                                                'z_material_unit.title','z_storages.title as storageName')
                                            ->get();
        }else{
            $data['fields']=DB::table('z_materials')->whereStorageId($storageId)->leftJoin('z_material_unit','z_materials.unit_id','=','z_material_unit.id')
            ->leftJoin('z_storages','z_materials.storage_id','=','z_storages.id')
            ->select('z_materials.id','z_materials.name','z_materials.amount',
                'z_material_unit.title','z_storages.title as storageName')
            ->get();
        }
        return response()->json(['content'=>view('admin.warehousing.warehouse-filter',$data)->render()]);
    }

    public function getStaffLoans($staff_id){
       $data['loans']=DB::table('z_staff_loan')->whereStaffId($staff_id)
                                ->leftJoin('z_bank_account as acc1','z_staff_loan.account_id','=','acc1.id')
                                ->leftJoin('z_bank_account as acc2','z_staff_loan.payback_account','=','acc2.id')
                                ->select('z_staff_loan.amount','z_staff_loan.payback_date','z_staff_loan.loan_date'
                                        ,'z_staff_loan.loan_time','z_staff_loan.payed','acc1.name as fromAccount'
                                        ,'acc2.name as toAccount','z_staff_loan.id','z_staff_loan.staff_id')
                                ->get();
        $view = view('admin.hr.loan',$data)->renderSections();
        return response()->json(['content'=>$view['content']]);
    }

    public function editLoan(Request $request){
            $loanId = $request->input('itemId');
            $data['field'] = DB::table('z_staff_loan')
                                    ->leftJoin('z_bank_account','z_staff_loan.account_id','=','z_bank_account.id')
                                    ->where('z_staff_loan.id',$loanId)
                                    ->select('z_staff_loan.id','z_staff_loan.account_id','z_staff_loan.amount','z_staff_loan.loan_date'
                                            ,'z_staff_loan.payback_date','z_bank_account.name as acc_name')
                                    ->first();
            $data['accounts'] = DB::table('z_bank_account')->get();
            $data['staff_id'] = $request->input('staffId');
            return response()->json(['content'=>view('admin.hr.edit-loan',$data)->render()]);
    }

    public function submitEditLoan(Request $request){
        $loanId = $request->input('loan_id');
        $accountId = $request->input('account');
        $amount = $request->input('amount');
        $loan_date = j2g($request->input('loan_date'));
        $payback_date = j2g($request->input('payback_date'));
        DB::table('z_staff_loan')->where('id',$loanId)->update(['account_id'=>$accountId,'amount'=>$amount,
                                         'loan_date'=>$loan_date,'payback_date'=>$payback_date]);
    }

    public function reportingVacations(Request $request){
        $fromDate = j2g($request->input('fromDate'));
        $toDate = j2g($request->input('toDate'));
        $name = $request->input('p_name');

        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');

        if (!isset($fromDate) || $fromDate==""){
            $fromDate = getCurrentDate();
        }
        if (!isset($toDate) || $toDate==""){
            $toDate = getCurrentDate();
        }


        $query = DB::table('z_vacation')->leftJoin('z_staff','z_vacation.staff_id','=','z_staff.id')
                                        ->whereBetween('z_vacation.from_date',array($fromDate,$toDate))
                                        ->whereBetween('z_vacation.from_time',array($fromTime,$toTime))
                                        ->select('z_vacation.from_date','z_vacation.to_date','z_vacation.from_time',
                                                 'z_vacation.to_time','z_staff.name');

        if (isset($name) && $name!=""){
            $query->where('z_staff.name','like','%'.$name.'%');
        }

        $data['fields'] = $query->orderBy('z_vacation.to_date','desc')->get();
        $data['orderType'] = 'asc';
        $data['orderField'] = 'z_vacation.to_date';
        return response()->json(['content'=>view('admin.reporting.vacations',$data)->render()]);
    }

    public function filterVacationReports(Request $request){
        $date = $request->input('date');
        $values = $request->input('inputsValue');
        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');

        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="z_vacation.to_date";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];
        $fromTime = $values[2];
        $toTime = $values[3];
        $name = $values[4];

        $query = DB::table('z_vacation')->leftJoin('z_staff','z_vacation.staff_id','=','z_staff.id')
                                         ->whereBetween('z_vacation.from_date',array($queryDate,$current))
                                         ->whereBetween('z_vacation.from_time',array($fromTime,$toTime))
                                         ->select('z_vacation.from_date','z_vacation.to_date','z_vacation.from_time',
                                             'z_vacation.to_time','z_staff.name');

        if (isset($name) && $name!=""){
            $query->where('z_staff.name','like','%'.$name.'%');
        }

        $data['fields'] = $query->orderBy($orderBy,$sortType)->get();

        if ($sortType == "desc"){
            $sortType="asc";
        }else{
            $sortType="desc";
        }
        $data['orderType'] = $sortType;
        $data['orderField'] = $orderBy;
        $fromDate = g2j($queryDate);
        $toDate = g2j($current);
        return response()->json(['content'=>view('admin.reporting.vacations',$data)->render(),'fromDate'=>$fromDate,'toDate'=>$toDate]);
    }

    public function reportingLoans(Request $request){
        $fromDate = j2g($request->input('fromDate'));
        $toDate = j2g($request->input('toDate'));
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $name = $request->input('p_name');

        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');

        if (!isset($fromDate) || $fromDate==""){
            $fromDate = getCurrentDate();
        }
        if (!isset($toDate) || $toDate==""){
            $toDate = getCurrentDate();
        }

        $query = DB::table('z_staff_loan')
                        ->leftJoin('z_staff','z_staff_loan.staff_id','=','z_staff.id')
                        ->leftJoin('z_bank_account as acc1','z_staff_loan.account_id','=','acc1.id')
                        ->leftJoin('z_bank_account as acc2','z_staff_loan.payback_account','=','acc2.id')
                        ->whereBetween('z_staff_loan.loan_date',array($fromDate,$toDate))
                        ->whereBetween('z_staff_loan.loan_time',array($fromTime,$toTime))
                        ->select('z_staff.name','z_staff_loan.amount','z_staff_loan.loan_date','z_staff_loan.loan_time',
                                'z_staff_loan.payback_date','z_staff_loan.payed','z_staff_loan.payback_real_date',
                                'acc1.name as fromAccount','acc2.name as toAccount','z_staff_loan.id as loanId');


        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_staff_loan.amount BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($name) && $name!=""){
            $query->where('z_staff.name','like','%'.$name.'%');
        }

        $data['fields'] = $query->orderBy('z_staff_loan.payback_date','desc')->get();
        $data['orderType'] = 'asc';
        $data['orderField'] = 'z_staff_loan.payback_date';
        return response()->json(['content'=>view('admin.reporting.loan',$data)->render()]);
    }

    public function filterLoanReports(Request $request){
        $date = $request->input('date');
        $values = $request->input('inputsValue');

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');

        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="z_staff_loan.loan_date";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];
        $fromTime = $values[2];
        $toTime = $values[3];
        $fromFee = $values[4];
        $toFee = $values[5];
        $name = $values[6];

        $query = DB::table('z_staff_loan')
                        ->leftJoin('z_staff','z_staff_loan.staff_id','=','z_staff.id')
                        ->leftJoin('z_bank_account as acc1','z_staff_loan.account_id','=','acc1.id')
                        ->leftJoin('z_bank_account as acc2','z_staff_loan.payback_account','=','acc2.id')
                        ->whereBetween('z_staff_loan.loan_date',array($queryDate,$current))
                        ->whereBetween('z_staff_loan.loan_time',array($fromTime,$toTime))
                        ->select('z_staff.name','z_staff_loan.amount','z_staff_loan.loan_date','z_staff_loan.loan_time',
                            'z_staff_loan.payback_date','z_staff_loan.payed','z_staff_loan.payback_real_date',
                            'acc1.name as fromAccount','acc2.name as toAccount','z_staff_loan.id as loanId');


        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_staff_loan.amount BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($name) && $name!=""){
            $query->where('z_staff.name','like','%'.$name.'%');
        }

        $data['fields'] = $query->orderBy($orderBy,$sortType)->get();
        if ($sortType == "desc"){
            $sortType="asc";
        }else{
            $sortType="desc";
        }
        $data['orderType'] = $sortType;
        $data['orderField'] = $orderBy;
        $fromDate = g2j($queryDate);
        $toDate = g2j($current);
        return response()->json(['content'=>view('admin.reporting.loan',$data)->render(),'fromDate'=>$fromDate,'toDate'=>$toDate]);
    }

    public function filterOrders(Request $request){
        $order = $request->input('order');
        if (isset($order)){
            if ($order=="upper"){
                $now = getCurrentDate();
                $tomorrow = date('Y-m-d',strtotime('+1 day'));
                $data['fields'] = DB::table('z_orders')->whereBetween('z_orders.date',array($now,$tomorrow))
                                    ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                                    ->leftJoin('z_users','z_users.id','=','z_orders.user_id')
                                    ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
                                    ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
                                    ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                                    ->select('z_orders.refid','z_orders.date as date','z_orders.time as time','z_users.name as username',
                                        'z_order_types.name as orderType','z_payments.title as paymentType',
                                        'z_foods.title as foodname','z_food_orders.foodcount as foodcount','z_orders.total_fee as totalFee',
                                        'z_orders.order_set','z_orders.note','z_orders.id as or_id')
                                    ->orderBy('z_orders.date','desc')
                                    ->orderBy('z_orders.time','desc')
                                    ->get();
                return response()->json(['content'=>view('admin.orders.new-orders',$data)->render()]);
            }else if($order=="downer") {
                $now = getCurrentDate();
                $tomorrow = date('Y-m-d',strtotime('+1 day'));
                $data['fields'] = DB::table('z_orders')->whereBetween('z_orders.date',array($now,$tomorrow))
                                                        ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                                                        ->leftJoin('z_users','z_users.id','=','z_orders.user_id')
                                                        ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
                                                        ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
                                                        ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                                                        ->select('z_orders.refid','z_orders.date as date','z_orders.time as time','z_users.name as username',
                                                            'z_order_types.name as orderType','z_payments.title as paymentType',
                                                            'z_foods.title as foodname','z_food_orders.foodcount as foodcount','z_orders.total_fee as totalFee',
                                                            'z_orders.order_set','z_orders.note','z_orders.id as or_id')
                                                        ->orderBy('z_orders.date','asc')
                                                        ->orderBy('z_orders.time','asc')
                                                        ->get();
                return response()->json(['content'=>view('admin.orders.new-orders',$data)->render()]);
            }else if($order == "date"){
                $now = getCurrentDate();
                $tomorrow = date('Y-m-d',strtotime('+1 day'));
                $data['fields'] = DB::table('z_orders')->whereBetween('z_orders.date',array($now,$tomorrow))
                                                     ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                                                     ->leftJoin('z_users','z_users.id','=','z_orders.user_id')
                                                     ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
                                                     ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
                                                     ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                                                     ->select('z_orders.refid','z_orders.date as date','z_orders.time as time','z_users.name as username',
                                                         'z_order_types.name as orderType','z_payments.title as paymentType',
                                                         'z_foods.title as foodname','z_food_orders.foodcount as foodcount','z_orders.total_fee as totalFee',
                                                         'z_orders.order_set','z_orders.note','z_orders.id as or_id')
                                                     ->orderBy('z_orders.id','desc')
                ->get();
                return response()->json(['content'=>view('admin.orders.new-orders',$data)->render()]);
            }else if($order=="make"){
                $now = getCurrentDate();
                $tomorrow = date('Y-m-d',strtotime('+1 day'));
                $data['fields'] = DB::table('z_orders')->whereBetween('z_orders.date',array($now,$tomorrow))
                                                    ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                                                    ->leftJoin('z_users','z_users.id','=','z_orders.user_id')
                                                    ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
                                                    ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
                                                    ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                                                    ->select('z_orders.refid','z_orders.date as date','z_orders.time as time','z_users.name as username',
                                                        'z_order_types.name as orderType','z_payments.title as paymentType',
                                                        'z_foods.title as foodname','z_food_orders.foodcount as foodcount','z_orders.total_fee as totalFee',
                                                        'z_orders.order_set','z_orders.note','z_orders.id as or_id')
                                                    ->orderBy('z_orders.serve_time','asc')
                                                    ->get();
                return response()->json(['content'=>view('admin.orders.new-orders',$data)->render()]);
            }else if ($order == "dayFilter"){
                $thisDay = date('Y-m-d');
                $jalalyDate = explode('-',$thisDay);
                $jalalyDate = gregorian_to_jalali($jalalyDate[0],$jalalyDate[1],$jalalyDate[2],'/');
                $data['fields'] = DB::table('z_orders')->where('z_orders.date',$thisDay)
                                    ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                                    ->leftJoin('z_users','z_users.id','=','z_orders.user_id')
                                    ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
                                    ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
                                    ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                                    ->select('z_orders.refid','z_orders.date as date','z_orders.time as time','z_users.name as username',
                                        'z_order_types.name as orderType','z_payments.title as paymentType',
                                        'z_foods.title as foodname','z_food_orders.foodcount as foodcount','z_orders.total_fee as totalFee',
                                        'z_orders.order_set','z_orders.note','z_orders.id as or_id')
                                    ->orderBy('z_orders.date',$thisDay)
                                    ->get();
                return response()->json(['content'=>view('admin.orders.new-orders',$data)->render(),'jDate'=>$jalalyDate]);
            }else if($order == "preWeek"){
                $saturday = strtotime("previous saturday");
                $saturday = date('Y-m-d',$saturday);
                $time = explode("-",$saturday);
                $jtime = gregorian_to_jalali($time[0],$time[1],$time[2]-7,'-');
                $jtime = explode('-',$jtime);
                $gtimeSat = jalali_to_gregorian($jtime[0],$jtime[1],$jtime[2],'-');
                $friday = strtotime('previous friday');
                $friday = date('Y-m-d',$friday);
                $jFriday = explode('-',$friday);
                $jFriday = gregorian_to_jalali($jFriday[0],$jFriday[1],$jFriday[2],'/');
                $firstDay = explode('-',$gtimeSat);
                $firstDay = gregorian_to_jalali($firstDay[0],$firstDay[1],$firstDay[2],'/');
                $data['fields'] = DB::table('z_orders')->whereBetween('z_orders.date',[$gtimeSat,$friday])
                                                ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                                                ->leftJoin('z_users','z_users.id','=','z_orders.user_id')
                                                ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
                                                ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
                                                ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                                                ->select('z_orders.refid','z_orders.date as date','z_orders.time as time','z_users.name as username',
                                                    'z_order_types.name as orderType','z_payments.title as paymentType',
                                                    'z_foods.title as foodname','z_food_orders.foodcount as foodcount','z_orders.total_fee as totalFee',
                                                    'z_orders.order_set','z_orders.note','z_orders.id as or_id')
                                                ->get();
                return response()->json(['content'=>view('admin.orders.new-orders',$data)->render(),'firstWeek'=>$firstDay,'friday'=>$jFriday]);
            }else if($order == "thisWeek"){
                $sat = strtotime('last saturday');
                $satTime = date('Y-m-d',$sat);
                $jSatTime = explode('-',$satTime);
                $jdSatTime = gregorian_to_jalali($jSatTime[0],$jSatTime[1],$jSatTime[2],'/');
                $currentDate = date('Y-m-d');
                $jCurrentDate = explode('-',$currentDate);
                $jdCurrentDate = gregorian_to_jalali($jCurrentDate[0],$jCurrentDate[1],$jCurrentDate[2],'/');
                $now = getCurrentDate();
                $tomorrow = date('Y-m-d',strtotime('+1 day'));
                $data['fields'] = DB::table('z_orders')->whereBetween('z_orders.date',[$satTime,$currentDate])
                                                                ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                                                                ->leftJoin('z_users','z_users.id','=','z_orders.user_id')
                                                                ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
                                                                ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
                                                                ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                                                                ->select('z_orders.refid','z_orders.date as date','z_orders.time as time','z_users.name as username',
                                                                    'z_order_types.name as orderType','z_payments.title as paymentType',
                                                                    'z_foods.title as foodname','z_food_orders.foodcount as foodcount','z_orders.total_fee as totalFee',
                                                                    'z_orders.order_set','z_orders.note','z_orders.id as or_id')
                                                                ->get();
                return response()->json(['content'=>view('admin.orders.new-orders',$data)->render(),'firstWeek'=>$jdSatTime,'nowTime'=>$jdCurrentDate]);
            }else if($order == "past"){
                $yesterday = date('Y-m-d',strtotime("-1 days"));
                $pastDay=explode('-',$yesterday);
                $pastDay = gregorian_to_jalali($pastDay[0],$pastDay[1],$pastDay[2],'/');
                $data['fields'] = DB::table('z_orders')->where('z_orders.date',$yesterday)
                                                        ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                                                        ->leftJoin('z_users','z_users.id','=','z_orders.user_id')
                                                        ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
                                                        ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
                                                        ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                                                        ->select('z_orders.refid','z_orders.date as date','z_orders.time as time','z_users.name as username',
                                                            'z_order_types.name as orderType','z_payments.title as paymentType',
                                                            'z_foods.title as foodname','z_food_orders.foodcount as foodcount','z_orders.total_fee as totalFee',
                                                            'z_orders.order_set','z_orders.note','z_orders.id as or_id')
                                                        ->get();
                return response()->json(['content'=>view('admin.orders.new-orders',$data)->render(),'jDate'=>$pastDay]);
            }
        }
        $fromDate = $request->input('form');
        $toDate = $request->input('to');
        if (isset($fromDate)){
            $newFromDate = explode('/',$fromDate);
            $newToDate = explode('/',$toDate);
            $fromGdate = jalali_to_gregorian($newFromDate[2],$newFromDate[1],$newFromDate[0],'-');
            $toGdate = jalali_to_gregorian($newToDate[2],$newToDate[1],$newToDate[0],'-');
            $now = getCurrentDate();
            $tomorrow = date('Y-m-d',strtotime('+1 day'));
            $data['fields'] = DB::table('z_orders')->whereBetween('z_orders.date',[$fromGdate,$toGdate])
            ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
            ->leftJoin('z_users','z_users.id','=','z_orders.user_id')
            ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
            ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
            ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
            ->select('z_orders.refid','z_orders.date as date','z_orders.time as time','z_users.name as username',
                'z_order_types.name as orderType','z_payments.title as paymentType',
                'z_foods.title as foodname','z_food_orders.foodcount as foodcount','z_orders.total_fee as totalFee',
                'z_orders.order_set','z_orders.note','z_orders.id as or_id')
            ->get();
            return response()->json(['content'=>view('admin.orders.new-orders',$data)->render()]);
        }
    }

    public function reportingWarehouse(Request $request){
        $fromDate = j2g($request->input('fromDate'));
        $toDate = j2g($request->input('toDate'));
        $fromCount = $request->input('fromCount');
        $toCount = $request->input('toCount');
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');

        if (!isset($fromDate) || $fromDate==""){
            $fromDate = getCurrentDate();
        }
        if (!isset($toDate) || $toDate==""){
            $toDate = getCurrentDate();
        }

        $query = DB::table('z_orders')
                            ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                            ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                            ->leftJoin('z_food_material','z_foods.id','=','z_food_material.food_id')
                            ->leftJoin('z_materials','z_food_material.material_id','=','z_materials.id')
                            ->whereBetween('z_orders.date',array($fromDate,$toDate))
                            ->whereBetween('z_orders.time',array($fromTime,$toTime))
                            ->select('z_orders.date','z_orders.time','z_materials.name as matName',
                                DB::raw('z_food_material.amount*z_food_orders.foodcount as matUsage'),
                                DB::raw('z_food_material.amount*z_food_orders.foodcount*z_materials.unit_price as matCost'),
                                'z_foods.title as food_name','z_orders.refid as orderId','z_food_orders.foodcount as food_count');

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('matUsage BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('matCost BETWEEN '.$fromFee.' AND '.$toFee);
        }
        $data['fields'] = $query->orderBy('z_orders.date','desc')->get();
        $data['orderType'] = 'asc';
        $data['orderField'] = 'z_orders.date';
        return response()->json(['content'=>view('admin.reporting.warehouse',$data)->render()]);
    }

    public function filterWareHouseReports(Request $request){
        $date = $request->input('date');
        $values = $request->input('inputsValue');

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');

        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="z_orders.date";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];
        $fromTime = $values[2];
        $toTime = $values[3];
        $fromCount = $values[4];
        $toCount = $values[5];
        $fromFee = $values[6];
        $toFee = $values[7];

        $query = DB::table('z_orders')
                                    ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                                    ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                                    ->leftJoin('z_food_material','z_foods.id','=','z_food_material.food_id')
                                    ->leftJoin('z_materials','z_food_material.material_id','=','z_materials.id')
                                    ->whereBetween('z_orders.date',array($queryDate,$current))
                                    ->whereBetween('z_orders.time',array($fromTime,$toTime))
                                    ->select('z_orders.date','z_orders.time','z_materials.name as matName',
                                        DB::raw('z_food_material.amount*z_food_orders.foodcount as matUsage'),
                                        DB::raw('z_food_material.amount*z_food_orders.foodcount*z_materials.unit_price as matCost'),
                                        'z_foods.title as food_name','z_orders.refid as orderId','z_food_orders.foodcount as food_count');

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('matUsage BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('matCost BETWEEN '.$fromFee.' AND '.$toFee);
        }
        $data['fields'] = $query->orderBy($orderBy,$sortType)->get();
        if ($sortType == "desc"){
            $sortType ="asc";
        }else{
            $sortType="desc";
        }
        $data['orderType'] = $sortType;
        $data['orderField'] = $orderBy;
        $fromDate = g2j($queryDate);
        $toDate = g2j($current);
        return response()->json(['content'=>view('admin.reporting.warehouse',$data)->render(),'fromDate'=>$fromDate,'toDate'=>$toDate]);
    }

    public function reportingStaffOrders(Request $request){
        $fromDate = j2g($request->input('fromDate'));
        $toDate = j2g($request->input('toDate'));
        $fromCount = $request->input('fromCount');
        $toCount = $request->input('toCount');
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $orderType = $request->input('orderTypes');


        if (!isset($fromDate) || $fromDate==""){
            $fromDate = getCurrentDate();
        }
        if (!isset($toDate) || $toDate==""){
            $toDate = getCurrentDate();
        }

        $query = DB::table('z_staff_orders')
                            ->leftJoin('z_staff_order_type','z_staff_orders.type','=','z_staff_order_type.id')
                            ->leftJoin('z_foods','z_staff_orders.food_id','=','z_foods.id')
                            ->whereBetween('z_staff_orders.date',array($fromDate,$toDate))
                            ->select('z_staff_orders.time','z_staff_order_type.title as orderType','z_foods.title as foodname','z_staff_orders.food_name','z_staff_orders.count','z_staff_orders.cost','z_staff_orders.date','z_staff_orders.type');

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_staff_orders.cost BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('z_staff_orders.count BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($orderType) && $orderType!=""){
            $query->whereIn('z_staff_orders.type',$orderType);
        }

        $data['fields'] = $query->orderBy('z_staff_orders.date','desc')->get();
        $data['orderType'] = 'asc';
        $data['orderField'] = 'z_staff_orders.date';
        return response()->json(['content'=>view('admin.reporting.personel-food',$data)->render()]);
    }

    public function filterStaffOrdersReport(Request $request){
        $date = $request->input('date');
        $values = $request->input('inputsValue');
        $selects = $request->input('selectsValue');

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');

        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="z_staff_orders.date";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];

        $fromCount = $values[4];
        $toCount = $values[5];
        $fromFee = $values[6];
        $toFee = $values[7];

        $orderType = $selects[0];

        $query = DB::table('z_staff_orders')
                            ->leftJoin('z_staff_order_type','z_staff_orders.type','=','z_staff_order_type.id')
                            ->leftJoin('z_foods','z_staff_orders.food_id','=','z_foods.id')
                            ->whereBetween('z_staff_orders.date',array($queryDate,$current))
                            ->select('z_staff_orders.time','z_staff_order_type.title as orderType','z_foods.title as foodname','z_staff_orders.food_name','z_staff_orders.count',
                                     'z_staff_orders.cost','z_staff_orders.date','z_staff_orders.type');

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_staff_orders.cost BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('z_staff_orders.count BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($orderType) && $orderType!=""){
            $query->whereIn('z_staff_orders.type',$orderType);
        }

        $data['fields'] = $query->orderBy($orderBy,$sortType)->get();
        if ($sortType == "asc"){
            $sortType='desc';
        }else{
            $sortType='asc';
        }
        $data['orderType'] = $sortType;
        $data['orderField'] = $orderBy;
        $fromDate = g2j($queryDate);
        $toDate = g2j($current);
        return response()->json(['content'=>view('admin.reporting.personel-food',$data)->render(),'fromDate'=>$fromDate,'toDate'=>$toDate]);
    }

    public function reportingUsersClub(Request $request){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $fromCount = $request->input('fromCount');
        $toCount = $request->input('toCount');
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $name = $request->input('name');
        $ssid = $request->input('factor_id');
        $sortingType = $request->input('sortType');

        $jFromDate = explode('/',$fromDate);
        $jToDate = explode('/',$toDate);
        if (count($jFromDate) < 2){
            $fromGdate = getCurrentDate();
            $toGdate = getCurrentDate();
        }else if (count($jToDate) < 2){
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = getCurrentDate();
        }else{
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = jalali_to_gregorian($jToDate[0],$jToDate[1],$jToDate[2],'-');
        }
        if (strtotime(getCurrentDate()) < strtotime($fromGdate)){
            $data['error'] = "تاریخ وارد شده صحیح نمی باشد.";
            return response()->json(['content'=>view('admin.reporting.orders-chart',$data)->render()]);
            exit;
        }
        $query = DB::table('z_users')
                        ->leftJoin('z_orders','z_users.id','=','z_orders.user_id')
                        ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                        ->whereBetween($sortingType,array($fromGdate,$toGdate))
                        ->select('z_users.name','z_users.phone','z_users.cctt as user_id','z_users.submit_date',
                                'z_users.last_visit',DB::raw('SUM(z_orders.total_fee) as totalFee'),
                                DB::raw('SUM(z_food_orders.foodcount) as food_count'),DB::raw('MAX(z_orders.date) as lastPurchase'));

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('SUM(z_orders.total_fee) BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('SUM(z_food_orders.foodcount) BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($name) && $name!=""){
           $query->where('z_users.name','like','%'.$name.'%');
        }

        if (isset($ssid) && $ssid!=""){
            $query->where('z_users.cctt','like','%'.$ssid.'%');
        }

        $data['fields'] = $query->orderBy('lastPurchase','desc')->groupBy('z_users.id')->get();
        $user_ids ='';
        if(isset($data['fields']) && count($data['fields']) > 0){
           foreach ($data['fields'] as $field) {
            if(isset($field->user_id)){
                $user_ids .= '|'.$field->user_id.'|';
            }
        }
    }
       
        $data['user_ids'] = $user_ids;

        $data['orderType'] = 'asc';
        $data['orderField'] = 'lastPurchase';
        return response()->json(['content'=>view('admin.reporting.users-club',$data)->render()]);
    }

    public function filterUsersClubReports(Request $request){
        $date = $request->input('date');
        $values = $request->input('inputsValue');

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');
        $selects = $request->input('selectsValue');

        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="z_users.submit_date";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];

        $name = $values[4];
        $ssid = $values[5];
        $fromCount = $values[6];
        $toCount = $values[7];
        $fromFee = $values[8];
        $toFee= $values[9];

        $sorting = $selects[0];

        $query = DB::table('z_users')
                        ->leftJoin('z_orders','z_users.id','=','z_orders.user_id')
                        ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                        ->whereBetween($sorting,array($queryDate,$current))
                        ->select('z_users.name','z_users.phone','z_users.cctt as user_id','z_users.submit_date',
                            'z_users.last_visit',DB::raw('SUM(z_orders.total_fee) as totalFee'),
                            DB::raw('SUM(z_food_orders.foodcount) as food_count'),DB::raw('MAX(z_orders.date) as lastPurchase'));


        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('SUM(z_orders.total_fee) BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('SUM(z_food_orders.foodcount) BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($name) && $name!=""){
            $query->where('z_users.name','like','%'.$name.'%');
        }

        if (isset($ssid) && $ssid!=""){
            $query->where('z_users.cctt','like','%'.$ssid.'%');
        }

        $data['fields'] = $query->orderBy($orderBy,$sortType)->groupBy('z_users.id')->get();


        $user_ids ='';
        if(isset($data['fields']) && count($data['fields']) > 0){
         foreach ($data['fields'] as $field) {
            if(isset($field->user_id)){
                $user_ids .= '|'.$field->user_id.'|';
            }
        }
    }
        $data['user_ids'] = $user_ids;

        if ($sortType == "desc"){
            $sortType="asc";
        }else{
            $sortType = "desc";
        }
        $data['orderType'] = $sortType;
        $data['orderField'] = $orderBy;
        $fromDate = g2j($queryDate);
        $toDate = g2j($current);
        return response()->json(['content'=>view('admin.reporting.users-club',$data)->render(),'fromDate'=>$fromDate,'toDate'=>$toDate]);
    }

    public function reportingSalary(Request $request){
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $fromDate = j2g($request->input('fromDate'));
        $toDate = j2g($request->input('toDate'));
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $account = $request->input('accounts');
        $name = $request->input('name');
        $transId = $request->input('trans_id');

        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }
        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }

        if (!isset($fromDate) || $fromDate == ""){
            $fromDate = getCurrentDate();
        }

        if (!isset($toDate) || $toDate == ""){
            $toDate = getCurrentDate();
        }


        $query = DB::table('z_salary')
                        ->leftJoin('z_staff','z_salary.staff_id','=','z_staff.id')
                        ->leftJoin('z_bank_account','z_salary.account_id','=','z_bank_account.id')
                        ->whereBetween('z_salary.date',array($fromDate,$toDate))
                        ->whereBetween('z_salary.time',array($fromTime,$toTime))
                        ->select('z_salary.cash','z_salary.date','z_salary.time','z_staff.name'
                                ,'z_staff.salary','z_bank_account.name as account_name');

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_salary.cash BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($name) && $name!=""){
            $query->where('z_staff.name','like','%'.$name.'%');
        }

        if (isset($account) && $account!=""){
            $query->whereIn('z_salary.account_id',$account);
        }

        if (isset($transId) && $transId!=""){
            $query->where('z_salary.trans_id','like','%'.$transId.'%');
        }

        $data['fields'] = $query->orderBy('z_salary.date','desc')->get();
        $data['orderType'] = 'asc';
        $data['orderField']  = 'z_salary.date';
        return response()->json(['content'=>view('admin.reporting.reporting-salary',$data)->render()]);
    }

    public function filterSalaryReports(Request $request){
        $date = $request->input('date');
        $values = $request->input('inputsValue');
        $selects = $request->input('selectsValue');

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');

        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="z_salary.date";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];

        $fromTime = $values[2];
        $toTime = $values[3];
        $name = $values[4];
        $fromFee = $values[5];
        $toFee = $values[6];
        $transId = $values[7];

        $account = $selects[0];
        $query = DB::table('z_salary')
                    ->leftJoin('z_staff','z_salary.staff_id','=','z_staff.id')
                    ->leftJoin('z_bank_account','z_salary.account_id','=','z_bank_account.id')
                    ->whereBetween('z_salary.date',array($queryDate,$current))
                    ->whereBetween('z_salary.time',array($fromTime,$toTime))
                    ->select('z_salary.cash','z_salary.date','z_salary.time','z_staff.name'
                        ,'z_staff.salary','z_bank_account.name as account_name');

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_salary.cash BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($name) && $name!=""){
            $query->where('z_staff.name','like','%'.$name.'%');
        }

        if (isset($account) && $account!=""){
            $query->whereIn('z_salary.account_id',$account);
        }
        if (isset($transId) && $transId!=""){
            $query->where('z_salary.trans_id','like','%'.$transId.'%');
        }

        $data['fields'] = $query->orderBy($orderBy,$sortType)->get();
        if ($sortType == "desc"){
            $sortType="asc";
        }else{
            $sortType = "desc";
        }
        $data['orderType'] = $sortType;
        $data['orderField']  = $orderBy;
        $fromDate = g2j($queryDate);
        $toDate = g2j($current);
        return response()->json(['content'=>view('admin.reporting.reporting-salary',$data)->render(),'fromDate'=>$fromDate,'toDate'=>$toDate]);
    }

    public function reportingIncomes(Request $request){

        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $fromDate = j2g($request->input('fromDate'));
        $toDate = j2g($request->input('toDate'));
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $transId = $request->input('transId');
        $types = $request->input('types');
        $subTypes = $request->input('subTypes');
        $account = $request->input('accounts');


        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }
        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }

        if (!isset($fromDate) || $fromDate == ""){
            $fromDate = getCurrentDate();
        }

        if (!isset($toDate) || $toDate == ""){
            $toDate = getCurrentDate();
        }

        $query = DB::table('z_transactions')
                            ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                            ->leftJoin('z_trans_type','z_trans_sub_type.parent_id','=','z_trans_type.id')
                            ->where('z_trans_sub_type.parent_id',2)
                            ->whereBetween('z_transactions.date',array($fromDate,$toDate))
                            ->whereBetween('z_transactions.time',array($fromTime,$toTime))
                            ->select('z_transactions.trans_id','z_transactions.cash','z_transactions.date','z_transactions.time',
                                'z_trans_sub_type.title as subType','z_trans_type.title as catTitle');

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_transactions.cash BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($transId) && $transId!=""){
            $query->where('z_transactions.trans_id',$transId);
        }

        if (isset($types) && $types!=""){
            $query->whereIn('z_trans_type.id',$types);
        }

        if (isset($subTypes) && $subTypes!=""){
            $query->whereIn('z_transactions.type',$subTypes);
        }

        if (isset($account) && $account!=""){
            $query->whereIn('z_transactions.account_id',$account);
        }

        $data['fields'] = $query->orderBy('z_transactions.date','desc')->get();

        $data['orderType'] = 'asc';
        $data['orderField'] = 'z_transactions.date';
        return response()->json(['content'=>view('admin.reporting.incomes',$data)->render()]);

    }

    public function filterIncomeReports(Request $request){

        $date = $request->input('date');
        $values = $request->input('inputsValue');
        $selects = $request->input('selectsValue');

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');

        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="z_transactions.date";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];

        $fromTime = $values[2];
        $toTime = $values[3];

        $transId = $values[4];
        $fromFee = $values[5];
        $toFee = $values[6];

        $subTypes = $selects[0];
        $account = $selects[1];

        $query = DB::table('z_transactions')
                            ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                            ->leftJoin('z_trans_type','z_trans_sub_type.parent_id','=','z_trans_type.id')
                            ->where('z_trans_sub_type.parent_id',2)
                            ->whereBetween('z_transactions.date',array($queryDate,$current))
                            ->whereBetween('z_transactions.time',array($fromTime,$toTime))
                            ->select('z_transactions.trans_id','z_transactions.cash','z_transactions.date','z_transactions.time',
                                'z_trans_sub_type.title as subType','z_trans_type.title as catTitle');

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_transactions.cash BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($transId) && $transId!=""){
            $query->where('z_transactions.trans_id',$transId);
        }

        if (isset($types) && $types!=""){
            $query->whereIn('z_trans_type.id',$types);
        }

        if (isset($subTypes) && $subTypes!=""){
            $query->whereIn('z_transactions.type',$subTypes);
        }

        if (isset($account) && $account!=""){
            $query->whereIn('z_transactions.account_id',$account);
        }

        $data['fields'] = $query->orderBy($orderBy,$sortType)->get();
        if ($sortType == "asc"){
            $sortType = "desc";
        }else{
            $sortType = "asc";
        }

        $data['orderType'] = $sortType;
        $data['orderField'] = $orderBy;
        $fromDate = g2j($queryDate);
        $toDate = g2j($current);
        return response()->json(['content'=>view('admin.reporting.incomes',$data)->render(),'fromDate'=>$fromDate,'toDate'=>$toDate]);

    }

    public function reportingCosts(Request $request){
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $fromDate = j2g($request->input('fromDate'));
        $toDate = j2g($request->input('toDate'));
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $transId = $request->input('transId');
        $types = $request->input('types');
        $subTypes = $request->input('subTypes');
        $account = $request->input('accounts');


        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }
        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }

        if (!isset($fromDate) || $fromDate == ""){
            $fromDate = getCurrentDate();
        }

        if (!isset($toDate) || $toDate == ""){
            $toDate = getCurrentDate();
        }

        $query = DB::table('z_transactions')
                    ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                    ->leftJoin('z_trans_type','z_trans_sub_type.parent_id','=','z_trans_type.id')
                    ->where('z_trans_sub_type.parent_id',1)
                    ->whereBetween('z_transactions.date',array($fromDate,$toDate))
                    ->whereBetween('z_transactions.time',array($fromTime,$toTime))
                    ->select('z_transactions.trans_id','z_transactions.cash','z_transactions.date','z_transactions.time',
                        'z_trans_sub_type.title as subType','z_trans_type.title as catTitle');

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_transactions.cash BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($transId) && $transId!=""){
            $query->where('z_transactions.trans_id',$transId);
        }

        if (isset($types) && $types!=""){
            $query->whereIn('z_trans_type.id',$types);
        }

        if (isset($subTypes) && $subTypes!=""){
            $query->whereIn('z_transactions.type',$subTypes);
        }

        if (isset($account) && $account!=""){
            $query->whereIn('z_transactions.account_id',$account);
        }

        $data['fields'] = $query->orderBy('z_transactions.date','desc')->get();

        $data['orderType'] = 'asc';
        $data['orderField'] = 'z_transactions.date';
        return response()->json(['content'=>view('admin.reporting.costs',$data)->render()]);
    }

    public function filterCostsReport(Request $request){
        $date = $request->input('date');
        $values = $request->input('inputsValue');
        $selects = $request->input('selectsValue');

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');

        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="z_transactions.date";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];

        $fromTime = $values[2];
        $toTime = $values[3];

        $transId = $values[4];
        $fromFee = $values[5];
        $toFee = $values[6];

        $subTypes = $selects[0];
        $account = $selects[1];

        $query = DB::table('z_transactions')
                    ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                    ->leftJoin('z_trans_type','z_trans_sub_type.parent_id','=','z_trans_type.id')
                    ->where('z_trans_sub_type.parent_id',1)
                    ->whereBetween('z_transactions.date',array($queryDate,$current))
                    ->whereBetween('z_transactions.time',array($fromTime,$toTime))
                    ->select('z_transactions.trans_id','z_transactions.cash','z_transactions.date','z_transactions.time',
                        'z_trans_sub_type.title as subType','z_trans_type.title as catTitle');

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_transactions.cash BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($transId) && $transId!=""){
            $query->where('z_transactions.trans_id',$transId);
        }

        if (isset($types) && $types!=""){
            $query->whereIn('z_trans_type.id',$types);
        }

        if (isset($subTypes) && $subTypes!=""){
            $query->whereIn('z_transactions.type',$subTypes);
        }

        if (isset($account) && $account!=""){
            $query->whereIn('z_transactions.account_id',$account);
        }

        $data['fields'] = $query->orderBy($orderBy,$sortType)->get();
        if ($sortType == "asc"){
            $sortType = "desc";
        }else{
            $sortType = "asc";
        }

        $data['orderType'] = $sortType;
        $data['orderField'] = $orderBy;
        $fromDate = g2j($queryDate);
        $toDate = g2j($current);
        return response()->json(['content'=>view('admin.reporting.costs',$data)->render(),'fromDate'=>$fromDate,'toDate'=>$toDate]);
    }

    public function reportingTransactions(Request $request){

        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $fromDate = j2g($request->input('fromDate'));
        $toDate = j2g($request->input('toDate'));
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $transId = $request->input('transId');
        $types = $request->input('types');
        $subTypes = $request->input('subTypes');
        $account = $request->input('accounts');


        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }
        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }

        if (!isset($fromDate) || $fromDate == ""){
            $fromDate = getCurrentDate();
        }

        if (!isset($toDate) || $toDate == ""){
            $toDate = getCurrentDate();
        }

        $query = DB::table('z_transactions')
                            ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                            ->leftJoin('z_trans_type','z_trans_sub_type.parent_id','=','z_trans_type.id')
                            ->whereBetween('z_transactions.date',array($fromDate,$toDate))
                            ->whereBetween('z_transactions.time',array($fromTime,$toTime))
                            ->select('z_transactions.trans_id','z_transactions.cash','z_transactions.date','z_transactions.time',
                                'z_trans_sub_type.title as subType','z_trans_type.title as catTitle');

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_transactions.cash BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($transId) && $transId!=""){
            $query->where('z_transactions.trans_id',$transId);
        }

        if (isset($types) && $types!=""){
            $query->whereIn('z_trans_type.id',$types);
        }

        if (isset($subTypes) && $subTypes!=""){
            $query->whereIn('z_transactions.type',$subTypes);
        }

        if (isset($account) && $account!=""){
            $query->whereIn('z_transactions.account_id',$account);
        }

        $data['fields'] = $query->orderBy('z_transactions.date','desc')->get();

        $data['orderType'] = 'asc';
        $data['orderField'] = 'z_transactions.date';
        return response()->json(['content'=>view('admin.reporting.transactions',$data)->render()]);
    }

    public function filterTransactionsReport(Request $request){
        $date = $request->input('date');

        $values = $request->input('inputsValue');
        $selects = $request->input('selectsValue');

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');

        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="z_transactions.date";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];

        $fromTime = $values[2];
        $toTime = $values[3];

        $transId = $values[4];
        $fromFee = $values[5];
        $toFee = $values[6];

        $types = $selects[0];
        $subTypes = $selects[1];
        $account = $selects[2];

        $query = DB::table('z_transactions')
                         ->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
                         ->leftJoin('z_trans_type','z_trans_sub_type.parent_id','=','z_trans_type.id')
                         ->whereBetween('z_transactions.date',array($queryDate,$current))
                         ->whereBetween('z_transactions.time',array($fromTime,$toTime))
                         ->select('z_transactions.trans_id','z_transactions.cash','z_transactions.date','z_transactions.time',
                             'z_trans_sub_type.title as subType','z_trans_type.title as catTitle');

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('z_transactions.cash BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($transId) && $transId!=""){
            $query->where('z_transactions.trans_id',$transId);
        }

        if (isset($types) && $types!=""){
            $query->whereIn('z_trans_type.id',$types);
        }

        if (isset($subTypes) && $subTypes!=""){
            $query->whereIn('z_transactions.type',$subTypes);
        }

        if (isset($account) && $account!=""){
            $query->whereIn('z_transactions.account_id',$account);
        }

        $data['fields'] = $query->orderBy($orderBy,$sortType)->get();
        if ($sortType == "asc"){
            $sortType = "desc";
        }else{
            $sortType = "asc";
        }

        $data['orderType'] = $sortType;
        $data['orderField'] = $orderBy;
        $fromDate = g2j($queryDate);
        $toDate = g2j($current);
        return response()->json(['content'=>view('admin.reporting.transactions',$data)->render(),'fromDate'=>$fromDate,'toDate'=>$toDate]);
    }

    public function reportingPaymentType(Request $request){
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $fromCount = $request->input('fromCount');
        $toCount = $request->input('toCount');
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $name = $request->input('name');
        $factorId = $request->input('factor_id');
        $subset = $request->input('branch');
        $foods = $request->input('food');
        $menu = $request->input('menus');

        $jFromDate = explode('/',$fromDate);
        $jToDate = explode('/',$toDate);
        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }
        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }
        if (count($jFromDate) < 2){
            $fromGdate = getCurrentDate();
            $toGdate = getCurrentDate();
        }else if (count($jToDate) < 2){
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = getCurrentDate();
        }else{
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = jalali_to_gregorian($jToDate[0],$jToDate[1],$jToDate[2],'-');
        }
        if (strtotime(getCurrentDate()) < strtotime($fromGdate)){
            $data['error'] = "تاریخ وارد شده صحیح نمی باشد.";
            return response()->json(['content'=>view('admin.reporting.orders-chart',$data)->render()]);
            exit;
        }
        if (!isset($fromFee) || $fromFee==""){
            $fromFee=1;
        }
        if (!isset($toFee) || $toFee==""){
            $toFee=DB::table('z_orders')->sum('total_fee');
        }

        $query = DB::table('z_orders')
                        ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
                        ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                        ->leftJoin('z_foods','z_foods.id','=','z_food_orders.food_id')
                        ->whereBetween('z_orders.date',array($fromGdate,$toGdate))
                        ->whereBetween('z_orders.time',array($fromTime,$toTime))
                        ->select('z_payments.name as paymentType',DB::raw('SUM(z_food_orders.foodcount) as foodcount'),
                            DB::raw('SUM(z_foods.price*z_food_orders.foodcount) as totalFee'));

        if (isset($fromFee) && $fromFee !=""){
            $query->havingRaw('SUM(z_foods.price*z_food_orders.foodcount) BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('SUM(z_food_orders.foodcount) BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($name) && $name!= ""){
            $query->leftJoin('z_users','z_orders.user_id','=','z_users.id')
            ->where('z_users.name','like','%'.$name.'%');
        }


        if (isset($factorId) || $factorId!=""){
            $query->where('z_payments.name','like','%'.$factorId.'%');
        }

        if (isset($subset) && $subset!=""){
            $query->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                    ->leftJoin('z_res_subset','z_food_cats.parent_id','=','z_res_subset.id')
                    ->whereIn('z_res_subset.id',$subset);
        }

        if (isset($foods) && $foods!=""){
            $query->whereIn('z_foods.id',$foods);
        }

        if (isset($menu) && $menu!=""){
            if (isset($subset) && $subset!=""){
                $query->whereIn('z_food_cats.id',$menu);
            }else{
                $query->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                ->whereIn('z_food_cats.id',$menu);
            }
        }
        $data['orderType'] = 'asc';
        $data['orderField'] ='z_payments.name';

        $data['fields'] = $query->orderBy('z_payments.name','desc')->groupBy('z_payments.id')->get();
        return response()->json(['content'=>view('admin.reporting.paymentType',$data)->render()]);
    }

    public function filterPaymentTypeReports(Request $request){
        $date = $request->input('date');

        $values = $request->input('inputsValue');
        $selects = $request->input('selectsValue');

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');

        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="z_payments.title";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];

        $fromTime = $values[2];
        $toTime = $values[3];
        $name = $values[4];
        $factorId = $values[5];
        $fromCount = $values[6];
        $toCount = $values[7];
        $fromFee = $values[8];
        $toFee=  $values[9];

        $subset = $selects[0];
        $foods = $selects[1];
        $menu = $selects[2];


        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }

        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }

        if (!isset($fromFee) || $fromFee==""){
            $fromFee=1;
        }

        if (!isset($toFee) || $toFee==""){
            $toFee=DB::table('z_orders')->sum('total_fee');
        }

        $query = DB::table('z_orders')
                        ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
                        ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                        ->leftJoin('z_foods','z_foods.id','=','z_food_orders.food_id')
                        ->whereBetween('z_orders.date',array($queryDate,$current))
                        ->whereBetween('z_orders.time',array($fromTime,$toTime))
                        ->select('z_payments.name as paymentType',DB::raw('SUM(z_food_orders.foodcount) as foodcount'),
                            DB::raw('SUM(z_foods.price*z_food_orders.foodcount) as totalFee'));

        if (isset($fromFee) && $fromFee !=""){
            $query->havingRaw('SUM(z_foods.price*z_food_orders.foodcount) BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('SUM(z_food_orders.foodcount) BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($name) && $name!= ""){
            $query->leftJoin('z_users','z_orders.user_id','=','z_users.id')
            ->where('z_users.name','like','%'.$name.'%');
        }

        if (isset($factorId) && $factorId!=""){
            $query->where('z_payments.name','like','%'.$factorId.'%');
        }

        if (isset($subset) && $subset!=""){
            $query->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                        ->leftJoin('z_res_subset','z_food_cats.parent_id','=','z_res_subset.id')
                        ->whereIn('z_res_subset.id',$subset);
        }

        if (isset($foods) && $foods!=""){
            $query->whereIn('z_foods.id',$foods);
        }

        if (isset($menu) && $menu!=""){
            if (isset($subset) && $subset!=""){
                $query->whereIn('z_food_cats.id',$menu);
            }else{
                $query->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                ->whereIn('z_food_cats.id',$menu);
            }
        }

        $jFromDate = g2j($queryDate);
        $jTodate = g2j($current);
        $data['fields'] = $query->orderBy($orderBy,$sortType)->groupBy('z_payments.id')->get();

        if ($sortType == "asc"){
            $sortType = "desc";
        }else{
            $sortType = "asc";
        }

        $data['orderType'] = $sortType;
        $data['orderField'] = $orderBy;

        return response()->json(['content'=>view('admin.reporting.paymentType',$data)->render(),'fromDate'=>$jFromDate,'toDate'=>$jTodate]);
    }

    private function loadOrders(){
        $now = getCurrentDate();
        $tomorrow = date('Y-m-d',strtotime('+1 day'));
        $fields = DB::table('z_orders')->whereBetween('z_orders.date',array($now,$tomorrow))
                            ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                            ->leftJoin('z_users','z_users.id','=','z_orders.user_id')
                            ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
                            ->leftJoin('z_payments','z_payments.id','=','z_orders.payment_type')
                            ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                            ->select('z_orders.refid','z_orders.date as date','z_orders.time as time','z_users.name as username',
                                     'z_order_types.name as orderType','z_payments.title as paymentType',
                                     'z_foods.title as foodname','z_food_orders.foodcount as foodcount','z_orders.total_fee as totalFee',
                                     'z_orders.order_set','z_orders.note','z_orders.id as or_id')
                            ->orderBy('z_orders.date','desc')
                            ->orderBy('z_orders.time','desc')
                            ->get();
        return $fields;
    }

    public function filterFoodsReport(Request $request){
        $date = $request->input('date');

        $values = $request->input('inputsValue');
        $selects = $request->input('selectsValue');

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');
        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="foodcount";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];

        $fromTime = $values[2];
        $toTime = $values[3];
        $name = $values[4];
        $factorId = $values[5];
        $fromCount = $values[6];
        $toCount = $values[7];
        $fromFee = $values[8];
        $toFee=  $values[9];

        $subset = $selects[0];
        $foods = $selects[1];
        $menu = $selects[2];

        $orderType = $selects[3];
        $paymentType = $selects[4];

        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }

        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }

        if (!isset($fromFee) || $fromFee==""){
            $fromFee=1;
        }

        if (!isset($toFee) || $toFee==""){
            $toFee=DB::table('z_orders')->sum('total_fee');
        }

        $query   = DB::table('z_food_orders')
                                ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                                ->leftJoin('z_orders','z_food_orders.order_id','=','z_orders.id')
                                ->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                                ->leftJoin('z_res_subset','z_food_cats.parent_id','=','z_res_subset.id')
                                ->whereBetween('z_orders.date',array($queryDate,$current))
                                ->whereBetween('z_orders.time',array($fromTime,$toTime));

        $groupBy = "z_foods.id";
        $select = ['z_foods.title','z_res_subset.title as resTitle','z_food_cats.title as catTitle','z_food_orders.food_id','z_orders.date','z_orders.time',DB::raw('SUM(z_food_orders.foodcount) as foodcount'),DB::raw('SUM(z_food_orders.foodcount) * z_foods.price as totalFee')];

        if (isset($name) && $name!=""){
            $query->join('z_users','z_users.id','=','z_orders.user_id')->where('z_users.name','like','%'.$name.'%');
            array_push($select,'z_users.name');
        }

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('SUM(z_food_orders.foodcount) BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($factorId) && $factorId!=""){
            $query->where('z_orders.refid',$factorId);
        }

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('SUM(z_food_orders.foodcount) * z_foods.price BETWEEN '.$fromFee.' AND '.$toFee);
            array_push($select,'z_foods.price');
        }

        if (isset($foods) && $foods!=""){
            $query->whereIn('z_foods.id',$foods);
            array_push($select,'z_foods.title');
            $groupBy = "z_foods.id";
        }

        if (isset($subset) && $subset!=""){
            $query->whereIn('z_res_subset.id',$subset);
        }

        if (isset($menu) && $menu!=""){
            $query->whereIn('z_food_cats.id',$menu);
        }
        if (isset($orderType) && $orderType!=""){
            $query->whereIn('z_orders.order_type',$orderType);
        }

        if (isset($paymentType) && $paymentType!=""){
            $query->whereIn('z_orders.payment_type',$paymentType);
        }

        $data['fields'] = $query->select($select)
                                ->orderBy($orderBy,$sortType)
                                ->groupBy($groupBy)
                                ->get();

        if ($sortType == "asc"){
            $sortType = "desc";
        }else{
            $sortType="asc";
        }

        $data['orderType'] = $sortType;
        $data['orderField'] = $orderBy;
        $jFromDate = g2j($queryDate);
        $jTodate = g2j($current);

        return response()->json(['content'=>view('admin.reporting.foods',$data)->render(),'fromDate'=>$jFromDate ,'toDate'=>$jTodate]);
    }

    public function reportingFoods(Request $request){
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $fromCount = $request->input('fromCount');
        $toCount = $request->input('toCount');
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $name = $request->input('name');
        $factorId = $request->input('factor_id');
        $subset = $request->input('branch');
        $foods = $request->input('food');
        $menu = $request->input('menus');
        $paymentType = $request->input('paymentType');
        $orderType = $request->input('orderType');

        $jFromDate = explode('/',$fromDate);
        $jToDate = explode('/',$toDate);
        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }
        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }
        if (count($jFromDate) < 2){
            $fromGdate = getCurrentDate();
            $toGdate = getCurrentDate();
        }else if (count($jToDate) < 2){
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = getCurrentDate();
        }else{
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = jalali_to_gregorian($jToDate[0],$jToDate[1],$jToDate[2],'-');
        }
        if (strtotime(getCurrentDate()) < strtotime($fromGdate)){
            $data['error'] = "تاریخ وارد شده صحیح نمی باشد.";
            return response()->json(['content'=>view('admin.reporting.orders-chart',$data)->render()]);
            exit;
        }

        if (!isset($fromFee) || $fromFee==""){
            $fromFee=1;
        }

        if (!isset($toFee) || $toFee==""){
            $toFee=DB::table('z_orders')->sum('total_fee');
        }

        $query   = DB::table('z_food_orders')
                             ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                             ->leftJoin('z_orders','z_food_orders.order_id','=','z_orders.id')
                             ->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                             ->leftJoin('z_res_subset','z_food_cats.parent_id','=','z_res_subset.id')
                             ->whereBetween('z_orders.date',array($fromGdate,$toGdate))
                             ->whereBetween('z_orders.time',array($fromTime,$toTime));

        $groupBy = "z_foods.id";
        $select = ['z_foods.title','z_res_subset.title as resTitle','z_food_cats.title as catTitle','z_food_orders.food_id','z_orders.date','z_orders.time',DB::raw('SUM(z_food_orders.foodcount) as foodcount'),DB::raw('SUM(z_food_orders.foodcount) * z_foods.price as totalFee')];

        if (isset($name) && $name!=""){
            $query->join('z_users','z_users.id','=','z_orders.user_id')->where('z_users.name','like','%'.$name.'%');
            array_push($select,'z_users.name');
        }

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('SUM(z_food_orders.foodcount) BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($factorId) && $factorId!=""){
            $query->where('z_orders.refid',$factorId);
        }

        if (isset($fromFee) && $fromFee!=""){
            $query->havingRaw('SUM(z_food_orders.foodcount) * z_foods.price BETWEEN '.$fromFee.' AND '.$toFee);
            array_push($select,'z_foods.price');
        }

        if (isset($foods) && $foods!=""){
            $query->whereIn('z_foods.id',$foods);
            array_push($select,'z_foods.title');
            $groupBy = "z_foods.id";
        }

        if (isset($subset) && $subset!=""){
            $query->whereIn('z_res_subset.id',$subset);
        }

        if (isset($menu) && $menu!=""){
            $query->whereIn('z_food_cats.id',$menu);
        }

        if (isset($paymentType) && $paymentType!=""){
            $query->whereIn('z_orders.payment_type',$paymentType);
        }

        if (isset($orderType) && $orderType!=""){
            $query->whereIn('z_orders.order_type',$orderType);
        }

        $data['fields'] = $query->select($select)->groupBy($groupBy)->get();

        $data['orderType'] = 'desc';
        $data['orderField'] = 'foodcount';
        return response()->json(['content'=>view('admin.reporting.foods',$data)->render()]);
    }

    public function reportingDelivery(Request $request){
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $fromCount = $request->input('fromCount');
        $toCount = $request->input('toCount');
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $name = $request->input('name');
        $factorId = $request->input('factor_id');
        $subset = $request->input('branch');
        $foods = $request->input('food');
        $menu = $request->input('menus');

        $jFromDate = explode('/',$fromDate);
        $jToDate = explode('/',$toDate);
        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }
        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }
        if (count($jFromDate) < 2){
            $fromGdate = getCurrentDate();
            $toGdate = getCurrentDate();
        }else if (count($jToDate) < 2){
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = getCurrentDate();
        }else{
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = jalali_to_gregorian($jToDate[0],$jToDate[1],$jToDate[2],'-');
        }
        if (strtotime(getCurrentDate()) < strtotime($fromGdate)){
            $data['error'] = "تاریخ وارد شده صحیح نمی باشد.";
            return response()->json(['content'=>view('admin.reporting.orders-chart',$data)->render()]);
            exit;
        }
        if (!isset($fromFee) || $fromFee==""){
            $fromFee=1;
        }
        if (!isset($toFee) || $toFee==""){
            $toFee=DB::table('z_orders')->sum('total_fee');
        }

        $query = DB::table('z_orders')
                        ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
                        ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                        ->leftJoin('z_foods','z_foods.id','=','z_food_orders.food_id')
                        ->whereBetween('z_orders.date',array($fromGdate,$toGdate))
                        ->whereBetween('z_orders.time',array($fromTime,$toTime))
                        ->select('z_order_types.name as orderType',DB::raw('SUM(z_food_orders.foodcount) as foodcount'),
                            DB::raw('SUM(z_foods.price*z_food_orders.foodcount) as totalFee'));

        if (isset($fromFee) && $fromFee !=""){
            $query->havingRaw('SUM(z_foods.price*z_food_orders.foodcount) BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('SUM(z_food_orders.foodcount) BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($name) && $name!= ""){
            $query->leftJoin('z_users','z_orders.user_id','=','z_users.id')
            ->where('z_users.name','like','%'.$name.'%');
        }


        if (isset($factorId) || $factorId!=""){
            $query->where('z_order_types.name','like','%'.$factorId.'%');
        }

        if (isset($subset) && $subset!=""){
            $query->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                    ->leftJoin('z_res_subset','z_food_cats.parent_id','=','z_res_subset.id')
                    ->whereIn('z_res_subset.id',$subset);
        }

        if (isset($foods) && $foods!=""){
            $query->whereIn('z_foods.id',$foods);
        }

        if (isset($menu) && $menu!=""){
            if (isset($subset) && $subset!=""){
                $query->whereIn('z_food_cats.id',$menu);
            }else{
                $query->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                ->whereIn('z_food_cats.id',$menu);
            }
        }
        $data['orderType'] = 'asc';
        $data['orderField'] ='z_order_types.name';

        $data['fields'] = $query->orderBy('z_order_types.name','desc')->groupBy('z_order_types.id')->get();
        return response()->json(['content'=>view('admin.reporting.delivery',$data)->render()]);
    }

    public function filterDeliveryReports(Request $request){
        $date = $request->input('date');

        $values = $request->input('inputsValue');
        $selects = $request->input('selectsValue');

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');

        if (!isset($date)||$date==""){
            $date=[j2g($values[0]),j2g($values[1])];
        }

        if (!isset($sortType) || $sortType==""){
            $sortType = "desc";
        }

        if (!isset($orderBy) || $orderBy==""){
            $orderBy="z_order_types.id";
        }

        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];

        $fromTime = $values[2];
        $toTime = $values[3];
        $name = $values[4];
        $factorId = $values[5];
        $fromCount = $values[6];
        $toCount = $values[7];
        $fromFee = $values[8];
        $toFee=  $values[9];

        $subset = $selects[0];
        $foods = $selects[1];
        $menu = $selects[2];


        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }

        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }

        if (!isset($fromFee) || $fromFee==""){
            $fromFee=1;
        }

        if (!isset($toFee) || $toFee==""){
            $toFee=DB::table('z_orders')->sum('total_fee');
        }

        $query = DB::table('z_orders')
                            ->leftJoin('z_order_types','z_order_types.id','=','z_orders.order_type')
                            ->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                            ->leftJoin('z_foods','z_foods.id','=','z_food_orders.food_id')
                            ->whereBetween('z_orders.date',array($queryDate,$current))
                            ->whereBetween('z_orders.time',array($fromTime,$toTime))
                            ->select('z_order_types.name as orderType',DB::raw('SUM(z_food_orders.foodcount) as foodcount'),
                                DB::raw('SUM(z_foods.price*z_food_orders.foodcount) as totalFee'),'z_order_types.id');

        if (isset($fromFee) && $fromFee !=""){
            $query->havingRaw('SUM(z_foods.price*z_food_orders.foodcount) BETWEEN '.$fromFee.' AND '.$toFee);
        }

        if (isset($fromCount) && $fromCount!=""){
            $query->havingRaw('SUM(z_food_orders.foodcount) BETWEEN '.$fromCount.' AND '.$toCount);
        }

        if (isset($name) && $name!= ""){
            $query->leftJoin('z_users','z_orders.user_id','=','z_users.id')
                        ->where('z_users.name','like','%'.$name.'%');
        }

        if (isset($factorId) && $factorId!=""){
            $query->where('z_order_types.name','like','%'.$factorId.'%');
        }

        if (isset($subset) && $subset!=""){
            $query->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                    ->leftJoin('z_res_subset','z_food_cats.parent_id','=','z_res_subset.id')
                    ->whereIn('z_res_subset.id',$subset);
        }

        if (isset($foods) && $foods!=""){
            $query->whereIn('z_foods.id',$foods);
        }

        if (isset($menu) && $menu!=""){
                if (isset($subset) && $subset!=""){
                    $query->whereIn('z_food_cats.id',$menu);
                }else{
                    $query->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                            ->whereIn('z_food_cats.id',$menu);
                }
        }

        $jFromDate = g2j($queryDate);
        $jTodate = g2j($current);
        $data['fields'] = $query->orderBy($orderBy,$sortType)->groupBy('z_order_types.id')->get();

        if ($sortType == "asc"){
            $sortType = "desc";
        }else{
            $sortType = "asc";
        }

        $data['orderType'] = $sortType;
        $data['orderField'] = $orderBy;

        return response()->json(['content'=>view('admin.reporting.delivery',$data)->render(),'fromDate'=>$jFromDate,'toDate'=>$jTodate]);
    }

    public function newvote(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.userclub.add-vote')->render()]);
    }

    public function newressubset(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.setting.new-res-subset')->render()]);
    }


    public function newregisterfields(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $data['fields']=DB::table('z_field_types')->get();
        return response()->json(['content'=>view('admin.userclub.new-register-fields',$data)->render()]);
    }


    public function wareHouseWareHouses(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $isEdit = $request->input('edit');
        $parentId = $request->input('parentWareHouse');
        $title = $request->input('wTitle');
        if (isset($isEdit) && $isEdit != ""){
            DB::table('z_storages')->whereId($isEdit)->update(['parent_id'=>$parentId,'title'=>$title]);
        }else{
            DB::table('z_storages')->insert(['title'=>$title,'parent_id'=>$parentId]);
        }
    }



    public function submitNote(Request $request){
        $title = $request->input('noteTitle');
        $content = $request->input('noteContent');
        DB::table('z_note')->insert(['title'=>$title,'content'=>$content]);
    }

    public function phoneBook(Request $request){
       DB::table('z_phonebook')->insert(['name'=>$request->input('name'),
                                        'phone'=>$request->input('phone'),'company'=>$request->input('company'),
                                        'mobile'=>$request->input('mobile'),'group'=>$request->input('group'),
                                        'address'=>$request->input('address'),'email'=>$request->input('email'),
                                        'website'=>$request->input('website'),'note'=>$request->input('note')]);
    }

    public function showCalculator(){
        return view('admin.showCalculator');
    }

    public function filterSalary(Request $request){
        $fromDate = j2g($request->input('fromDate'));
        $toDate = j2g($request->input('toDate'));
        $data['salaries']=DB::table('z_salary')
                                ->join('z_staff','z_staff.id','=','z_salary.staff_id')
                                ->join('z_bank_account','z_bank_account.id','=','z_salary.account_id')
                                ->select('z_salary.cost','z_salary.date','z_bank_account.name','z_staff.name as staff_name')
                                ->whereBetween('z_salary.date',array($fromDate,$toDate))
                                ->get();
        return response()->json(['content'=>view('admin.filter_salary',$data)->render()]);
    }

    public function paySalary(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $isid = $request->input('staffId');
        $transId= $this->randomNumber(7);
        DB::table('z_salary')->whereId($isid)->update(['account_id'=>$request->accounts,'cash'=>$request->cash,'trans_id'=>$transId]);
        DB::table('z_transactions')->insert(['trans_id'=>$transId,'account_id'=>$request->accounts,'cash'=>$request->cash,'type'=>2,'date'=>getCurrentDate()]);
    }
    public function submitchangeorder(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $isid = $request->input('id');
        DB::table('z_orders')->whereId($isid)->update(['status'=>$request->status]);
    }

    public function staffSalary(Request $request){
        $data['staff']=DB::table('z_staff')->whereId($request->input('itemId'))->first();
        $month_ini = new \DateTime("first day of this month");
        $month_end = new \DateTime("last day of this month");

        $fromMonth =  $month_ini->format('Y-m-d');
        $toMonth =  $month_end->format('Y-m-d');
        $data['vacations'] = DB::table('z_vacation')->whereStaffId($request->input('itemId'))->whereCondition(2)->whereBetween('from_date',array($fromMonth,$toMonth))->get();
        $interval=0;
        foreach($data['vacations'] as $vacation){
            $date1 = new \DateTime($vacation->from_date.' '.$vacation->from_time);
            $date2 = new \DateTime($vacation->to_date.' '.$vacation->to_time);
            $int =date_diff($date1,$date2);
            $interval += $int->h;
        }
        $data['vacation_times'] = $interval;
        $data['accounts'] = DB::table('z_bank_account')->where('status',0)->get();
        $data['salarygrid'] = DB::table('z_salary')->where('staff_id',$request->input('itemId'))->get();
        return response()->json(['content'=>view('admin.accounting.salary_info',$data)->render()]);
    }
    public function fillneworders(Request $request){
        $statusval = $request->input('status');
        $value= explode(",",$statusval);
        $now = j2g($request->input('date1'));
        $tonow = $request->input('date2');
        $refid = $request->input('refid');
        if($refid == "") {
            if ($tonow == "0")
                $data['fields'] = DB::table('z_orders')->where('date', $now)->whereIN('status', $value)->get();
            else
                $data['fields'] = DB::table('z_orders')->whereBetween('date', array($now, j2g($tonow)))->whereIN('status', $value)->get();
        }
        else
            $data['fields'] = DB::table('z_orders')->where('refid', $refid)->get();
        return response()->json(['content'=>view('admin.orders.new-fill-orders-main',$data)->render()]);
    }

    public function setPay(Request $request){
        $status = $request->input('state');
        $itemId = $request->input('itemId');
        $payed = $request->input('paye');
        if ($status == 0 && $payed==0) {
            $transId= $this->randomNumber(7);
            DB::table('z_staff_loan')->whereId($itemId)->update(['payed' => 1,'trans_id' => $transId]);
            $loanPay = DB::table('z_staff_loan')->whereId($itemId)->first();
            DB::table('z_transactions')->insert(['trans_id' => $transId,'account_id'=>$loanPay->account_id, 'cash' => $loanPay->amount, 'type' => 3, 'date' => getCurrentDate()]);
        }
        else
        {
            $loanPay = DB::table('z_staff_loan')->whereId($itemId)->first();
            DB::table('z_transactions')->where('trans_id',$loanPay->trans_id)->delete();
            DB::table('z_staff_loan')->whereId($itemId)->update(['payed' => 0,'trans_id' => 0]);
        }
    }

    public function sallarynopay(Request $request){
        $itemId = $request->input('itemId');
         $loanPay = DB::table('z_salary')->whereId($itemId)->first();
         DB::table('z_transactions')->where('trans_id',$loanPay->trans_id)->delete();
         DB::table('z_salary')->whereId($itemId)->update(['account_id' => 0,'trans_id' => 0]);

    }

    public function loans(Request $request){
        $itemId = $request->input('itemId');
        $data['account'] = DB::table('z_bank_account')->get();
        $data['staff_id']=$itemId;
        return response()->json(['content'=>view('admin.hr.loan_summary',$data)->render()]);
    }

    public function addLoan(Request $request){
        $amount = $request->input('amount');
        $account = $request->input('account');
        $loanDate =j2g($request->input('loanDate'));
        $payBackDate = j2g($request->input('payBackDate'));
        $staffId = $request->input('id');
        DB::table('z_staff_loan')->insert(['staff_id'=>$staffId,'account_id'=>$account,'amount'=>$amount,'loan_time'=>getCurrentTime(),
                                           'loan_date'=>$loanDate,'payback_date'=>$payBackDate,'payed'=>0]);
    }

    public function filterFinance(Request $request){
        $fromDate = $request->input('fir');
        $toDate = $request->input('sir');
        $fromDate=j2g($fromDate);
        $toDate=j2g($toDate);
        $data['sales'] =DB::table('z_money')->whereBetween('date',array($fromDate,$toDate))->sum('cash');
        $data['ordersSold'] = DB::table('z_orders')->whereBetween('date',array($fromDate,$toDate))->sum('total_fee');
        $data['cost'] = DB::table('z_costs')->whereBetween('date',array($fromDate,$toDate))->sum('cash');
        return response()->json(['content'=>view('admin.filter_by_finance',$data)->render()]);
    }

    public function filterCost(Request $request){
        $itemId = $request->input('itemId');
        $data['name'] = DB::table('z_transaction_cost')->whereId($itemId)->first();
        $data['details'] = DB::table('z_costs')->whereCostType($itemId)->get();
        $data['total'] = DB::table('z_costs')->whereCostType($itemId)->sum('cash');
        return response()->json(['content'=>view('admin.f_filter',$data)->render()]);
    }

    public function filterMoney(Request $request){
        $itemId = $request->input('itemId');
        $data['name'] = DB::table('z_transaction_money')->whereId($itemId)->first();
        $data['details'] = DB::table('z_money')->whereMoneyType($itemId)->get();
        $data['total'] = DB::table('z_money')->whereMoneyType($itemId)->sum('cash');
        return response()->json(['content'=>view('admin.f_filter',$data)->render()]);
    }

    public function googleMap(Request $request){
        $lat = $request->input('lat');
        $long = $request->input('lang');
        $record = DB::table('z_google_map')->first();
        if (count($record) > 0){
            DB::table('z_google_map')->whereId(1)->update(['lat'=>$lat,'lang'=>$long]);
        }else{
            DB::table('z_google_map')->insert(['lat'=>$lat,'lang'=>$long]);
        }
    }

    public function changeOrderingStatus(Request $request){
        $key = $request->input('key');
        $fields = DB::table('z_service_settings')->get();
        if ($key == "online"){
            if (count($fields) < 1){
                DB::table('z_service_settings')->insert(['service_status'=>1]);
            }else{
                DB::table('z_service_settings')->whereId(1)->update(['service_status'=>1]);
            }
        }else{
            if (count($fields) < 1){
                DB::table('z_service_settings')->insert(['service_status'=>0]);
            }else{
                DB::table('z_service_settings')->whereId(1)->update(['service_status'=>0]);
            }
        }
        return response()->json(['content'=>' ']);
    }

    public function mPrint($id){
        $order = DB::table('z_orders')->whereId($id)->first();
        $data['user'] = DB::table('z_users')->whereId($order->user_id)->first();
        $foodOrders = DB::table('z_food_orders')->whereOrderId($order->id)->get();
        foreach($foodOrders as $foodOrder){
            $foodNames[]=DB::table('z_foods')->whereId($foodOrder->food_id)->first();
        }
        $data['order'] = $order;
        $data['foodOrders'] = $foodOrders;
        $data['foodNames'] = $foodNames;

        return view('admin.print',$data);
    }

    public function ServiceSettings(Request $request){
        $fields = DB::table('z_service_settings')->get();
        if (count($fields) > 0){
            $failure = $request->input('failure');
            $startTime = $request->input('startTime');
            $endTime = $request->input('endTime');
            DB::table('z_service_settings')->whereId(1)->update(['start_time'=>$startTime,'end_time'=>$endTime,'service_failure'=>$failure]);
        }else {
            $failure = $request->input('failure');
            $startTime = $request->input('startTime');
            $startTime = $startTime .':00:00';
            $endTime = $request->input('endTime');
            if ($endTime == '24'){
                $endTime = "00";
            }
            $endTime= $endTime.':00:00';
            DB::table('z_service_settings')->insert(['start_time' => $startTime, 'end_time' => $endTime, 'service_failure' => $failure]);
        }
    }

    public function orderPaymentType(Request $request){
        $orderType = $request->input('orderType');
        $paymentType = $request->input('paymentType');
        DB::table('z_order_payment_type')->insert(['order_type'=>$orderType,'payment_type'=>$paymentType]);
    }

    public function insertSiteInfo(Request $request){
        $site_name = $request->input('website_name');
        $site_title= $request->input('website_title');
        $tel = $request->input('website_tel');
        $desc = $request->input('desc');
        $email = $request->input('website_email');
        $logo = $request->file('logo');
        $header = $request->file('header');
        $area = $request->file('area');
        $areaPath = $this->uploadFile($area,'info');
        $logoPath = $this->uploadFile($logo,'info');
        $headerPath = $this->uploadFile($header,'info');
        $fields = DB::table('z_site_info')->get();
        if (count($fields) > 0){
            DB::table('z_site_info')->whereId(1)->update(['site_name'=>$site_name,'site_title'=>$site_title,'desc'=>$desc,'tel'=>$tel,'email'=>$email,'logo'=>$logoPath,'header'=>$headerPath,'area'=>$areaPath]);
        }else{
            DB::table('z_site_info')->insert(['site_name'=>$site_name,'site_title'=>$site_title,'desc'=>$desc,'tel'=>$tel,'email'=>$email,'logo'=>$logoPath,'header'=>$headerPath,'area'=>$areaPath]);
        }
        return redirect('/admin/adminhome');
    }

    public function newPanelUser(Request $request){
        $name  = $request->input('admin_name');
        $phone = $request->input('admin_phone');
        $email = $request->input('admin_mail');
        $userName = $request->input('admin_user');
        $password = $request->input('admin_pass');
        DB::table('z_admins')->insert(['name'=>$name,'tel'=>$phone,'username'=>$userName,'password'=>$password,'email'=>$email]);
    }

    public function deactivateField(Request $request){
        $id = $request->input('id');
        DB::table('z_user_fields')->whereId($id)->update(['enabled'=>0]);
        return response()->json(['content'=>' ']);
    }

    public function activateField(Request $request){
        $id = $request->input('id');
        DB::table('z_user_fields')->whereId($id)->update(['enabled'=>1]);
        return response()->json(['content'=>' ']);
    }

    public function addRegisterField(Request $request){
        $is_required = $request->input('required');
        if ($is_required == 'on'){
            $required  = 1;
        }else{
            $required=0;
        }
        $defvalue = $request->input('defvalue');
        $dropDownValues = $request->input('dropdownValue');
        $values = "";
        if (isset($dropDownValues) && $dropDownValues !=''){
            foreach($dropDownValues as $dropDownValue){
                if ($dropDownValue == ''){
                    continue;
                }
                $values .='|'.$dropDownValue.'|';
            }
            DB::table('z_user_fields')->insert(['field_type_id'=>$request->field_type,'en_name'=>$request->en_name,'title'=>$request->title,'default_value'=>$values,'required'=>$required,'enabled'=>1]);
        }else{
            DB::table('z_user_fields')->insert(['field_type_id'=>$request->field_type,'en_name'=>$request->en_name,'title'=>$request->title,'default_value'=>$defvalue,'required'=>$required,'enabled'=>1]);
        }
    }

    public function addSocialMediaAddress(Request $request){
        $isEdit = $request->input('edit');
        if (isset($isEdit) && $isEdit!=""){
            DB::table('z_social_sites')->whereId($isEdit)->update(['title'=>$request->title,'icon'=>$request->icon,'url'=>$request->url]);
        }else{
            DB::table('z_social_sites')->insert(['title'=>$request->title,'icon'=>$request->icon,'url'=>$request->url]);
        }
    }


    public function areaImageUpload(Request $request){
        $titles = $request->input('title');
        $desc = $request->input('desc');
        $images = $request->file('image');
        for($i=0;$i<count($titles);$i++){
            $filePath = $this->uploadFile($images[$i],'area');
            DB::table('z_area_pics')->insert(['title'=>$titles[$i],'desc'=>$desc[$i],'path'=>$filePath]);;
        }
        return redirect('/admin/adminhome');
    }

    public function insertAfterBuyCoupon(Request $request){
      $code = $request->input('code');
      $expire = j2g($request->input('expiration_date'));
      $valid_date = $request->input('valid_date');
      $from_fee = $request->input('from_fee');
      $to_fee = $request->input('to_fee');
      $amount_type = $request->input('amount_type');
      $amount = $request->input('amount');


      if (empty($valid_date)){
        return response()->json(['content'=>"لطفا مدت اعتبار را مشخص نمایید."]);
      }
      if (empty($expire)){
        return response()->json(['content'=>"لطفا تاریخ انقضا را وارد نمایید."]);
      }
      if (empty($code) || $code==""){
        $code = $this->randomNumber(8);
      }

      if (empty($to_fee) || !isset($to_fee)){
        $to_fee='100000000';
      }

      DB::table('z_coupons_after_buy')->insert(['code'=>$code,'expire'=>$expire,'valid_date'=>$valid_date,'from_fee'=>$from_fee,'to_fee'=>$to_fee,'type'=>$amount_type,'amount'=>$amount]);
      return response()->json(['content'=>"کد تخفیف : $code"]);
    }

    public function insertCoopen(Request $request){
      $code = $request->input('code');
      $expire = j2g($request->input('expiration_date'));
      $from_fee = $request->input('from_fee');
      $to_fee = $request->input('to_fee');
      $amount_type = $request->input('amount_type');
      $amount = $request->input('amount');

      if (empty($expire)){
        return response()->json(['content'=>"لطفا تاریخ انقضا را وارد نمایید."]);
      }
      if (empty($code) || $code==""){
        $code = $this->randomNumber(8);
      }

      if (empty($to_fee) || !isset($to_fee)){
        $to_fee='100000000';
      }

      DB::table('z_coupons_on_buy')->insert(['code'=>$code,'expire'=>$expire,'from_fee'=>$from_fee,'to_fee'=>$to_fee,'type'=>$amount_type,'amount'=>$amount]);
      return response()->json(['content'=>"کد تخفیف : $code"]);
    }

    public function searchCoopen(Request $request){
        $number = $request->input('num');
        $data ['fields'] = DB::table('z_discounts')->where('coopen_id','like',$number)->get();
        foreach($data['fields'] as $field){
            $gDate = $field->exp_date;
            $gDate = explode('-',$gDate);
            $jDates[] = gregorian_to_jalali($gDate[0],$gDate[1],$gDate[2],'/');
        }
        $data['dates'] = $jDates;
        $view = view('admin.userclub.all-coopens',$data)->renderSections();
        return response()->json(['content'=>$view['coops']]);
    }

    public function changeCoopenState(Request $request){
        $itemId = $request->input('itemId');
        DB::table('z_discounts')->whereId($itemId)->update(['enabled'=>0]);
        return response()->json(['content'=>'Success']);
    }

    public function activateCoopenState(Request $request){
        $itemId = $request->input('itemId');
        DB::table('z_discounts')->whereId($itemId)->update(['enabled'=>1]);
        return response()->json(['content'=>'Success']);
    }

    public function accessGroup(Request $request){
        $allAccess = $request->all();
        $accessList = "";
        $user_id = $request->input('user_id');
        if (isset($allAccess['all'])){
            DB::table('z_access_group')->insert(['admin_id'=>$user_id,'access_list'=>'all']);
        }else{
            foreach($allAccess as $key=>$value){
                if ($value=='on'){
                    $key = $this->removeUnderScores($key);
                    $accessList .='|'.$key.'|';
                }
            }
            DB::table('z_access_group')->insert(['admin_id'=>$user_id,'access_list'=>$accessList]);
        }
    }

    private function removeUnderScores($var){
        $var = explode('_',$var);
        $var = implode(' ',$var);
        return $var;
    }

    public function insertVote(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $question = $request->input('question');
        $questionId = DB::table('z_vote_question')->insertGetId(['title'=>$question,'enable'=>1]);
        $answers = $request->input('answers');
        foreach($answers as $answer){
            DB::table('z_vote_answer')->insert(['title'=>$answer,'q_id'=>$questionId]);
        }
    }

    public function deleteVote(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $questionId = $request->input('id');
        DB::table('z_votes')->whereQId($questionId)->delete();
        DB::table('z_vote_question')->whereId($questionId)->delete();
        DB::table('z_vote_answer')->whereQId($questionId)->delete();
        return response()->json(['content'=>'سطر مورد نظر با موفقیت حدف شد.']);
    }

    public function voteDetails(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $questionId  = $request->input('id');
        $data['votes']=DB::table('z_votes')
                    ->leftJoin('z_vote_question','z_votes.q_id','=','z_vote_question.id')
                    ->leftJoin('z_vote_answer','z_votes.answer_id','=','z_vote_answer.id')
                    ->leftJoin('z_users','z_votes.user_id','=','z_users.id')
                    ->select('z_vote_answer.title as ansTitle','z_users.name as user_name','z_votes.date',
                             'z_votes.time',DB::raw('COUNT(z_votes.answer_id) as voteSum'))
                    ->where('z_votes.q_id',$questionId)
                    ->groupBy('z_votes.id')
                    ->get();
        return response()->json(['content'=>view('admin.userclub.vote-chart',$data)->render()]);
    }

    public function insertStaffFood(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $title = $request->input('title');
        $desc = $request->input('desc');
        $foodId = DB::table('z_staff_food_list')->insertGetId(['title'=>$title,'desc'=>$desc]);

        $materialGroups = $request->input('group');
        $materialCounts = $request->input('count');
        $i=0;
        foreach($materialGroups as $matGroup){
            DB::table('z_staff_food_material')->insert(['mat_id'=>$matGroup,'staff_food_id'=>$foodId,'amount'=>$materialCounts[$i]]);
            $i++;
        }
        return redirect('/admin/adminhome');
    }

    public function firstStateStaffOrder(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $foodId = $request->input('foodId');
        $count = $request->input('count');
        $food_name = DB::table('z_foods')->whereId($foodId)->first();
        $materials = DB::table('z_food_material')
                                    ->leftJoin('z_materials','z_food_material.material_id','=','z_materials.id')
                                    ->whereFoodId($foodId)
                                    ->select('z_food_material.amount','z_food_material.material_id','z_materials.unit_price')
                                    ->get();
        $totalPrice=0;
        foreach($materials as $material){
            $amount = $material->amount*$count;
            $mat = DB::table('z_materials')->whereId($material->material_id)->first();
            $finalAmount =$mat->amount-$amount;
            DB::table('z_materials')->whereId($material->material_id)->update(['amount'=>$finalAmount]);
            $totalPrice += $material->unit_price;
        }
        $totalPrice *=$count;
        $currentDate = getCurrentDate();
        $transId = $this->randomNumber(7);
        $account = 2;
        DB::table('z_staff_orders')->insert(['food_id'=>$foodId,'food_name'=>$food_name->title,
                                            'count'=>$count,'type'=>1,'date'=>$currentDate,'time'=>getCurrentTime(),
                                            'trans_id'=>$transId,'cost'=>$totalPrice]);
        DB::table('z_transactions')->insert(['trans_id'=>$transId,'account_id'=>$account,'type'=>6,'cash'=>$totalPrice
                                            ,'date'=>getCurrentDate(),'time'=>getCurrentTime()]);
    }

    public function secondStateStaffOrder(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $foodname = $request->input('foodname');
        $count = $request->input('count2');
        $cost = $request->input('cost');
        $currentDate = getCurrentDate();
        $transId= $this->randomNumber(7);
        $account = $request->input('account_id');
        DB::table('z_staff_orders')->insert(['food_name'=>$foodname,'count'=>$count,'cost'=>$cost,
                                             'type'=>3,'date'=>$currentDate,'time'=>getCurrentTime(),'trans_id'=>$transId]);
        DB::table('z_transactions')->insert(['trans_id'=>$transId,'account_id'=>$account,'type'=>6,'cash'=>$cost,
                                             'date'=>$currentDate,'time'=>getCurrentTime()]);
    }

    public function thirdStateStaffOrder(Request $request){
        if (!$this->isAdmin()){
            return;
        }

        $groups = $request->input('group');
        $counts = $request->input('count');
        $trans_id = $this->randomNumber(7);
        $account= 3;
        $i=0;
        $totalPrice=0;
        foreach($groups as $group){
            $name = DB::table('z_materials')->whereName($group)->first();
            //$mat = DB::table('z_food_material')->where('material_id',$name->id)->first();
            $price = $name->unit_price*$counts[$i];
            $totalPrice +=$price;
            $remainedAmount = $name->amount-$counts[$i];
            DB::table('z_materials')->whereId($name->id)->update(['amount'=>$remainedAmount]);
            DB::table('z_staff_orders')->insert(['food_id'=>0,'food_name'=>$name->name,'count'=>$counts[$i],'cost'=>$price,
                                                 'type'=>2,'date'=>getCurrentDate(),'time'=>getCurrentTime(),
                                                 'trans_id'=>$trans_id]);
            $i++;
        }
        DB::table('z_transactions')->insert(['trans_id'=>$trans_id,'account_id'=>$account,'type'=>6,
                                             'cash'=>$totalPrice,'date'=>getCurrentDate(),'time'=>getCurrentTime()]);
    }

    public function insertStaffOrder(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $foodId = $request->input('foodName');
        $count = $request->input('count');
        $currentDate = getCurrentDate();
        DB::table('z_staff_orders')->insert(['staff_food_id'=>$foodId,'count'=>$count,'date'=>$currentDate]);

        $materials = DB::table('z_staff_food_material')->whereStaffFoodId($foodId)->get();
        foreach($materials as $material){
            $mat = DB::table('z_materials')->whereId($material->mat_id)->first();
            $off = $count * $material->amount;
            $amount = $mat->amount - $off;
            DB::table('z_materials')->whereId($material->mat_id)->update(['amount'=>$amount]);
        }

    }

    public function findUnit(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $unitName =DB::table('z_material_unit')->whereId($request->input('key'))->first();
        return response()->json(['content'=>$unitName->title]);
    }

    public function unitForm(Request $request){
        if (!$this->isAdmin()){
            return;
        }

        $id = $request->input('itemId');
        if (isset($id) && $id!=""){
            $data['unit']=DB::table('z_material_unit')->whereId($id)->first();
            return response()->json(['content'=>view('admin.warehousing.insert-unit',$data)->render()]);
        }else{
            return response()->json(['content'=>view('admin.warehousing.insert-unit')->render()]);
        }
    }

    public function submitUnit(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $title = $request->input('title');
        $desc = $request->input('desc');
        $isEdit = $request->input('edit');
        if (isset($isEdit) && $isEdit!=""){
            DB::table('z_material_unit')->whereId($isEdit)->update(['title'=>$title,'desc'=>$desc]);
        }else{
            DB::table('z_material_unit')->insert(['title'=>$title,'desc'=>$desc]);
        }
    }

    public function searchInventory(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $filter = $request->input('key');
        $field = DB::table('z_materials')->where('name','like',$filter)->first();
        $unit = DB::table('z_material_unit')->whereId($field->unit_id)->first();
        $data['field'] = $field;
        $data['units'] = $unit;
        $view = view('admin.warehousing.warehouse-inventory',$data)->renderSections();
        return response()->json(['content'=>$view['content']]);
    }

    public function transForm(){
        if (!$this->isAdmin()){
            return;
        }
        $data['accounts'] = DB::table('z_bank_account')->where('status',0)->get();
        return response()->json(['content'=>view('admin.accounting.new-transaction',$data)->render()]);
    }

    public function insertTrans(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $cash = $request->input('cash');
        $desc = $request->input('desc');
        $fromBank = $request->input('fromBank');
        $toBank = $request->input('toBank');
        $currentDate = getCurrentDate();
        $this->performAccountsTransaction($cash,$fromBank,$toBank);
        DB::table('z_account_transaction')->insert(['source_account'=>$fromBank,'dest_account'=>$toBank,'cash'=>$cash,'desc'=>$desc,'date'=>$currentDate]);
    }

    /**
     * @param $cash - income and outcome cash
     * @param $fromBank - source bank account
     * @param $toBank - destination bank account
     */
    private function performAccountsTransaction($cash,$fromBank,$toBank){
        if (!$this->isAdmin()){
            return;
        }
        $sourceAccount = DB::table('z_bank_account')->whereId($fromBank)->first();
        $sourceCash = $sourceAccount->cash - $cash;
        DB::table('z_bank_account')->whereId($fromBank)->update(['cash'=>$sourceCash]);
        $destAccount = DB::table('z_bank_account')->whereId($toBank)->first();
        $destCash = $destAccount->cash + $cash;
        DB::table('z_bank_account')->whereId($toBank)->update(['cash'=>$destCash]);
    }

    public function submitAccountForm(){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.accounting.new-account')->render()]);
    }

    public function submitAccount(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $name = $request->input('name');
        $accountNumber = $request->input('acc_number');
        $sheba = $request->input('sheba');
        $accountType = $request->input('acc_type');
        $cardNumber = $request->input('card_number');
        $check = $request->input('is_check');
        $isEdit = $request->input('edit');
        if (isset($isEdit) && $isEdit!=""){
            DB::table('z_bank_account')->whereId($isEdit)->update(['name'=>$name,'account_number'=>$accountNumber,'sheba_number'=>$sheba,'account_type'=>$accountType,'card_number'=>$cardNumber,'check'=>$check]);
        }else{
            DB::table('z_bank_account')->insert(['name'=>$name,'account_number'=>$accountNumber,'sheba_number'=>$sheba,'account_type'=>$accountType,'card_number'=>$cardNumber,'check'=>$check,'cash'=>0]);
        }
    }
    public function editaccount($id){
        $data['account'] = DB::table('z_bank_account')->whereId($id)->first();
        return response()->json(['content'=>view('admin.accounting.new-account',$data)->render()]);
    }
    public function editccoupon($id){
        $data['fields'] = DB::table('z_coupons_on_after_buy')->whereId($id)->first();
        return response()->json(['content'=>view('admin.userclub.new-c-coupon',$data)->render()]);
    }

    public function deleteaccount(Request $request){
        $id = $request->input('itemId');
        DB::table('z_bank_account')->whereId($id)->where('cash',0)->update(['status'=>1]);
    }
    public function backaccount(Request $request){
        $id = $request->input('itemId');
        DB::table('z_bank_account')->whereId($id)->update(['status'=>0]);
    }

    public function deletestore(Request $request){
        $id = $request->input('itemId');
        DB::table('z_storages')->whereId($id)->update(['status'=>1]);
    }

    public function deletematcat(Request $request){
        $id = $request->input('itemId');
        DB::table('z_material_cat')->whereId($id)->update(['status'=>1]);
    }

    public function costTypeForm(){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.accounting.new-cost-type-form')->render()]);
    }

    public function addcoupons(){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.userclub.new-coupon')->render()]);
    }
    
    public function newsaveorderroute(){
        if (!$this->isAdmin()){
            return;
        }
        $data['menu'] = DB::table('z_food_cats')->get();
        return response()->json(['content'=>view('admin.orders.new-save-order',$data)->render()]);
    }
    public function newaddpersonel(){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.hr.new_personel')->render()]);
    }

    public function addfoodcat(){
        if (!$this->isAdmin()){
            return;
        }
        $data['subsets'] = DB::table('z_res_subset')->where('status',0)->get();
        return response()->json(['content'=>view('admin.setting.new-food-category',$data)->render()]);
    }
    public function addfood(){
        if (!$this->isAdmin()){
            return;
        }
        $data['menus'] = food::getMenuList();
        $data['materials'] = DB::table('z_materials')->leftJoin('z_storages','z_materials.storage_id','=','z_storages.id')
            ->select('z_materials.name','z_materials.mat_ref','z_storages.title as storageName','z_materials.id')
            ->get();
        $data['units'] = food::getAllUnits();
        $data['subset'] = DB::table('z_res_subset')->where('status',0)->get();
        return response()->json(['content'=>view('admin.setting.new-food',$data)->render()]);
    }

    public function newccoupon(){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.userclub.new-c-coupon')->render()]);
    }

    public function editstore($id){
        if (!$this->isAdmin()){
            return;
        }
        $data['store'] = DB::table('z_storages')->whereId($id)->first();
        $data['substore'] = DB::table('z_storages')->where('status',0)->get();
        return response()->json(['content'=>view('admin.warehousing.new-store-form',$data)->render()]);
    }

    public function editcoupon($id){
        if (!$this->isAdmin()){
            return;
        }
        $data['coupon'] = DB::table('z_coupons')->whereId($id)->first();
        return response()->json(['content'=>view('admin.userclub.new-coupon',$data)->render()]);
    }

    public function editressubset($id){
        if (!$this->isAdmin()){
            return;
        }
        $data['fields'] = DB::table('z_res_subset')->whereId($id)->first();
        return response()->json(['content'=>view('admin.setting.new-res-subset',$data)->render()]);
    }
    public function edtfoodcat($id){
        if (!$this->isAdmin()){
            return;
        }
        $data['fields'] = DB::table('z_food_cats')->whereId($id)->first();
        $data['subsets'] = DB::table('z_res_subset')->where('status',0)->get();
        return response()->json(['content'=>view('admin.setting.new-food-category',$data)->render()]);
    }

    public function editsocialmedia($id){
        if (!$this->isAdmin()){
            return;
        }
        $data['socialmedia'] = DB::table('z_social_sites')->whereId($id)->first();
        return response()->json(['content'=>view('admin.userclub.new-social-media',$data)->render()]);
    }

    public function editcustomers($id){
        if (!$this->isAdmin()){
            return;
        }
        $data['customer'] = DB::table('z_users')->whereId($id)->first();
        return response()->json(['content'=>view('admin.userclub.new_user',$data)->render()]);
    }

    public function submitCostType(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $isEdit = $request->input('edit');
        if(isset($isEdit) && $isEdit!=""){
            DB::table('z_trans_sub_type')->whereId($isEdit)->update(['parent_id'=>1,'title'=>$request->title,'desc'=>$request->desc]);
        }else{
            DB::table('z_trans_sub_type')->insert(['parent_id'=>1,'title'=>$request->title,'desc'=>$request->desc]);
        }
    }

    public function submitordernew(Request $request)
    {
        if (!$this->isAdmin()) {
            return;
        }
        $currentDate = date('Y-m-d');
        $trans_id = $this->randomNumber(7);
        if ($request->input('sbscode') != null AND $request->input('sbscode') != 0) {
            $user = DB::table('z_users')->whereCctt($request->input('sbscode'))->first();
            $userid = $user->id;
        }
        else
            $userid=0;
        $orders = DB::table('z_orders')->where('date',$currentDate)->get();
        $queue = count($orders);
        $totalFee = $request->input('total');
        $tableNo = $request->input('tableNo');
        $times = date("G:i");
        $getstatus = DB::table('z_order_status')->where('isdefault',1)->first();
        $orderId = DB::table('z_orders')->insertGetId(['user_id' => $userid,'refid'=>$trans_id,'queue'=>($queue+1),'total_fee'=>$totalFee,'time'=>$times,'order_set'=>$tableNo,'date'=>$currentDate,'status'=>$getstatus->id]);
         DB::table('z_transactions')->insert(['trans_id'=>$trans_id,'account_id'=>1,'cash'=>$totalFee,'type'=>1,'date'=>$currentDate]);
         $accountCash = DB::table('z_bank_account')->whereId(1)->first();
         $cash = $accountCash->cash;
         $cash +=$totalFee;
         DB::table('z_bank_account')->whereId(1)->update(['cash'=>$cash]);

        $menu = DB::table('z_food_cats')->get();
            foreach ($menu as $menus) {
                $food = DB::table('z_foods')->where('cat_id',$menus->id)->get();
                foreach ($food as $foodsmenu) {
                    if($request->input('price'.$foodsmenu->id)!=0)
                    {
                        DB::table('z_food_orders')->insert(['order_id'=>$orderId,'factor_id'=>$trans_id,'foodcount'=>$request->input('price'.$foodsmenu->id),'food_id'=>$foodsmenu->id]);
                    }
                }
            }
    }

    public function deletecosttype(Request $request){
        $id = $request->input('itemId');
        DB::table('z_trans_sub_type')->whereId($id)->update(['status'=>1]);
    }

    public function deleteressubset(Request $request){
        $id = $request->input('itemId');
        DB::table('z_res_subset')->whereId($id)->update(['status'=>1]);
    }

    public function deletesocialmedia(Request $request){
        $id = $request->input('itemId');
        DB::table('z_social_sites')->whereId($id)->delete();
    }

    public function deletecustomers(Request $request){
        $id = $request->input('itemId');
        DB::table('z_users')->whereId($id)->update(['status'=>1]);
    }

    public function backcosttype(Request $request){
        $id = $request->input('itemId');
        DB::table('z_trans_sub_type')->whereId($id)->update(['status'=>0]);
    }


    public function newMoneyTypeForm(){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.accounting.new-money-type-form')->render()]);
    }

    public function submitMoneyType(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $isEdit = $request->input('edit');
        if (isset($isEdit) && $isEdit != ""){
            DB::table('z_trans_sub_type')->whereId($isEdit)->update(['parent_id'=>2,'title'=>$request->title,'desc'=>$request->desc]);
        }else{
            DB::table('z_trans_sub_type')->insert(['parent_id'=>2,'title'=>$request->title,'desc'=>$request->desc]);
        }
    }

    public function submitusercustomer(){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.userclub.new_user')->render()]);
    }

    public function deletemoneytype(Request $request){
        $id = $request->input('itemId');
        DB::table('z_trans_sub_type')->whereId($id)->update(['status'=>1]);
    }
    public function backmoneytype(Request $request){
        $id = $request->input('itemId');
        DB::table('z_trans_sub_type')->whereId($id)->update(['status'=>0]);
    }

    public function newCostForm(){
        if (!$this->isAdmin()){
            return;
        }
        $data['fields'] = DB::table('z_trans_sub_type')->whereParentId(1)->where('status',0)->get();
        $data['accounts'] = DB::table('z_bank_account')->where('status',0)->get();
        return response()->json(['content'=>view('admin.accounting.new-cost-form',$data)->render()]);
    }

    public function submitCost(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $cash = $request->input('cash');
        $desc = $request->input('desc');
        $currentDate = getCurrentDate();
        $group = $request->input('group');
        $bank = $request->input('bank');
        $bankId = DB::table('z_bank_account')->whereId($bank)->first();
        $newCash = $bankId->cash - $cash;
        DB::table('z_bank_account')->whereId($bank)->update(['cash'=>$newCash]);
        $transId = $this->randomNumber(7);
        $isEdit = $request->input('edit');
        if (isset($isEdit) && $isEdit!=""){
            DB::table('z_transactions')->whereId($isEdit)->update(['trans_id'=>$transId,'type'=>$group,'cash'=>$cash
                ,'date'=>$currentDate,'time'=>getCurrentTime()
                ,'desc'=>$desc,'account_id'=>$bank]);
        }else{
            DB::table('z_transactions')->insert(['trans_id'=>$transId,'type'=>$group,'cash'=>$cash
                ,'date'=>$currentDate,'time'=>getCurrentTime()
                ,'desc'=>$desc,'account_id'=>$bank]);
        }
    }

    public function editregfield(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $isEdit = $request->input('edit');
        $is_required = $request->input('required');
        if ($is_required == 'on'){
            $required  = 1;
        }else{
            $required=0;
        }
        $defvalue = $request->input('defvalue');
        $dropDownValues = $request->input('dropdownValue');
        $values = "";
        if (isset($dropDownValues) && $dropDownValues !=''){
            foreach($dropDownValues as $dropDownValue){
                if ($dropDownValue == ''){
                    continue;
                }
                $values .='|'.$dropDownValue.'|';
            }

            DB::table('z_user_fields')->whereId($isEdit)->update(['field_type_id'=>$request->field_type,'en_name'=>$request->en_name,'title'=>$request->title,'default_value'=>$values,'required'=>$required,'enabled'=>1]);
        }else{
            DB::table('z_user_fields')->whereId($isEdit)->update(['field_type_id'=>$request->field_type,'en_name'=>$request->en_name,'title'=>$request->title,'default_value'=>$defvalue,'required'=>$required,'enabled'=>1]);
        }
    }

    public function deletecost(Request $request){
        $id = $request->input('itemId');
        DB::table('z_transactions')->whereId($id)->delete();
    }

    public  function newIncomeForm(){
        if (!$this->isAdmin()){
            return;
        }
        $data['fields']= DB::table('z_trans_sub_type')->whereParentId(2)->where('status',0)->get();
        $data['accounts'] = DB::table('z_bank_account')->where('status',0)->get();
        return response()->json(['content'=>view('admin.accounting.new-income-form',$data)->render()]);
    }

    public function submitIncome(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $cash = $request->input('cash');
        $desc = $request->input('desc');
        $currentDate = getCurrentDate();
        $group = $request->input('group');
        $bank = $request->input('bank');
        $isEdit = $request->input('edit');
        $bankId = DB::table('z_bank_account')->whereId($bank)->first();
        $newCash = $bankId->cash + $cash;
        DB::table('z_bank_account')->whereId($bank)->update(['cash'=>$newCash]);
        $trans_id = $this->randomNumber(7);
        if (isset($isEdit) && $isEdit!=""){
            DB::table('z_transactions')->whereId($isEdit)->update(['trans_id'=>$trans_id,'cash'=>$cash,'date'=>$currentDate,'time'=>getCurrentTime(),
                'account_id'=>$bank,'type'=>$group,'desc'=>$desc]);
        }else{
            DB::table('z_transactions')->insert(['trans_id'=>$trans_id,'cash'=>$cash,'date'=>$currentDate,'time'=>getCurrentTime(),
                'account_id'=>$bank,'type'=>$group,'desc'=>$desc]);
        }
    }

    public function deleteincome(Request $request){
        $id = $request->input('itemId');
        DB::table('z_transactions')->whereId($id)->delete();
    }



    public function ordersAutoGetNew(){
        if (!$this->isAdmin()){
            return;
        }
        $data['fields'] = $this->loadOrders();
        return response()->json(['content'=>view('admin.orders.new-orders',$data)->render()]);
    }

    public function changeCondition(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        if ($request->type == 'accept'){
            DB::table('z_vacation')->whereId($request->staff_id)->update(['condition'=>2]);
        }else{
            DB::table('z_vacation')->whereId($request->staff_id)->update(['condition'=>3]);
        }
        $data = $this->getStaffVacations();
        return response()->json(['content'=>view('admin.hr.new-leave',$data)->render()]);
    }

    public function newLeave(){
        if (!$this->isAdmin()){
            return;
        }
        $data['fields'] = DB::table('z_staff')->get();
        return response()->json(['content'=>view('admin.hr.submit-leave-form',$data)->render()]);
    }

    public function addMatCat(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.warehousing.new_material_cat')->render()]);
    }

    public function newsocialmedia(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.userclub.new-social-media')->render()]);
    }

    public function submitstorewarehouse(){
        if (!$this->isAdmin()){
            return;
        }
        $data['substore'] = DB::table('z_storages')->where('status',0)->get();
        return response()->json(['content'=>view('admin.warehousing.new-store-form',$data)->render()]);
    }

    public function submitmatexchange(){
        if (!$this->isAdmin()){
            return;
        }
        $data['storages'] = DB::table('z_storages')->where('status',0)->get();
        return response()->json(['content'=>view('admin.warehousing.mat-exchange',$data)->render()]);
    }


    public function addmaterial(){
        if (!$this->isAdmin()){
            return;
        }
        $data['fields'] = DB::table('z_material_cat')->where('status',0)->get();
        $data['storages'] = DB::table('z_storages')->where('status',0)->get();
        $data['accounts'] = DB::table('z_bank_account')->where('status',0)->get();
        $data['units'] = DB::table('z_material_unit')->where('status',0)->get();
        return response()->json(['content'=>view('admin.warehousing.new_material',$data)->render()]);
    }

    public function editMaterialGroup($id){
        if (!$this->isAdmin()){
            return;
        }
        $data['mat'] = DB::table('z_material_cat')->whereId($id)->first();
        return response()->json(['content'=>view('admin.warehousing.new_material_cat',$data)->render()]);
    }

    public function updateMaterialGroup(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $isEdit = $request->input('edit');
        if(isset($isEdit) && $isEdit!=""){
            DB::table('z_material_cat')->whereId($isEdit)->update(['title'=>$request->title,'desc'=>$request->desc]);
        }else{
            DB::table('z_material_cat')->insert(['title'=>$request->title,'desc'=>$request->desc]);
        }
    }

    public function editMaterial($id){
        if (!$this->isAdmin()){
            return;
        }
        $matId = DB::table('z_materials')->whereId($id)->first();
        $group = DB::table('z_material_cat')->whereId($matId->cat_id)->first();
        $unit = DB::table('z_material_unit')->whereId($matId->unit_id)->first();
        $data['allGroups'] = DB::table('z_material_cat')->get();
        $data['allUnits'] = DB::table('z_material_unit')->get();
        $data['materials'] = $matId;
        $data['group'] = $group;
        $data['unit'] = $unit;
        return response()->json(['content'=>view('admin.warehousing.edit_material',$data)->render()]);
    }

    public function updateMaterial(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $isEdit = $request->id;
        $expDate = $request->exp_date0;
        DB::table('z_materials')->whereId($isEdit)->update(['name'=>$request->matTitle,'amount'=>$request->count,'cat_id'=>$request->grouping,
                                                        'unit_id'=>$request->uniting,'exp_date'=>j2g($expDate)]);
    }

    public function submitNewMaterial(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $trans_id = $this->randomNumber(7);
        $date = date('Y-m-d',strtotime('+'.$request->exp_date.' day'));
        DB::table('z_materials')->insert(['name'=>$request->name,'amount'=>$request->amount,'cat_id'=>$request->group,'unit_id'=>$request->unit,'exp_date'=>$date,'price'=>$request->totalPrice,'unit_price'=>$request->priceForUnit,'storage_id'=>$request->storage,'mat_ref'=>$request->productId]);
       DB::table('z_transactions')->insert(['trans_id'=>$trans_id,'account_id'=>$request->account,'type'=>7,'cash'=>$request->totalPrice,'date'=>getCurrentDate(),'time'=>getCurrentTime()]);

    }

    public function getStaffVacations(){
        if (!$this->isAdmin()){
            return;
        }
        $data['fields'] = DB::table('z_vacation')->orderBy('id','DESC')->get();
        $staffName=array();
        $conditions = array();
        $colors=array();
        foreach($data['fields'] as $field){
            $staffName[] = DB::table('z_staff')->whereId($field->staff_id)->first();
            $conditions[] = DB::table('z_vacation_condition')->whereId($field->condition)->first();
            if ($field->condition == '1'){
                $colors[] = '#ff0';
            }else if ($field->condition == '2'){
                $colors[] = '#0f0';
            }else if($field->condition == '3'){
                $colors[] = '#f00';
            }
        }
        $data['colors']=$colors;
        $data['staff_name'] = $staffName;
        $data['condition'] = $conditions;
        return $data;
    }
    public function validateStaff(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $staff_name = $request->input('satff_name');
        $staff = DB::table('z_staff')->whereName($staff_name)->first();
        if (count($staff)>0){
            return response()->json(['content'=>'&nbsp;']);
        }else{
            return response()->json(['content'=>'نام کارمند وارد شده موجود نمی باشد']);
        }
    }

    public function insertLeave(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $staff_id = $request->input('name');
        $fromDate = $request->input('fromDate');
        $fromDate = explode('/',$fromDate);
        $fromGdate = jalali_to_gregorian($fromDate[0],$fromDate[1],$fromDate[2],'-');
        $toDate = $request->input('toDate');
        $toDate = explode('/',$toDate);
        $toGdate = jalali_to_gregorian($toDate[0],$toDate[1],$toDate[2],'-');
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $desc = $request->input('desc');
        DB::table('z_vacation')->insert(['staff_id'=>$staff_id,'from_date'=>$fromGdate,'to_date'=>$toGdate,'from_time'=>$fromTime,'to_time'=>$toTime,'desc'=>$desc,'condition'=>1]);
    }

    public function newPersonel(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $workHours = $request->input('workHours');
        $maxVacations = $request->input('vacations');
        $payDay = $request->input('paydayMonth');
        $isEdit = $request->input('edit');
        if (isset($isEdit) && $isEdit!=""){
            DB::table('z_staff')->whereId($isEdit)->update(['name'=>$request->name,'father_name'=>$request->father,'ssid'=>$request->ssid,'work_hours'=>$workHours,'max_vacation'=>$maxVacations,'national_code'=>$request->nationalCode,'birthday'=>$request->birthday,'insurance_code'=>$request->insurance,'last_worked'=>$request->lastWork,'position'=>$request->position,'bg_date'=>$request->bgDate,'en_date'=>$request->enDate,'salary'=>$request->salary,'payday'=>$payDay]);
        }else{
            DB::table('z_staff')->insert(['name'=>$request->name,'father_name'=>$request->father,'ssid'=>$request->ssid,'work_hours'=>$workHours,'max_vacation'=>$maxVacations,'national_code'=>$request->nationalCode,'birthday'=>$request->birthday,'insurance_code'=>$request->insurance,'last_worked'=>$request->lastWork,'position'=>$request->position,'bg_date'=>$request->bgDate,'en_date'=>$request->enDate,'salary'=>$request->salary,'payday'=>$payDay]);
        }

    }

    private function uploadFile($file,$path){
        $filename = $file->getClientOriginalName();
        $destination = public_path().'/uploads/'.$path;
        $file->move($destination,$filename);
        return $file->getClientOriginalName();
    }

    public function reportingOrdersSort(Request $request){

        $sortType= $request->input('sortType');
        $orderBy = $request->input('orderBy');

        $values = $request->input('inputsValue');

        $fromGdate = j2g($values[0]);
        $toDdate = j2g($values[1]);
        $fromTime = $values[2];
        $toTime = $values[3];
        $name = $values[4];
        $factorId = $values[5];
        $fromCount = $values[6];
        $toCount = $values[7];
        $fromFee = $values[8];
        $toFee=  $values[9];

        $selects =$request->input('selectsValue');

        $subset = $selects[0];
        $orderTypes = $selects[1];


        if ($orderBy == "z_food_orders.foodcount"){
            $is_count=true;
            $orderBy = "z_orders.date";
        }else if ($orderBy == "z_users.name" && $sortType == ""){
            $sortType = "asc";
        }

        $query = DB::table('z_orders')
                                ->join('z_users','z_orders.user_id','=','z_users.id')
                                ->leftJoin('z_order_types','z_orders.order_type','=','z_order_types.id')
                                ->whereBetween('z_orders.date',array($fromGdate,$toDdate))
                                ->whereBetween('z_orders.time',array($values[2],$values[3]));

        $select = ['z_orders.id as orid','z_orders.date','z_users.name','z_orders.time','z_orders.refid','z_orders.user_id','z_orders.total_fee','z_order_types.name as orderType'];
        if (isset($fromCount)&&$fromCount!=""&&$fromCount>=0) {
            $query->join('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                        ->whereBetween('z_food_orders.foodcount', array($fromCount - 1, $toCount));
            array_push($select,'z_food_orders.foodcount','z_food_orders.order_id','z_food_orders.food_id');
        }

        if (isset($fromFee) && $fromFee!=""){
            $query->whereBetween('z_orders.total_fee',array($fromFee,$toFee));
        }
        if (isset($name)&& $name!=""){
            $query->where('z_users.name','like','%'.$name.'%')->orWhere('z_users.cctt',$name);
            array_push($select,'z_users.name');
        }
        if (isset($factorId)&& $factorId!=""){
            $query->where('z_orders.refid',$factorId);
        }

        if (isset($subset) && $subset!=""){
            $query->leftJoin('z_food_orders','z_food_orders.order_id','=','z_orders.id')
                    ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                    ->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                    ->leftJoin('z_res_subset','z_food_cats.parent_id','=','z_res_subset.id')
                    ->whereIn('z_res_subset.id',$subset)
                    ->groupBy('z_food_orders.factor_id');
            array_push($select,'z_res_subset.id','z_res_subset.title');
        }

        if (isset($orderTypes) && $orderTypes != ""){
            $query->whereIn('z_orders.order_type',$orderTypes);
            array_push($select,'z_orders.order_type');
        }

        $data['fields'] = $query->select($select)
                                ->orderBy($orderBy,$sortType)
                                ->orderBy('z_orders.date','desc')
                                ->orderBy('z_orders.time','desc')
                                ->get();

        if ($sortType == "asc"){
            $sorting = "desc";
        }else if($sortType == "desc"){
            $sorting = "asc";
        }


        foreach($data['fields'] as $fid){
            $counts[] = DB::table('z_food_orders')->whereOrderId($fid->orid)->sum('foodcount');
        }

        if (isset($is_count)){
        if ($is_count){
            if ($sortType == "asc"){
                sort($counts);
            }else{
                rsort($counts);
            }
            $orderBy = "z_food_orders.foodcount";
        }
        }
        if (!isset($sorting)){
            $sorting="asc";
        }
        $data['sorting'] = $sorting;
        $data['orderField'] = $orderBy;

        $data['count'] = DB::table('z_orders')
                            ->join('z_users','z_users.id','=','z_orders.user_id')
                            ->join('z_food_orders','z_food_orders.factor_id','=','z_orders.refid')
                            ->sum('z_food_orders.foodcount');

        $data['counts'] = $counts;
        foreach($data['fields'] as $dd){
            $user = DB::table('z_users')->whereId($dd->user_id)->first();
            $title[] = $user->name;
            $field[] = $dd->total_fee;
        }
        $data['user'] = $user;
        $title=array();
        $field=array();
        foreach($data['fields'] as $dd){
            $user = DB::table('z_users')->whereId($dd->user_id)->first();
            $title[] = $user->name;
            $field[] = $dd->total_fee;
        }
        $data['title'] = $title;
        $data['data']=$field;
        return response()->json(['content'=>view('admin.first_one',$data)->render()]);
    }


    public function chartByDatePrice($dates){
        $totalFees=array();
        $totalSold=array();
        foreach($dates as $date){
            $totalFees[]=DB::table('z_orders')->where('date',$date->format('Y-m-d'))->sum('total_fee');
            $totalSold[] = DB::table('z_orders')->where('date',$date->format('Y-m-d'))->count();
        }
        $data['totalFees'] = $totalFees;
        $data['totalSold'] = $totalSold;
        return $data;
    }

    public function filterOrderReport(Request $request){

        $date = $request->input('date');
        $targetDays = $this->getTargetDays($date);
        $queryDate = $targetDays['queryDate'];
        $current = $targetDays['current'];

        $values = $request->input('inputsValue');
        $selects = $request->input('selectsValue');
        $fromTime = $values[2];
        $toTime = $values[3];
        $name = $values[4];
        $factorId = $values[5];
        $fromCount = $values[6];
        $toCount = $values[7];
        $fromFee = $values[8];
        $toFee=  $values[9];

        $subset = $selects[0];
        $orderType = $selects[1];
        $paymentType = $selects[2];

        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }
        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }

        $query = DB::table('z_orders')
                        ->leftJoin('z_food_orders','z_orders.refid','=','z_food_orders.factor_id')
                        ->leftJoin('z_order_types','z_orders.order_type','=','z_order_types.id')
                        ->whereBetween('z_orders.date',array($queryDate,$current))
                        ->whereBetween('z_orders.time',array($fromTime,$toTime));

        $select = ['z_orders.id','z_orders.date','z_orders.time','z_orders.refid','z_orders.user_id','z_orders.total_fee','z_order_types.name as orderType'];

        if (!isset($toCount) || !is_numeric($toCount) && isset($fromCount)){
            $toCount = DB::table('z_food_orders')->max('foodcount');
        }

        if (!isset($fromCount) || !is_numeric($fromCount) && isset($toCount)){
            $fromCount = 1;
        }

        if (isset($fromCount)&&$fromCount!="") {
            $query->havingRaw('SUM(z_food_orders.foodcount) BETWEEN '.$fromCount.' AND '.$toCount)
            ->groupBy('z_food_orders.factor_id');
            array_push($select,'z_food_orders.foodcount','z_food_orders.order_id','z_food_orders.food_id');
        }

        if (!isset($toFee) || !is_numeric($toFee) && isset($fromFee)){
            $toFee = DB::table('z_orders')->max('total_fee');
        }

        if (!isset($fromFee) || !is_numeric($fromFee) && isset($toFee)){
            $fromFee = 1;
        }

        if (isset($fromFee) && $fromFee!=""){
            $query->whereBetween('z_orders.total_fee',array($fromFee,$toFee));
        }
        if (isset($name)&& $name!=""){
            $query->join('z_users','z_orders.user_id','=','z_users.id')->where('z_users.name','like','%'.$name.'%')
                                            ->orWhere('z_users.cctt',$name);
            array_push($select,'z_users.name');
        }
        if (isset($factorId)&& $factorId!=""){
            $query->where('z_orders.refid','like','%'.$factorId.'%');
        }

        if (isset($subset) && $subset!=""){
            $query->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                                        ->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                                        ->leftJoin('z_res_subset','z_food_cats.parent_id','=','z_res_subset.id')
                                        ->whereIn('z_res_subset.id',$subset)
                                        ->groupBy('z_food_orders.factor_id');
            array_push($select,'z_res_subset.id','z_res_subset.title');
        }

        if (isset($orderType) && $orderType!=""){
            $query->whereIn('z_orders.order_type',$orderType);
            array_push($select,'z_orders.order_type');
        }

        if (isset($paymentType) && $paymentType!=""){
            $query->whereIn('z_orders.payment_type',$paymentType);
        }

        $data['fields'] = $query->select($select)->orderBy('z_orders.date','desc')->orderBy('z_orders.time','desc')->get();

        foreach($data['fields'] as $dd){
            $users []= DB::table('z_users')->whereId($dd->user_id)->first();
            $count[] = DB::table('z_food_orders')->whereFactorId($dd->refid)->orderBy('foodcount', 'desc')->sum('foodcount');
            $user = DB::table('z_users')->whereId($dd->user_id)->orderBy('id', 'desc')->first();
        }

        if (count($data['fields']) > 0){
            $dates = returnDates($queryDate,$current);
            $values = $this->chartByDatePrice($dates);
            $totalFees =  $values['totalFees'];
            $data['title'] = convertDateRangeToJalali($dates);
            $data['data']=$totalFees;
            $data['countSold'] =$values['totalSold'];

            $usersname =DB::table('z_users')->get();
            $sumOfAll =DB::table('z_orders')->sum('total_fee');
            foreach($usersname as $user){
                $solds = DB::table('z_orders')->whereBetween('date',array($queryDate,$current))->whereUserId($user->id)->first();
                if (isset($solds)){
                    $oneDegree = 1/360;
                    $calculation = $solds->total_fee / $sumOfAll;
                    if (count($solds)< 1 || $calculation < $oneDegree){
                        continue;
                    }
                    $usersSold[] = DB::table('z_orders')->whereBetween('date',array($queryDate,$current))->whereUserId($user->id)->sum('total_fee');
                    $user_name[] = $user->name;
                }
            }
        }
        if (isset($usersSold)){
            $data['usersSold'] = $usersSold;
        }
        if (isset($user_name)){
            $data['user_names'] = $user_name;
        }
        $data['orderField'] = 'z_orders.date';
        $data['orderType'] = 'asc';

        if (isset($user)){
            $data['user'] = $user;
        }
        if (isset($count)){
            $data['count'] = $count;
        }
        if (isset($users)){
            $data['users'] = $users;
        }
        if (isset($count)){
            $data['counts'] = $count;
        }

        $jFromDate = g2j($queryDate);
        $jTodate = g2j($current);
        return response()->json(['content'=>view('admin.reporting.orders',$data)->render(),'fromDate'=>$jFromDate ,'toDate'=>$jTodate]);
    }


    public function reportingOrders(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $fromCount = $request->input('fromCount');
        $toCount = $request->input('toCount');
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $name = $request->input('name');
        $factorId = $request->input('factor_id');
        $subset = $request->input('branch');
        $orderType = $request->input('type');
        $paymentType = $request->input('paymentType');

        $jFromDate = explode('/',$fromDate);
        $jToDate = explode('/',$toDate);
        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
        }
        if (!isset($toTime) || $toTime == ""){
            $toTime = "23:59:59";
        }

        if (count($jFromDate) < 2){
            $fromGdate = getCurrentDate();
            $toGdate = getCurrentDate();
        }else if (count($jToDate) < 2){
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = getCurrentDate();
        }else{
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = jalali_to_gregorian($jToDate[0],$jToDate[1],$jToDate[2],'-');
        }
        if (strtotime(getCurrentDate()) < strtotime($fromGdate)){
            $data['error'] = "تاریخ وارد شده صحیح نمی باشد.";
            return response()->json(['content'=>view('admin.reporting.orders-chart',$data)->render()]);
            exit;
        }
        $query = DB::table('z_orders')
                                    ->leftJoin('z_food_orders','z_orders.refid','=','z_food_orders.factor_id')
                                    ->leftJoin('z_order_types','z_orders.order_type','=','z_order_types.id')
                                    ->whereBetween('z_orders.date',array($fromGdate,$toGdate))
                                    ->whereBetween('z_orders.time',array($fromTime,$toTime));

        $select = ['z_orders.id','z_orders.date','z_orders.time','z_orders.refid','z_orders.user_id','z_orders.total_fee','z_order_types.name as orderType'];

        if (!isset($toCount) || !is_numeric($toCount) && isset($fromCount)){
            $toCount = DB::table('z_food_orders')->max('foodcount');
        }

        if (!isset($fromCount) || !is_numeric($fromCount) && isset($toCount)){
            $fromCount = 1;
        }

        if (isset($fromCount)&&$fromCount!="") {
            $query->havingRaw('SUM(z_food_orders.foodcount) BETWEEN '.$fromCount.' AND '.$toCount)
                            ->groupBy('z_food_orders.factor_id');
            array_push($select,'z_food_orders.foodcount','z_food_orders.order_id','z_food_orders.food_id');
        }

        if (!isset($toFee) || !is_numeric($toFee) && isset($fromFee)){
            $toFee = DB::table('z_orders')->max('total_fee');
        }

        if (!isset($fromFee) || !is_numeric($fromFee) && isset($toFee)){
            $fromFee = 1;
        }

        if (isset($fromFee) && $fromFee!=""){
            $query->whereBetween('z_orders.total_fee',array($fromFee,$toFee));
        }
        if (isset($name)&& $name!=""){
            $query->join('z_users','z_orders.user_id','=','z_users.id')->where('z_users.name','like','%'.$name.'%')
                                                    ->orWhere('z_users.cctt',$name);
            array_push($select,'z_users.name');
        }
        if (isset($factorId)&& $factorId!=""){
            $query->where('z_orders.refid','like','%'.$factorId.'%');
        }

        if (isset($subset) && $subset!=""){
            $query->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                    ->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                    ->leftJoin('z_res_subset','z_food_cats.parent_id','=','z_res_subset.id')
                    ->whereIn('z_res_subset.id',$subset)
                    ->groupBy('z_food_orders.factor_id');
            array_push($select,'z_res_subset.id','z_res_subset.title');
        }

        if (isset($orderType) && $orderType!=""){
            $query->whereIn('z_orders.order_type',$orderType);
            array_push($select,'z_orders.order_type');
        }

        if (isset($paymentType) && $paymentType!=""){
            $query->whereIn('z_orders.payment_type',$paymentType);
        }

        $data['fields'] = $query->select($select)->orderBy('z_orders.date','desc')->orderBy('z_orders.time','desc')->get();


        foreach($data['fields'] as $dd){
            $users []= DB::table('z_users')->whereId($dd->user_id)->first();
            $count[] = DB::table('z_food_orders')->whereFactorId($dd->refid)->orderBy('foodcount', 'desc')->sum('foodcount');
            $user = DB::table('z_users')->whereId($dd->user_id)->orderBy('id', 'desc')->first();
            //$title[] = g2j($dd->date);
            //$field[] = $dd->total_fee;
        }
    if (count($data['fields']) > 0) {
        $dates = returnDates($fromGdate, $toGdate);
        $values = $this->chartByDatePrice($dates);
        $totalFees = $values['totalFees'];
        $data['title'] = convertDateRangeToJalali($dates);
        $data['data'] = $totalFees;
        $data['countSold'] = $values['totalSold'];
        $usersname = DB::table('z_users')->get();
        $sumOfAll = DB::table('z_orders')->sum('total_fee');
        foreach ($usersname as $user) {
            $solds = DB::table('z_orders')->whereBetween('date', array($fromGdate, $toGdate))->whereUserId($user->id)->first();
            if (isset($solds)) {
                $oneDegree = 1 / 360;
                $calculation = $solds->total_fee / $sumOfAll;
                if (count($solds) < 1 || $calculation < $oneDegree) {
                    continue;
                }
                $usersSold[] = DB::table('z_orders')->whereBetween('date', array($fromGdate, $toGdate))->whereUserId($user->id)->sum('total_fee');
                $user_name[] = $user->name;
            }
        }
    }
        if (isset($usersSold)){
            $data['usersSold'] = $usersSold;
        }
        if (isset($user_name)){
            $data['user_names'] = $user_name;
        }
        $data['orderField'] = 'z_orders.date';
        $data['orderType'] = 'asc';

        if (isset($user)){
            $data['user'] = $user;
        }
        if (isset($count)){
            $data['count'] = $count;
        }
        if (isset($users)){
            $data['users'] = $users;
        }
        if (isset($count)){
            $data['counts'] = $count;
        }
        
        return response()->json(['content'=>view('admin.reporting.orders',$data)->render()]);
       /* switch ($orderType){
            case "all" :
                //$field=array();

            case "food":
                return response()->json(['content'=>view('admin.filter_food',$data)->render()]);
                break;
            case "order":
                $data = $this->getOrdersType($fromGdate,$toGdate,$fromTime,$toTime);
                return response()->json(['content'=>view('admin.filter_type',$data)->render()]);
                break;
            default:
                $title=array();
                $field=array();
                $datas = DB::table('z_orders')->get();
                foreach($datas as $dd){
                    $user = DB::table('z_users')->whereId($dd->user_id)->first();
                    $title[] = $user->name;
                    $field[] = $dd->total_fee;
                }
                $data['title'] = $title;
                $data['data']=$field;
                return response()->json(['content'=>view('admin.c-report',$data)->render()]);
                break;
        }*/
    }






	public function foodreport(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $fromCount = $request->input('fromCount');
        $toCount = $request->input('toCount');
        $fromFee= $request->input('fromFee');
        $toFee= $request->input('toFee');
        $name = $request->input('name');
        $factorId = $request->input('factor_id');
        $subset = $request->input('branch');

        $jFromDate = explode('/',$fromDate);
        $jToDate = explode('/',$toDate);
        if (!isset($fromTime) || $fromTime == ""){
            $fromTime = "00:00:00";
            $toTime="23:59:59";
        }
        if (count($jFromDate) < 2){
            $fromGdate = getCurrentDate();
            $toGdate = getCurrentDate();
        }else if (count($jToDate) < 2){
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = getCurrentDate();
        }else{
            $fromGdate = jalali_to_gregorian($jFromDate[0],$jFromDate[1],$jFromDate[2],'-');
            $toGdate = jalali_to_gregorian($jToDate[0],$jToDate[1],$jToDate[2],'-');
        }
        if (strtotime(getCurrentDate()) < strtotime($fromGdate)){
            $data['error'] = "تاریخ وارد شده صحیح نمی باشد.";
            return response()->json(['content'=>view('admin.reporting.orders-chart',$data)->render()]);
            exit;
        }

        $query = DB::table('z_orders')
                                    ->whereBetween('z_orders.date',array($fromGdate,$toGdate))
                                    ->whereBetween('z_orders.time',array($fromTime,$toTime));

        if (isset($fromCount)&&$fromCount!="") {
            $query->leftJoin('z_food_orders','z_orders.id','=','z_food_orders.order_id')
                            ->whereBetween('z_food_orders.foodcount', array($fromCount, $toCount))
                            ->groupBy('z_food_orders.factor_id');
        }
        if (isset($fromFee) && $fromFee!=""){
            $query->whereBetween('z_orders.total_fee',array($fromFee,$toFee));
        }
        if (isset($name)&& $name!=""){
            $query->join('z_users','z_orders.user_id','=','z_users.id')->where('z_users.name','like','%'.$name.'%')
                                                    ->orWhere('z_users.cctt',$name);
        }
        if (isset($factorId)&& $factorId!=""){
            $query->where('z_orders.refid',$factorId);
        }

        if (isset($subset) && $subset!=""){
            $query->leftJoin('z_food_orders','z_food_orders.order_id','=','z_orders.id')
                    ->leftJoin('z_foods','z_food_orders.food_id','=','z_foods.id')
                    ->leftJoin('z_food_cats','z_foods.cat_id','=','z_food_cats.id')
                    ->leftJoin('z_res_subset','z_food_cats.parent_id','=','z_res_subset.id')
                    ->whereIn('z_res_subset.id',$subset)
                    ->groupBy('z_food_orders.factor_id');
        }

        $data['fields'] = $query->orderBy('z_orders.date','desc')->orderBy('z_orders.time','desc')->get();

        foreach($data['fields'] as $dd){
            $users []= DB::table('z_users')->whereId($dd->user_id)->first();
            $count[] = DB::table('z_food_orders')->whereFactorId($dd->refid)->orderBy('foodcount', 'desc')->sum('foodcount');
            $user = DB::table('z_users')->whereId($dd->user_id)->orderBy('id', 'desc')->first();
            //$title[] = g2j($dd->date);
            //$field[] = $dd->total_fee;
        }
    if (count($data['fields']) > 0){
        $dates = returnDates($fromGdate,$toGdate);
        $values = $this->chartByDatePrice($dates);
        $totalFees =  $values['totalFees'];
        $data['title'] = convertDateRangeToJalali($dates);
        $data['data']=$totalFees;
        $data['countSold'] =$values['totalSold'];

        $usersname =DB::table('z_users')->get();
        $sumOfAll =DB::table('z_orders')->sum('total_fee');
        foreach($usersname as $user){
            $solds = DB::table('z_orders')->whereBetween('date',array($fromGdate,$toGdate))->whereUserId($user->id)->first();
            if (isset($solds)){
                $oneDegree = 1/360;
                $calculation = $solds->total_fee / $sumOfAll;
                if (count($solds)< 1 || $calculation < $oneDegree){
                    continue;
                }
                $usersSold[] = DB::table('z_orders')->whereBetween('date',array($fromGdate,$toGdate))->whereUserId($user->id)->sum('total_fee');
                $user_name[] = $user->name;
            }
        }
    }
        if (isset($usersSold)){
            $data['usersSold'] = $usersSold;
        }
        if (isset($user_name)){
            $data['user_names'] = $user_name;
        }
        $data['orderField'] = 'z_orders.date';
        $data['orderType'] = 'asc';

        if (isset($user)){
            $data['user'] = $user;
        }
        if (isset($count)){
            $data['count'] = $count;
        }
        if (isset($users)){
            $data['users'] = $users;
        }
        if (isset($count)){
            $data['counts'] = $count;
        }

        return response()->json(['content'=>view('admin.reporting.orders-chart',$data)->render()]);
    }


    public function exportChart(Request $request){

        $data['titles'] = json_decode(stripslashes($request->input('title')));
        $data['values'] = json_decode(stripslashes($request->input('data')));

       Excel::create('new file',function($excel) use ($data){
          $excel->sheet('new sheet',function($sheet) use ($data){
              $sheet->setRightToLeft(true);
             $sheet->loadView('admin.excel_export',$data);
          });
       })->download('xlsx');
    }

    public function exportPdf($input,$users,$counts){
        $data['users'] = json_decode(stripslashes($users));
        $data['counts'] = json_decode(stripslashes($counts));
        $data['fields'] = json_decode(stripslashes($input));
        $pdf = \PDF::loadView('admin.excel_export',$data);
        return $pdf->download('report-pdf.pdf');
    }

    public function newUser(){
        if (!$this->isAdmin()){
            return;
        }
        return response()->json(['content'=>view('admin.new_user')->render()]);
    }

    public function submitUser(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $user_name = $request->name;
        $phone = $request->phone;
        $currentDate = getCurrentDate();
        $ran = $this->randomNumber(4);
        $rans = DB::table('z_users')->whereCctt($ran)->first();
        if (isset($rans) || count($rans)> 0){
            $ran = $this->randomNumber(4);
        }
        $isEdit = $request->input('edit');
        if(isset($isEdit) && $isEdit!=""){
            DB::table('z_users')->whereId($isEdit)->update(['name'=>$user_name,'phone'=>$phone,]);
        }else{
            DB::table('z_users')->insert(['name'=>$user_name,'phone'=>$phone,'submit_date'=>$currentDate,'last_visit'=>$currentDate,'cctt'=>$ran]);
        }
    }

    /** zagrot must remove */
    public function sortTable(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $tableAndFieldName = $request->input('field_name');
        $outputView = $request->input('view');
        $outputKey = $request->input('key');
        $sortType = $request->input('sortType');
        $whereClause = $request->input('where');
        $details = explode('.',$tableAndFieldName);
        $tableName = $details[0];
        $orderBy =  $details[1];
        $whereClause = str_replace('"',"'",$whereClause);
        $data[$outputKey]=DB::table($tableName)->orderBy($orderBy,$sortType)->get();
        print_r($data);
        exit;
        return response()->json(['content'=>view($outputView,$data)->render()]);
    }

    public function ordersTypeFilters(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $newFromDate = explode('/',$fromDate);
        $fromDate = jalali_to_gregorian($newFromDate[2],$newFromDate[1],$newFromDate[0],'-');
        $newToDate = explode('/',$toDate);
        $toDate = jalali_to_gregorian($newToDate[2],$newToDate[1],$newToDate[0],'-');
        $key = $request->input('key');
        $data['fromDate']=$fromDate;
        $data['toDate']=$toDate;
        if ($key=='food'){
            return response()->json(['content'=>view('admin.filter_food',$data)->render()]);
        }else if ($key == 'order'){
            $data = $this->getOrdersType($fromDate,$toDate);
            return response()->json(['content'=>view('admin.filter_type',$data)->render()]);
        }else if ($key == 'pay'){

        }
    }

    public function ordersFoodCountFilter(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $fromCount = $request->input('fromCount');
        $toCount = $request->input('toCount');
        $data['fields']= DB::table('z_food_orders')->whereBetween('foodcount',array($fromCount,$toCount))->get();
        return response()->json(['content'=>view('admin.filter_many',$data)->render()]);
    }

    public function ordersPriceFilter(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $fromPrice = $request->input('fromPrice');
        $toPrice = $request->input('toPrice');
        $data['fields'] = DB::table('z_orders')->whereBetween('total_fee',array($fromPrice,$toPrice))->get();
        return response()->json(['content'=>view('admin.filter_price',$data)->render()]);
    }

    public function ordersTimeFilter(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $data['fields'] = DB::table('z_orders')->whereBetween('time',array($fromTime,$toTime))->get();
        return response()->json(['content'=>view('admin.filter_time',$data)->render()]);
    }

    public function exportXls(Request $request){
        $fromDate = $request->input('fromDate');
        $toDate=$request->input('toDate');
        $fromDate = explode('/',$fromDate);
        $fromGdate = jalali_to_gregorian($fromDate[2],$fromDate[1],$fromDate[0]);
        $toDate = explode('/',$toDate);
        $toGdate = jalali_to_gregorian($toDate[2],$toDate[1],$toDate[0]);
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $data['fields'] = DB::table('z_orders')->whereBetween('date',array($fromGdate,$toGdate))->whereBetween('time',array($fromTime,$toTime))->get();
        Excel::create('excelFile', function($excel) use($data) {
            $excel->sheet('excelSheet', function($sheet) use($data) {
                $sheet->loadView('admin.c-filter',$data);
            });
        })->download('csv');
        return response()->json('YES');
    }

    public function pdf(Request $request){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $fromTime = $request->input('fromTime');
        $toTime = $request->input('toTime');
        $fromDate = explode('/',$fromDate);
        $fromGdate = jalali_to_gregorian($fromDate[2],$fromDate[1],$fromDate[0]);
        $toDate = explode('/',$toDate);
        $toGdate = jalali_to_gregorian($toDate[2],$toDate[1],$toDate[0]);
        $data['title']=array();
        $data['data']=array();
        $data['fields'] = DB::table('z_orders')->whereBetween('date',array($fromGdate,$toGdate))->whereBetween('time',array($fromTime,$toTime))->get();
        $pdf = \PDF::loadView('admin.c-filter', $data);
        return $pdf->download('c-filter.pdf');
    }

    private function getOrdersType($fromDate,$toDate,$fromTime,$toTime){
        $fields = DB::table('z_orders')->whereBetween('date',array($fromDate,$toDate))->whereBetween('time',array($fromTime,$toTime))->get();
        $preOrder =0;
        $inside = 0;
        $outside=0;
        $outsidePresent=0;
        foreach($fields as $field){
            if (isset($field->come_later) && $field->come_later != ""){
                $preOrder +=1;
            }else if (isset($field->table_no) && $field->table_no !=""){
                $inside +=1;
            }else if (isset($field->intime) && $field->intime != ""){
                $outside +=1;
            }else if (isset($field->outtime) && $field->outtime != ""){
                $outsidePresent +=1;
            }
        }
        $data['preOrder'] = $preOrder;
        $data['inside']=$inside;
        $data['outside']=$outside;
        $data['present']=$outsidePresent;
        return $data;
    }

    private function getTotalOrdersCount(){
        $totalOrders = DB::table('z_food_orders')->get();
        $totalSales=0;
        foreach($totalOrders as $totalOrder){
            $totalSales +=$totalOrder->foodcount;
        }
        return $totalSales;
    }

    private function countMonthSales(){
        $totalMonthProfit=0;
        $firstDayOfMonth = date('Y-m-01');
        $currentDate = date('Y-m-d');
        $totalMonthSales = DB::table('z_orders')->whereBetween('date',array($firstDayOfMonth,$currentDate))->get();
        $msale = array();
        foreach($totalMonthSales as $tmp){
            $factorId = $tmp->refid;
            if (isset($msale[$factorId])){
                continue;
            }else{
                $msale[$factorId]= $tmp->refid;
            }
            $monthSales = DB::table('z_orders')->whereRefid($factorId)->get();
            foreach($monthSales as $monthSale){
                $totalMonthProfit +=$monthSale->total_fee;
            }
        }
        return $totalMonthProfit;
    }

    private function countWeekSales(){
        $sat = strtotime('last saturday');
        $satTime = date('Y-m-d',$sat);
        $currentDate = date('Y-m-d');
        $thisWeekSales = DB::table('z_orders')->whereBetween('date',array($satTime,$currentDate))->get();
        $totalWeekProfit=0;
        $msale = array();
        foreach($thisWeekSales as $thisSales){
            $factorId = $thisSales->refid;
            if (isset($msale[$thisSales->refid])){
                continue;
            }else{
                $msale[$thisSales->refid]= $thisSales->refid;
            }
            $sales = DB::table('z_orders')->whereRefid($factorId)->get();
            foreach($sales as $sale){
                $totalWeekProfit +=$sale->total_fee;
            }
        }
        return $totalWeekProfit;
    }

    public function ordersFactorFilter(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $req = $request->input('key');
        $fields = DB::table('z_orders')->where('refid','like','%'.$req.'%')->get();
        $data['user_id'] = Session::get('admin_id');
        $iFields=array();
        foreach($fields as $field){
            $iFields[]= DB::table('z_food_orders')->whereOrderId($field->id)->get();
        }
        $data['fields']=$iFields;
        return response()->json(array('content'=>view('admin.sort_day',$data)->render()));
    }

    public function ordersNewLoadFood(){
        if (!$this->isAdmin()){
            return;
        }
        $menus[] = DB::table('z_food_cats')->get();
        foreach($menus as $menu){
            foreach($menu as $bar){
                $foods[] = DB::table('z_foods')->where('cat_id',$bar->id)->get();
            }
        }
        $data=array('menu'=>$menu,'foods'=>$foods);
        return response()->json(array('content'=>view('admin.orders.new',$data)->render()));
    }

    public function ordersNameFilter(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $req = $request->input('key');
        $id = DB::table('z_users')->whereName($req)->first();
        $foodMenu = DB::table('z_orders_id')->whereUserId($id->id)->first();
        $data['fields']= DB::table('z_orders')->whereUserid($foodMenu->order_id)->get();
        return response()->json(array('content'=>view('admin.temp',$data)->render()));
    }

    public function insertFood(Request $request){
        if (!$this->isAdmin()){
            return;
        }
            $excepts = ['3','_token','menu'];
            $requests = $request->except($excepts);
            $menuName = $request->input('menu');
            $file = $request->file('3');
            $filename=array();
            $j=0;
            foreach($file as $ff){
                $filename[$j] = time()."_".$ff->getClientOriginalName();
                $destination = public_path().'/uploads/food_images';
                $ff->move($destination,$filename[$j]);
                $img = \Image::make($destination.'/'.$filename[$j]);
                $img->resize(320,240);
                $img->save(public_path().'/uploads/food_thumb/'.$filename[$j]);
                $j++;
            }
            $foodIds = array();
            for($i=0;$i<=count($requests);$i++){
                if (isset($filename[$i])){
                    $catId = DB::table('z_food_cats')->whereTitle($menuName)->first();
                    $foodIds[] = DB::table('z_foods')->insertGetId(['title'=>$requests['food'][$i],'price'=>$requests['price'][$i],'desc'=>$requests['desc'][$i],'cook_time'=>$requests['makeup'][$i],'image'=>$filename[$i],'cat_id'=>$catId->id,'thumb'=>$filename[$i]]);
                }
            }
            $materialGroups = $request->input('group');
            $materialCounts = $request->input('count');
            $i=0;
            $j=0;
            foreach($materialGroups as $matGroup){
                $material = DB::table('z_materials')->whereMatRef($matGroup)->first();
                if (!isset($foodIds[$j])){
                    $j--;
                }
                DB::table('z_food_material')->insert(['material_id'=>$material->id,'food_id'=>$foodIds[$j],'amount'=>$materialCounts[$i]]);
                $i++;
                $j++;
            }
       // return redirect()->back();
        return redirect()->route('dashboard');
        }

    public function ordersNew(Request $request){
        if (!$this->isAdmin()){
            return;
        }
        $excepts = array('_token','total','sbscode','cname','tableNo','sbscode');
        $reqs = $request->except($excepts);
        $userid = Session::get('admin_id');
        $ran = $this->randomNumber(7);
        if (!isset($userid)){
            return redirect('/admin/z.admin');
        }
        $customerId = $request->input('sbscode');
        $userId = DB::table('z_users')->whereCctt($customerId)->first();
        $tableNo = $request->input('tableNo');
        $totalFee= $request->input('total');
        foreach($reqs as $key=>$value){
            if ($value == 0){
                continue;
            }
            if (strpos($key,"_")){
                $key = str_replace("_"," ",$key);
            }
            $foodId = DB::table('z_foods')->whereTitle($key)->first();
            $time = date("G:i");
            $currentDate = date('Y-m-d');
            //'food_id'=>$foodId->id,'foodcount'=>$value
            $orders = DB::table('z_orders')->whereRefid($ran)->first();
            if (count($orders)==0){
                $queue = $this->getRequestQueue();
                if (!isset($queue) || $queue==null){
                    $queue=0;
                }
                $queue +=1;
                $orderId = DB::table('z_orders')->insertGetId(['user_id' => $userId->id,'refid'=>$ran,'queue'=>$queue,'total_fee'=>$totalFee,'time'=>$time,'table_no'=>$tableNo,'date'=>$currentDate]);
                DB::table('z_transactions')->insert(['trans_id'=>$ran,'cash'=>$totalFee,'type'=>1,'date'=>$currentDate]);
                $accountCash = DB::table('z_bank_account')->whereId(1)->first();
                $cash = $accountCash->cash;
                $cash +=$totalFee;
                DB::table('z_bank_account')->whereId(1)->update(['cash'=>$cash]);

            }
            DB::table('z_food_orders')->insert(['order_id'=>$orderId,'factor_id'=>$ran,'foodcount'=>$value,'food_id'=>$foodId->id]);
        }
        //return redirect('/admin/adminhome');
    }

    private function getRequestQueue(){

        $queue = DB::table('z_orders')->orderBy('queue','desc')->first();
        if (isset($queue->queue)){
            return $queue->queue;
        }else{
            return 0;
        }
    }

    private function randomNumber($length) {
        $result = '';
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    private function getTargetDays($date){
        switch ($date){
            case "today":
                $queryDate = getCurrentDate();
                $current = getCurrentDate();
                break;
            case "yesterday":
                $queryDate = date('Y-m-d',strtotime("-1 days"));
                $current= date('Y-m-d',strtotime("-1 days"));
                break;
            case "thisWeek":
                if(date('w', strtotime(getCurrentDate())) == 6) {
                    $queryDate =getCurrentDate();
                }else{
                    $queryDate = date('Y-m-d',strtotime('last saturday'));
                }
                $current=getCurrentDate();
                break;
            case "lastWeek":
                if(date('w', strtotime(getCurrentDate()))==6) {
                    $queryDate = date('Y-m-d',strtotime('last saturday'));
                }else{
                    $queryDate = date('Y-m-d',strtotime('-2 week saturday'));
                }
                $current=date('Y-m-d',strtotime('last friday'));
                break;
            case "thisMonth":
                $queryDate = date('Y-m-01');
                $lastDayOfMonth = new \DateTime('last day of this month');
                $current =$lastDayOfMonth->format('Y-m-d');
                break;
            default:
                $queryDate = $date[0];
                $current = $date[1];
                break;
        }
        return array('queryDate'=>$queryDate,'current'=>$current);
    }

    public function logout(){
        Session::flush();
        return redirect('/admin/z.admin');
    }

    private function isAdmin(){
        $adminId = Session::get('admin_id');
        return isset($adminId);
    }

}
