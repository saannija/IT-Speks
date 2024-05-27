<div id="edit-user-window" class="default-popup">
    <div class="row">
        <h2>Rediģēt</h2>
        <button class="default-button" onclick="hideWindow('edit-user-window')"><i class="fas fa-times"></i></button>
    </div>
    <hr>

    <form id="login-form">
    <input type="text" id="username" name="username" class="default-input" placeholder="Lietotājvārds" required>
    <input type="text" id="epasts" name="epasts" class="default-input" placeholder="E-pasts" required>
    <input type="text" id="vards" name="vards" class="default-input" placeholder="Parādāmais vārds" required>
    <select name="tiesibas" id="">
        <option value="admin">Administrators</option>
        <option value="moder">Moderators</option>
    </select>
    <input type="password" id="password" name="password" class="default-input" placeholder="Parole" required>
    <button type="submit" class="default-button" id="login-button">Saglabāt</button>
  </form>
</div>

<div id="background-overlay"></div>