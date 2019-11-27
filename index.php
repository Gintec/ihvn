<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
</head>
  <body>
        <?php
        $con=mysqli_connect("localhost","root","","employees");
        // Check connection
        if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        $result = mysqli_query($con,"SELECT dept_no FROM dept_emp WHERE emp_no='10003' LIMIT 1");
        if (!$result) {
            printf("Error: %s\n", mysqli_error($con));
            exit();
        }

        $empno = mysqli_fetch_array($result);

        $dept_no =  $empno['dept_no'];

        // $result2 = mysqli_query($con,"SELECT * FROM dept_emp WHERE dept_no='$dept_no'");?>
        
       <?php $result2 = mysqli_query($con,"SELECT * FROM employees WHERE emp_no in (SELECT emp_no FROM dept_emp
             WHERE dept_no='$dept_no')"); 
             if (!$result2) {
              printf("Error: %s\n", mysqli_error($con));
              exit();
          }
             ?>

        

        <table id="table_id" class="display">
                <thead>
        <tr>
        <th>Employee No</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Birth Date</th>
        <th>Gender</th>
        <th>Hire Date</th>
        
        </tr>
        </thead>
        <tbody>

        <?php
        while($row = mysqli_fetch_array($result2))
        {
        echo "<tr>";
        echo "<td>" . $row['emp_no'] . "</td>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['birth_date'] . "</td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "<td>" . $row['hire_date'] . "</td>";
        
        echo "</tr>";
        }        
        ?>

    </tbody>
    </table>
        
        <?php
        mysqli_close($con);
        ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
  </body>
</html>