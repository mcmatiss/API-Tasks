<?php
echo "Choose one of the options:" .
    PHP_EOL .
    "[1] - Estimate the Age of a Name." .
    PHP_EOL .
    "[2] - Check the Gender of a Name." .
    PHP_EOL .
    "[3] - Predict the Nationality of a Name." .
    PHP_EOL .
    "[4] - Display all of the above and more of a Name." .
    PHP_EOL;
$userChoice = (int) readline("Enter number (1-4): ");
if ($userChoice < 1 || $userChoice > 4) {
    exit("Invalid input.\n");
}
$name = readline("Type your name: ");
$agify = json_decode(file_get_contents("https://api.agify.io?name=$name"));
$genderize = json_decode(
    file_get_contents("https://api.genderize.io?name=$name")
);
$nationalize = json_decode(
    file_get_contents("https://api.nationalize.io/?name=$name")
);
$countryNames = json_decode(
    file_get_contents("http://country.io/names.json"),
    true
);
if ($agify->age === null) {
    exit("Name not found.\n");
}
switch ($userChoice) {
    case 1:
        echo "$name is $agify->age years old.\n";
        break;
    case 2:
        echo "$name is $genderize->gender with " .
            $genderize->probability * 100 .
            "% certainty.\n";
        break;
    case 3:
        echo "$name is from {$countryNames[$nationalize->country[0]->country_id]} with " .
            round($nationalize->country[0]->probability * 100) .
            "% certainty.\n";
        break;
    case 4:
        echo "$name is $agify->age years old, is $genderize->gender with " .
            $genderize->probability * 100 .
            "% certainty and is ";
        foreach ($nationalize->country as $index => $nationality) {
            if ($index !== count($nationalize->country) - 1) {
                echo "from {$countryNames[$nationality->country_id]} with " .
                    round($nationality->probability * 100) .
                    "% certainty, ";
            } else {
                echo "from {$countryNames[$nationality->country_id]} with " .
                    round($nationality->probability * 100) .
                    "% certainty.\n";
            }
        }
}