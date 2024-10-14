<?php
require_once('Config/db.php');
//$query = "select * from machine_data";
//$results = mysqli_query($conn,$query);
//include 'Config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Web Solutions</title>
    <meta charset="UTF-8" />
    <meta name="Chen0273" content="width=device-width, initial-scale=1.0" />

</head>   
    <div class="containers">
     <form method="post">
        <input type="date" name ="search" value="<?php echo $_POST['search']; ?>">
        <button class="btn" name="submit">Search</button>
	</form>
    <div class="container">
        <table class="table">

        <?php

        if(isset($_POST['search'])){
            $search=$_POST['search'];
            $searchstart=$search.'T00:00'; 
            $searchend=$search.'T23:59';
            
            $unixtimeStart= strtotime($searchstart);
            $unixtimeEnd= strtotime($searchend); //convert time to unix timestamp to be able to use for search which requires seconds.
            $fsearchStart = date('Y-m-d H:i:s', $unixtimeStart);
            $fsearchEnd = date('Y-m-d H:i:s', $unixtimeEnd);
           // echo $fsearch;
            $sql="select * from machine_data where timestamp>='$fsearchStart' and timestamp <='$fsearchEnd' ";
           // echo $sql; // testing the data retrieved
            //$results=mysqli_query($conn,$sql);
            
            /*if ($result){
            if(mysqli_num_rows($result)>0){
                echo '<thead>
                <tr>
                <th>title test</th>
                <th>Test one</th>
                <th>Test two</th>
                </tr>
                </thead>
                ';
                
                while($row=mysqli_fetch_assoc($result)){
                echo '<tbody>
                <tr>
                <td>'.$row['maintenance_log'].'</td>
                <td>'.$row['timestamp'].'</td>
                <td>'.$row['machine_name'].'</td>
                </tr>
                </tbody>';
            }
            }else {
                echo '<h2 class=text> No data found</h2>';}*/
            
            
            //$num=mysqli_num_rows($results);
            //echo $num

            }
            else {
                $sql = "select * from machine_data";
            }

            $results=mysqli_query($conn,$sql);



        ?>
       </div>
    </div>



    <body class="db-dark">
    <div class="container">
        <div class="row mt-5">
         <div class="col">
          <div class="card mt-5">
           <div class="card-header">
             <h2 class="display-6 text-center">Auditor report Review</h2>

            </div>
           </div>
          </div>
         </div>
        </div>
    <div class="card-body">

<?php if(mysqli_num_rows($results)>0){ ?>   


    <table class="table table-bordered">
    <tr class="bg-dark text-white">
    <td> Timestamp </td>
    <td> machine_name </td>
    <td> Temperature </td>
    <td> Pressure </td>
    <td> vibration </td>
    <td> Humidity </td>
    <td> Power_consumption </td>
    <td> operational_status </td>
    <td> error_code </td>
    <td> production_count </td>
    <td> mainteneance_log </td>
    <td> speed </td>
    </tr>
    
   
    <?php
    
    while($row = mysqli_fetch_assoc($results))
    {
  ?> <tr>
  <td><?php echo $row['timestamp']; ?></td>
  <td><?php echo $row['machine_name']; ?></td>
  <td><?php echo $row['temperature']; ?></td>
  <td><?php echo $row['pressure']; ?></td>
  <td><?php echo $row['vibration']; ?></td>
  <td><?php echo $row['humidity']; ?></td>
  <td><?php echo $row['power_consumption']; ?></td>
  <td><?php echo $row['operational_status']; ?></td>
  <td><?php echo $row['error_code']; ?></td>
  <td><?php echo $row['production_count']; ?></td>
  <td><?php echo $row['maintenance_log']; ?></td>
  <td><?php echo $row['speed']; ?></td>
    </tr>
    <?php
    }



    ?>
</table>
<?php } else { ?>  
    <h2>No data found</h2>
<?php } ?>
</body>
</html>
