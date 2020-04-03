<?php

namespace Res;
use DB;
use Illuminate\Database\Eloquent\Model;

class food extends Model
{
    public static function getMenuList(){
        $menu = DB::table('z_food_cats')->get();
        return $menu;
    }

  public static function getAllMaterials(){
    $materials = DB::table('z_materials')->get();
    return $materials;
  }

  public static function getAllUnits(){
    $units = DB::table('z_material_unit')->get();
    return $units;
  }

}
