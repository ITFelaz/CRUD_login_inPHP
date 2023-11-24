<?php
if ($Table == 'Student') {
    foreach($newres as $item) {
        foreach($row as $rows) {
            if ($rows['COLUMN_NAME'] == 'Record_book_number')
                $Record = $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'Full_name')
                $Full_name = $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'Faculty')
                $Faculty = $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'Groups')
                $Groups= $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'job_id')
                $job_id = $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'Year')
                $Year= $item[$rows['COLUMN_NAME']];
        }
    }
}

if ($Table == 'Teachers') {
    foreach($newres as $item) {
        foreach($row as $rows) {
            if ($rows['COLUMN_NAME'] == 'Full_name')
                $Full_name = $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'Degree')
                $Degree= $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'Rank')
                $Rank = $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'Department')
                $Department = $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'Phone')
                $Phone= $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'email')
                $email= $item[$rows['COLUMN_NAME']];
        }
    }
}

if ($Table == 'Subject') {
    foreach($newres as $item) {
        foreach($row as $rows) {
            if ($rows['COLUMN_NAME'] == 'teacher_id')
                $teacher_id = $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'Theme_diploma')
                $Theme_diploma = $item[$rows['COLUMN_NAME']];
            
        }
    }
}

if ($Table == 'Marks') {
    foreach($newres as $item) {
        foreach($row as $rows) {
            if ($rows['COLUMN_NAME'] == 'Record_book_number')
                $Record_book_number = $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'State_assessment_exam')
                $State_assessment_exam = $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'Defense_assessment')
                $Defense_assessment = $item[$rows['COLUMN_NAME']];
            if ($rows['COLUMN_NAME'] == 'id_student')
                $id_student = $item[$rows['COLUMN_NAME']];
        }
    }
}


