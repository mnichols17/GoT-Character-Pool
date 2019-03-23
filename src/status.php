<?php
$title = "Status";
include("../inc/header.php");
require("Content.php");
$content = new Content();
?>
        <div class="content card mx-auto my-2 p-3">
            <div class="container">
                <div class="row mt-2">
                    <h4>As of the start of Season 8:</h4>
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
                        echo($content::createStatus());
                    ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
