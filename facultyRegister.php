<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title> Spark </title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="src/css/bootstrap.min.css" rel="stylesheet">
    <link href="src/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="src/css/index.css" rel="stylesheet">
    <link href="src/css/indexLess.css" rel="stylesheet">
    <link href="src/css/facultyRegister.css" rel="stylesheet">

</head>

<body>
<div class="container">
            <form class="form-horizontal" role="form" action="fRegister.php" method="post">
                <h2>Registration Form</h2>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="name" placeholder="name" class="form-control" autofocus>

                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" id="email" placeholder="Email" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                     <label for="contact" class="col-sm-3 control-label">Contact No.</label>
                     <div class="col-sm-9">
                         <input type="text" id="contact" placeholder="Contact" class="form-control" autofocus>

                     </div>
                </div>

                <div class="form-group">
                     <label for="department" class="col-sm-3 control-label">Department Name</label>
                     <div class="col-sm-9">
                         <input type="text" id="department" placeholder="Department" class="form-control" autofocus>                     </div>
                </div>

                <div class="form-group">
                	<label for="project" class="col-sm-3 control-label">Project Discription</label>
                	<textarea  class="col-sm-8" id="project" placeholder="Project Decription" class="form-control input-lg" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="password" placeholder="Password" class="form-control">
                    </div>
                </div>




                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form> <!-- /form -->
        </div> <!-- ./container -->


    <script src="src/js/jquery.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script src="src/js/facultyRegister.js"></script>
</body>

</html>