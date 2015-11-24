 <!-- /.inner title Start ./-->
  <section class="inner-titlebg">
    <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2>Contact Us</h2>

      </div>
      <div>
        <div class="col-lg-9 col-md-9">
       <!--   <h5>There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration in some form.</h5>
       --> </div>
        <div class="col-lg-3 col-md-3">
          <ul class="bcrumb pull-right">
            <li> <a href="#">Home </a></li>
            <li><a href="#"> Contact US</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  </section>
  
  <!-- /.inner title Start ./-->
  <div class="gap"></div>
 
  
  <!-- /.contact Start ./-->
  
  <section class="signup">
    <div class="container">
      <div class="row">
      
      <!-- Register Form Start -->

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<div class="contact">
<h2>Quick Contact</h2>
<p class="contact-sub" style="color: green"> 
  <?php
if(!empty($_POST['email'])):
    foreach ($_POST as $key=>$value):       
${$key}= addslashes($value);  

endforeach;                  
      // $to="opeyemi.omezie@roseandvelvet.com";
       $to='opeyemi.omezie@roseandvelvet.com';       
       // $message="$name just filled in the Request form. His details are:\n\nFull Name:: $surname\n\nCountry: $country\n\nTelephone: $phone\n\nE-mail: $mail\n\nMessage: $prayer";
       if(isset($email)) {
            $headers = "MIME-Version: 1.0"."\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1"."\r\n";
            $headers .= 'From: <info@roseandvelvet.com>'."\r\n";
            $input=array("@@name","@@country","@@phone","@@email","@@message");
            $output=array($name,$subject,$phone,$email,$message);
            $string=file_get_contents('basic.txt',true);
            $string=str_replace($input,$output,$string);///send message to the admin
            mail($to,'From the Site (Rose and Velvet Oniline)',$string,$headers);
          echo "<strong>**Thank you, your Message has been submitted**</strong>";
       } else {
          echo "<strong>**There was a problem sending your message**</strong>";
         }
    
  endif;

  
/*  function alert($message){    
 
 print  "<script type='text/javascript'>alert($message);</script>";
   
    
}
 */

?></p>

<form method="post" action="" id="form_contact">

<ul class="row">
<li class="col-lg-6">
<label class="first">Name *</label>
<input name="name" type="text" class="required" placeholder="Name">
</li>
<li class="col-lg-6">
<label class="first">Email *</label>
<input name="email" type="text" class="required" placeholder="Email">
</li>
</ul>

<ul class="row">
<li class="col-lg-6">
<label>Phone No. *</label>
<input name="phoneno" type="text" class="required" placeholder="Phone No.">
</li>
<li class="col-lg-6">
<label>Subject *</label>
<input name="subject" type="text" class="required" placeholder="Subject">
</li>
</ul>


<ul>
<li>
<label>Message</label>
<textarea name="message"  rows="10">Message</textarea>
</li>
</ul>
<ul>
<li>
<input type="submit" name="submit" value="Submit">
</li>
</ul>


</form>








</div>






        
        
        </div>



<!-- Register Form end -->


<!-- Login Form Start -->

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        
        
<div class="contact-details">
<h2>Contact Info</h2>

        <p>
<h4>Office Hours</h4><br>
Monday – Saturday, 9am – 6pm<br><br>
Sunday , 2pm - 6pm

<h4>Email</h4><br>
info@roseandvelvet.com<br><br>
</p>

<hr>
<address>
<ul>
<li><strong class="title"><i class="fa fa-home"></i>No 25 Ladipo Oluwole Off Adeniyi Jones |Ikeja </strong></li>
<li><strong class="title"><i class="fa fa-phone"></i> +2348093972300</strong></li>
<li><strong class="title"><i class="fa fa-mobile"></i> +2348180350201</strong></li>
<li><strong class="title"><i class="fa fa-mobile"></i> +2348023312137</strong></li>
<li><strong class="title"><i class="fa fa-envelope"></i><a href="mailto:info@roseandvelvet.com">info@roseandvelvet.com</a></strong></li>
</ul>
</address>
<hr>

<div class="social">
<a href="#" title="Facebook"><i class="fa fa-facebook-square"></i></a>
<a href="#" title="Linkedin"><i class="fa fa-linkedin-square"></i></a>
<a href="#" title="Gplus"><i class="fa fa-google-plus-square"></i></a>
<a href="#" title="Twitter"><i class="fa fa-twitter-square"></i></a>
<a href="#" title="Pinterest"><i class="fa fa-pinterest-square"></i></a>
<a href="#" title="Instagram"><i class="fa fa-instagram"></i>
</a> <a href="#" title="Flickr"><i class="fa fa-flickr"></i></a>
</div>


</div>




        
        
        </div>

<!-- contact Form End -->

      </div>
    </div>
  </section>
  <!-- /.contact End ./-->
  
  <div class="gap"></div>
  
  <!-- /. Footer Start ./-->