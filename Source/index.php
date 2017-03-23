<?php
    //echo "test";

    /*
        PhantomJS template
    */
    function GenerateJSTemplate($filename)
    {
        $jstemplate =   "var page = require('webpage').create();";
        /*
            If width/height options are specified
            This won't work if height isn't specified

            If the height is set to a value that is lower than
            what's required to fit all the content, the entire page
            will be printed (height value will be ignored).
        */
        if (isset($_POST['height']))
        {
            $jstemplate .=  "page.viewportSize = {" .
                                "width: ". $_POST['width'] ."," .
                                "height: ". $_POST['height'] .
                            "};";
        }

        if ($_POST['type'] == 'render-content')
        {
            $jstemplate .=  "page.open('files/".$filename.".html', function()";
        }

        if ($_POST['type'] == 'render-url')
        {
            $jstemplate .=  "page.open('".$_POST['content']."', function()";
        }

        $jstemplate .=  "{" .
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
        if ($_POST['type'] == 'render-content')
        {
            RenderContent();
        }
        if ($_POST['type'] == 'render-url')
        {
            RenderURL();
        }
    }

    /*
        Renders a picture from a URL
    */
    function RenderURL()
    {
        //Generate filename
        $filename = md5(uniqid(rand(), true));

        //Generate JS Template
        GenerateJSTemplate($filename);

        //Execute PhantomJS Operation
        exec('phantomjs files/' . $filename . ".js");

        //Once picture is saved, return URL
        $microserviceURL = (isset($_SERVER['HTTPS']) ? "https" : "http") .
                            "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        echo $microserviceURL . "files/" . $filename . ".png";
    }

    /*
        Renders a picture from HTML
    */
    function RenderContent()
    {
        //Generate filename
        $filename = md5(uniqid(rand(), true));

        //Save the content file //make sure to do this before generating template
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
