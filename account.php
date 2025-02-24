<!DOCTYPE html>
<html>

<?php include 'head.php'?>


<body>
    <!--Account-->
<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg col-md-12 colsm-12">
            <h3 class ="font-weight-bold">Account info</h3>
            <hr class ="mx-auto">
            <div class="account info">
                <p>Name<span>John</span></p>
                <p>Email<span>John@email.com</span></p>
                <p><a href ="" id="orders-btn">Your orders</a></p>
                <p><a href ="" id="logout-btn">Logout</a></p>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 colsm-12">
            <form id="account-form">
                <h3>Change Password</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password"  class="form-control" id="account-password"  name="Password" placeholder="Account-Password" required="required">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password"  class="form-control" id="account-password-confirm"  name="confirm-Password" placeholder="Account-Password" required="required">
                </div>
                <div class ="form-group">
                <input type="submit" value="Change Password" class="btn" id="change-pass-btn">
                </div>
            </form>
        </div>
    </div>
</section> 
<!-- footer section -->
<?php include 'footer.php'?>

<!-- footer section -->

<!-- jQery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
</script>
<!-- End Google Map -->

</body>

</html>