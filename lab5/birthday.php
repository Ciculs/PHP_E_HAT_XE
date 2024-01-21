<?php

function birthdaycount($birthdate) {
    $today = new DateTime();
    $birthday = new DateTime($birthdate);

    $birthday->setDate($today->format('Y'), $birthday->format('m'), $birthday->format('d'));

    if ($today > $birthday) {
        $birthday->modify('+1 year');
    }

    $songay = $today->diff($birthday);

    return $songay->days;
}

$birthdate = "2005-01-02";
$count = birthdaycount($birthdate);

echo "Số ngày còn lại đến sinh nhật: $count\n";
?>