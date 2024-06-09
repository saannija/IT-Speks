<div id="login-window" class="default-popup">
    <div class="row">
        <h2>Pieslēgties sistēmā</h2>
        <button class="default-button" onclick="hideWindow('login-window'); refreshLogin();"><i class="fas fa-times"></i></button>
    </div>
    <hr>

    <form method="post" id="role-selection-form">
      <p>Laipni lūdzam! <br>Lūdzu, izvēlieties savu pieteikšanās veidu:</p>
      <div class="wrapper">
        <button type="submit" name="login" value="user" class="default-button invert">Lietotājiem</button>
        <button type="submit" name="login" value="admin" class="default-button invert">Administratoriem</button>
      </div>
    </form>

    <form id="login-form-admin" method="post">
      <p>Sistēmas administrēšanas vietne ir paredzēta tikai mūsu aģentūras darbiniekiem</p>
      <input type="text" name="username" class="default-input" placeholder="Lietotājvārds" required>
      <input type="password" name="password" class="default-input" placeholder="Parole" required>
      <a href="" onclick="showWindow('password-reset-window')">Paroles atjaunošana</a>

      <button type="submit" class="default-button" id="login-button" name="login-button" onclick='hideWindow("login-window")'>Pieslēgties</button>
    </form>

    <form id="login-form-user" method="post">
      <input type="text" name="username" class="default-input" placeholder="Lietotājvārds" required>
      <input type="password" name="password" class="default-input" placeholder="Parole" required>
      <a href="" onclick="showWindow('password-reset-window')">Paroles atjaunošana</a>
      <p id="register-text">Vēl neesat lietotājs? <a href="" onclick="showWindow('create-user-window')">Reģistrēties</a></p>

      <button type="submit" class="default-button" name="login-button-user" onclick='hideWindow("login-window")'>Pieslēgties</button>
    </form>

    <?php
      if(isset($_POST['login'])){
        if($_POST['login'] == "admin"){
          $_SESSION['role'] = "admin";
          echo "
            <script>
                let loginForm = document.getElementById('login-form-admin');
                loginForm.style.display = 'flex';

                let loginFormUser = document.getElementById('login-form-user');
                loginFormUser.style.display = 'none';
            </script>
          ";
        }else{
          $_SESSION['role'] = "user";
          echo "
            <script>
                let loginForm = document.getElementById('login-form-user');
                loginForm.style.display = 'flex';

                let loginFormAdmin = document.getElementById('login-form-admin');
                loginFormAdmin.style.display = 'none';
            </script>
          ";
        }
        echo "
        <script>
            let roleForm = document.getElementById('role-selection-form');
            roleForm.style.display = 'none';
        </script>
      ";
      }
    ?>

</div>

<div id="background-overlay"></div>