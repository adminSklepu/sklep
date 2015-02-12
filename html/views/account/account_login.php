<form method="POST" action="/<?= APP_ROOT ?>/account/login">
    <div class="form-group">
        <label >Login: </label>
        <input type="text" name="login" class="form-control"/> 
    </div>
    <div class="form-group">
        <label>Password: </label>
        <input type="password" name="password"  class="form-control"/> 
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>