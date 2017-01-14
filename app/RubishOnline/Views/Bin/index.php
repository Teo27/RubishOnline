<?php

    $question = $this->results['Question'];
    $rightAnswer = $this->results['A_Right'];
    $leftAnswer = $this->results['A_Left'];
    $rightValue = $this->results['Right_Result'];
    $leftValue = $this->results['Left_Result'];

    if($this->results == null){
        echo 'No such trash bin exists';
    }
function refresh( $time ){
    $current_url = $_SERVER[ 'REQUEST_URI' ];
    return header( "Refresh: " . $time . "; URL=$current_url" );
}

// call the function in the appropriate place
refresh( 4 );
// this refreshes page after 4 seconds
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
<!--
<script>
    $(document).ready(function() {
        setInterval(GetData, 1000);

        function GetData() {

            $.ajax({
                type: "GET",
                url: "<?php echo URL?>Bin/index",
                dataType: "text",
                cache: false,
                success: function (data) {

                    var title = $(xml).find("title").text();
                    var singer = title.split(" - ")[0];
                    var song = title.split(" - ")[1];

                    var album = $(xml).find("album").text();
                    var genre = $(xml).find("genre").text();
                    var duration = $(xml).find("duration").text();
                    var next = $(xml).find("next").text();


                    if (localStorage.getItem("title") != title) {

                        var xmldata = 'singer=' + singer + '&song=' + song + '&album=' + album + '&genre=' + genre + '&duration=' + duration;
                        AddDB(title, xmldata);

                    }
                    $('#singer').html(singer);
                    $('#song').html(song);
                    $('#album').html(album);
                    $('#genre').html(genre);
                    $('#duration').html("/" + duration);

                    Timer(duration, next);

                }
            });
        }
    }
</script>
-->

