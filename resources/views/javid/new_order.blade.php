<ul class="nav nav-tabs"><?php
  if (isset($foods)) {
    foreach ($menu as $bar) {?>
      <li><a href="#<?php echo $bar->menu_name;?>"><?php echo $bar->menu_name;?></a></li>
      <?php
    }
  }
  ?>
</ul>
<div class="tab-content">
<?php
foreach ($menu as $bar) {
  foreach ($foods as $food) {
    foreach ($food as $foo) {
      if ($foo->menu_name == $bar->menu_name) { ?>
        <div class="tab-pane fade" id="<?php echo $foo->menu_name ?>">
          <li style="width:200px;margin-right: 15px;text-align: center;display: inline-block;padding:12px 5px;list-style: none;"><?php echo $foo->foodname; ?></li>
          <div class="contentContainer">
            <input style="padding:8px; width:120px;" class="price" id="price<?php echo $foo->id; ?>"
                   onkeyup="costCalc('price<?php echo $foo->id; ?>','totalCost<?php echo $foo->id; ?>','<?php echo $foo->price ?>')"
                   name="<?php echo $foo->foodname; ?>" value="0">
            <li
              style="width:200px;margin-right: 15px;text-align: center;display: inline-block;padding:12px 5px;list-style: none;"><?php echo $foo->price; ?></li>
            <div style="display: inline-block">
              <span id="totalCost<?php echo $foo->id; ?>" name="<?php echo $foo->id ?>"
                    style=";margin-right:180px;"></span>
            </div>
          </div>
        </div>
        <?php
      }
    }
  }
}
?>
</div>
