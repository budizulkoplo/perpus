<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>.:: E-Perpus | SMP Kesatrian 2 Semarang ::.</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">

        <div>
            <div><br><br>
                <img alt="image" width="200" src="img/logopng.png" />
            </div>
            <br>
            <h3>Sistem Informasi Perpustakaan<br>
                SMP Kesatrian 2 Semarang</h3>
            <form class="m-t" role="form" action="index.php">
                <div class="form-group">
                    <input type="text" name="txtUser" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" name="txtPass" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
            <p class="m-t"> <small>E-Perpus | SMP Kesatrian 2 Semarang &copy; 2023</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/toastr/toastr.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("form").submit(function() {

                $.ajax({
                    url: "log.php",
                    type: "post",
                    data: $(this).serialize(),
                    success: function(msg) {
                        data = $.parseJSON(msg);
                        console.log(data);
                        // toastr.success("dadadas");
                        if (data["isError"] == 1) {
                            toastr.error(data["Alert"]);
                        } else {
                            toastr.success(data["Alert"]);
                            setInterval(function() {
                                location.href = "index.php";
                            }, 1500);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error(errorThrown);
                    }
                });

                return false;
            })
        })
    </script>

</body>

</html>