

<!-- s+++++++++++++++++++++++++++++++++++++++ -->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kalit = $_POST["kalit"];
    $tanlash = $_POST["tanlash"];
    $matn = $_POST["matn"];

    function shifrlashMatn($matn, $kalit) {
        // Shifrlash algoritmi
        
    }

    function de_shifrlash($shifr, $kalit) {
        // De-Shifrlash algoritmi
    }

    if ($tanlash == "1") {
        $shifr = shifrlashMatn($matn, $kalit);
        echo "Shifrlangan matn: " . $shifr;
    } elseif ($tanlash == "2") {
        $de_shifr_matn = de_shifrlash($matn, $kalit);
        echo "De-Shifrlangan matn: " . $de_shifr_matn;
    } else {
        echo "Noto'g'ri raqam kiritildi. Iltimos, faqat 1 yoki 2 raqamini kiriting.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shifrlash Sayti</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Matn Shifrlash va Ochish</h1>
        <form action="" method="post"> 
            <label for="kalit">Kalit so'zni kiriting:</label>
            <input type="text" id="kalit" name="kalit" required>
            
            <label for="tanlash">Raqamni kiriting (1 oddiy so'z, 2 shifrlangan so'z):</label>
            <input type="text" id="tanlash" name="tanlash" required>
            
            <label for="matn">Matnni kiriting:</label>
            <textarea id="matn" name="matn" rows="4" required></textarea>
            
            <button type="submit">Amalni bajarish</button>
        </form>
    </div>
</body>
</html>
