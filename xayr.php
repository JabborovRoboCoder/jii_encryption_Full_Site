<?php
$msg = "ббиу12";

$royxat = "";
for ($i = 0; $i < strlen($msg); $i++) {
    switch (mb_substr($msg, $i, 1)) {
        case 'б':
            $royxat .= '1';
            break;
        case 'и':
            $royxat .= '2';
            break;
        case 'у':
            $royxat .= '3';
            break;
        case 'т':
            $royxat .= '4';
            break;
        case 'в':
            $royxat .= '5';
            break;
        case 'о':
            $royxat .= '6';
            break;
        case 'й':
            $royxat .= '7';
            break;
        case 'с':
            $royxat .= '8';
            break;
        case 'ч':
            $royxat .= '9';
            break;
        default:
            $royxat .= mb_substr($msg, $i, 1);
            break;
    }
}

echo $royxat;
?>