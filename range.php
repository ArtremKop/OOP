<?php

function calculateRange($start, $finish) {
    $results = array();
    $maxIterations = 0;
    $minIterations = PHP_INT_MAX;
    $maxNumber = 0;
    $minNumber = 0;

    for ($i = $start; $i <= $finish; $i++) {
        $result = calculateSequence($i);
        $iterations = $result["iterations"];
        $maxSequenceValue = max($result["sequence"]);

        $results[] = array("number" => $i, "maxValue" => $maxSequenceValue, "iterations" => $iterations);

        if ($iterations > $maxIterations) {
            $maxIterations = $iterations;
            $maxNumber = $i;
        }
        if ($iterations < $minIterations) {
            $minIterations = $iterations;
            $minNumber = $i;
        }
    }

    return array("results" => $results, "maxNumber" => $maxNumber, "maxIterations" => $maxIterations, "minNumber" => $minNumber, "minIterations" => $minIterations);
}


?>

