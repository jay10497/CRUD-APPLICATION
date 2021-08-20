<?php 
    $conn = mysqli_connect("localhost","root","","categoryDB");

    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result = array();
    $catID = '';
    $action = '';
    
    
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    
    if($action == 'read'){
        $sql_cat = $conn -> query("select id,category from categories");
        $categories = array();
        while($row = $sql_cat -> fetch_assoc()){
            array_push($categories, $row);
        }
        $result['categories'] = $categories;
    }
    
    $catID = $_COOKIE['id'];
    
    if($catID != 0){
        $sql_doc = $conn -> query("select name from documents where category_id=$catID");
        $documents = array();
        while($row = $sql_doc -> fetch_assoc()){
            array_push($documents, $row);
        }
        $result['documents'] = $documents;         
    }

    if($action == 'create'){
        $name = $_POST['name'];
        $sql = $conn -> query("insert into documents(category_id,name,updated_at) values('$catId','$name',CURRENT_TIMESTAMP)");
        
    }

     
    echo json_encode($result);
    
    //print $catID;
    /*
    if($action == 'create'){
        $catID = $_POST['categoryID'];
        $sql_cat = $conn -> query("select * from documents where category_id=$catID");
        $categories = array();
        while($row = $sql_cat -> fetch_assoc()){
            array_push($categories, $row);
        }
        $result['documents'] = $categories;

    }
    echo json_encode($result);
    /*
    if($action == 'readID'){
        $catID = '1';
        $sql_doc = $conn -> query("select * from documents where category_id ='$categoryID'");
        $documents = array();
        while($row = $sql_doc -> fetch_assoc()){
            array_push($documents, $row);
        }
        $resultDoc['documents'] = $documents;
    }
    echo json_encode($result);
    */
?>