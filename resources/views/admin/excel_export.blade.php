<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body style="direction: rtl;text-align: center;">
<table style="text-align: center">
    <tbody>
    <tr style="text-align: center">
        <?php
        foreach ($titles as $title) {
            ?>
                <th><?php echo $title?></th>
            <?php
        }
        ?>
    </tr>
    <?php
    for($i=0;$i<count($values);$i++){
    ?>
    <tr style="text-align: center">
        <?php
        $j=0;
        foreach($values[$i] as $value){
            ?>
            <td><?php echo $value?></td>
            <?php
            $j++;
        }
        ?>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>
</body>
</html>
