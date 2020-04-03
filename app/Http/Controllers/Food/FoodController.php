<?php
namespace Res\Http\Controllers\Food;
use Res\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Res\Http\Requests;
use Illuminate\Support\Facades\Session;
class FoodController extends Controller{

    public function menu(){
        $services = DB::table('z_service_settings')->whereId(1)->first();
        $status = $services->service_status;
        if ($status == 0){
            $services = 'offline';
            $data['site_offline'] = $services;
        }
        $menus[] = DB::table('z_food_cats')->get();
        foreach($menus as $menu){
            foreach($menu as $bar){
                $foods[] = DB::table('z_foods')->where('cat_id',$bar->id)->get();
            }
        }
        $data['menu']=$menu;
        $data['foods']=$foods;
        $data['services'] = $services;
        return view('food.menu',$data);
    }

    public function addToList(Request $request){
        $foodName = $request->input('food');
        $food = DB::table('z_foods')->whereTitle($foodName)->first();
        return response()->json(['foodname'=>$food->title,'price'=>$food->price,'id'=>$food->id]);
    }

    public function preOrder(Request $request){
        $data = $request->all();
        Session::forget('foods');
        Session::forget('price');
        Session::forget('total');
        Session::forget('pre');
        Session::forget('discount');
        Session::forget('discount_type');
        Session::forget('new_total');
        Session::put('foods',$data['foods']);
        Session::put('price',$data['counts']);
        Session::put('pre',$data['prci']);
        $foods = explode('|',Session::get('foods',null));
        $pre = explode('|',Session::get('price',null));
        $i=0;
        $prices=0;
        $pres = array();
        foreach($pre as $pr){
            if ($pr == ""){
                continue;
            }
            $pres[] = $pr;
        }
        foreach($foods as $food){
            if ($food==""){
                continue;
            }
            $price = DB::table('z_foods')->whereTitle($food)->first();
            $foodPrice = $price->price;
            $prices +=$foodPrice * $pres[$i];
            $i++;
        }

        Session::put('total',$prices);
        $userId = Session::get('userid',null);
        if (!isset($userId)){
            return response()->json(['redirect'=>url().'/user/login']);
        }else {
            $name = DB::table('z_users')->whereId($userId)->first();
            Session::put('username',$name->name);
            $ran = $this->randomNumber(6);
            Session::put('factorId',$ran);
            $time = $this->calculateExpressTime();
            Session::put('foodtime',$time);
            return response()->json(['redirect' => url() . '/food/preorderform']);
        }
    }

    public function preOrderForm(){
        $services = DB::table('z_service_settings')->whereId(1)->first();
        $status = $services->service_status;
        if ($status == 0){
            $services = 'offline';
            $data['site_offline'] = $services;
        }
        $userId = Session::get('userid',null);
        $name = DB::table('z_users')->whereId($userId)->first();
        Session::put('username',$name->name);
        $ran = $this->randomNumber(6);
        Session::put('factorId',$ran);
        $time = $this->calculateExpressTime();
        Session::put('foodtime',$time);
        $data['address'] = $name->address;
        $data['paymentTypes'] = DB::table('z_order_payment_type')->get();
        foreach($data['paymentTypes'] as $paymentType){
            $payments[] = DB::table('z_payments')->whereId($paymentType->payment_type)->first();
        }
        $total_fee = Session::get('total');
        $tommorow = date('Y-m-d',strtotime('+1 day'));
        //$coupons = DB::table('z_coupons_on_after_buy')->where('from_fee','<=',$total_fee)->where('to_fee','>=',$total_fee)->where('type',1)->where('expire','>=',getCurrentDate())->first();

        $user = DB::table('z_users')->where('id',$userId)->first();
        //$count = DB::table('z_coupons_use')->where('code',$coupons->id)->where('user_id',$user->cctt)->count();


        $discount = Session::get('discount');
//        if($coupons->max_per_user >$count){
//        if (isset($coupons) && count($coupons) > 0 && !isset($discount)){
//            // $is_used = DB::table('z_coupons_use')->whereUserId($userId)->where('code',$coupons->code)->first();
//                Session::put('discount',$coupons->amount);
//                Session::put('discount_type',$coupons->type);
//                Session::put('from_fee',$coupons->from_fee);
//                Session::put('c_coopen_id',$coupons->id);
//                // Session::put('coopen_code',$coupons->code);
//        }
//    }


        $data['orderTypes'] = DB::table('z_order_types')->get();
        $data['payments'] = $payments;
        return view('food.preorder',$data);
    }

    public function validatePayment(Request $request){
        $orderType = $request->input('orderType');
        $paymentType = DB::table('z_order_payment_type')->whereOrderType($orderType)
                                ->join('z_payments','z_order_payment_type.payment_type','=','z_payments.id')
                                ->select('z_payments.id as pId','z_payments.title as pTitle')
                                ->first();
        $data['paymentId'] = $paymentType->pId;
        $data['paymentTitle'] = $paymentType->pTitle;
        return response()->json(['content'=>view('food.payment_type',$data)->render()]);
    }

    private function calculateExpressTime(){
        $foods = explode('|',Session::get('foods',null));
        $prices = explode('|',Session::get('price',null));
        $failure = DB::table('z_service_settings')->whereId(1)->first();
        $calculationTime=0;
        $prc=array();
        foreach($prices as $price){
            $prc[] = $price;
        }
        $time = 0;
        for($i=0;$i<count($foods);$i++){
            if ($foods[$i]=="") {
                continue;
            }
            $food = DB::table('z_foods')->whereTitle($foods[$i])->first();
            if ($time < $food->cook_time*$prc[$i]){
                $time = $food->cook_time*$prc[$i];
            }
            $calculationTime += $food->cook_time * $prc[$i];
        }
        $failurePercent = $time * $failure->service_failure/100;
        $calculationTime = floor($time + $failurePercent);
        return $calculationTime;
    }

    private function randomNumber($length) {
        $result = '';
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    public function io(Request $request){
        //dd($request->all());
        $orderType = $request->input('orderType');
        $orderVal = $request->input('orderVal');
        $desc = $request->input('desc');
        Session::put('paymentType',$request->input('paymentType'));
        Session::put('orderType',$orderType);
        Session::put('orderVal',$orderVal);
        Session::put('desc',$desc);
        return redirect('/food/insertorder');
        //return response()->json(['content'=>'/food/insertorder']);
    }

    public function insertOrders(){
        $userid = Session::get('userid');
        if (!isset($userid)) {
            return redirect('/user/login');
        }
        $foods = explode('|', Session::get('foods', null));
        $prices = explode('|', Session::get('price', null));
        $fee = explode('|',Session::get('pre',null));
        $factorId= Session::get('factorId');
        $desc = Session::get('desc');
        $makeUp = Session::get('foodtime');
        $totalFee =Session::get('new_total');
        $paymentType =Session::get('paymentType');
        $orderType = Session::get('orderType');
        $orderSet = Session::get('orderVal');

        $pType = DB::table('z_payments')->whereId($paymentType)->first();
        $paymentType = $pType->id;

        $priceSlice = array();
        $fees = array();
        foreach ($prices as $price) {
            $priceSlice[] = $price;
        }
        foreach($fee as $ff){
            $fees[]=$ff;
        }
        for ($i = 0; $i < count($foods); $i++) {
            if ($foods[$i] == "") {
                continue;
            }else {
                $foodId = DB::table('z_foods')->whereTitle($foods[$i])->first();
                //calculate material usage in every single food.
                $materials = DB::table('z_food_material')->whereFoodId($foodId->id)->get();
                if (count($materials) > 0) {
                    foreach ($materials as $material) {
//                        $mat = DB::table('z_materials')->whereId($material->material_id)->first();
//                        $negate = $material->amount*$priceSlice[$i];
//                        $amount = $mat->amount - $negate;
//                        DB::table('z_materials')->whereId($material->material_id)->update(['amount' => $amount]);
//                        DB::table('z_material_use')->insert(['mat_id' => $material->material_id, 'amount' => $negate, 'date' => getCurrentDate()]);
                    }
                }
                // end of calculation.
                $time = date("G:i");
                $currentDate = date('Y-m-d');
                $orders = DB::table('z_orders')->whereRefid($factorId)->first();
                if (count($orders)==0){
                    $queue = $this->getRequestQueue();
                    if (!isset($queue) || $queue==null){
                        $queue=0;
                    }
                    $queue +=1;
                    $orderId = DB::table('z_orders')->insertGetId(['user_id'=>$userid,'refid'=>$factorId,'queue'=>$queue,'total_fee'=>$totalFee,'order_type'=>$orderType,'payment_type'=>$paymentType,'order_set'=>$orderSet,'note'=>$desc,'date'=>$currentDate,'time'=>$time,'status'=>'','serve_level'=>'','serve_time'=>$makeUp]);
                    DB::table('z_transactions')->insert(['trans_id'=>$factorId,'cash'=>$totalFee,'type'=>8,'date'=>$currentDate,'time'=>getCurrentTime(),'account_id'=>1]);
                    $accountCash = DB::table('z_bank_account')->whereId(1)->first();
                    $cash = $accountCash->cash;
                    $cash +=$totalFee;
                    DB::table('z_bank_account')->whereId(1)->update(['cash'=>$cash]);
                }else{
                  break;
                }
                DB::table('z_food_orders')->insertGetId(['order_id'=>$orderId,'food_id'=>$foodId->id,'foodcount'=>$priceSlice[$i],'factor_id'=>$factorId]);
            }
        }
        if (isset($address)){
            $user = DB::table('z_users')->whereId($userid)->first();
            if (!isset($user->address) || $user->address=""){
                DB::table('z_users')->whereId($userid)->update(['address'=>$address]);
            }
        }

        $coopen_id = Session::get('coopen_id');
        if(isset($coopen_id) && $coopen_id!=""){
            $code = Session::get('coopen_code');
            $coopen = DB::table('z_coupons')->whereId($coopen_id)->first();
            $user = DB::table('z_users')->whereId($userid)->first();

            DB::table('z_coupons_use')->insert(['code'=>$code,'user_id'=>$user->cctt,'date'=>getCurrentDate()]);
        }

        $cCoupon = Session::get('c_coopen_id');
        if(isset($cCoupon) && $cCoupon!=""){
            $coopen = DB::table('z_coupons_on_after_buy')->whereId($cCoupon)->first();
            $user = DB::table('z_users')->whereId($userid)->first();
            DB::table('z_coupons_use')->insert(['code'=>$coopen->id,'user_id'=>$user->cctt,'date'=>getCurrentDate()]);
        }

        return redirect('/food/confirm');
    }


    private function getRequestQueue(){
        $queue = DB::table('z_orders')->orderBy('queue','desc')->first();
        if (isset($queue->queue)){
            return $queue->queue;
        }else{
            return 0;
        }
    }

    public function checkCoopen(Request $request){
        $userId = Session::get('userid');
        $user = DB::table('z_users')->whereId($userId)->first();
        $coopen_id = $request->input('coupon_code');
        $coopens = DB::table('z_user_coupons')
                                        ->leftJoin('z_coupons','z_coupons.code','=','z_user_coupons.code')
                                         ->where('z_user_coupons.code',$coopen_id)
                                        ->where('z_user_coupons.user_id',$user->cctt)
                                        ->select('z_user_coupons.code','z_user_coupons.user_id','z_user_coupons.id',
                                                 'z_coupons.max_per_user','z_coupons.amount','z_coupons.expire',
                                                 'z_coupons.type')
                                        ->first();


        // if (count($coopens) < 1){
        //     return redirect('/food/preorderform');
        // }

        $currentDate= getCurrentDate();
        if(isset($coopens)){
        if ($currentDate > $coopens->expire){
            // Session::forget('discount');
            // Session::forget('discount_type');
            // Session::forget('from_fee');
            return redirect('/food/preorderform');
        }else{
            if (isset($coopens) && count($coopens)>0){
                $userCoopen = DB::table('z_coupons_use')->where('user_id',$user->cctt)->where('code',$coopen_id)->count();
                if ($userCoopen >= $coopens->max_per_user){
                    // Session::forget('discount');
                    // Session::forget('discount_type');
                    // Session::forget('from_fee');
                    return redirect('/food/preorderform');
                }else{
                    $discount = Session::get('discount');
                    if(isset($discount) && $discount>0){
                        $type = Session::get('discount_type');
                        if($type == $coopens->type){
                            Session::forget('discount');
                            Session::set('discount',$discount+$coopens->amount);
                        }
                    }
                    // Session::put('discount',$coopens->amount);
                    Session::put('discount_type',$coopens->type);
                    // Session::put('from_fee',$coopens->from_fee);
                    Session::put('coopen_code',$coopens->code);
                    Session::put('coopen_id',$coopens->id);

                }
            }
        }
    }
        return redirect('/food/preorderform');
    }

    public function confirm(){
        return view('food.confirm');
    }
}
