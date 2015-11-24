
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$("#reserve_form").validate();
	});
</script>  
  <!-- /.inner title Start ./-->
  <section class="inner-titlebg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <h2>Reservation</h2>
        </div>
        <div>
          <div class="col-lg-9 col-md-9">
          </div>
          <div class="col-lg-3 col-md-3">
            <ul class="bcrumb pull-right">
              <li> <a href="#">Home </a></li>
              <li><a href="#"> Reservation</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- /.inner title Start ./-->
  <div class="gap"></div>
  
  <!-- /.signup Start ./-->
  
  <section class="register signup">
    <div class="container">
      <div class="row"> 
        
        <!-- Register Form Start -->
        
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">       
          <?php 

if(!empty($_POST['first_name']) && isset($_POST['first_name'])){
    foreach ($_POST as $key=>$value):
    ${$key}= addslashes($value);    
    endforeach;  
   
       // $date=substr($date, 8,2)."-".substr($date,5,2)."-".  substr($date,0,4);    
        $recipient='bookings@roseandvelvet.com';       
       // $message="$name just filled in the Request form. His details are:\n\nFull Name:: $surname\n\nCountry: $country\n\nTelephone: $phone\n\nE-mail: $mail\n\nMessage: $prayer";
       if(isset($email)) {
            $headers = "MIME-Version: 1.0"."\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1"."\r\n";
            $headers .= 'From: <info@roseandvelvet.com>'."\r\n";
            $headers .= 'Bcc: adegokeayanfe@gmail.com' . "\r\n";
            $input=array("@@name","@@treatment","@@date","@@time","@@email","@@gender","@@phone","@@address","@@messages");
            $output=array($first_name." ".$last_name, $treatment, $date, $time, $email, $gender, $phone, $address, $messages);
            $string=file_get_contents('reserve.txt',true);
            $string=str_replace($input,$output,$string);///send message to the admin
            mail($recipient,'From the Site (Rose and Velvet Oniline)',$string,$headers);
          $response = "<strong>Thank you, your reservation has been submitted</strong>";
       } else {

          $response = "<strong>There was a problem sending your reservation.</strong>";
         }  
    }
?>
          <div>
            <h2>Make a Reservation</h2><br>
            <h5>
            Schedule your appointment online, right here, from our automated booking system.
We will email you response and/or confirmation within 24- hours.            
            </h5>
            <p><?=isset($response)? $response:'';?></p>
            <form method="post" action="" id="reserve_form">
              <ul>
                <li>
                  <label>Treatment *</label>
                   <input name="treatment" class="required" type="text" placeholder="Describe Treatment">
                </li>
              </ul>
              <ul class="row">
                <li class="col-lg-6">
                  <label>First Name *</label>
                  <input name="first_name" class="required" type="text" placeholder="First Name">
                </li>
                <li class="col-lg-6">
                  <label>Last Name*</label>
                  <input name="last_name" class="required" type="text" placeholder="Last Name">
                </li>
              </ul>
              <ul class="row">
                <li class="col-lg-6">
                  <label>Email Address*</label>
                  <input name="email" class="required email" type="text" placeholder="Email">
                </li>
                <li class="col-lg-6">
                  <label>Phone*</label>
                  <input name="phone" type="text" class="required number" placeholder="Phone">
                </li>
              </ul>
              <ul class="row">
                <li class="col-lg-6" id="datetimepicker2">
                  <label>Date *</label>
                  <input type="date"  name="date" class="required date" placeholder="Date">
                </li>
                <li class="col-lg-3">
                  <label>Time *</label>
                  <input id="duration"  name="time" type="text" class="required time" placeholder="Time" />
                </li>
                <li class="col-lg-3">
                  <label>Gender *</label>
                  <select class="selectpicker" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </li>
              </ul>
              <ul>
                <li>
                  <label>Special Requirements</label>
                  <textarea  class="required" name="req" rows="14"></textarea>
                </li>
              </ul>
              <ul>
                <li>
                  <input type="submit" value="Submit">
                </li>
              </ul>
            </form>
          </div>
        </div>
        
        <!-- Register Form end --> 
        
        <!-- Login Form Start -->
        
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="login">
            <h2>Booking Info</h2>
           Book your spa treatment by phone, or simply fill out the form below and we will respond to your request shortly.<br><br>
We do our best to accommodate last-minute requests, however we recommend that you book your treatment at least 48 hours in advance to ensure that we can fulfil your request.<br><br><br>

<h2>OUR POLICIES</h2>
<h5>Reservation Policy:</h5>
Appointments need to made at least 48 hours in advance. Appointments can be made by calling 08023312137 or booking online. Appointments can be made from 10:00 AM to 7:00 PM 7 days a week.<br><br>

Women or couples only please, unless otherwise arranged. Cash, Visa, Master Card, or personal cheques accepted with a smile.<br><br>

<h5>Cancellation Policy:</h5>

For individual treatments 24 hours notice is appreciated and required when changing appointments time or date. There is a 20% charge for cancellations made less then 24 hours.<br><br>

Cancellations for Spa Parties require 1 week in advance in order to avoid a 20% cancellation charge.<br><br>

Changes to Spa Party Packages must be made within 48 hours of event.<br><br>

<h5>Important Note:</h5>

Your Beauty Therapist has the right to refuse treatment if any of the following apply:<br><br>

1. Any Medical conditions that were not mentioned at time of booking appointment.<br><br>

2. Broken skin or lesions.<br><br>

If pregnant please state while booking appointment.
          </div>
        </div>
        
        <!-- Login Form End --> 
        
      </div>
    </div>
  </section>
  <!-- /.Cart End ./-->
  
  <div class="gap"></div>
  
  <!-- /. Footer Start ./-->
 