<?php 
 if ($Table == 'Student') {
    echo '
    <input type="text" size="40" name="Record_book_number" value="'. $Record .'"> <br>
    <input type="text" size="40" name="Full_name" value="'. $Full_name.'"><br>
    <input type="text" size="40" name="Faculty" value="'.$Faculty.'"><br>
    <input type="text" size="40" name="Groups" value="'. $Groups.'"><br>
    <input type="text" size="40" name="job_id" value="'.$job_id.'"><br>
    <input type="text" size="40" name="Year" value="'.$Year.'"><br>';
}

if ($Table == 'Teachers') {
    echo '
    <input type="text" size="40" name="Full_name" value="'. $Full_name .'"> <br>
    <input type="text" size="40" name="Degree" value="'. $Degree.'"><br>
    <input type="text" size="40" name="Rank" value="'.$Rank.'"><br>
    <input type="text" size="40" name="Department" value="'. $Department.'"><br>
    <input type="text" size="40" name="Phone" value="'.$Phone.'"><br>
    <input type="text" size="40" name="email" value="'.$email.'"><br>';
}

if ($Table == 'Subject') {
    echo '
    <input type="text" size="40" name="teacher_id" value="'. $teacher_id .'"> <br>
    <input type="text" size="40" name="Theme_diploma" value="'. $Theme_diploma.'"><br>
    ';}

if ($Table == 'Marks') {
    echo '
    <input type="text" size="40" name="Record_book_number" value="'. $Record_book_number .'"><br>
        <input type="text" size="40" name="State_assessment_exam" value="'. $State_assessment_exam.'"><br>
        <input type="text" size="40" name="Defense_assessment" value="'. $Defense_assessment .'"><br>
        <input type="text" size="40" name="id_student" value="'. $id_student.'"><br>
    ';}
    