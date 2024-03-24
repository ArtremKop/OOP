<?php

include('calc.php');
include('seq.php');
include('range.php');

class MathCalculator
{
    protected function calculateRange($start, $finish)
    {
        $results = calculateRange($start, $finish);
        $maxValue = max(array_column($results['results'], 'maxValue'));
        $minValue = min(array_column($results['results'], 'maxValue'));

        $maxIterations = array_search($maxValue, array_column($results['results'], 'maxValue'));
        $minIterations = array_search($minValue, array_column($results['results'], 'maxValue'));

        return [
            'results' => $results['results'],
            'maxNumber' => $results['results'][$maxIterations]['number'],
            'minNumber' => $results['results'][$minIterations]['number'],
            'maxIterations' => $maxIterations,
            'minIterations' => $minIterations
        ];
    }
}

class MathStatsCalculator extends MathCalculator
{
    public function calculateHistogram($start, $finish)
    {
        $histogram = [];
        for ($i = $start; $i <= $finish; $i++) {
            $iterations = 0;
            $number = $i;
            while ($number != 1) {
                if ($number % 2 == 0) {
                    $number /= 2;
                } else {
                    $number = 3 * $number + 1;
                }
                $iterations++;
            }
            if (isset($histogram[$iterations])) {
                $histogram[$iterations]++;
            } else {
                $histogram[$iterations] = 1;
            }
        }
        return $histogram;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start = $_POST["start"];
    $finish = $_POST["finish"];

    // Create MathStatsCalculator instance
    $statsCalculator = new MathStatsCalculator();

    // Calculate histogram
    $histogram = $statsCalculator->calculateHistogram($start, $finish);

    // Output histogram
    echo "<h3>Histogram:</h3>";
    foreach ($histogram as $iterations => $count) {
        echo "Iterations: " . $iterations . ", Count: " . $count . "<br>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
</head>

<body>
    <h2>Calculator - Kopach Artem - task 3</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="start">Start Number:</label>
        <input type="number" id="start" name="start" required><br><br>
        <label for="finish">Finish Number:</label>
        <input type="number" id="finish" name="finish" required><br><br>
        <input type="submit" value="Calculate">
    </form>
</body>

</html>
