<?php include_once "header.php";
include_once "php/validation.php";
include_once "php/user.php";
include_once "php/City.php";
include_once "php/Region.php";
include_once "php/Address.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['updateInfo'])) {
    $updateInfoErrors = [];
    $updateInfoSuccess = [];
    if (
        isset($_POST['first']) && $_POST['first'] &&
        isset($_POST['last']) && $_POST['last'] &&
        isset($_POST['gender']) && $_POST['gender'] &&
        isset($_POST['phone']) && $_POST['phone']
    ) {
        $updatedUser = new User;
        $updatedUser->setId($_SESSION['user']->id);
        $updatedUser->setFirst($_POST['first']);
        $updatedUser->setlast($_POST['last']);
        $updatedUser->setPhone($_POST['phone']);
        $updatedUser->setGender($_POST['gender']);
        if ($_FILES['photo']['error'] == 0) {
            // print_r($_FILES);die;
            $directory = 'assets/img/users/';
            $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $fileName = time() . '.' . $extension;
            $fullPath = $directory . $fileName;
            $allowedExtensions = ['png', 'jpg', 'jpeg'];
            if ($_FILES['photo']['size'] > 10 ** 6) {
                $_SESSION['errors']['size'] = "<div class='alert alert-danger'> Size of image must be less than 1 MegaByte </div>";
            }

            if (!in_array($extension, $allowedExtensions)) {
                $updateInfoErrors['ext'] = "<div class='alert alert-danger'> Photo Must be png,jpg,jpeg </div>";
            }

            if (empty($updateInfoErrors)) {
                move_uploaded_file($_FILES['photo']['tmp_name'], $fullPath);
                $updatedUser->setPhoto($fileName);
                $_SESSION['user']->photo = $fileName;
            }
        }
        if (empty($updateInfoErrors)) {
            $result = $updatedUser->updateData();
            if ($result) {
                $_SESSION['user']->first = $_POST['first'];
                $_SESSION['user']->last = $_POST['last'];
                $_SESSION['user']->phone = $_POST['phone'];
                $_SESSION['user']->gender = $_POST['gender'];
                $updateInfoSuccess['success'] = "<div class='alert alert-success'> Data has been updated </div>";
            } else {
                $updateInfoErrors['updateInfoSomeThing'] = "<div class='alert alert-danger'> Something went wrong </div>";
            }
        }
    } else {
        $updateInfoErrors['updateInfoData'] = "<div class='alert alert-danger'> All fields is required </div>";
    }
}

if (isset($_POST['change-password'])) {
    $changePasswordErrors = [];
    $changePasswordSuccess = [];
    if (
        isset($_POST['password']) && $_POST['password']
        && isset($_POST['oldPassword']) && $_POST['password']
        && isset($_POST['ConfrimPassword']) && $_POST['ConfrimPassword']
    ) {

        $changePasswordUser = new user;
        $changePasswordUser->setPassword($_POST['oldPassword']);
        if ($_SESSION['user']->password != $changePasswordUser->getPassword()) {
            $changePasswordErrors['oldPassowrd'] = "<div class='alert alert-danger'> Old Password is wrong </div>";
        }
        $changePasswordUser->setPassword($_POST['password']);
        if ($_SESSION['user']->password == $changePasswordUser->getPassword()) {
            $changePasswordErrors['enterNew'] = "<div class='alert alert-danger'> you have entered an old password , please enter new one </div>";
        }

        $validation = new validation;
        $validation->setPassword($_POST['password']);
        $validation->setConfrimPassword($_POST['ConfrimPassword']);
        $passwordValidation = $validation->passwordValidation();

        if (empty($passwordValidation) && empty($changePasswordErrors)) {
            $changePasswordUser->setId($_SESSION['user']->id);
            $result = $changePasswordUser->changePassword();
            if ($result) {
                $_SESSION['user']->password  = $changePasswordUser->getPassword();
                $changePasswordSuccess['passwordUpdated'] = "<div class='alert alert-success'> Password has been updated </div>";
            } else {
                $changePasswordErrors['something'] = "<div class='alert alert-danger'> something went wrong </div>";
            }
        }
    } else {
        $changePasswordErrors['changePasswordFields'] = "<div class='alert alert-danger'> All fields is required </div>";
    }
}

if (isset($_POST['change-email'])) {
    $changeEmailErrors = [];
    $changeEmailSuccess = [];
    $validation = new validation;
    $validation->setEmail($_POST['email']);
    $emailValidation = $validation->emailValidation();
    if (empty($emailValidation)) {
        if ($_POST['email']  == $_SESSION['user']->email) {
            $changeEmailErrors['enterNew'] = "<div class='alert alert-danger'> You have entered an old email , please enter new one </div>";
        } else {
            // email cycle
            // verify if email already exists
            $emailVerification = new user;
            $emailVerification->setEmail($_POST['email']);
            $result = $emailVerification->checkEamil();
            if ($result) {
                // error
                $changeEmailErrors['emailExists'] = "<div class='alert alert-danger'> This Email Already exists </div>";
            } else {
                // set code
                $code = rand(99999, 10000);
                $emailVerification->setCode($code);
                // set id
                $emailVerification->setId($_SESSION['user']->id);
                // set status
                $emailVerification->setStatus(2);
                // update email
                $res = $emailVerification->updateEmail();
                if ($res) {
                    // modify session
                    $_SESSION['user']->email = $_POST['email'];
                    // send code
                    // send email
                    //Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);
                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'ntiecommerce3@gmail.com';                     //SMTP username
                        $mail->Password   = 'NTI@123456';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                        //Recipients
                        $mail->setFrom('ntiecommerce3@gmail.com', 'NTI Ecommerce');
                        $mail->addAddress($_POST['email']);     //Add a recipient


                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Verification Code';
                        $mail->Body    = 'Your Verifcation Code is:<b>' . $code  . '</b>';

                        $mail->send();
                        // echo 'Message has been sent';
                        // header checkCode
                        header('Location:checkCode.php?email=' . $_POST['email'] . '&forget=3');
                        // hello world
                        // nti
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    $changeEmailErrors['something'] = "<div class='alert alert-danger'> something went wrong </div>";
                }
            }
        }
    }
}

if (isset($_POST['add-address'])) {
    $addAddressErrors = [];
    $addAddressSuccess = [];
    if (
        isset($_POST['street']) && $_POST['street']
        && isset($_POST['building']) && $_POST['building']
        && isset($_POST['floor']) && $_POST['floor']
        && isset($_POST['flat']) && $_POST['flat']
        && isset($_POST['region_id']) && $_POST['region_id']
    ) {
        $addressObj = new Address;
        $addressObj->setStreet($_POST['street']);
        $addressObj->setBuilding($_POST['building']);
        $addressObj->setFlat($_POST['flat']);
        $addressObj->setFloor($_POST['floor']);
        $addressObj->setNotes($_POST['notes']);
        $addressObj->setRegionId($_POST['region_id']);
        $addressObj->setUserId($_SESSION['user']->id);
        $result = $addressObj->insertData();
        if ($result) {
            $addAddressSuccess['success'] =  "<div class='alert alert-success'> A New Address Has been inserted Successfully </div>";
        } else {
            $addAddressErrors['AddAddressSomeThing'] = "<div class='alert alert-danger'>  something went wrong</div>";
        }
    } else {
        $addAddressErrors['AddAddressFields'] = "<div class='alert alert-danger'> All fields is required </div>";
    }
}

if(isset($_POST['delete-address'])){
    $deleteAddressErrors = [];
    $deleteAddressSuccess = [];
    $addressObj = new address;
    $addressObj->setId($_POST['id']);
    $result = $addressObj->deleteData();
    if($result){
        $deleteAddressSuccess['success'] = "<div class='alert alert-success'> You Have Deleted Address Number <b>".$_POST['id']." </b></div>";
    }else{
        $deleteAddressErrors['something'] = "<div class='alert alert-danger'> Something went wrong</div>";
    }
}

if (isset($_POST['edit-address'])) {
    $EditAddressErrors = [];
    $EditAddressSuccess = [];
    if (
        isset($_POST['street']) && $_POST['street']
        && isset($_POST['building']) && $_POST['building']
        && isset($_POST['floor']) && $_POST['floor']
        && isset($_POST['flat']) && $_POST['flat']
        && isset($_POST['region_id']) && $_POST['region_id']
    ) {
        $addressObj = new Address;
        $addressObj->setStreet($_POST['street']);
        $addressObj->setBuilding($_POST['building']);
        $addressObj->setFlat($_POST['flat']);
        $addressObj->setFloor($_POST['floor']);
        $addressObj->setNotes($_POST['notes']);
        $addressObj->setRegionId($_POST['region_id']);
        $addressObj->setId($_POST['id']);
        $result = $addressObj->updateData();
        if ($result) {
            $EditAddressSuccess['success'] =  "<div class='alert alert-success'> Data  Successfully  Updated </div>";
        } else {
            $EditAddressErrors['EditAddressSomeThing'] = "<div class='alert alert-danger'>  something went wrong</div>";
        }
    } else {
        $EditAddressErrors['EditAddressFields'] = "<div class='alert alert-danger'> All fields is required </div>";
    }
}

$getUser = new user;
$getUser->setId($_SESSION['user']->id);
$result = $getUser->getUser();
if ($result) {
    $user = $result->fetch_object();
} else {
    header('Location:404.php');
}

$cityObj = new City;
$result2 = $cityObj->getAllData();

if ($result2) {
    $cities = $result2->fetch_all(MYSQLI_ASSOC);
}

$regionObj = new Region;

$addressObj = new Address;
$addressObj->setUserId($_SESSION['user']->id);
$addressResult = $addressObj->getUserAddresses();
if ($addressResult) {
    $addresses = $addressResult->fetch_all(MYSQLI_ASSOC);
}



?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>MY ACCOUNT</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">My Account</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <!-- class='show' to open collapse -->
                            <form method="POST" enctype="multipart/form-data">
                                <div id="my-account-1" class="panel-collapse collapse <?php if (isset($_POST['updateInfo'])) {
                                                                                            echo 'show';
                                                                                        } ?>">
                                    <div class="panel-body">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>My Account Information</h4>
                                                <h5>Your Personal Details</h5>
                                            </div>
                                            <div class="row">
                                                <div class='col-12 text-center'>
                                                    <?php
                                                    if (isset($updateInfoErrors)) {
                                                        foreach ($updateInfoErrors as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }

                                                    if (isset($updateInfoSuccess)) {
                                                        foreach ($updateInfoSuccess as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }
                                                    ?>


                                                </div>
                                                <div class="offset-3 col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <img src="assets/img/users/<?php echo $user->photo; ?>" alt="" class="rounded" style="width: 100%;">
                                                        <input type="file" class="form-control" name="photo">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>First Name</label>
                                                        <input type="text" name="first" value="<?php echo $user->first ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last" value="<?php echo $user->last ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Phone</label>
                                                        <input type="tel" name="phone" value="<?php echo $user->phone ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Gender</label>
                                                        <select name="gender" class="form-control" id="">
                                                            <option <?php echo ($user->gender == 'm' ? 'selected' : '') ?> value="m">Male</option>
                                                            <option <?php echo ($user->gender == 'f' ? 'selected'  : '') ?> value="f">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">

                                                <div class="billing-btn">
                                                    <button name="updateInfo">Update Info</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <form method="post">
                                <div id="my-account-2" class="panel-collapse collapse <?php if (isset($_POST['change-password'])) {
                                                                                            echo 'show';
                                                                                        } ?>">
                                    <div class="panel-body">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>Change Password</h4>
                                                <h5>Your Password</h5>
                                            </div>
                                            <div class="row">
                                                <div class='col-12 text-center'>
                                                    <?php
                                                    if (isset($changePasswordSuccess)) {
                                                        foreach ($changePasswordSuccess as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Old Password</label>
                                                        <input type="password" name="oldPassword">
                                                    </div>
                                                </div>
                                                <?php
                                                if (isset($changePasswordErrors)) {
                                                    foreach ($changePasswordErrors as $key => $value) {
                                                        echo $value;
                                                    }
                                                }
                                                ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password </label>
                                                        <input type="password" name="password">
                                                    </div>
                                                </div>
                                                <?php
                                                if (isset($passwordValidation)) {
                                                    foreach ($passwordValidation as $key => $value) {
                                                        echo $value;
                                                    }
                                                }
                                                ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Confrim Password </label>
                                                        <input type="password" name="ConfrimPassword">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">

                                                <div class="billing-btn">
                                                    <button name="change-password">Change Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-10">Change your Email Address </a></h5>
                            </div>
                            <form method="post">
                                <div id="my-account-10" class="panel-collapse collapse <?php if (isset($_POST['change-email'])) {

                                                                                            echo 'show';
                                                                                        } ?>">
                                    <div class="panel-body">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>Change Email</h4>
                                                <h5>Your Email</h5>
                                            </div>
                                            <div class="row">

                                                <div class='col-12 text-center'>
                                                    <?php
                                                    if (isset($changeEmailErrors)) {
                                                        foreach ($changeEmailErrors as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Email Address</label>
                                                        <input type="email" name="email" value="<?php echo $user->email ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <?php
                                                    if (!empty($emailValidation)) {
                                                        foreach ($emailValidation as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }

                                                    ?>
                                                </div>


                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button name="change-email">Change Email</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>4</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your address book entries </a></h5>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse <?php if (isset($_POST['add-address']) || isset($_POST['delete-address']) || isset($_POST['edit-address'])) {
                                                                                        echo 'show';
                                                                                    } ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Add Address</h4><br>
                                            <form method="POST">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <?php
                                                        if (isset($addAddressErrors)) {
                                                            foreach ($addAddressErrors as $key => $value) {
                                                                echo $value;
                                                            }
                                                        }
                                                        if (isset($addAddressSuccess)) {
                                                            foreach ($addAddressSuccess as $key => $value) {
                                                                echo $value;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Street</label>
                                                            <input type="text" name="street">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Building</label>
                                                            <input type="text" name="building">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Floor</label>
                                                            <input type="text" name="floor">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Flat</label>
                                                            <input type="text" name="flat">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Regions</label>
                                                            <select name="region_id" class="form-control" id="">
                                                                <?php foreach ($cities as $key => $value) { ?>
                                                                    <optgroup label="<?php echo $value['name'] ?>">
                                                                        <?php
                                                                        $regionObj->setCityId($value['id']);
                                                                        $result3 = $regionObj->getRegionByCity();
                                                                        if ($result3) {
                                                                            $regions = $result3->fetch_all(MYSQLI_ASSOC);
                                                                            foreach ($regions as $key1 => $value1) {
                                                                        ?>
                                                                                <option value="<?php echo $value1['id'] ?>"><?php echo $value1['name']; ?></option>

                                                                            <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <option disabled> This city Has No regions Yet</option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </optgroup>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Notes</label>
                                                            <textarea name="notes" class="form-control" id="" cols="30" rows="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="billing-btn">
                                                        <button name="add-address">Add Address</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="account-info-wrapper">
                                            <h4>Address Book Entries</h4>
                                            <br>
                                            <?php 
                                                if(isset($deleteAddressSuccess)){
                                                    foreach($deleteAddressSuccess AS $key=>$value){
                                                        echo $value;
                                                    }
                                                }

                                                if(isset($deleteAddressErrors)){
                                                    foreach($deleteAddressErrors AS $key=>$value){
                                                        echo $value;
                                                    }
                                                }

                                                if(isset($EditAddressErrors)){
                                                    foreach($EditAddressErrors AS $key=>$value){
                                                        echo $value;
                                                    }
                                                }

                                                if(isset($EditAddressSuccess)){
                                                    foreach($EditAddressSuccess AS $key=>$value){
                                                        echo $value;
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <div class="entries-wrapper">
                                           
                                                <?php  foreach ($addresses as $key => $value) { ?>
                                                    <form method="post">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                            <div class="entries-info text-center">

                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div class="billing-info">
                                                                        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                                                                            <label>Street</label>
                                                                            <input type="text" name="street" value="<?php echo $value['street'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div class="billing-info">
                                                                            <label>Building</label>
                                                                            <input type="text" name="building"  value="<?php echo $value['building'] ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div class="billing-info">
                                                                            <label>Floor</label>
                                                                            <input type="text" name="floor" value="<?php echo $value['floor'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div class="billing-info">
                                                                            <label>Flat</label>
                                                                            <input type="text" name="flat" value="<?php echo $value['flat'] ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div class="billing-info">
                                                                            <label>Regions</label>
                                                                            <select name="region_id" class="form-control" id="">
                                                                                <?php foreach ($cities as $key2 => $value2) { ?>
                                                                                    <optgroup label="<?php echo $value2['name'] ?>">
                                                                                        <?php
                                                                                        $regionObj->setCityId($value2['id']);
                                                                                        $result3 = $regionObj->getRegionByCity();
                                                                                        if ($result3) {
                                                                                            $regions = $result3->fetch_all(MYSQLI_ASSOC);
                                                                                            foreach ($regions as $key1 => $value1) {
                                                                                        ?>
                                                                                                <option <?php if($value['region_id'] == $value1['id']){echo "selected";} ?> value="<?php echo $value1['id'] ?>"><?php echo $value1['name']; ?></option>

                                                                                            <?php
                                                                                            }
                                                                                        } else {
                                                                                            ?>
                                                                                            <option disabled> This city Has No regions Yet</option>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </optgroup>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div class="billing-info">
                                                                            <label>Notes</label>
                                                                            <textarea name="notes" class="form-control" id="" cols="30" rows="10"><?php echo $value['notes'] ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="billing-btn">
                                                                    <button name="add-address">Edit Address</button>
                                                                </div> -->
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                            <div class="entries-edit-delete text-center">
                                                                <button name="edit-address" class="btn btn-warning">Edit</button>
                                                                <button name="delete-address" class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        </form>
                                                    <?php } ?>
                                          
                                        </div>
                                    </div>
                                    <div class="billing-back-btn">

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- my account end -->
<?php include_once "footer.php" ?>