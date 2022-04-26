<?php

    function countRow(){

        require ('data.php');
        $query = "SELECT count(*) as n FROM employees";
        $result = mysqli_query($connessione, $query)
            or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
        $row = mysqli_fetch_array ($result);
        return $row[0];

    }

    function getPage($first, $lenght){

        require ('data.php');
        $query = "SELECT * FROM employees ORDER BY id LIMIT $first, $lenght";
        $result = mysqli_query($connessione, $query)
            or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
        $rows = array();
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function postEmployee($birth_date, $first_name, $last_name, $gender){
        require ('data.php');
        $query = "INSERT INTO employees (birth_date, first_name, last_name, gender, hire_date) VALUES ('$birth_date', '$first_name', '$last_name', '$gender', null)";
        $connessione -> query($query);
    }

    function deleteEmployee($id){
        require ('data.php');
        $query = "DELETE FROM employees WHERE employees.id = $id";
        $connessione -> query($query);
    }

    function editEmployee($id, $birth_date, $first_name, $last_name, $gender){
        require ('data.php');
        $query = "UPDATE employees SET birth_date = '$birth_date', first_name = '$first_name', last_name = '$last_name', gender = '$gender' WHERE id = $id";
        $connessione -> query($query);
    }

?>