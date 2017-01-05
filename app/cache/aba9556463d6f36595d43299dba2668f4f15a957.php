<!DOCTYPE html>
<html id="twilio_tool">
    <head>
        <title>twilio</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        #twilio_tool,
        #twilio_tool #wpcontent,
        #twilio_tool #wrapper,
        #twilio_tool body
        {
            padding-left: 0!important;
            padding-right: 0!important;
            padding-bottom: 0!important;
            margin-left: 0!important;
            margin-right: 0!important;
            margin-bottom: 0!important;
            width: 100%!important;
        }
        .navbar-brand img{
            height:30px;
            width:auto;
        }
        .navbar-brand{
            padding:10px;
        }
    </style>
    </head>
    <body>
        <div id="wrapper" class="col-sm-12">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <img alt="Brand" src="<?php echo e(substr( dirname(__DIR__), strlen( $_SERVER[ 'DOCUMENT_ROOT' ] ) )); ?>/views/images/Twilio_logo_red_small.png">
                        </a>
                    </div>
                </div>
            </nav>
            <div id="content" class="col-sm-12">
                <?php echo $__env->yieldContent("content"); ?>
            </div>
        </div>
    </body>
    <footer>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.common.js" integrity="sha256-AGkzvqACie5W3SC1FTWx6zQyoi+zdhfoM8Lcb6Ly6fk=" crossorigin="anonymous"></script>
    </footer>
</html>