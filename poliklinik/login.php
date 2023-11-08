<?php
include_once("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- /Logo -->
            <form method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="username" autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" class="form-control" name="password" placeholder="password" aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit" name="simpan">Login</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>
  <?php
    if (isset($_POST['simpan'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashed_input_password = hash("sha256", $password);
        $tambah = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username' AND password='$hashed_input_password'"); 
        $result= mysqli_num_rows($tambah);

        if($result==1){
            session_start();
            $_SESSION['user_id'] = true;
            $data = $tambah->fetch_assoc();

            $_SESSION['user']=$data;
            echo "<script> 
            alert('Login Successful');
            document.location='index.php';
            </script>";
        }else {
            // Login gagal
            echo
            "<script> 
            alert('Login gagal. Cek kembali username dan password Anda.');
            </script>";
        }
    }
    ?>
</body>
</html>