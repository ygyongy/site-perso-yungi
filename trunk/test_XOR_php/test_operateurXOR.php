<div>
    <?php
        $a = 9;
        $b = 12;

        $aA = decbin($a);
        $bB = decbin($b);

        echo $aA . " XOR " . $bB . " = ";
        echo decbin($a^$b);
    ?>
</div>