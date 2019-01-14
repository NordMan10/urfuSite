<?php
session_start();
include ('connection.php');

if (isset($_POST['user_id'])) {
    $user_number = $_POST['user_id'];
    $_SESSION['user_number'] = $user_number;
    $query = mysql_query("SELECT * from abiturients WHERE `abiturient_reg_id` = '$user_number'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $abiturient_fullname = $row['abiturient_fullname'];
        $abiturient_exam_type = $row['abiturient_exam_type'];
        $abiturient_private_score = $row['abiturient_private_score'];
        $abiturient_choose_speciality_id = $row['abiturient_choose_speciality_id'];
    }
    $query = mysql_query("SELECT * from choose_specialities WHERE `student_reg_id` = '$user_number'");
    echo mysql_error();
    echo "<div class='tablecpec'><div class=\"col-md-12\">
                    <table class=\"table\">
                        <thead>
                        <tr>
                            <th scope=\"col\"></th>
                            <th scope=\"col\">Выбрать направление подготовки</th>
                        </tr>
                        </thead>
                        <tbody>";
    while ($row = mysql_fetch_array($query)) {

        $speciality_id = $row['speciality_id'];
        $total_score = $row['total_score'];
        $query1 = mysql_query("SELECT * from specialities WHERE `speciality_id` = '$speciality_id'");
        echo mysql_error();
        while ($row1 = mysql_fetch_array($query1)) {
            $speciality_name = $row1['speciality_name'];
        }
        echo "<tr class='radiocheck'>";
        if ($speciality_id == $abiturient_choose_speciality_id) {
            echo "<th scope=\"row\"><input type=\"radio\" value='$speciality_id' name=\"way\"></th><td>$speciality_name</td>";
        } else {
            echo "<th scope=\"row\"><input type=\"radio\" value='$speciality_id' name=\"way\"></th><td>$speciality_name</td>";
        }
        echo "</tr>";
    }
    echo "
                        </tbody>
                    </table>
                </div>
                </div>";
    $query = mysql_query("SELECT * from abiturients WHERE `abiturient_reg_id` = '$user_number'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $abiturient_fullname = $row['abiturient_fullname'];
        $abiturient_exam_type = $row['abiturient_exam_type'];
        $abiturient_private_score = $row['abiturient_private_score'];
        $abiturient_choose_speciality_id = $row['abiturient_choose_speciality_id'];
    }
    $query = mysql_query("SELECT * from choose_specialities WHERE `student_reg_id` = '$user_number'");
    echo mysql_error();
                echo "<div class='selectcpec'>
                            <select id=\"choose\">
                <option value=\"hide\">Выбрать направление подготовки</option>";
    while ($row = mysql_fetch_array($query)) {
        echo "<tr>";
        $speciality_id = $row['speciality_id'];
        $total_score = $row['total_score'];
        $query1 = mysql_query("SELECT * from specialities WHERE `speciality_id` = '$speciality_id'");
        echo mysql_error();
        while ($row1 = mysql_fetch_array($query1)) {
            $speciality_name = $row1['speciality_name'];
        }
        if ($speciality_id == $abiturient_choose_speciality_id) {
            echo "<option value=\"$speciality_id[$i]\">$speciality_name</option>";
        } else {
            echo "<option value=\"$speciality_id[$i]\">$speciality_name</option>";
        }
        echo "</tr>";
    }
            echo "</select>
</div>
    ";

}

if (isset($_POST['user_speciality'])) {
    $user_speciality = $_POST['user_speciality'];
    $user_number = $_SESSION['user_number'];
    $query = mysql_query("SELECT * from specialities WHERE `speciality_id` = '$user_speciality'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $speciality_id = $row['speciality_id'];
        $budget = $row['budget'];
    }
    $j = 0;
    $query = mysql_query("SELECT * from choose_specialities WHERE `speciality_id` = '$speciality_id'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $j++;
        $student_id = $row['student_reg_id'];
        $student_score = $row['total_score'];
        $query2 = mysql_query("SELECT * from specialities WHERE `speciality_id` = '$speciality_id'");
        echo mysql_error();
        while ($row2 = mysql_fetch_array($query2)) {
            $subject_id[1] = $row2['subject1_id'];
            $subject_id[2] = $row2['subject2_id'];
            $subject_id[3] = $row2['subject3_id'];
        }
        $query2 = mysql_query("SELECT * from abiturients WHERE `abiturient_reg_id` = '$student_id'");
        echo mysql_error();
        while ($row2 = mysql_fetch_array($query2)) {
            $private_score = $row2['abiturient_private_score'];
        }
        for ($i = 1; $i <= 3; $i++) {
            $subject = $subject_id[$i];
            $query2 = mysql_query("SELECT * from exam WHERE `abiturient_reg_id` = '$student_id' AND `subject_id` = '$subject'");
            echo mysql_error();
            while ($row2 = mysql_fetch_array($query2)) {
                $scores[$i] = $row2['score'];
            }
        }
        $students[$j] = array($student_id, $student_score, $private_score, $scores[1], $scores[2], $scores[3]);
    }
    $k = $j;
    $proverka = 0;

    for ($c = 0; $c < $k; $c++) {
        for ($g = 1; $g < $k - $c; $g++) {



            if ((int)$students[$g][1] < (int)$students[$g + 1][1]) {
                $temp[0] = $students[$g][0];
                $temp[1] = $students[$g][1];
                $temp[2] = $students[$g][2];
                $temp[3] = $students[$g][3];
                $temp[4] = $students[$g][4];
                $temp[5] = $students[$g][5];
                $students[$g][0] = $students[$g + 1][0];
                $students[$g][1] = $students[$g + 1][1];
                $students[$g][2] = $students[$g + 1][2];
                $students[$g][3] = $students[$g + 1][3];
                $students[$g][4] = $students[$g + 1][4];
                $students[$g][5] = $students[$g + 1][5];
                $students[$g + 1][0] = $temp[0];
                $students[$g + 1][1] = $temp[1];
                $students[$g + 1][2] = $temp[2];
                $students[$g + 1][3] = $temp[3];
                $students[$g + 1][4] = $temp[4];
                $students[$g + 1][5] = $temp[5];
            } elseif ((int)$students[$g][1] == (int)$students[$g + 1][1]) {
                if ((int)$students[$g][3] < (int)$students[$g + 1][3]) {
                    $temp[0] = $students[$g][0];
                    $temp[1] = $students[$g][1];
                    $temp[2] = $students[$g][2];
                    $temp[3] = $students[$g][3];
                    $temp[4] = $students[$g][4];
                    $temp[5] = $students[$g][5];
                    $students[$g][0] = $students[$g + 1][0];
                    $students[$g][1] = $students[$g + 1][1];
                    $students[$g][2] = $students[$g + 1][2];
                    $students[$g][3] = $students[$g + 1][3];
                    $students[$g][4] = $students[$g + 1][4];
                    $students[$g][5] = $students[$g + 1][5];
                    $students[$g + 1][0] = $temp[0];
                    $students[$g + 1][1] = $temp[1];
                    $students[$g + 1][2] = $temp[2];
                    $students[$g + 1][3] = $temp[3];
                    $students[$g + 1][4] = $temp[4];
                    $students[$g + 1][5] = $temp[5];
                } elseif ((int)$students[$g][3] == (int)$students[$g + 1][3]) {
                    if ((int)$students[$g][4] < (int)$students[$g + 1][4]) {
                        $temp[0] = $students[$g][0];
                        $temp[1] = $students[$g][1];
                        $temp[2] = $students[$g][2];
                        $temp[3] = $students[$g][3];
                        $temp[4] = $students[$g][4];
                        $temp[5] = $students[$g][5];
                        $students[$g][0] = $students[$g + 1][0];
                        $students[$g][1] = $students[$g + 1][1];
                        $students[$g][2] = $students[$g + 1][2];
                        $students[$g][3] = $students[$g + 1][3];
                        $students[$g][4] = $students[$g + 1][4];
                        $students[$g][5] = $students[$g + 1][5];
                        $students[$g + 1][0] = $temp[0];
                        $students[$g + 1][1] = $temp[1];
                        $students[$g + 1][2] = $temp[2];
                        $students[$g + 1][3] = $temp[3];
                        $students[$g + 1][4] = $temp[4];
                        $students[$g + 1][5] = $temp[5];
                    } elseif ((int)$students[$g][4] == (int)$students[$g + 1][4]) {
                        if ((int)$students[$g][5] < (int)$students[$g + 1][5]) {
                            $temp[0] = $students[$g][0];
                            $temp[1] = $students[$g][1];
                            $temp[2] = $students[$g][2];
                            $temp[3] = $students[$g][3];
                            $temp[4] = $students[$g][4];
                            $temp[5] = $students[$g][5];
                            $students[$g][0] = $students[$g + 1][0];
                            $students[$g][1] = $students[$g + 1][1];
                            $students[$g][2] = $students[$g + 1][2];
                            $students[$g][3] = $students[$g + 1][3];
                            $students[$g][4] = $students[$g + 1][4];
                            $students[$g][5] = $students[$g + 1][5];
                            $students[$g + 1][0] = $temp[0];
                            $students[$g + 1][1] = $temp[1];
                            $students[$g + 1][2] = $temp[2];
                            $students[$g + 1][3] = $temp[3];
                            $students[$g + 1][4] = $temp[4];
                            $students[$g + 1][5] = $temp[5];
                        } elseif ((int)$students[$g][5] == (int)$students[$g + 1][5]) {
                            if ((int)$students[$g][2] < (int)$students[$g + 1][2]) {
                                $temp[0] = $students[$g][0];
                                $temp[1] = $students[$g][1];
                                $temp[2] = $students[$g][2];
                                $temp[3] = $students[$g][3];
                                $temp[4] = $students[$g][4];
                                $temp[5] = $students[$g][5];
                                $students[$g][0] = $students[$g + 1][0];
                                $students[$g][1] = $students[$g + 1][1];
                                $students[$g][2] = $students[$g + 1][2];
                                $students[$g][3] = $students[$g + 1][3];
                                $students[$g][4] = $students[$g + 1][4];
                                $students[$g][5] = $students[$g + 1][5];
                                $students[$g + 1][0] = $temp[0];
                                $students[$g + 1][1] = $temp[1];
                                $students[$g + 1][2] = $temp[2];
                                $students[$g + 1][3] = $temp[3];
                                $students[$g + 1][4] = $temp[4];
                                $students[$g + 1][5] = $temp[5];
                            }
                        }
                    }
                }
            }
        }
    }

//    for ($c = 1; $c <= $k; $c++) {
//        $student = $students[$c][0];
//        $score = $students[$c][1];
//        $private = $students[$c][2];
//        $score1 = $students[$c][3];
//        $score2 = $students[$c][4];
//        $score3 = $students[$c][5];
//        if ($proverka == 1) {
//            if ((int)$score_o < (int)$score) {
//                $temp = $students[$c - 1];
//                $students[$c - 1] = $students[$c];
//                $students[$c] = $temp;
//            } elseif ((int)$score_o == (int)$score) {
//                if ((int)$score1_o < (int)$score1) {
//                    $temp = $students[$c - 1];
//                    $students[$c - 1] = $students[$c];
//                    $students[$c] = $temp;
//                    $sdf[$c] = '1<<';
//                } elseif ((int)$score1_o == (int)$score1) {
//                    if ((int)$score2_o < (int)$score2) {
//                        $sdf[$c] = '2<<';
//                        $temp = $students[$c - 1];
//                        $students[$c - 1] = $students[$c];
//                        $students[$c] = $temp;
//                    } elseif ((int)$score2_o == (int)$score2) {
//                        if ((int)$score3_o < (int)$score3) {
//                            $sdf[$c] = '3<<';
//                            $temp = $students[$c - 1];
//                            $students[$c - 1] = $students[$c];
//                            $students[$c] = $temp;
//                        } elseif ((int)$score3_o == (int)$score3) {
//                            $sdf[$c] = '3==';
//                            if ((int)$private_o < (int)$private) {
//                                $sdf[$c] = '4<<';
//                                $temp = $students[$c - 1];
//                                $students[$c - 1] = $students[$c];
//                                $students[$c] = $temp;
//                            }
//                        }
//                    }
//                }
//            }
//        }
//        $proverka = 1;
//        $student_o = $student;
//        $score_o = $score;
//        $private_o = $private;
//        $score1_o = $score1;
//        $score2_o = $score2;
//        $score3_o = $score3;
//    }

    for ($i = 1; $i <= $k; $i++) {
        if ($students[$i][0] == $user_number) {
            $budget = $budget;
            $position = $i;
            $total = $k;
        }
    }





    echo "
    <ul id=\"myTab2\" class=\"nav nav-tabs\">
                <li class='active'><a data-toggle=\"tab\" href=\"#panely1\" class='active show'>Статистика</a></li>
                <li><a data-toggle=\"tab\" href=\"#panely2\">Список</a></li>
                <li><a data-toggle=\"tab\" href=\"#panely3\">Данные</a></li>
            </ul>
            <div class=\"tab-content\">
                <div id=\"panely1\" class=\"tab-pane fade in active\">
                    <div class=\"statgroup\">
                        <div class=\"statblock\">
                            <p class=\"stat\">$position</p>
                            <h3>Вы в рейтинге</h3>
                        </div>

                        <div class=\"statblock\">
                            <p class=\"stat\">$total</p>
                            <h3>Всего поступающих</h3>

                        </div>

                        <div class=\"statblock\">
                            <p class=\"stat\">$budget</p>
                            <h3>Бюджетных мест</h3>
                        </div>
                    </div>
                </div>
                <div id=\"panely2\" class=\"tab-pane fade\">
                    <table class=\"table table-striped\">
                        <thead>
                        <tr>
                            <th scope=\"col\">№</th>
                            <th scope=\"col\">Абитуриент</th>
                            <th scope=\"col\">Общий балл</th>
                        </tr>
                        </thead>
                        <tbody>
  ";


    for ($i = $position-5; $i <= $position+5; $i++) {
        if (isset($students[$i])) {
            $student = $students[$i][0];
            $score = $students[$i][1];
            $private = $students[$i][2];
            $score1 = $students[$i][3];
            $score2 = $students[$i][4];
            $score3 = $students[$i][5];
            $query = mysql_query("SELECT * from abiturients WHERE abiturient_reg_id = '$student'");
            echo mysql_error();
            while ($row = mysql_fetch_array($query)) {
                $fullname = $row['abiturient_fullname'];
                $choose_speciality = $row['abiturient_choose_speciality_id'];
                if ((int)$student == (int)$user_number) {

                    $dop = 'bg1-success';
                }
                else {
                    $dop = '';
                }
            }
            if ($student != '') {
                echo "
    <tr class='$dop'>
      <th scope=\"row\">$i</th>
      <td>$fullname</td>
      <td>$score</td>
        </tr>
    ";
            }

        }
    }
    echo "
    
    
</tbody>
                    </table>
                </div>



                    
                        
<div id=\"panely3\" class=\"tab-pane fade\">";
    $user_number_1 = $_SESSION['user_number'];
    $query = mysql_query("SELECT * from abiturients WHERE abiturient_reg_id = '$user_number_1'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $abiturient_fullname1 = $row['abiturient_fullname'];
        $abiturient_exam_type1 = $row['abiturient_exam_type'];
        $abiturient_private_score1 = $row['abiturient_private_score'];
        $abiturient_choose_speciality_id1 = $row['abiturient_choose_speciality_id'];
    }
    $iii = 0;
    $query = mysql_query("SELECT * from exam WHERE abiturient_reg_id = '$user_number_1'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $iii++;
        $abiturient_subject1[$iii] = $row['subject_id'];
        $abiturient_score1[$iii] = $row['score'];
    }
    $jjj = 0;
    $query = mysql_query("SELECT * from choose_specialities WHERE student_reg_id = '$user_number_1'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $jjj++;
        $abiturient_total_score1[$jjj] = $row['total_score'];
        $abiturient_speciality_id1[$jjj] = $row['speciality_id'];
    }

    for ($kkk = 1; $kkk <= $iii; $kkk++) {
        $query = mysql_query("SELECT * FROM subjects WHERE subject_id = '$abiturient_subject1[$kkk]'");
        echo mysql_error();
        while ($row = mysql_fetch_array($query)) {
            $abiturient_subject1[$kkk] = $row['subject_name'];
        }
    }
    for ($kkk = 1; $kkk <= $jjj; $kkk++) {
        $query = mysql_query("SELECT * FROM specialities WHERE speciality_id = '$abiturient_speciality_id1[$kkk]'");
        echo mysql_error();
        while ($row = mysql_fetch_array($query)) {
            $abiturient_speciality_id1[$kkk] = $row['speciality_name'];
        }
    }

    $query = mysql_query("SELECT * FROM specialities WHERE speciality_id = '$abiturient_choose_speciality_id1'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $abiturient_choose_speciality_id1 = $row['speciality_name'];
    }

    echo "

   <table class=\"table table-striped\">
                        <tbody>

 <tr>
 <th>ФИО</th>
 <td>$abiturient_fullname1</td>
</tr>
<tr>
 <th>Регистрационный номер</th>
 <td>$user_number_1</td>
</tr>
<tr>
 <th>Тип вступительных испытаний</th>
 <td>$abiturient_exam_type1</td>
</tr>

<tr>
 <th>Балл личных достижений</th>
 <td>$abiturient_private_score1</td>
</tr>
 <tr>
 <th>Предпочтительное направление подготовки</th>
 <td>$abiturient_choose_speciality_id1</td>
</tr>   
<tr>
 <th>***Баллы вступительных испытаний***</th>
</tr>";
    for ($kkk = 1; $kkk <= $iii; $kkk++) {
        echo "
        <tr>
        <th>$abiturient_subject1[$kkk]</th>
        <td>$abiturient_score1[$kkk]</td>
        </tr>
        ";
    }
    echo "
    <tr>
 <th>***Выбранные направления подготовки***</th>
 <th>***Баллы***</th>
</tr>";
    for ($kkk = 1; $kkk <= $jjj; $kkk++) {
        echo "
        <tr>
        <th>$abiturient_speciality_id1[$kkk]</th>
        <td>$abiturient_total_score1[$kkk]</td>
        </tr>
        ";
    }

    echo "
</tbody>
                    </table>
                </div>
                </div>



    
    
        
    
    ";

}

if (isset($_POST['user_speciality1'])) {
    $user_speciality = $_POST['user_speciality1'];
    $user_number = $_SESSION['user_number'];
    $query = mysql_query("SELECT * from specialities WHERE `speciality_name` = '$user_speciality'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $speciality_id = $row['speciality_id'];
        $budget = $row['budget'];
    }
    $j = 0;
    $query = mysql_query("SELECT * from choose_specialities WHERE `speciality_id` = '$speciality_id'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $j++;
        $student_id = $row['student_reg_id'];
        $student_score = $row['total_score'];
        $query2 = mysql_query("SELECT * from specialities WHERE `speciality_id` = '$speciality_id'");
        echo mysql_error();
        while ($row2 = mysql_fetch_array($query2)) {
            $subject_id[1] = $row2['subject1_id'];
            $subject_id[2] = $row2['subject2_id'];
            $subject_id[3] = $row2['subject3_id'];
        }
        $query2 = mysql_query("SELECT * from abiturients WHERE `abiturient_reg_id` = '$student_id'");
        echo mysql_error();
        while ($row2 = mysql_fetch_array($query2)) {
            $private_score = $row2['abiturient_private_score'];
        }
        for ($i = 1; $i <= 3; $i++) {
            $subject = $subject_id[$i];
            $query2 = mysql_query("SELECT * from exam WHERE `abiturient_reg_id` = '$student_id' AND `subject_id` = '$subject'");
            echo mysql_error();
            while ($row2 = mysql_fetch_array($query2)) {
                $scores[$i] = $row2['score'];
            }
        }
        $students[$j] = array($student_id, $student_score, $private_score, $scores[1], $scores[2], $scores[3]);
    }
    $k = $j;
    $proverka = 0;

    for ($c = 0; $c < $k; $c++) {
        for ($g = 1; $g < $k - $c; $g++) {


            if ((int)$students[$g][1] < (int)$students[$g + 1][1]) {
                $temp[0] = $students[$g][0];
                $temp[1] = $students[$g][1];
                $temp[2] = $students[$g][2];
                $temp[3] = $students[$g][3];
                $temp[4] = $students[$g][4];
                $temp[5] = $students[$g][5];
                $students[$g][0] = $students[$g + 1][0];
                $students[$g][1] = $students[$g + 1][1];
                $students[$g][2] = $students[$g + 1][2];
                $students[$g][3] = $students[$g + 1][3];
                $students[$g][4] = $students[$g + 1][4];
                $students[$g][5] = $students[$g + 1][5];
                $students[$g + 1][0] = $temp[0];
                $students[$g + 1][1] = $temp[1];
                $students[$g + 1][2] = $temp[2];
                $students[$g + 1][3] = $temp[3];
                $students[$g + 1][4] = $temp[4];
                $students[$g + 1][5] = $temp[5];
            } elseif ((int)$students[$g][1] == (int)$students[$g + 1][1]) {
                if ((int)$students[$g][3] < (int)$students[$g + 1][3]) {
                    $temp[0] = $students[$g][0];
                    $temp[1] = $students[$g][1];
                    $temp[2] = $students[$g][2];
                    $temp[3] = $students[$g][3];
                    $temp[4] = $students[$g][4];
                    $temp[5] = $students[$g][5];
                    $students[$g][0] = $students[$g + 1][0];
                    $students[$g][1] = $students[$g + 1][1];
                    $students[$g][2] = $students[$g + 1][2];
                    $students[$g][3] = $students[$g + 1][3];
                    $students[$g][4] = $students[$g + 1][4];
                    $students[$g][5] = $students[$g + 1][5];
                    $students[$g + 1][0] = $temp[0];
                    $students[$g + 1][1] = $temp[1];
                    $students[$g + 1][2] = $temp[2];
                    $students[$g + 1][3] = $temp[3];
                    $students[$g + 1][4] = $temp[4];
                    $students[$g + 1][5] = $temp[5];
                } elseif ((int)$students[$g][3] == (int)$students[$g + 1][3]) {
                    if ((int)$students[$g][4] < (int)$students[$g + 1][4]) {
                        $temp[0] = $students[$g][0];
                        $temp[1] = $students[$g][1];
                        $temp[2] = $students[$g][2];
                        $temp[3] = $students[$g][3];
                        $temp[4] = $students[$g][4];
                        $temp[5] = $students[$g][5];
                        $students[$g][0] = $students[$g + 1][0];
                        $students[$g][1] = $students[$g + 1][1];
                        $students[$g][2] = $students[$g + 1][2];
                        $students[$g][3] = $students[$g + 1][3];
                        $students[$g][4] = $students[$g + 1][4];
                        $students[$g][5] = $students[$g + 1][5];
                        $students[$g + 1][0] = $temp[0];
                        $students[$g + 1][1] = $temp[1];
                        $students[$g + 1][2] = $temp[2];
                        $students[$g + 1][3] = $temp[3];
                        $students[$g + 1][4] = $temp[4];
                        $students[$g + 1][5] = $temp[5];
                    } elseif ((int)$students[$g][4] == (int)$students[$g + 1][4]) {
                        if ((int)$students[$g][5] < (int)$students[$g + 1][5]) {
                            $temp[0] = $students[$g][0];
                            $temp[1] = $students[$g][1];
                            $temp[2] = $students[$g][2];
                            $temp[3] = $students[$g][3];
                            $temp[4] = $students[$g][4];
                            $temp[5] = $students[$g][5];
                            $students[$g][0] = $students[$g + 1][0];
                            $students[$g][1] = $students[$g + 1][1];
                            $students[$g][2] = $students[$g + 1][2];
                            $students[$g][3] = $students[$g + 1][3];
                            $students[$g][4] = $students[$g + 1][4];
                            $students[$g][5] = $students[$g + 1][5];
                            $students[$g + 1][0] = $temp[0];
                            $students[$g + 1][1] = $temp[1];
                            $students[$g + 1][2] = $temp[2];
                            $students[$g + 1][3] = $temp[3];
                            $students[$g + 1][4] = $temp[4];
                            $students[$g + 1][5] = $temp[5];
                        } elseif ((int)$students[$g][5] == (int)$students[$g + 1][5]) {
                            if ((int)$students[$g][2] < (int)$students[$g + 1][2]) {
                                $temp[0] = $students[$g][0];
                                $temp[1] = $students[$g][1];
                                $temp[2] = $students[$g][2];
                                $temp[3] = $students[$g][3];
                                $temp[4] = $students[$g][4];
                                $temp[5] = $students[$g][5];
                                $students[$g][0] = $students[$g + 1][0];
                                $students[$g][1] = $students[$g + 1][1];
                                $students[$g][2] = $students[$g + 1][2];
                                $students[$g][3] = $students[$g + 1][3];
                                $students[$g][4] = $students[$g + 1][4];
                                $students[$g][5] = $students[$g + 1][5];
                                $students[$g + 1][0] = $temp[0];
                                $students[$g + 1][1] = $temp[1];
                                $students[$g + 1][2] = $temp[2];
                                $students[$g + 1][3] = $temp[3];
                                $students[$g + 1][4] = $temp[4];
                                $students[$g + 1][5] = $temp[5];
                            }
                        }
                    }
                }
            }
        }
    }

//    for ($c = 1; $c <= $k; $c++) {
//        $student = $students[$c][0];
//        $score = $students[$c][1];
//        $private = $students[$c][2];
//        $score1 = $students[$c][3];
//        $score2 = $students[$c][4];
//        $score3 = $students[$c][5];
//        if ($proverka == 1) {
//            if ((int)$score_o < (int)$score) {
//                $temp = $students[$c - 1];
//                $students[$c - 1] = $students[$c];
//                $students[$c] = $temp;
//            } elseif ((int)$score_o == (int)$score) {
//                if ((int)$score1_o < (int)$score1) {
//                    $temp = $students[$c - 1];
//                    $students[$c - 1] = $students[$c];
//                    $students[$c] = $temp;
//                    $sdf[$c] = '1<<';
//                } elseif ((int)$score1_o == (int)$score1) {
//                    if ((int)$score2_o < (int)$score2) {
//                        $sdf[$c] = '2<<';
//                        $temp = $students[$c - 1];
//                        $students[$c - 1] = $students[$c];
//                        $students[$c] = $temp;
//                    } elseif ((int)$score2_o == (int)$score2) {
//                        if ((int)$score3_o < (int)$score3) {
//                            $sdf[$c] = '3<<';
//                            $temp = $students[$c - 1];
//                            $students[$c - 1] = $students[$c];
//                            $students[$c] = $temp;
//                        } elseif ((int)$score3_o == (int)$score3) {
//                            $sdf[$c] = '3==';
//                            if ((int)$private_o < (int)$private) {
//                                $sdf[$c] = '4<<';
//                                $temp = $students[$c - 1];
//                                $students[$c - 1] = $students[$c];
//                                $students[$c] = $temp;
//                            }
//                        }
//                    }
//                }
//            }
//        }
//        $proverka = 1;
//        $student_o = $student;
//        $score_o = $score;
//        $private_o = $private;
//        $score1_o = $score1;
//        $score2_o = $score2;
//        $score3_o = $score3;
//    }

    for ($i = 1; $i <= $k; $i++) {
        if ($students[$i][0] == $user_number) {
            $budget = $budget;
            $position = $i;
            $total = $k;
        }
    }


    echo "
    <ul id=\"myTab2\" class=\"nav nav-tabs\">
                <li class='active'><a data-toggle=\"tab\" href=\"#panely1\" class='active show'>Статистика</a></li>
                <li><a data-toggle=\"tab\" href=\"#panely2\">Список</a></li>
                <li><a data-toggle=\"tab\" href=\"#panely3\">Данные</a></li>
            </ul>
            <div class=\"tab-content\">
                <div id=\"panely1\" class=\"tab-pane fade in active\">
                    <div class=\"statgroup\">
                        <div class=\"statblock\">
                            <p class=\"stat\">$position</p>
                            <h3>Вы в рейтинге</h3>
                        </div>
                    </div>
                    <div class=\"statgroup\">
                        <div class=\"statblock\">
                            <p class=\"stat\">$total</p>
                            <h3>Всего поступающих</h3>
                        </div>
                    </div>
                        
                    <div class=\"statgroup\">
                        <div class=\"statblock\">
                            <p class=\"stat\">$budget</p>
                            <h3>Бюджетных мест</h3>
                        </div>
                    </div>
                </div>
                <div id=\"panely2\" class=\"tab-pane fade\">
                    <table class=\"table table-striped\">
                        <thead>
                        <tr>
                            <th scope=\"col\">№</th>
                            <th scope=\"col\">Абитуриент</th>
                            <th scope=\"col\">Общий балл</th>
                        </tr>
                        </thead>
                        <tbody>
  ";


    for ($i = $position - 5; $i <= $position + 5; $i++) {
        if (isset($students[$i])) {
        $student = $students[$i][0];
        $score = $students[$i][1];
        $private = $students[$i][2];
        $score1 = $students[$i][3];
        $score2 = $students[$i][4];
        $score3 = $students[$i][5];
        $query = mysql_query("SELECT * from abiturients WHERE abiturient_reg_id = '$student'");
        echo mysql_error();
        while ($row = mysql_fetch_array($query)) {
            $fullname = $row['abiturient_fullname'];
            $choose_speciality = $row['abiturient_choose_speciality_id'];
            if ((int)$student == (int)$user_number) {

                $dop = 'bg1-success';
            } else {
                $dop = '';
            }
        }
        if ($student != '') {
            echo "
    <tr class='$dop'>
      <th scope=\"row\">$i</th>
      <td>$fullname</td>
      <td>$score</td>
        </tr>
    ";
        }

    }
}
    echo "
    
    
</tbody>
                    </table>
                </div>



                    
                        
<div id=\"panely3\" class=\"tab-pane fade\">";
    $user_number_1 = $_SESSION['user_number'];
    $query = mysql_query("SELECT * from abiturients WHERE abiturient_reg_id = '$user_number_1'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $abiturient_fullname1 = $row['abiturient_fullname'];
        $abiturient_exam_type1 = $row['abiturient_exam_type'];
        $abiturient_private_score1 = $row['abiturient_private_score'];
        $abiturient_choose_speciality_id1 = $row['abiturient_choose_speciality_id'];
    }
    $iii = 0;
    $query = mysql_query("SELECT * from exam WHERE abiturient_reg_id = '$user_number_1'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $iii++;
        $abiturient_subject1[$iii] = $row['subject_id'];
        $abiturient_score1[$iii] = $row['score'];
    }
    $jjj = 0;
    $query = mysql_query("SELECT * from choose_specialities WHERE student_reg_id = '$user_number_1'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $jjj++;
        $abiturient_total_score1[$jjj] = $row['total_score'];
        $abiturient_speciality_id1[$jjj] = $row['speciality_id'];
    }

    for ($kkk = 1; $kkk <= $iii; $kkk++) {
        $query = mysql_query("SELECT * FROM subjects WHERE subject_id = '$abiturient_subject1[$kkk]'");
        echo mysql_error();
        while ($row = mysql_fetch_array($query)) {
            $abiturient_subject1[$kkk] = $row['subject_name'];
        }
    }
    for ($kkk = 1; $kkk <= $jjj; $kkk++) {
        $query = mysql_query("SELECT * FROM specialities WHERE speciality_id = '$abiturient_speciality_id1[$kkk]'");
        echo mysql_error();
        while ($row = mysql_fetch_array($query)) {
            $abiturient_speciality_id1[$kkk] = $row['speciality_name'];
        }
    }

    $query = mysql_query("SELECT * FROM specialities WHERE speciality_id = '$abiturient_choose_speciality_id1'");
    echo mysql_error();
    while ($row = mysql_fetch_array($query)) {
        $abiturient_choose_speciality_id1 = $row['speciality_name'];
    }

    echo "

   <table class=\"table table-striped\">
                        <tbody>

 <tr>
 <th>ФИО</th>
 <td>$abiturient_fullname1</td>
</tr>
<tr>
 <th>Регистрационный номер</th>
 <td>$user_number_1</td>
</tr>
<tr>
 <th>Тип вступительных испытаний</th>
 <td>$abiturient_exam_type1</td>
</tr>

<tr>
 <th>Балл личных достижений</th>
 <td>$abiturient_private_score1</td>
</tr>
 <tr>
 <th>Предпочтительное направление подготовки</th>
 <td>$abiturient_choose_speciality_id1</td>
</tr>   
<tr>
 <th>***Баллы вступительных испытаний***</th>
</tr>";
    for ($kkk = 1; $kkk <= $iii; $kkk++) {
        echo "
        <tr>
        <th>$abiturient_subject1[$kkk]</th>
        <td>$abiturient_score1[$kkk]</td>
        </tr>
        ";
    }
    echo "
    <tr>
 <th>***Выбранные направления подготовки***</th>
 <th>***Баллы***</th>
</tr>";
    for ($kkk = 1; $kkk <= $jjj; $kkk++) {
        echo "
        <tr>
        <th>$abiturient_speciality_id1[$kkk]</th>
        <td>$abiturient_total_score1[$kkk]</td>
        </tr>
        ";
    }

    echo "
</tbody>
                    </table>
                </div>
                </div>



    
    
        
    
    ";

}



if (isset($_POST['likeload'])) {
    if (isset($_COOKIE['like'])) {
        $query = mysql_query("SELECT * from likes");
        while ($row = mysql_fetch_array($query)) {
            $likes = $row['likes'];
        }
        if ($likes < 1) {
            $likes = 0;
        }
        echo "
        <div class=\"container\">
            <div class=\"vote\">
                <span class=\"likes liked\"><i class=\"fa fa-heart \"></i> $likes</span>
            </div>
        </div>
        ";
    } else {
        $query = mysql_query("SELECT * from likes");
        while ($row = mysql_fetch_array($query)) {
            $likes = $row['likes'];
        }
        if ($likes < 1) {
            $likes = 0;
        }
        echo "
        <div class=\"container\">
            <div class=\"vote\">
                <span class=\"likes \"><i class=\"fa fa-heart likeme\"></i> $likes</span>
            </div>
        </div>
        ";
    }
}
if (isset($_POST['likeclick'])) {
    if (isset($_COOKIE['like'])) {
        unset($_COOKIE['like']);
        setcookie('like', '', time() - 3600, '/');
        $query = mysql_query("SELECT * from likes");
        while ($row = mysql_fetch_array($query)) {
            $likes = $row['likes'];
        }
        $likes--;
        $query = mysql_query("UPDATE `likes` SET `likes` = '$likes'");
        echo mysql_error();
        echo "
        <div class=\"container\">
            <div class=\"vote\">
                <span class=\"likes \"><i class=\"fa fa-heart likeme\"></i> $likes</span>
            </div>
        </div>
        ";
    } else {
        setcookie("like", 1, time()+60*60*24*365*10);
        $query = mysql_query("SELECT * from likes");
        while ($row = mysql_fetch_array($query)) {
            $likes = $row['likes'];
        }
        $likes++;
        $query = mysql_query("UPDATE `likes` SET `likes` = '$likes'");
        echo mysql_error();
        echo "
        <div class=\"container\">
            <div class=\"vote\">
                <span class=\"likes liked\"><i class=\"fa fa-heart \"></i> $likes</span>
            </div>
        </div>
        ";
    }
}
?>