<?php
namespace Res\Http\Controllers\Page;
use DB;
use Res\Http\Controllers\Auth;
use Res\Http\Controllers\Controller;
use Res\Http\Requests;
use Illuminate\Support\Facades\Session;
use Response;
class PageController extends Controller{

    public function home(){
      $user = Session::get('userid');
      $username = DB::table('z_users')->whereId($user)->first();
      $data['siteInfo']=DB::table('z_site_info')->first();
      $data['map'] = DB::table('z_google_map')->first();
      if (isset($username)){
        $data['username']=$username->name;
        $data['user_id']=$user;
        $data['questions']=DB::table('z_vote_question')->whereEnable(1)->get();
        $flags = array();
        foreach($data['questions'] as $question){
          $vote = DB::table('z_votes')->whereUserId($user)->whereQId($question->id)->first();
          if (count($vote) > 0){
            $flags[]=1;
          }else{
            $answers []= DB::table('z_vote_answer')->whereQId($question->id)->get();
            $flags[]=0;
          }
        }
        if (isset($answers)){
          $data['answers'] = $answers;
        }
        $data['flags'] = $flags;
        return view('home',$data);
      }else{
        return view('home',$data);
      }
    }

}