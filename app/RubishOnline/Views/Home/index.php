<input type="button" id="welcome" value="Welcome">
<br>
<p id="msg" hidden>To the website</p>

<script>
    $(document).ready(function () {
        $("#welcome").click(function () {
            $("#msg").toggle();
        });
    });
</script>


