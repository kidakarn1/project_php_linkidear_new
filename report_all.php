<html>
    <head>
        <title></title>
    </head>

    <body>
        <?php
        include("conn.php");
        include ("menu.php");
        if (empty($_SESSION['STAFF_ID'])) {
            echo "<script>window.location.href = 'index.php';
	  	</script>";
        }
        $sql_lable_join = "select count(LABLE_ID) as NB from LABLE ";
        $sql_max = "select max(TOTAL) as MAXH from LABLE";
        $sql_min = "select min(TOTAL) as MINH from LABLE";
        $sql_salary = "select FNAME,LNAME  from STAFF where SALARY=(select
				 max(SALARY) from STAFF )";
        $res_salary = $conn->query($sql_salary);
        $rowsalary = $res_salary->fetch_array();
        $res_lable_join = $conn->query($sql_lable_join);
        $row_lable_join = $res_lable_join->fetch_array();
        $resmax = $conn->query($sql_max);
        $rowmax = $resmax->fetch_array();
        $resmin = $conn->query($sql_min);
        $rowmin = $resmin->fetch_array();
        ?>
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>จำนวนการสั่งซื้อ</font></th>
                        <th>ราคาการสั่งทำป้ายที่สูงที่สุด</font></th>
                        <th>ราคาการสั่งทำป้ายที่น้อยที่สุด</font></th>
                        <th>พนักงานที่มีเงินเดือนสูงที่สุด</font></th>
                    </tr>
                    <tr>
                        <th><?php echo $row_lable_join['NB']; ?> รายการ</th>
                        <th><?php echo $rowmax['MAXH']; ?>บาท</th>
                        <th><?php echo $rowmin['MINH']; ?>บาท</th>
                        <th><?php echo $rowsalary['FNAME'] . " " . $rowsalary['LNAME']; ?>บาท</th>
                    </tr>
                </table>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </body>
</html>
