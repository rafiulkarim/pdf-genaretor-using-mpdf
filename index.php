<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        .error{
            color: red;
        }
    </style>
    <title>PDF Genarator in PHP</title>
</head>
<body>
    <div class="container mt-5">
        <form id="makepdf" action="makepdf.php" method="post" class="offset-md-3 col-md-6" enctype="multipart/form-data">
            <div class="text-center">
                <h1>Create your own pdf</h1>
                <p>Please fill out the details below and the pdf will downloaded</p>
                <?php
                    
                    if(isset($_GET['msg'])){
                        $msg = base64_decode($_GET['msg']);
                        if($msg!=""){
                            echo $msg;
                            unset($msg);
                        }
                        
                    }
                ?>
            </div>
            <div class="mb-2">
                <input type="text" name="name" placeholder="Enter Your Full Name" class="form-control" id="name">                
            </div>
            <div class="mb-2">
                <input type="text" name="roll" placeholder="Enter Your ID" class="form-control" id="roll">                
            </div>
            <div class="mb-2">
                <input type="email" name="email" placeholder="Enter Your Email"  class="form-control" id="email">
            </div>
            <div class="mb-2">
                <input type="tel" name="phone" placeholder="Enter Your Phone Number"  class="form-control" id="phone">
            </div>
            <div id="loader_form" style="display: none;">
                <img src="upload/loader.gif" alt="">
            </div>        
            <button type="submit" class="btn btn-success btn-md btn-block" id="submit">Create PDF</button>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function (){
        $("#makepdf").validate({
            rules: {
                name: {
                    required: true,
                    name: true
                },
                roll: {
                    required: true,
                    roll: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                }                
            },
            messages: {
                name: "Please enter a name",
                roll: "Please enter a Roll",
                email: "Please enter a valid email address",
                phone: "Please enter a phone number"           
            }
        });
    });
    
</script>
</html>