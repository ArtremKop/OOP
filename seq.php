<?php



function calculateSequence($start) {
    $sequence = array($start);
    $current = $start;
    $iterations = 0;
    while ($current != 1) {
        $current = calculateFunction($current);
        $sequence[] = $current;
        $iterations++;
    }
    return array("sequence" => $sequence, "iterations" => $iterations);
}


?>

