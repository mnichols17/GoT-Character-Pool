<?php
$title = "Home";
include("../inc/header.php");
require("Content.php");
$content = new Content();
?>

        <div class="card mx-auto my-2 p-3" style="width:80%;">
            <div class="container mx-auto" style="width:80%;">
                <div class="row">
                    <table class="table table-bordered mt-2">
                        <thead class="thead-dark">
                            <th>Name</th>
                            <th>Points</th>
                        </thead>
                        <tbody>
                            <?php
                            $content::makeLeaderboard();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
