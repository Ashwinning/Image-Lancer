<?php
    //echo "test";

    /*
        PhantomJS template
    */
    function GenerateJSTemplate($filename)
    {
        $jstemplate =   "var page = require('webpage').create();" .
                        "page.open('"."files/".$filename.".html', function()" .
                        "{" .
                            "page.render('".$filename.".png');" .
                            "phantom.exit();" .
                        "});";

        Save($filename . ".js", $jstemplate);
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
        exec('phantomjs ' . $filename . ".js");
    }

    /*
        Saves the $content to a file named $filename
    */
    function Save($filename, $content)
    {
        file_put_contents($filename,$content);
    }






?>