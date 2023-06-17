<?php
include "ads/cons.php";
# this will be sent to the db
if(isset($_POST['create']))
{
    $control_number = $_POST['control_number'];
    $description =  $_POST['description'];

    $query = "INSERT INTO sales (control_number,description) VALUES ('$control_number','$description')";
    $add_sales = mysqli_query($conn,$query); 

    if(!$add_sales){
        echo "<script type= 'text/javascript'> alert('something went wrong!')</script>". mysqli_error($conn);
    }
    else{
      header("Location: sales.php"); 
    }
}

?>
 <div class="box2" >
           <form action="salesadd.php" method="POST" class="row g-3">
           <div class="form-row" >
              <div class="p-3 container justify-content-evenly " >
           <div class="col-md-4">
             <label for="control_number" class="form-label">control number</label>
             <input type="text" name="control_number" class="form-control" id="controlnumber">
           </div>
           <div class="col-md-4">
             <label for="description" class="form-label">description</label>
             <input type="text" name="description" class="form-control" id="desc">
           </div>
           </div>
           <!-- end -->
           <div class="col-md-4">
           <input type="submit" name="create" class="btn btn-primary" id="submit" value="submit" >
           </div>
         </form>
         </div>
         