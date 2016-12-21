<div style="width: 50%;margin: 0 auto;text-align: center;margin-top: 20px;">
    <form method="POST" action="<?php echo URL ?>admin/login">
        <input id="Username" type="text" placeholder="Username" name="username">
        <br>
        <input id="Password" type="password" placeholder="Password" name="password">
        <br>
        <br>
        <input type="submit" class="btn btn-default">
    </form>
    <br>

    <?php
    if (isset($this->login)){
        switch ($this->login){
            case 0:
                showError('Could not connect to DB');
                break;
            case -1:
                showError('Error getting data from DB');
                break;
            case -2:
                showError('Bad Input');
                break;
        }
    }


    ?>

    <?php

    function showError($msg){
        echo '<div class="alert alert-danger" style="width: 50%;margin: 0 auto;">';
        echo $msg;
        echo '</div>';
    }

    ?>

</div>


