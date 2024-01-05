<?php

$key = "HACK";

// Encryption
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

    return $cipher;
}

// Decryption
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

    for ($i = 0; $i < $col; $i++) {
        $curr_idx = array_search($key_lst[$k_indx], $key_lst);
        for ($j = 0; $j < $row; $j++) {
            $dec_cipher[$j][$curr_idx] = $msg_lst[$msg_indx];
            $msg_indx++;
        }
        $k_indx++;
    }

    try {
        $msg = implode(array_merge(...$dec_cipher));
    } catch (TypeError $e) {
        throw new Exception("This program cannot handle repeating words.");
    }

    $null_count = substr_count($msg, '_');

    if ($null_count > 0) {
        return substr($msg, 0, -$null_count);
    }

    return $msg;
}

// Driver Code
$msg = "Men Qorboboga ishonaman URA Dilmurod !!!";

$cipher = encryptMessage($msg, $key);
echo "Encrypted Message: $cipher\n";

$decryptedMsg = decryptMessage($cipher, $key);
echo "Decrypted Message: $decryptedMsg\n";

?>
