<?php
$entry = $_GET["entry"];
$title = $entry;
include("../inc/header.php");
require("Content.php");
$content = new Content();
$a = $content::getEntry($entry)
?>
        <div class="container mx-auto" style="width:50%;">
            <div class="row mt-2">
                <h4>Points: <?php echo($a[1]); ?></h4>
            </div>
            <div class="row">
                <table class="table table-bordered table-sm mx-auto">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    <?php
                        echo($a[0]);
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
