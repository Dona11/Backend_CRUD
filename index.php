<?php

    require "pages/dbLayer.php";
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    $ar = array();
    $page = @$_GET['page'] ?? 0;
    $size = @$_GET['size'] ?? 20;
    $tot = countRow();
    $URL = "http://localhost:8080/";
    $method = $_SERVER['REQUEST_METHOD'];
    $last = floor($tot / $size);

    

    $ar['_embedded'] = array(
        "employees" => array()
    );

    $ar['_links'] = links($page, $size, $last, $URL);

    $ar['page'] = [
        'size' => $size,
        'totalElements' => $tot,
        'totalPages' => $last,
        'number' => $page
    ];

    if($method == "GET"){
        
        $ar['_embedded']['employees'] = getPage($page*$size, $size);
        echo json_encode($ar);
    }else if($method == "POST"){
        $data = json_decode(file_get_contents('php://input'), true);
        postEmployee($data["birth_date"], $data['first_name'], $data['last_name'], $data['gender']);
        echo json_encode($data);
    }else if($method == "DELETE"){
        deleteEmployee($_GET['id']);
        echo json_encode($ar);
    }else if($method == "PUT"){
        $data = json_decode(file_get_contents('php://input'), true);
        editEmployee($_GET['id'], $data["birth_date"], $data['first_name'], $data['last_name'], $data['gender']);
        echo json_encode($data);
    }

    function href($url, $page, $size){

        $href = $url . "?page=" . $page . "&size=" . $size;
        return $href;
    }

    function links($page, $size, $last, $URL){
        $links = array();
        $links['first']['href'] = href($URL, 0, $size);

        if($page > 0){
            $links['prev']['href'] = href($URL, ($page - 1), $size);
        }
        if($page < $last){

            $links['next']['href'] = href($URL, ($page + 1), $size);
        }
        $links['last']['href'] = href($URL, $last, $size);

        return $links;
    }

?>

