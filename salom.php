<?php

$key = "salom";

// shifrlash
function encryptMessage($msg, $key) {
    $cipher = "";
    $k_indx = 0;
    $msg_len = strlen($msg);
    $msg_lst = str_split($msg);
    $key_lst = str_split($key);

    $col = strlen($key);
    $row = ceil($msg_len / $col);
    $fill_null = ($row * $col) - $msg_len;
    for ($i = 0; $i < $fill_null; $i++) {
        $msg_lst[] = '_';
    }

    $matrix = array_chunk($msg_lst, $col);

    for ($i = 0; $i < $col; $i++) {
        $curr_idx = array_search($key_lst[$k_indx], $key_lst);
        foreach ($matrix as $row) {
            $cipher .= $row[$curr_idx];
        }
        $k_indx++;
    }

    $royxat = "";
    for ($i = 0; $i < strlen($cipher); $i++) {
        switch ($cipher[$i]) {
            case '1':
                $royxat .= 'б';
                break;
            case '2':
                $royxat .= 'и';
                break;
            case '3':
                $royxat .= 'у';
                break;
            case '4':
                $royxat .= 'т';
                break;
            case '5':
                $royxat .= 'в';
                break;
            case '6':
                $royxat .= 'о';
                break;
            case '7':
                $royxat .= 'й';
                break;
            case '8':
                $royxat .= 'с';
                break;
            case '9':
                $royxat .= 'ч';
                break;
            default:
                $royxat .= $cipher[$i];
                break;
        }
    }
    return $royxat;
}


// deshifrlash
function decryptMessage($cipher, $key) {
    $msg = "";
    $k_indx = 0;
    $msg_indx = 0;
    $msg_len = strlen($cipher);
    $msg_lst = str_split($cipher);

    $col = strlen($key);
    $row = ceil($msg_len / $col);
    $key_lst = str_split($key);

    $dec_cipher = array_fill(0, $row, array_fill(0, $col, null));

    // for ($i = 0; $i < $col; $i++) {
    //     $curr_idx = array_search($key_lst[$k_indx], $key_lst);
    //     for ($j = 0; $j < $row; $j++) {
    //         $dec_cipher[$j][$curr_idx] = $msg_lst[$msg_indx];
    //         $msg_indx++;
    //     }
    //     $k_indx++;
    // }
    for ($i = 0; $i < $col && $k_indx < count($key_lst); $i++) {
        $curr_idx = array_search($key_lst[$k_indx], $key_lst);
    
        for ($j = 0; $j < $row && $msg_indx < count($msg_lst); $j++) {
            $dec_cipher[$j][$curr_idx] = $msg_lst[$msg_indx];
            $msg_indx++;
        }
    
        $k_indx++;
    }
    

    try {
        $msg = implode(array_merge(...$dec_cipher));
    } catch (TypeError $e) {
        throw new Exception("Bu dastur ushbu shifrlashni bajara olmaydi.Boshqa matn kiritib ko'ring.");
    }

    $null_count = substr_count($msg, '_');

    if ($null_count > 0) {
        return substr($msg, 0, -$null_count);
    }

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
    
    return $royxat;
}


$msg = "Men Ilhomman salom 1";

$cipher = encryptMessage($msg, $key);
echo "Shifrlangan: $cipher\n";

$decryptedMsg = decryptMessage($cipher, $key);
echo "De-Shifrlash: $decryptedMsg\n";

?>
