<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['namespace'=>'Page'],function(){
  Route::get('/','PageController@home');
  Route::get('/page/home','PageController@home');
});

Route::group(['prefix'=>'user','namespace'=>'User'],function(){
  Route::get('login','UserController@login');
  Route::post('order-food','UserController@insertOrder');
  Route::get('register','UserController@register');
  Route::post('register','UserController@register');
  Route::post('emailvalidate','UserController@emailValidator');
  Route::post('register','UserController@register');
  Route::get('emailvalidate','UserController@emailValidator');
  Route::get('logout','UserController@logout');
  Route::post('logincheck','UserController@loginCheck');
  Route::get('forget','UserController@forget');
  Route::get('profile/{id}','UserController@profile');
  Route::post('insertProfile','UserController@insertProfile');
  Route::get('transactions/{id}','UserController@transactions');
  Route::get('vote','UserController@vote');



});

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
  //Base
  Route::get('z.admin','AdminController@login');
  Route::post('z.admin','AdminController@login');
  Route::get('logout','AdminController@logout');
  Route::get('dashboard',['as'=>'dashboard','uses'=>'AdminController@dashboard']);
  Route::get('ajaxCore','AdminController@ajaxCore');
  Route::post('ajaxCore','AdminController@ajaxCore');
  //Orders
  Route::get('print/{id}','AdminController@mPrint');
  Route::post('ordersFactorFilter','AdminController@ordersFactorFilter');
  Route::get('ordersFactorFilter','AdminController@ordersFactorFilter');
  Route::post('ordersNameFilter','AdminController@ordersNameFilter');
  Route::get('ordersNameFilter','AdminController@ordersNameFilter');
  Route::post('ordersNew','AdminController@ordersNew');
  Route::get('ordersNewLoadSbs','AdminController@ordersNewLoadSbs');
  Route::post('ordersNewLoadSbs','AdminController@ordersNewLoadSbs');
  Route::post('ordersNewLoadFood','AdminController@ordersNewLoadFood');
  Route::get('ordersNewLoadFood','AdminController@ordersNewLoadFood');
  Route::post('ordersTypeFilters','AdminController@ordersTypeFilters');
  Route::get('ordersTypeFilters','AdminController@ordersTypeFilters');
  Route::get('ordersFoodCountFilter','AdminController@ordersFoodCountFilter');
  Route::post('ordersFoodCountFilter','AdminController@ordersFoodCountFilter');
  Route::post('ordersPriceFilter','AdminController@ordersPriceFilter');
  Route::get('ordersPriceFilter','AdminController@ordersPriceFilter');
  Route::get('ordersTimeFilter','AdminController@ordersTimeFilter');
  Route::post('ordersTimeFilter','AdminController@ordersTimeFilter');
  Route::get('ordersAutoGetNew','AdminController@ordersAutoGetNew');
  Route::get('filterOrders','AdminController@filterOrders');
  Route::get('new-save-order-route','AdminController@newsaveorderroute');


  //reporting
  Route::get('reportingOrders','AdminController@reportingOrders');
  Route::get('reportingOrdersSort','AdminController@reportingOrdersSort');
  Route::get('filterOrderReport','AdminController@filterOrderReport');
  Route::get('reportingFoods','AdminController@reportingFoods');
  Route::get('filterFoodsReport','AdminController@filterFoodsReport');
  Route::get('reportingDelivery','AdminController@reportingDelivery');
  Route::get('filterDeliveryReports','AdminController@filterDeliveryReports');
  Route::get('reportingPaymentType','AdminController@reportingPaymentType');
  Route::get('filterPaymentTypeReports','AdminController@filterPaymentTypeReports');
  Route::get('reportingTransactions','AdminController@reportingTransactions');
  Route::get('filterTransactionsReport','AdminController@filterTransactionsReport');
  Route::get('reportingCosts','AdminController@reportingCosts');
  Route::get('filterCostsReport','AdminController@filterCostsReport');
  Route::get('reportingIncomes','AdminController@reportingIncomes');
  Route::get('filterIncomeReports','AdminController@filterIncomeReports');
  Route::get('reportingSalary','AdminController@reportingSalary');
  Route::get('filterSalaryReports','AdminController@filterSalaryReports');
  Route::get('reportingUsersClub','AdminController@reportingUsersClub');
  Route::get('filterUsersClubReports','AdminController@filterUsersClubReports');
  Route::get('reportingStaffOrders','AdminController@reportingStaffOrders');
  Route::get('filterStaffOrdersReport','AdminController@filterStaffOrdersReport');
  Route::get('reportingWarehouse','AdminController@reportingWarehouse');
  Route::get('filterWareHouseReports','AdminController@filterWareHouseReports');
  Route::get('reportingLoans','AdminController@reportingLoans');
  Route::get('filterLoanReports','AdminController@filterLoanReports');
  Route::get('reportingVacations','AdminController@reportingVacations');
  Route::get('filterVacationReports','AdminController@filterVacationReports');

  //Excel Export
  Route::get('excel-export','AdminController@exportChart');

  //accounting
  Route::get('new-cost','AdminController@newCostForm');
  Route::get('submit-new-cost','AdminController@submitCost');
  Route::get('new-cost-type','AdminController@costTypeForm');
  Route::get('new-add-personel','AdminController@newaddpersonel');
  Route::get('submit-cost-type','AdminController@submitCostType');
  Route::get('submit-order-new','AdminController@submitordernew');
  Route::get('new-personel','AdminController@newpersonel');
  Route::get('new-income-form','AdminController@newIncomeForm');
  Route::get('submit-income','AdminController@submitIncome');
  Route::get('new-money-type','AdminController@newMoneyTypeForm');
  Route::get('submit-money-type','AdminController@submitMoneyType');
  Route::get('filter-salary','AdminController@filterSalary');
  Route::get('st-salary','AdminController@staffSalary');
  Route::get('fill-new-orders','AdminController@fillneworders');
  Route::get('paySalary','AdminController@paySalary');
  Route::get('submit-change-order','AdminController@submitchangeorder');
  Route::get('new-account-form','AdminController@submitAccountForm');
  Route::get('submit-account','AdminController@submitAccount');
  Route::get('new-trans-form','AdminController@transForm');
  Route::get('insert-trans','AdminController@insertTrans');
  Route::get('edit-cost/{id}','AdminController@editCost');
  Route::get('edit-income/{id}','AdminController@editIncome');
  Route::get('edit-cost-type/{id}','AdminController@editCostType');
  Route::get('change-status-order/{id}','AdminController@changestatusorder');
  Route::get('sallary-payed/{id}','AdminController@sallarypayed');
  Route::get('edit-money-type/{id}','AdminController@editMoneyType');
  Route::get('edit-account/{id}','AdminController@editaccount');
  Route::get('edit-c-coupon/{id}','AdminController@editccoupon');
  Route::get('delete-account','AdminController@deleteaccount');
  Route::get('delete-costtype','AdminController@deletecosttype');
  Route::get('delete-res-subset','AdminController@deleteressubset');
  Route::get('delete-cost','AdminController@deletecost');
  Route::get('delete-social-media','AdminController@deletesocialmedia');
  Route::get('delete-moneytype','AdminController@deletemoneytype');
  Route::get('delete-income','AdminController@deleteincome');
  Route::get('back-account','AdminController@backaccount');
  Route::get('back-costtype','AdminController@backcosttype');
  Route::get('back-moneytype','AdminController@backmoneytype');
  Route::get('edit-reg-field','AdminController@editregfield');
  Route::get('new-c-coupon','AdminController@newccoupon');


  //hr
  Route::get('staff-order-1','AdminController@firstStateStaffOrder');
  Route::get('staff-order-2','AdminController@secondStateStaffOrder');
  Route::get('staff-order-3','AdminController@thirdStateStaffOrder');
  Route::get('submit-new-leave','AdminController@newLeave');
  Route::get('change-vacation','AdminController@changeCondition');
  Route::get('insert-leave','AdminController@insertLeave');
  Route::get('new-edit-personel/{id}','AdminController@neweditpersonel');
  Route::get('delete-staff','AdminController@deleteStaff');
  Route::get('eve/{id}','AdminController@showEvidence');
  Route::get('food-category-photo/{id}','AdminController@foodcategoryphoto');
  Route::get('deleteEve/{id}','AdminController@deleteEve');
  Route::post('addEvidence/{id}','AdminController@addEvidence');
  Route::post('addfoodcategoryphoto/{id}','AdminController@addfoodcategoryphoto');
  //Loan
  Route::get('loans','AdminController@loans');
  Route::get('addLoan','AdminController@addLoan');
  Route::get('getLoans/{id}','AdminController@getStaffLoans');
  Route::get('payLoan','AdminController@setPay');
  Route::get('sallary-nopay','AdminController@sallarynopay');
  Route::get('editLoan','AdminController@editLoan');
  Route::get('submit-edit-loan','AdminController@submitEditLoan');

  //warehouse
  Route::get('submitwarehouse-warehouses','AdminController@wareHouseWareHouses');
  Route::get('add-mat-cat','AdminController@addMatCat');
  Route::get('edit-mat-group/{id}','AdminController@editMaterialGroup');
  Route::get('update-mat-cat','AdminController@updateMaterialGroup');
  Route::get('new-material','AdminController@submitNewMaterial');
  Route::get('edit-material/{id}','AdminController@editMaterial');
  Route::get('update-material','AdminController@updateMaterial');
  Route::get('search-inventory','AdminController@searchInventory');
  Route::get('add-unit','AdminController@unitForm');
  Route::get('new-unit','AdminController@submitUnit');
  Route::get('deleteMaterial','AdminController@deleteMaterial');
  Route::get('filterMatByStorage','AdminController@filterMatByStorage');
  Route::get('loadMaterials','AdminController@loadMaterials');
  Route::get('exchangeMaterials','AdminController@exchangeMaterials');
  Route::get('delete-unit','AdminController@deleteUnit');
  Route::get('add-store-warehouse','AdminController@submitstorewarehouse');
  Route::get('edit-store/{id}','AdminController@editstore');
  Route::get('delete-store','AdminController@deletestore');
  Route::get('delete-matcat','AdminController@deletematcat');
  Route::get('add-material','AdminController@addmaterial');
  Route::get('add-mat-exchange','AdminController@submitmatexchange');



  //users club
  // Route::get('insert-coopen/{id}','AdminController@insertCoopen');

  Route::get('add-coupon','AdminController@insertCoupon');
  Route::get('add-c-coupon','AdminController@addCCoupon');
  Route::get('add-food-category','AdminController@addfoodcategory');
  Route::get('add-food','AdminController@addfood');
  Route::get('add-res-subset','AdminController@addressubset');
  // Route::get('deleteCoupon','AdminController@deleteCoupon');
  // Route::get('deleteAfterBuyCoupon','AdminController@deleteAfterBuyCoupon');
  // Route::get('add-after-buy-coupon','AdminController@insertAfterBuyCoupon');
  Route::get('filter-customers','AdminController@filterCustomers');
  Route::get('attachCoupon','AdminController@attachCoupon');
  Route::get('add-customers','AdminController@submitusercustomer');
  Route::get('edit-customers/{id}','AdminController@editcustomers');
  Route::get('delete-customers','AdminController@deletecustomers');
  Route::get('edit-coupon/{id}','AdminController@editcoupon');
  Route::get('edt-food-cat/{id}','AdminController@edtfoodcat');
  Route::get('edit-res-subset/{id}','AdminController@editressubset');

  // Route::get('change-coopen-state','AdminController@changeCoopenState');
  // Route::get('activate-coopen-state','AdminController@activateCoopenState');
  Route::get('addSocialMediaAddress','AdminController@addSocialMediaAddress');
  Route::get('add-reg-field','AdminController@addRegisterField');
  Route::get('deactive-field','AdminController@deactivateField');
  Route::get('active-field','AdminController@activateField');
  Route::get('insert-vote','AdminController@insertVote');
  Route::get('delete-vote','AdminController@deleteVote');
  Route::get('vote-detail','AdminController@voteDetails');
  Route::get('submit-user','AdminController@submitUser');
  Route::get('delete-coopen/{id}','AdminController@deleteCoopen');
  Route::get('search-coopen','AdminController@searchCoopen');
  Route::get('edit-vote','AdminController@editVote');
  Route::get('edit-register-fields/{id}','AdminController@editregisterfields');
  Route::get('submit-edit-vote','AdminController@submitEditVote');
  Route::get('add-coupons','AdminController@addcoupons');
  Route::get('add-food-cat','AdminController@addfoodcat');


  //settings
  Route::get('new-panel-user','AdminController@newPanelUser');
  Route::post('site-info','AdminController@insertSiteInfo');
  Route::get('order-setting','AdminController@orderPaymentType');
  Route::get('service-settings','AdminController@ServiceSettings');
  Route::get('changeOrderingStatus','AdminController@changeOrderingStatus');
  Route::get('googleMap','AdminController@googleMap');
  Route::post('insert-new-food','AdminController@insertFood');
  Route::get('accessGroup','AdminController@accessGroup');
  Route::get('loadMat','AdminController@loadMat');
  Route::get('new-social-media','AdminController@newsocialmedia');
  Route::get('new-vote','AdminController@newvote');
  Route::get('new-res-subset','AdminController@newressubset');
  Route::get('new-register-fields','AdminController@newregisterfields');
  Route::get('edit-social-media/{id}','AdminController@editsocialmedia');

  //account Settings
  Route::get('editAdminAccount','AdminController@editAdminAccount');

});

Route::group(['prefix'=>'food','middleware'=>'csrf','namespace'=>'Food'],function(){
  Route::get('menu','FoodController@menu');
  Route::get('addlist','FoodController@addToList');
  Route::post('addlist','FoodController@addToList');
  Route::post('preorder','FoodController@preOrder');
  Route::get('preorder','FoodController@preOrder');
  Route::get('preorderform','FoodController@preOrderForm');
  Route::get('insertorder','FoodController@insertOrders');
  Route::post('insertorder','FoodController@insertOrders');
  Route::post('insertorder','FoodController@io');
  Route::get('io','FoodController@io');
  Route::post('io','FoodController@io');
  Route::get('confirm','FoodController@confirm');
  Route::post('check-coopen','FoodController@checkCoopen');
  Route::get('validatePayment','FoodController@validatePayment');
});
