<?php
require('req_globals.php');
/*------------------------------
| 2. Run a query
------------------------------*/
$gallery = mysqli_query($con, "SELECT * FROM gallery");
$pageTitle = 'Class';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>English SEED</title>
	<link rel="stylesheet" href="bower_components/foundation/css/foundation.min.css">
</head>
<body>
<!-- gallery loop -->

<!-- end gallery loop -->

	  <div class="row">
     
        <div class="large-12 columns">
           
        <?php 
            include("inc_header.php");
            include("inc_nav.php");
          ?>
        </div>
      </div>

      <div class="row">
        <div class="large-12 columns">
          <img src="http://placehold.it/1000x500&text=[banner img]">
        </div>
      </div>

      <div class="row">
        <hr>
        <div class="large-8 columns">
            
<!-- login -->
            <div class="center row">
              <div class="section-container tabs" data-section="tabs">
                <section class="active">
                  <p class="title" data-section-title><a href="#">Sign Up</a></p>
                  <div class="content" data-section-content>
                    <p>
                      <div class="row">
                        <div class="large-12 columns">
                          <div class="signup-panel">
                            <p class="welcome">Hello, new user!</p>
                            <form>
                              <div class="row collapse">
                                <div class="small-2  columns">
                                  <span class="prefix"><i class="fi-torso"></i></span>
                                </div>
                                <div class="small-10  columns">
                                  <input type="text" placeholder="Full Name">
                                </div>
                              </div>
                              <div class="row collapse">
                                <div class="small-2 columns">
                                  <span class="prefix"><i class="fi-mail"></i></span>
                                </div>
                                <div class="small-10  columns">
                                  <input type="text" placeholder="Email">
                                </div>
                              </div>
                              <div class="row collapse">
                                <div class="small-2 columns ">
                                  <span class="prefix"><i class="fi-lock"></i></span>
                                </div>
                                <div class="small-10 columns ">
                                  <input type="text" placeholder="Password">
                                </div>
                              </div>
                            </form>
                            <a href="#" class="button ">Sign Up! </a>
                          </div>
                        </div>
                       </div></p>
                  </div>
                </section>
                <section>
                  <p class="title" data-section-title><a href="#">Sign In</a></p>
                  <div class="content" data-section-content>
                    <p>
                      <div class="row">
                        <div class="large-12 columns">
                          <div class="signup-panel">
                            <p class="welcome">Welcome back!</p>
                            <form>
                              <div class="row collapse">
                                <div class="small-2 columns">
                                  <span class="prefix"><i class="fi-mail"></i></span>
                                </div>
                                <div class="small-10  columns">
                                  <input type="text" placeholder="Email">
                                </div>
                              </div>
                              <div class="row collapse">
                                <div class="small-2 columns ">
                                  <span class="prefix"><i class="fi-lock"></i></span>
                                </div>
                                <div class="small-10 columns ">
                                  <input type="text" placeholder="Password">
                                </div>
                              </div>
                            </form>
                            <a href="#" class="button ">Sign Up! </a>
                          </div>
                        </div>
                       </div></p>
                  </div>
                </section>
              </div>
            <div>
<!-- end login -->
          <i class="fi-social-twitter"></i>
        </div>
        <div class="large-4 columns">
          <img src="http://placehold.it/400x300&text=[img]">
        </div>
      </div>

      <div class="row">
        <hr>
        <div class="large-12 columns">
          <h4>Assignments</h4>
          <p>Click on an assignment to begin!</p>

          <ul class="clearing-thumbs small-block-grid-1 medium-block-grid-2 large-block-grid-4" data-clearing>
            <li>
              <a href="http://placehold.it/800x500&text=[img]">
              <img data-caption="caption here..." src="http://placehold.it/800x500&text=[img]"></a>
            </li>
            <li>
              <a href="http://placehold.it/800x500&text=[img]"><img data-caption="caption 2 here..." src="http://placehold.it/800x500&text=[img]"></a>
            </li>
            <li>
              <a href="http://placehold.it/800x500&text=[img]"><img data-caption="caption 3 here..." src="http://placehold.it/800x500&text=[img]"></a>
            </li>
            <li>
              <a href="http://placehold.it/800x500&text=[img]"><img data-caption="caption 4 here..." src="http://placehold.it/800x500&text=[img]"></a>
            </li>
            <li>
              <a href="http://placehold.it/800x500&text=[img]"><img data-caption="caption 5 here..." src="http://placehold.it/800x500&text=[img]"></a>
            </li>       
            <li>
              <a href="http://placehold.it/800x500&text=[img]"><img data-caption="caption 6 here..." src="http://placehold.it/800x500&text=[img]"></a>
            </li> 
          </ul>
        </div>
      </div>

      <div class="row">
        <div class="large-12 columns">
          <hr>
          <h4>Contact Me</h4>
          <div class="large-4 columns">
            Email: <a class="__cf_email__" href="/cdn-cgi/l/email-protection" data-cfemail="caa7af8aa7b3baa5b8beaca5a6a3a5e4a9a5a7">[email protected]</a><script cf-hash='f9e31' type="text/javascript">
/* <![CDATA[ */!function(){try{var t="currentScript"in document?document.currentScript:function(){for(var t=document.getElementsByTagName("script"),e=t.length;e--;)if(t[e].getAttribute("cf-hash"))return t[e]}();if(t&&t.previousSibling){var e,r,n,i,c=t.previousSibling,a=c.getAttribute("data-cfemail");if(a){for(e="",r=parseInt(a.substr(0,2),16),n=2;a.length-n;n+=2)i=parseInt(a.substr(n,2),16)^r,e+=String.fromCharCode(i);e=document.createTextNode(e),c.parentNode.replaceChild(e,c)}}}catch(u){}}();/* ]]> */</script>
          </div>
          <div class="large-4 columns">
            Twitter: @twitterhandle
          </div>
          <div class="large-4 columns">
            Phone: 555-555-1234
          </div>
        </div>
      </div>
<?php include('inc_footer.php'); ?>
      
    
	
</body>
</html>