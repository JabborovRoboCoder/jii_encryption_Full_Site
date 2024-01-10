

<!-- s+++++++++++++++++++++++++++++++++++++++ -->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key = $_POST["kalit"];
    $tanlash = $_POST["shifrr"];
    $msg = $_POST["matn"];

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
    function decryptMessage($msg, $key) {
        $cipher=$msg;
        $mss = "";
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
            $mss = implode(array_merge(...$dec_cipher));
        } catch (TypeError $e) {
            throw new Exception("Noto'g'ri harakat amalga oshirildi.Dastur bu matnga ishlov bera olmaydi.");
        }
    
        $null_count = substr_count($mss, '_');
    
        if ($null_count > 0) {
            return substr($mss, 0, -$null_count);
        }
    
        return $mss;
    }

    
}
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <title>Shifrlash Sayti</title>
    <link rel="stylesheet" href="style.css">
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
        <div class="container px-5">
            <img class="img-fluid rounded mx-3" width="40" src="assets/f1.png" alt="...">
            <a class="navbar-brand" href="index.php"><span class="fw-bolder text-primary">jii shifrlash dasturi</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                    <li class="nav-item"><a class="nav-link" href="index.php">Bosh sahifa</a></li>
                    <li class="nav-item"><a class="nav-link" href="resume.html">Yuklab olish</a></li>
                    <li class="nav-item"><a class="nav-link" href="projects.html">Qo'llanma</a></li>
                    <li class="nav-item"><a class="nav-link" href="online.php">Online Foydalanish</a></li>

                </ul>
            </div>
        </div>
    </nav>
    
    
    <div class="container">
        <h1>jii Shifrlash / de-Shifrlash</h1>
        <form action="" method="post">
            <label for="kalit">Kalit so'zni kiriting:</label>
            <input type="text" id="kalit" name="kalit" required>
            
            <label for="tanlash">Harakatni tanlang:</label>
            <div class="d-flex justify-content-around">
            <div>
            <input type="radio" id="demoCheckbox" name="shifrr" value="0" required> Shifrlash
            </div>
            <div>
            <input type="radio" id="demoCheckbox" name="shifrr" value="1" required> Deshifrlash
            </div>
            </div>
            
            <label for="matn">Matnni kiriting:</label>
            <textarea id="matn" name="matn" rows="4" required></textarea>
            
            <button class="mt-3" type="submit">Amalni bajarish</button>
        </form>
    </div>
    <div class="container">
        <?php
            if (isset($tanlash)){
                if ($tanlash == "0") {
                    $cipher = encryptMessage($msg, $key);
                    echo "<p><div id='myInput'>$cipher</div></p>";
                    
                } elseif ($tanlash == "1") {
                    $decryptedMsg = decryptMessage($msg, $key);
                    echo "<p>$decryptedMsg</p>";
                } else {
                    echo "<p>Noto'g'ri harakat amalga oshirildi.Dastur bu matnga ishlov bera olmaydi.</p>";
                }}
        ?>
    </div>

            <script>
                const copyText = document.querySelector("#myInput")

                copyText.addEventListener('click', (e)=>{
                    navigator.clipboard.writeText(e.target.textContent);
                })
            </script>
    
<!-- Footer-->
        <footer class="bg-white py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0">Copyright &copy; Ilhom Jabborov 2024</div></div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
