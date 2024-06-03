<div id="login-window" class="default-popup">
    <div class="row">
        <h2>Pieslēgties sistēmā</h2>
        <button class="default-button" onclick="hideWindow('login-window')"><i class="fas fa-times"></i></button>
    </div>
    <hr>

    <form id="login-form" method="post">
      <p>Sistēmas administrēšanas vietne ir paredzēta tikai mūsu aģentūras darbiniekiem</p>
      <input type="text" id="username" name="username" class="default-input" placeholder="Lietotājvārds" required>
      <input type="password" id="password" name="password" class="default-input" placeholder="Parole" required>
      <a href="" onclick="showWindow('password-reset-window')">Paroles atjaunošana</a>

      <button type="submit" class="default-button" id="login-button" name="login-button" onclick='hideWindow("login-window")'>Pieslēgties</button>
    </form>

</div>

<div id="background-overlay"></div>