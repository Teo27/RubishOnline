<style>
    table, td, th {
        border: 1px solid #ddd;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 5px;
    }
    h4{
        text-align: center;
    }
    #controls td{
        text-align: center;
    }
</style>

<?php
use RubishOnline\Core\Session;

Session::start();
if(!Session::get('loggedIn')){
    header('location: ../admin/index');
}


echo '<h4>Pending questions</h4><br>';
echo '<table>';
echo '<tr>';
echo '<th>Q_id</th>';
echo '<th>Question</th>';
echo '<th>Right</th>';
echo '<th>Left</th>';
echo '<th>Votes</th>';
echo '<th>Upvote</th>';
echo '<th>Promote</th>';
echo '<th>Delete</th>';
echo '</tr>';
foreach($this->pending as $val){

    $q_id = $val['Q_Id'];
    $question = $val['Question'];
    $right = $val['A_Right'];
    $left = $val['A_Left'];
    $votes = $val['Votes'];
    echo '<tr>';
    echo '<td>',$q_id,'</td>';
    echo '<td>',$question,'</td>';
    echo '<td>',$right,'</td>';
    echo '<td>',$left,'</td>';
    echo '<td>',$votes,'</td>';
    echo '<td><a href="'. URL . 'Pending/vote/' . $q_id.'" class="btn btn-default" target="_blank">Upvote</a></td>';
    echo '<td><a href="'. URL . 'Pending/promote/' . $q_id.'" class="btn btn-default" target="_blank">Promote</a></td>';
    echo '<td><a href="'. URL . 'Pending/deleteQuestion/' . $q_id.'" class="btn btn-default" target="_blank">delete</a></td>';
    echo '</tr>';
}
echo '</table><br>';



echo '<h4>Approved questions</h4><br>';
echo '<table>';
echo '<tr>';
echo '<th>Q_id</th>';
echo '<th>Question</th>';
echo '<th>Right</th>';
echo '<th>Left</th>';
echo '<th>Votes</th>';
echo '<th>Upvote</th>';
echo '<th>Delete</th>';
echo '</tr>';
foreach($this->approved as $val){

    $q_id = $val['Q_Id'];
    $question = $val['Question'];
    $right = $val['A_Right'];
    $left = $val['A_Left'];
    $votes = $val['Votes'];
    echo '<tr>';
    echo '<td>',$q_id,'</td>';
    echo '<td>',$question,'</td>';
    echo '<td>',$right,'</td>';
    echo '<td>',$left,'</td>';
    echo '<td>',$votes,'</td>';
    echo '<td><a href="'. URL . 'Approved/vote/' . $q_id.'" class="btn btn-default" target="_blank">upvote</a></td>';
    echo '<td><a href="'. URL . 'Approved/deleteQuestion/' . $q_id.'" class="btn btn-default" target="_blank">delete</a></td>';
    echo '</tr>';
}
echo '</table> <br>';


echo '<h4>Bins</h4><br>';
echo '<table>';
echo '<tr>';
echo '<th>Bin</th>';
echo '<th>Question</th>';
echo '<th>Right</th>';
echo '<th>Left</th>';
echo '<th>Right Result</th>';
echo '<th>Left Result</th>';
echo '<th>Published</th>';
echo '<th>Address</th>';
echo '<th>Lat</th>';
echo '<th>Long</th>';
echo '<th>Right</th>';
echo '<th>Left</th>';
echo '<th>Question</th>';
echo '<th>Promote</th>';
echo '<th>Delete</th>';
echo '</tr>';
foreach($this->bins as $val){

    $q_id = $val['Bin_Id'];
    $question = $val['Question'];
    $right = $val['A_Right'];
    $left = $val['A_Left'];
    $rightRes = $val['Right_Result'];
    $leftRes = $val['Left_Result'];
    $published = $val['Published'];
    $lat = $val['Latitude'];
    $long = $val['Longitude'];
    $address = $val['Address'];
    echo '<tr>';
    echo '<td>',$q_id,'</td>';
    echo '<td>',$question,'</td>';
    echo '<td>',$right,'</td>';
    echo '<td>',$left,'</td>';
    echo '<td>',$rightRes,'</td>';
    echo '<td>',$leftRes,'</td>';
    echo '<td>',$published,'</td>';
    echo '<td>',$address,'</td>';
    echo '<td>',$lat,'</td>';
    echo '<td>',$long,'</td>';
    echo '<td><a href="'. URL . 'Bin/voteRight/' . $q_id.'" class="btn btn-default" target="_blank">upvote</a></td>';
    echo '<td><a href="'. URL . 'Bin/voteLeft/' . $q_id.'" class="btn btn-default" target="_blank">upvote</a></td>';
    echo '<td><a href="'. URL . 'Bin/getQuestion/' . $q_id.'" class="btn btn-default" target="_blank">get</a></td>';
    echo '<td><a href="'. URL . 'Bin/promote/' . $q_id.'" class="btn btn-default" target="_blank">promote</a></td>';
    echo '<td><a href="'. URL . 'Bin/deleteBin/' . $q_id.'" class="btn btn-default" target="_blank">delete</a></td>';
    echo '</tr>';
}
echo '</table> <br>';

echo '<h4>Results</h4><br>';
echo '<table>';
echo '<tr>';
echo '<th>Question</th>';
echo '<th>Right</th>';
echo '<th>Left Result</th>';
echo '<th>Right Result</th>';
echo '<th>Left</th>';
echo '<th>Published</th>';
echo '</tr>';
foreach($this->results as $val){

    $question = $val['Question'];
    $right = $val['A_Right'];
    $left = $val['A_Left'];
    $rightRes = $val['Right_Result'];
    $leftRes = $val['Left_Result'];
    $published = $val['Published'];
    echo '<tr>';
    echo '<td>',$question,'</td>';
    echo '<td>',$right,'</td>';
    echo '<td>',$left,'</td>';
    echo '<td>',$rightRes,'</td>';
    echo '<td>',$leftRes,'</td>';
    echo '<td>',$published,'</td>';
    echo '</tr>';
}
echo '</table> <br>';
?>
<h4>Controls</h4>
<br>
<table id="controls">
    <tr>
        <th>
            <h4>Pending question</h4>
        </th>
        <th>
            <h4>Pending admin</h4>
        </th>
        <th>
            <h4>Create bin</h4>
        </th>
    </tr>
    <tr>
        <td>
            <form method="POST" action="<?php echo URL ?>pending/add" target="_blank">
                <input id="Question" type="text" placeholder="Question" name="Question">
                <br>
                <input id="Right" type="text" placeholder="Right" name="Right">
                <br>
                <input id="Left" type="text" placeholder="Left" name="Left">
                <br>
                <br>
                <input type="submit" value="Add" class="btn btn-default">
            </form>
        </td>
        <td>
            <form method="POST" action="<?php echo URL ?>pending/addAdmin" target="_blank">
                <input id="Question" type="text" placeholder="Question" name="Question">
                <br>
                <input id="Right" type="text" placeholder="Right" name="Right">
                <br>
                <input id="Left" type="text" placeholder="Left" name="Left">
                <br>
                <br>
                <input type="submit" value="Add" class="btn btn-default">
            </form>
        </td>
        <td>
            <form method="POST" action="<?php echo URL ?>Bin/createBin" target="_blank">
                <input id="Address" type="text" placeholder="Address" name="Address">
                <br>
                <br>
                <input type="submit" value="Add" class="btn btn-default">
            </form>
        </td>
    </tr>
</table>

<br>

