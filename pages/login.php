<div class="jumbotron">
    <img src="img/logo.png" style="float:left;height:10em;margin-right:3em;" />
    <h1>IHARTÜ-2000 KFT.</h1>
    <p>Tűzifa megrendelés, gyártás és szállítás nyilvántartó program</p>
</div>

<form class="form-horizontal" method="post" action="?mode=login&redirect=<?=(isset($_GET['redirect'])?$_GET['redirect']:'')?>">
    <fieldset>
        <legend>Bejelentkezés</legend>

        <?php if(!empty($loginError)){ ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">HIBA</span> Hibás felhasználónév vagy jelszó
            </div>
        <?php } ?>
        <?php if(!empty($loginTimeout)){ ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">HIBA</span> Lejárt a biztonsági időkorlát, jelentkezzen be újra!
            </div>
        <?php } ?>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="user">Felhasználónév</label>
                    <div class="col-md-5">
                        <input id="user" name="user" type="text" placeholder="Felhasználónév" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">Jelszó</label>
                    <div class="col-md-5">
                        <input id="password" name="password" type="password" placeholder="Jelszó" class="form-control input-md" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="submit"></label>
                    <div class="col-md-4">
                        <button id="submit" name="submit" class="btn btn-success">Bejelentkezés</button>
                    </div>
                </div>

    </fieldset>
</form>
