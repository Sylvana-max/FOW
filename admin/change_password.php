<?php include("includes/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1><br/>

        <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        ?>
        
        <form action="" method="POST">

            <div class="form-group">
                <label for="password">Old Password: </label>
                <input type="password" class="form-control" name="old_password" placeholder="Enter Your Old Password" required>
            </div>

            <div class="form-group">
                <label for="password">New Password: </label>
                <input type="password" class="form-control" name="new_password" placeholder="Enter Your New Password" required>
            </div>

            <div class="form-group">
                <label for="password">Confirm Password: </label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Enter Your New Password Again" required>
            </div>

            <div class="form-group">

                <input type="submit" name="submit" value="Change Password" class="btn-primary">
            </div>
        </form>
                
    </div>
</div>
<?php
//Also, check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //Get data from form
    // $id = $_POST['id'];
    $old_password = ($_POST['old_password']);
    $new_password = ($_POST['new_password']);
    $confirm_password = ($_POST['confirm_password']);

    //Check whether or not user exist
    $sql = "SELECT * FROM admin WHERE id='$id' AND password='$old_password'";

    //Execute the Query
    $res = mysqli_query($connection, $sql);
    if($res==true){
        //Checking for whether or not data is available
        $count = mysqli_num_rows($res);
        if($count==1){
            //check whether or not password matches
            if($new_password==$confirm_password){
                //Update the password
                $sql2 = "UPDATE admin SET password= '$new_password' WHERE id=$id";
                
                //Execute the Query
                $res2 = mysqli_query($connection, $sql2);
                
                //Check whether or not query executed
                if($res2==true){
                    //Display success Message
                    $_SESSION['change_password'] = "<div class='success text-center'>Password Successfully Changed. </div>";
                    //Redirect Page
                    header("location:".SITEURL.'admin/admin.php');
                }else{
                    //Display error Message
                    $_SESSION['change_password'] = "<div class='error text-center'>Password Unsuccessfully Changed. </div>";
                    //Redirect Page
                    header("location:".SITEURL.'admin/admin.php');
                }
                    
            }else{
                //Redirect Page
                $_SESSION['not_matched'] = "<div class='error text-center'>Password Doesn't Match. </div>";
                header("location:".SITEURL.'admin/change_password.php');
            }

        }else{
            //User doesn't exist
            $_SESSION['not_found'] = "<div class='error text-center'>User Not Found. </div>";
            //Redirect Page
            header("location:".SITEURL.'admin/change_password.php');
        }
    }

}

?>

<?php include("includes/footer.php"); ?>