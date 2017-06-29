<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Image Search!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Styles -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link rel='stylesheet' id='prettyphoto-css'  href="assets/css/prettyPhoto.css" type='text/css' media='all'>
        <link href="assets/css/fontello.css" type="text/css" rel="stylesheet">
        <!--[if lt IE 7]>
                <link href="assets/css/fontello-ie7.css" type="text/css" rel="stylesheet">  
            <![endif]-->
        <!-- Google Web fonts -->
        <link href='http://fonts.googleapis.com/css?family=Quattrocento:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
            }
        </style>
        <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.ico">

        <link rel="stylesheet" href="assets/dropzone/css/basic.css" />
        <!-- JQuery -->
        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <!-- Load ScrollTo -->
        <script type="text/javascript" src="assets/js/jquery.scrollTo-1.4.2-min.js"></script>
        <!-- Load LocalScroll -->
        <script type="text/javascript" src="assets/js/jquery.localscroll-1.2.7-min.js"></script>

        <script src="assets/dropzone/dropzone.min.js"></script>
        <!-- prettyPhoto Initialization -->
        <script type="text/javascript" charset="utf-8">
            var fileName = "";

            $(document).ready(function () {
                $("a[rel^='prettyPhoto']").prettyPhoto();
            });

            Dropzone.options.myAwesomeDropzone = {
                paramName: "file", // The name that will be used to transfer the file
                //maxFilesize: 2, // MB
                uploadMultiple: false,
                maxFiles: 1,
                accept: function (file, done) {
                    done();
                },
                init: function () {
                    this.on("addedfile", function (file) {
//                        console.log(file.name);
                        //alert('data berhasil masuk');
                    });
                },
                success: function (file, response) {
//                    console.log(response);
                    fileName = response;
                }
            }

            function goToSearch() {
                if (fileName != "") {
                    $.ajax({
                        url: 'result.php',
                        data: {
                            'file_name': fileName
                        },
                        type: 'post',
                        datatype: 'json',
                        success: function (result) {
                            a = eval(result);
//                            console.log(a);
//                            console.log(a[0].location);
                            var html = "";
                            $('#result').html(html);
                            
                            for (var i = 0; i < a.length; i++) {
                                html += '<article class="span4 post">\n\
                                        <img style="width: auto;height: 250px;" src="' + a[i].location + '" alt="">\n\
                                        <div class="inside">\n\
                                            <p class="post-date">' + a[i].ranking + '</p>\n\
                                        </div>\n\
                                    </article>';
                            }
                            
                            $('#result').html(html);
                        }
                    });
                } else {
                    alert("please insert image");
                }
            }

        </script>

    </head>
    <body>

        <!-- /.navbar-wrapper -->
        <div id="top"></div>
        <!-- ******************** HeaderWrap ********************-->
        <div id="headerwrap">
            <header class="clearfix">
                <h1><span>Image Search!</span></h1>
                <div class="container">
                    <div class="row">

                        <div class="span12">
<!--                            <input type="text" name="query" placeholder="search..." class="cform-text" size="40" title="Search">
                            >-->

                            <div id="dropzone">
                                <form action="process.php" class="dropzone dz-clickable" id="myAwesomeDropzone" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="process" value="uploadgambar" />
                                    <div class="dz-default dz-message" style="text-align:center">
                                        <span><b>Drop files here</b> to upload or <b>Click Me</b></span>
                                    </div>
                                </form>
                            </div>

                            <input type="submit" value="Search" class="cform-submit" onclick="goToSearch()">
                        </div>
                    </div>
                </div>
            </header>

        </div>

        <section id="news" class="single-page scrollblock">
            <div class="container">
                <div class="row"id="result">

                </div>
            </div>
        </section>

        <div class="footer-wrapper">
            <div class="container">
                <footer>
                    <small>&copy; 2013 Inbetwin Network. All rights reserved.</small>
                </footer>
            </div>
            <!-- ./container -->
        </div>

        <!-- Loading the javaScript at the end of the page -->
        <script type="text/javascript" src="assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="assets/js/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="assets/js/site.js"></script>



    </body>
</html>
