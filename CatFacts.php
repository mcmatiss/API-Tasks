<?php
$catFacts = json_decode(
    file_get_contents(
        "https://cat-fact.herokuapp.com/facts/random/?animal_type=cat&amount=100"
    )
);
$factAmount = 2;
foreach ($catFacts as $catFact) {
    if ($catFact->status->verified) {
        echo "$catFact->text\n";
        $factAmount--;
    }
    if ($factAmount == 0) {
        break;
    }
}