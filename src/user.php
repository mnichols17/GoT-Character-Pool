<?php
$entry = $_GET["entry"];
$title = $entry;
include("../inc/header.php");
require("Content.php");
$content = new Content();
$a = $content::getEntry($entry)
?>
        <div class="content card mx-auto my-2 p-3">
            <div class="container">
                <div class="row mt-2">
                    <h4><?php echo ucwords($entry); ?><br>Points: <?php echo($a[1]); ?></h4>
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
        </div>
    </body>
</html>
