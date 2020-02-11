<?php 
require "../include/database_config.php";

$category = trim($_GET["category"]);
$subCategory = trim($_GET["subCategory"]);
$priceMin = trim($_GET["priceMin"]);
$priceMax = trim($_GET["priceMax"]);
$search = trim($_GET["search"]);
$bindCount = 0;

$param = array();


$where = '';

$phone = 1;
$charger = 2;
$earphone = 4;
$cases = 8;
$watches = 16;

$ios = 1;
$android = 2;


// NOTE(Morne): THE ORDER OF THESE CHECKS CANNOT BE CHANGED!
if ($category != 0)
{
    if (($category & $phone) != 0)
    {
        array_push($param, 'phone');
        if($bindCount)
        {
            $where .= ' AND product_category = ?';
        }
        else
        {
            $where .= ' WHERE product_category = ?';
        }
        $bindCount++;
    }

    if (($category & $charger) != 0)
    {
        array_push($param, 'charger');
        if($bindCount)
        {
            $where .= ' AND product_category = ?';
        }
        else
        {
            $where .= ' WHERE product_category = ?';
        }
        $bindCount++;
    }

    if (($category & $earphone) != 0)
    {
        array_push($param, 'earphone');
        if($bindCount)
        {
            $where .= ' AND product_category = ?';
        }
        else
        {
            $where .= ' WHERE product_category = ?';
        }
        $bindCount++;
    }
    
    if (($category & $cases) != 0)
    {
        array_push($param, 'cases');
        if($bindCount)
        {
            $where .= ' AND product_category = ?';
        }
        else
        {
            $where .= ' WHERE product_category = ?';
        }
        $bindCount++;
    }

    if (($category & $watches) != 0)
    {
        array_push($param, 'watches');
        if($bindCount)
        {
            $where .= 'AND product_category = ?';
        }
        else
        {
            $where .= ' WHERE product_category = ?';
        }
        $bindCount++;
    }
}

if ($subCategory != 0)
{
    if (($subCategory & $ios) != 0)
    {
        array_push($param, 'apple');
        if($bindCount)
        {
            $where .= ' AND product_sub_category = ?';
        }
        else
        {
            $where .= ' WHERE product_sub_category = ?';
        }
        $bindCount++;
    }

    if (($subCategory & $android) != 0)
    {
        array_push($param, 'android');
        if($bindCount)
        {
            $where .= ' AND product_sub_category = ?';
        }
        else
        {
            $where .= ' WHERE product_sub_category = ?';
        }
        $bindCount++;
    }
}

if ($priceMin != 0)
{
    array_push($param, $priceMin);
    if ($bindCount)
    {
        $where .= ' AND product_price >= ?';
    }
    else
    {
        $where .= ' WHERE product_price >= ?';
    }
    $bindCount++;
}

if ($priceMax != 0)
{
    array_push($param, $priceMax);
    if ($bindCount)
    {
        $where .= ' AND product_price <= ?';
    }
    else
    {
        $where .= ' WHERE product_price <= ?';
    }
    $bindCount++;
}

if ($search != '')
{
    $search = '%'.$search.'%';
    array_push($param, $search);
    if ($bindCount)
    {
        $where .= ' AND product_name LIKE ?';
    }
    else
    {
        $where .= ' WHERE product_name LIKE ?';
    }
    $bindCount++;
}



$sql = "SELECT * FROM product". $where;

// $sql = "SELECT * FROM product WHERE product_category = ?";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    switch ($bindCount) {
        case 0: break;
        case 1:
        mysqli_stmt_bind_param($stmt, str_repeat("s", $bindCount), $param[0]);
        break;
        case 2: 
        mysqli_stmt_bind_param($stmt, str_repeat("s", $bindCount), $param[0], $param[1]);
        break;
        case 3: 
        mysqli_stmt_bind_param($stmt, str_repeat("s", $bindCount), $param[0], $param[1], $param[2]);
        break;
        case 4: 
        mysqli_stmt_bind_param($stmt, str_repeat("s", $bindCount), $param[0], $param[1], $param[2], $param[3]);
        break;
        case 5: 
        mysqli_stmt_bind_param($stmt, str_repeat("s", $bindCount), $param[0], $param[1], $param[2], $param[3], $param[4]);
        break;
        case 6: 
        mysqli_stmt_bind_param($stmt, str_repeat("s", $bindCount), $param[0], $param[1], $param[2], $param[3], $param[4], $param[5]);
        break;
        case 7: 
        mysqli_stmt_bind_param($stmt, str_repeat("s", $bindCount), $param[0], $param[1], $param[2], $param[3], $param[4], $param[5], $param[6]);
        break;
        case 8: 
        mysqli_stmt_bind_param($stmt, str_repeat("s", $bindCount), $param[0], $param[1], $param[2], $param[3], $param[4], $param[5], $param[6], $param[7]);
        break;
        case 9: 
        mysqli_stmt_bind_param($stmt, str_repeat("s", $bindCount), $param[0], $param[1], $param[2], $param[3], $param[4], $param[5], $param[6], $param[7], $param[8]);
        break;
        case 10: 
        mysqli_stmt_bind_param($stmt, str_repeat("s", $bindCount), $param[0], $param[1], $param[2], $param[3], $param[4], $param[5], $param[6], $param[7], $param[8], $param[9]);
        break;

    }

    // Attempt to execute the prepared statement
    $dbdata = array();
    if(mysqli_stmt_execute($stmt))
    {
        $result = mysqli_stmt_get_result($stmt);
        
        while ( $row = mysqli_fetch_assoc($result))  
        {
            $dbdata[]=$row;
        }

        if (!empty($dbdata))
            echo '{"products": ', json_encode($dbdata), '}';

    }
    else
    {
        exit();
    }
}
?>