<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#fff;min-width:300px;">
    <li style="display: inline-block;padding:10px 8px;width:100px;">نام</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">شماره تماس</li>
    <li style="display: inline-block;padding:10px 8px;width:100px;">شماره اشتراک</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">تاریخ ثبت نام</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">تاریخ آخرین بازدید</li>
</ul>
@if(isset($customers))
  @foreach($customers as $customer)
    <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
        <li style="display: inline-block;padding:10px 8px;width:100px;">{{$customer->name}}</li>
        <li style="display: inline-block;padding:10px 8px;width:200px;">{{$customer->phone}}</li>
        <li style="display: inline-block;padding:10px 8px;width:100px;">{{$customer->cctt}}</li>
        <li style="display: inline-block;padding:10px 8px;width:200px;">{{g2j($customer->submit_date)}}</li>
        <li style="display: inline-block;padding:10px 8px;width:200px;">{{g2j($customer->last_visit)}}</li>
    </ul>
@endforeach
@endif
