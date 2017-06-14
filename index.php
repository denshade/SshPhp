<?php
require_once("Console.php");
require_once("Authentication.php");
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            textarea {
                width: 100%;
                background-color: black;
                color: white;
                font-size: 1em;
                font-family: Courier, sans-serif;
                border: 1px solid black;
            }

            .inputline {
                width: 100%;
                background-color: black;
                color: white;
                font-size: 1em;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                border: 1px solid black;
            }
        </style>
    </head>
    <body color="white">
        <?php
        $token = urldecode(filter_input(INPUT_GET, 'token', FILTER_SANITIZE_ENCODED));
        ?>
        <form name="subm" action="index.php" method="GET">
            <label>Host
                <input type="text" name="host"/>
            </label><br/>
            <label>Token
                <input type="text" name="pwd" value=""/>
            </label><br/>
            <label>Cwd
                <input type="text" name="cwd" value="<?php
        $cwd = urldecode(filter_input(INPUT_GET, 'cwd', FILTER_SANITIZE_ENCODED));
        echo $cwd;
        ?>">
            </label><br/>

            <textarea id="textarea" rows="20" readonly><?php
                $auth = new Authentication();
                if (!$auth->isAuthenticated($token)) {
                    echo "ACCESS DENIED";
                } else {

                    if (isset($cwd) && $cwd != "") {
                        chdir($cwd);
                    }
                    $cmd = filter_input(INPUT_GET, 'cmd', FILTER_SANITIZE_ENCODED);
                    if (isset($cmd) && $cmd != "") {
                        $cmd = urldecode($cmd);
                        Console::registerOutput("\n>$cmd\n");
                        exec($cmd, $output, $exitcode);
                        if ($exitcode !== 0) {
                            Console::registerOutput("\nERRNR:" . $exitcode . "\n");
                        }
                        Console::registerOutput(implode("\n", $output));
                    }

                    echo Console::getOutput();
                }
        ?>
            </textarea><br/>
            <input class="inputline" id="cmd" name="cmd"
                   onkeydown="if (event.keyCode == 13) {
                       this.form.submit();
                       return false;
                   }" type="text"/>
        </form>
        <script>var textarea = document.getElementById('textarea');
    textarea.scrollTop = textarea.scrollHeight;</script>
    </body>
</html>
