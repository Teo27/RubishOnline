<?php

    $question = $this->results['Question'];
    $rightAnswer = $this->results['Right'];
    $leftAnswer = $this->results['Left'];
    $rightValue = $this->results['Right_Result'];
    $leftValue = $this->results['Left_Result'];

    if($this->results == null){
        echo 'No such trash bin exists';
    }

?>


<table>
    <tr>
        <th colspan="2">
            <?php echo $question ?>
        </th>
    </tr>
    <tr>
        <td>
            <?php echo $leftAnswer ?>
        </td>
        <td>
            <?php echo $rightAnswer ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $leftValue ?>
        </td>
        <td>
            <?php echo $rightValue ?>
        </td>
    </tr>
</table>
