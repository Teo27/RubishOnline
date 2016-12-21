<?php

    $question = $this->results['Question'];
    $rightAnswer = $this->results['A_Right'];
    $leftAnswer = $this->results['A_Left'];
    $rightValue = $this->results['Right_Result'];
    $leftValue = $this->results['Left_Result'];

    if($this->results == null){
        echo 'No such trash bin exists';
    }

?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;

    }

    th, td {
        text-align: center;
        padding: 8px;
    }
    #holder{
        width: 35%;
        margin: 0 auto;
    }
</style>
<div id="holder">
    <table>
        <tr>
            <th colspan="2">
                <h3><?php echo $question ?></h3>
            </th>
        </tr>
        <tr>
            <td>
                <h4><?php echo $leftAnswer ?></h4>
            </td>
            <td>
                <h4><?php echo $rightAnswer ?></h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4><?php echo $leftValue ?></h4>
            </td>
            <td>
                <h4><?php echo $rightValue ?></h4>
            </td>
        </tr>
    </table>
</div>

