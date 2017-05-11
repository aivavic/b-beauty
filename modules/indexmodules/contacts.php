<div class="container">
    <h1 class="page-caption"><?= $_logic['contactstitle'] ?></h1>

    <div class="contacts">
        <div class="contacts-data">
            <div class="contacts-info">
                <?= $_logic['contactstext'] ?>
            </div>

            <form action="/work.php" method="post">
                <h3><?= $varsline['formtitle'] ?></h3>
                <div class="contacts-form-rows">
                    <div class="contacts-form-row required">
                        <input type="text" name="name" required="required" placeholder="Ваше имя"/>
                    </div>
                    <div class="contacts-form-row required">
                        <input type="text" name="email" required="required" placeholder="E-mail"/>
                    </div>
                    <div class="contacts-form-row">
                        <input type="text" name="phone" placeholder="Телефон"/>
                    </div>
                </div>
                <div class="contacts-form-textarea">
                    <textarea rows="7" placeholder="Сообщение" name="message"></textarea>
                </div>

                <p class="contacts-form-text">
                    <?= $varsline['formcaption'] ?>
                </p>
                <input type="hidden" name="act" value="contactus"/>
                <input class="button-link-pull" type="submit" value="Отправить" name="send"/>
            </form>
        </div>
        <? if (isset($_SESSION['sent']) && $_SESSION['sent'] == 1) echo '<script>$(document).ready(function() {alert(\'Ваше сообщение отправлено\');  });</script>'; ?>
        <? // if(isset($_SESSION['sent']) && $_SESSION['sent']==2) echo '<script>$( document ).ready(function() {alert(\'Вы не верно ввели код с картинки\');});</script>'; ?>
        <? $_SESSION['sent'] = 0; ?>
        <div class="contacts-map">
            <?= $varsline['map'] ?>
        </div>
    </div>
</div>
<!-- /.container -->
