<html lang="ca">
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<head>
    <title>원자재 입력 페이지</title>
    <style>
        .table_header { text-align: left; }
        table {
            width: 100%;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #dadada;
        }
    </style>
</head>
<body onload="init()">

    <form method="post">
        <div style="float: left; width: 14%;">
            date : <br/>
<!--            <form method="post">-->
                <p><input type="date" id="ibox_date" name="ibox_date" value="<?php echo date('Y-m-d')?>"></p>
<!--            </form>-->
        </div>


        <div style="float: left; width: 14%;">
            supplier : <br/>
<!--            <form method="post">-->
                <p><input type="text" name="ibox_supplier" id="ibox_supplier" list="supplier_list" autocomplete="off"></p>
                <datalist id="supplier_list" name="supplier_list">
                    <?php echo update_supplier(); ?>
                </datalist>
                <input type="submit" name="add_supplier" id="add_supplier" value="항목 추가" /><br/>
<!--            </form>-->
        </div>


        <div style="float: left; width: 14%;">
            item : <br/>
<!--            <form method="post">-->
                <p><input type="text" name="ibox_item" id="ibox_item" list="item_list" autocomplete="off"></p>
                <datalist id="item_list">
                    <?php echo update_item(); ?>
                </datalist>
                <input type="submit" name="add_item" id="add_item" value="항목 추가" /><br/>
<!--            </form>-->
        </div>


        <div style="float: left; width: 14%;">
            design : <br/>
<!--            <form method="post">-->
                <p><input type="text" name="ibox_design" id="ibox_design" list="design_list" autocomplete="off"></p>
                <datalist id="design_list">
                    <?php echo update_design(); ?>
                </datalist>
                <input type="submit" name="add_design" id="add_design" value="항목 추가" /><br/>
<!--            </form>-->
        </div>


        <div style="float: left; width: 14%;">
            quantity : <br/>
<!--            <form method="post">-->
                <p><input type="number" name="ibox_quantity" id="ibox_quantity" min="0"></p>
<!--            </form>-->
        </div>


        <div style="float: left; width: 14%;">
            month : <br/>
<!--            <form method="post">-->
                <p><input type="number" name="ibox_month" id="ibox_month" placeholder="月份" min="0"></p>
<!--            </form>-->
        </div>


        <div style="float: left; width: 14%;">
            class : <br/>
<!--            <form method="post">-->
                <p><input type="text" name="ibox_class" id="ibox_class" list="class_list" autocomplete="off"></p>
                <datalist id="class_list">
                    <?php echo update_class(); ?>
                </datalist>
                <input type="submit" name="add_class" id="add_class" value="항목 추가" /><br/>
<!--            </form>-->
        </div>

<!--        <form method="post">-->
            <input type="submit" name="insert" id="insert" value="서버에 저장" /><br/>
<!--        </form>-->
    </form>
    
    <h1>
        서버에 저장된 데이터<br/>
    </h1>

    <table id="materials">
        <thead>
        <tr class="table_header">
            <th>no</th>
            <th>date</th>
            <th>supplier</th>
            <th>item</th>
            <th>design</th>
            <th>quantity</th>
            <th>month</th>
            <th>class</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $sql = "SELECT * FROM material";
        $conn = mysqli_connect("localhost", "root", "sunmoon1", "simple");
        $res = mysqli_query( $conn, $sql );
        while( $row = mysqli_fetch_array( $res ) ) {
            echo '<tr><td>' .
                $row[ 'num' ] . '</td><td>'.
                $row[ 'date' ] . '</td><td>' .
                $row[ 'supplier' ] . '</td><td>' .
                $row[ 'item' ] . '</td><td>' .
                $row[ 'design' ] . '</td><td>' .
                $row[ 'quantity' ] . '</td><td>' .
                $row[ 'month' ] . '</td><td>' .
                $row[ 'class' ] . '</td></tr>';
        }
        ?>
        </tbody>
    </table>

</body>
</html>

<?php
if (array_key_exists('insert', $_POST)) {
    insert();
}
if (array_key_exists('add_supplier', $_POST)) {
    add_supplier();
}
if (array_key_exists('add_item', $_POST)) {
    add_item();
}
if (array_key_exists('add_design', $_POST)) {
    add_design();
}
if (array_key_exists('add_class', $_POST)) {
    add_class();
}

function update_supplier() {
    $conn = mysqli_connect("localhost", "root", "sunmoon1", "simple");
    $sql = "SELECT * FROM supplier";
    $res = mysqli_query( $conn, $sql );
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row["supplier"]);
        echo "<option value='$var'>";
    }
}

function update_item() {
    $conn = mysqli_connect("localhost", "root", "sunmoon1", "simple");
    $sql = "SELECT * FROM item";
    $res = mysqli_query( $conn, $sql );
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row["item"]);
        echo "<option value='$var'>";
    }
}

function update_design() {
    $conn = mysqli_connect("localhost", "root", "sunmoon1", "simple");
    $sql = "SELECT * FROM design";
    $res = mysqli_query( $conn, $sql );
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row["design"]);
        echo "<option value='$var'>";
    }
}

function update_class() {
    $conn = mysqli_connect("localhost", "root", "sunmoon1", "simple");
    $sql = "SELECT * FROM class";
    $res = mysqli_query( $conn, $sql );
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row["class"]);
        echo "<option value='$var'>";
    }
}

function insert() {

    $date       = ($_POST['ibox_date']);
    $supplier   = ($_POST['ibox_supplier']);
    $item       = ($_POST['ibox_item']);
    $design     = ($_POST['ibox_design']);
    $quantity   = ($_POST['ibox_quantity']);
    $month      = ($_POST['ibox_month'])."月份";
    $class      = ($_POST['ibox_class']);

    $conn = mysqli_connect("localhost", "root", "sunmoon1", "simple");

    $sql = "INSERT INTO material (date, supplier, item, design, quantity, month, class) VALUES (\"{$date}\", \"{$supplier}\", \"{$item}\", \"{$design}\", {$quantity}, \"{$month}\", \"{$class}\")";
    $res = mysqli_query($conn, $sql);
    echo $res;
}

function add_supplier() {
    echo "supplier 추가";
    $supplier = $_POST['ibox_supplier'];

    if (empty($supplier)) {
        alert("항목을 입력하세요.");
        return;
    }
    $conn = mysqli_connect("localhost", "root", "sunmoon1", "simple");
    $sql = "SELECT EXISTS (SELECT * FROM supplier where supplier=\"{$supplier}\") as Chk";

    $res = mysqli_fetch_array(mysqli_query($conn, $sql));

    if (intval($res['Chk'])) {
        alert("해당 항목은 이미 존재합니다.");
        return;
    }

    $sql = "INSERT INTO supplier VALUES (\"{$supplier}\")";
    if (mysqli_query($conn, $sql)) {
        alert("{$supplier} 항목 추가 완료");
    }
}

function add_design() {
    echo "design 추가";
    $design = $_POST['ibox_design'];

    if (empty($design)) {
        alert("항목을 입력하세요.");
        return;
    }
    $conn = mysqli_connect("localhost", "root", "sunmoon1", "simple");
    $sql = "SELECT EXISTS (SELECT * FROM supplier where supplier=\"{$design}\") as Chk";

    $res = mysqli_fetch_array(mysqli_query($conn, $sql));

    if (intval($res['Chk'])) {
        alert("해당 항목은 이미 존재합니다.");
        return;
    }

    $sql = "INSERT INTO supplier VALUES (\"{$design}\")";
    if (mysqli_query($conn, $sql)) {
        alert("{$design} 항목 추가 완료");
    }
}

function add_item() {
    echo "item 추가";
    $item = $_POST['ibox_item'];

    if (empty($item)) {
        alert("항목을 입력하세요.");
        return;
    }
    $conn = mysqli_connect("localhost", "root", "sunmoon1", "simple");
    $sql = "SELECT EXISTS (SELECT * FROM supplier where supplier=\"{$item}\") as Chk";

    $res = mysqli_fetch_array(mysqli_query($conn, $sql));

    if (intval($res['Chk'])) {
        alert("해당 항목은 이미 존재합니다.");
        return;
    }

    $sql = "INSERT INTO supplier VALUES (\"{$item}\")";
    if (mysqli_query($conn, $sql)) {
        alert("{$item} 항목 추가 완료");
    }
}

function add_class() {
    echo "class 추가";
    $class = $_POST['ibox_class'];

    if (empty($class)) {
        alert("항목을 입력하세요.");
        return;
    }
    $conn = mysqli_connect("localhost", "root", "sunmoon1", "simple");
    $sql = "SELECT EXISTS (SELECT * FROM supplier where supplier=\"{$class}\") as Chk";

    $res = mysqli_fetch_array(mysqli_query($conn, $sql));

    if (intval($res['Chk'])) {
        alert("해당 항목은 이미 존재합니다.");
        return;
    }

    $sql = "INSERT INTO supplier VALUES (\"{$class}\")";
    if (mysqli_query($conn, $sql)) {
        alert("{$class} 항목 추가 완료");
    }
}

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>