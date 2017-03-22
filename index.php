<?php
    //echo "test";

    /*
        PhantomJS template
    */
    function GenerateJSTemplate($filename)
    {
        $jstemplate =   "var page = require('webpage').create();";
        if (isset($_POST['height']))
        {
            $jstemplate .=  "page.viewportSize = {" .
                                "width: ". $_POST['width'] ."," .
                                "height: ". $_POST['height'] .
                            "};";
        }
        $jstemplate .=  "page.open('files/".$filename.".html', function()" .
                        "{" .
                            "page.render('files/".$filename.".png');" .
                            "phantom.exit();" .
                        "});";

        Save("files/".$filename . ".js", $jstemplate);
    }

    /*
        Run the main function;
    */
    Main();

    /*
        Main code-block to be executed
        (Specify the POST params/API)
    */
    function Main()
    {
        if ($_POST['type'] == 'refresh')
        {
            Refresh();
        }
        if ($_POST['type'] == 'render')
        {
            Render();
        }
    }

    /*
        Renders the picture
    */
    function Render()
    {
        //Generate filename
        $filename = md5(uniqid(rand(), true));

        //Save the content file
        Save("files/" . $filename . ".html", $_POST['content']);

        //Generate JS Template
        GenerateJSTemplate($filename);

        //Execute PhantomJS Operation
        exec('phantomjs files/' . $filename . ".js");

        //Once picture is saved, return URL
        $microserviceURL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        echo $microserviceURL . "files/" . $filename . ".png";
    }

    /*
        Saves the $content to a file named $filename
    */
    function Save($filename, $content)
    {
        file_put_contents($filename,$content);
    }






?>
