<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Register</title>
    <link rel="stylesheet" href="asset/style.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <div class="bg-img">
        <div class="content">
            <header>Register</header>
            <form action="#">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" required placeholder="Username" />
                </div>
                <div class="field space">
                    <span class="fas fa-id-card"></span>
                    <input type="text" required placeholder="Nama" />
                </div>
                <div class="field space">
                    <span class="fas fa-id-card"></span>
                    <input type="email" required placeholder="Email" />
                </div>

                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" class="pass-key" required placeholder="Password" />
                    <span class="show">SHOW</span>
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" class="pass-key" required placeholder="Retype Password" />
                    <span class="show">SHOW</span>
                </div>

                <!-- <div class="pass">
            <a href="#">Forgot Password?</a>
          </div>
          <div class="field">
            <input type="submit" value="LOGIN" />
          </div> -->
            </form>
            <div class="login">Or Register with</div>
            <div class="links">
                <div class="instagram">
                    <i class="fab fa-google"><span>Google </span></i>
                </div>
            </div>
            <div class="login">
                Already have account?
                <a href="/">Login</a>
            </div>
            <div class="links">
                <a href="tables/pegawai">
                    <div class="submit">
                        <i class="fa fa-send-o"> <span>Submit</span></i>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script>
        const pass_field = document.querySelector(".pass-key");
        const showBtn = document.querySelector(".show");
        showBtn.addEventListener("click", function() {
            if (pass_field.type === "password") {
                pass_field.type = "text";
                showBtn.textContent = "HIDE";
                showBtn.style.color = "#3498db";
            } else {
                pass_field.type = "password";
                showBtn.textContent = "SHOW";
                showBtn.style.color = "#222";
            }
        });
    </script>
</body>

</html>
