
<script language="JavaScript" type="text/javascript">
    var timeout    = 500;
    var closetimer = 0;
    var ddmenuitem = 0;

    function jsddm_open()
    {  jsddm_canceltimer();
        jsddm_close();
        ddmenuitem = $(this).find('ul').css('visibility', 'visible');}

    function jsddm_close()
    {  if(ddmenuitem) ddmenuitem.hide();}

    function jsddm_timer()
    {  closetimer = window.setTimeout(jsddm_close, timeout);}

    function jsddm_canceltimer()
    {  if(closetimer)
    {  window.clearTimeout(closetimer);
        closetimer = null;}}

    $(document).ready(function()
    {
        $("#menu_brands").hover( function(){
            jsddm_canceltimer();
            jsddm_close();
            ddmenuitem = $(this).find('.jmenubox');
            ddmenuitem.show();
        },function(){
            jsddm_timer();
        });
        $("#menu_categories").hover( function(){
            jsddm_canceltimer();
            jsddm_close();
            ddmenuitem = $(this).find('.jmenubox');
            ddmenuitem.show();
        },function(){
            jsddm_timer();
        });
        $("#menu_conditions").hover( function(){
            jsddm_canceltimer();
            jsddm_close();
            ddmenuitem = $(this).find('.jmenubox');
            ddmenuitem.show();
        },function(){
            jsddm_timer();
        });
    });

</script>

<script>
    function pinIt()
    {
        var e = document.createElement('script');
        e.setAttribute('type','text/javascript');
        e.setAttribute('charset','UTF-8');
        e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
        document.body.appendChild(e);
    }
</script>
<!--[if IE 6]>
<style type="text/css">
    #menucolumns{
        margin-left:7px;
        margin-right:6px;
    }
</style>
<![endif]-->
<style>
    input[type="radio"]{
        -webkit-appearance:radio;
    }
    input[type="checkbox"]{
        -webkit-appearance:checkbox;
    }
</style>
<script type="text/javascript">
    <!--
    function refreshimg(){
        document.getElementById('captcha').src = document.getElementById('captcha').src + '?' + (new Date()).getMilliseconds();
    }

    -->
</script>
<script type="text/javascript" charset="utf-8">



    $(document).ready(function(){

        function validate_skin_form(){

            var no_errors = false
            var subsignal = 1;



            if( $("#questions input[name='realname']").val() == "" ){
                $("#skin_error").show();
                $("#incomplete_error").show();
                window.location = "#incomplete";
                subsignal = 0;
            }
            //alert('realname'+no_errors);

            if( $("#questions input[name='Email']").val() == "" ){
                $("#skin_error").show();
                $("#incomplete_error").show();
                window.location = "#incomplete";
                subsignal = 0;

            }
            var email = $("#questions input[name='Email']").val();
            var exp = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

            if(exp.test( email ) == false) {
                $("#email_error").show();
                $("#incomplete_error").show();
                window.location = "#incomplete";
                subsignal = 0;

            }

//alert('realname'+no_errors);
            if( $("#questions input[name='email']").val() == "" ){
                $("#skin_error").show();
                $("#incomplete_error").show();
                window.location = "#incomplete";
                subsignal = 0;

            }

            if( $("#questions input[name='Turing']").val() == "" ){
                $("#captcha_error").show();
                $("#incomplete_error").show();
                window.location = "#incomplete";
                subsignal = 0;

            }

            if( $("#questions input[name='age']:checked").length < 1 ){
                $("#age_error").show();
                $("#incomplete_error").show();
                window.location = "#incomplete";
                subsignal = 0;

            }

            if( $("#questions input[name='sex']:checked").length < 1 ){
                $("#sex_error").show();
                $("#incomplete_error").show();
                window.location = "#incomplete";
                subsignal = 0;

            }

            for( i=1;i<12;i++){
                if( $("#questions input[name='Question-" + i +"']:checked").length < 1 ){
                    $("#q" + i + "_error").show();
                    $("#incomplete_error").show();
                    window.location = "#incomplete";
                    subsignal = 0;

                }
            }

            for( i=14;i<16;i++){
                if( $("#questions input[name='Question-" + i +"']:checked").length < 1 ){
                    $("#q" + i + "_error").show();
                    $("#incomplete_error").show();
                    window.location = "#incomplete";
                    subsignal = 0;

                }
            }

            for( i=18;i<23;i++){
                if( $("#questions input[name='Question-" + i +"']:checked").length < 1 ){
                    $("#q" + i + "_error").show();
                    $("#incomplete_error").show();
                    window.location = "#incomplete";
                    subsignal = 0;

                }
            }

            //if( $("#questions input[name='Question-25']:checked").length < 1 )
            //return false;

            for( i=28;i<29;i++){
                if( $("#questions input[name='Question-" + i +"']:checked").length < 1 ){
                    $("#q" + i + "_error").show();
                    $("#incomplete_error").show();
                    window.location = "#incomplete";
                    subsignal = 0;

                }
            }
            if( $("#questions input[name='Turing']").val() != "" ){
                var sCap = $("#questions input[name='Turing']").val();
                var urlf = "check_cap.php";
                $.post(urlf,{captchaf:sCap},function(dataf){

                    if (dataf == 'Fail') {
                        $("#capajax_error").show();
                        $("#incomplete_error").show();

                    }


                });

            }

            if( subsignal == 1){
                var sCap = $("#questions input[name='Turing']").val();
                var urlf = "check_cap.php";

                $.post(urlf,{captchaf:sCap},function(dataf){

                    if (dataf == 'Fail') {
                        $("#capajax_error").show();
                        $("#incomplete_error").show();
                        window.location = "#incomplete";
                    }

                    if (dataf == 'Success') {
                        no_errors = true;
                        $("#incomplete_error").hide();
                        document.questions.action="http://www.skinterra.com/cgi-bin/spmail.pl";
                        document.questions.submit();
                    }

                });
            }


            return no_errors;

        }

        $('#submitbutton').click(function(){

            $(".required_field").hide();

            if( validate_skin_form() == false ){
                return false;
            }



        });


    });
</script>
<style>
    .question_error{
        color:#FF0000;
    }
    .required_field{
        color:#FF0000;font-weight:bold;display:none;
        font-size:12px;
    }
</style>
<style>
    #realname, #Email, #Qu17, #Qu23, #Question-24, #Question-26, #Question-29, #capxa {
        border:1px solid #999;
        padding:2px;
        font-size:12px;
        font-family:Arial,Helvetica,sans-serif;
        color:#333;
    }
    .sexy input{
        width:150px;
    }
    div.combo {
        float:left;
        position:relative;
    }


    /*text input*/
    .combo input{
        background:transparent url(/Art/trigger.gif) no-repeat 133px -1px;
    }

    /*icon*/
    .combo div.list-wrapper {
        position: absolute;
        overflow: hidden;
        /*we should set height and max-height explicitly*/
        height: 200px;
        max-height: 200px;
        /*should be always at the top*/
        z-index: 99999;
        width:148px;
        border:1px solid #999;
        border-top:none;
        top:20px;
        left:0px;


    }

    div.sexy div.icon {
        width:17px;
        height:20px;
        border: 0;
        cursor:pointer;
        top:0px;
        left: 133px;
        position:absolute;
    }

    div.sexy ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        height: 200px;
    }


    div.sexy  li {
        color:#333333;
        font-family:Arial,Helvetica,sans-serif;
        font-size:12px;
        line-height:20px;
        padding:2px;
        background-color: #FFFFFF;
        cursor: pointer;
        margin: 0;
    }

    div.sexy li.active {
        background-color: rgb(223, 232, 246);
    }
    /*"drop-up" list wrapper*/
    .combo div.list-wrapper-up {}

    /*dropdown list*/
    .combo ul {}

    /*dropdown list item*/
    .combo  li {
        height: 20px;
    }

    /*active (hovered) list item*/
    .combo li.active {}


    .combo .visible {
        display: block;
    }

    .combo .invisible {
        display: none;
    }

    /*used when emptyText config opt is set. Applied to text input*/
    .combo input.empty {}
</style>
<!--[if IE]>
<style>
    .combo div.list-wrapper {
        width:150px;
    }
    #one_pixel{
        position:relative;
        left:-1px;
    }
</style>
<![endif]-->


<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2>Skin Analysis</h2>

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
<h2>Skin Analysis</h2>
<p class="contact-sub"></p>

<form method="post" action="" id="form_contact">
<table width="566" border="0" cellspacing="0">
<tbody><tr>
<td width="566"><font face="Arial">
    <a name="incomplete"></a>
    <p id="incomplete_error" class="required_field">Skin Analysis Incomplete: Please answer all required questions as indicated below. </p>
    <b><font color="#006666" size="-1">Instructions:</font></b><font color="#333333" size="-1"> </font></font><font color="#333333" size="2" face="Arial">Please
    read and answer each question carefully. A listing of
    product recommendations and an individualized daily
    skin care routine that best addresses your specific
    skin care needs will be e-mailed to you within 24 hours.
    The information you provide is strictly confidential
    and will be used only for the purpose of skin analysis.
    PLEASE NOTE: Unless otherwise noted, all questions must
    be completed.</font>
<p class="required_field" id="skin_error">Please enter the required information.</p>
<p><font color="#333333" size="-1" face="Arial">Full Name:&nbsp;
        <input name="realname" type="text" size="20" id="realname">
        &nbsp;                          E-mail:
        <input name="Email" type="text" id="Email" size="20"> <span class="required_field" id="email_error">Invalid E-mail Address.</span>
    </font></p>
<p><font color="#333333" size="-1" face="Arial"><b>Your
            Age is:</b>&nbsp;&nbsp;&nbsp;&nbsp; </font>		<span class="required_field" id="age_error">Please enter the required information.</span></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="under 19" name="age" 1="">
        under 19&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" value="19-25" name="age">
        19-25 &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" value="26-35" name="age">
        26-35&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" value="36-45" name="age">
        36-45&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" value="46-59" name="age">
        46-59&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" value="60+" name="age">
        60+</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>Your
            Sex is:</b> &nbsp;&nbsp;&nbsp;<span class="required_field" id="sex_error">Please enter the required information.</span></font></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="F" name="sex" 1="">
        Female &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" value="M" name="sex">
        Male</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>1.
            Which of the following most closely describes your skin
            tone:</b>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q1_error">Please enter the required information.</span><br>
        <br>
        <input type="radio" value="Very Fair" name="Question-1" 1="">
        Very Fair, burns easily, never tans, freckles (typically
        red hair)</font></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Light" name="Question-1">
        Light, burns first, then tans (typically blond hair)</font></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Light Olive" name="Question-1">
        Light Olive, sometimes burns (typically light to medium
        brown hair)</font></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Medium Olive" name="Question-1">
        Medium Olive, rarely burns (typically Asian or Hispanic)</font></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Dark Brown" name="Question-1">
        Dark Brown, never burns (typically African-American)</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>2.
            Which of the following best describes your skin type:</b></font>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q2_error">Please enter the required information.</span></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Very Oily" name="Question-2" 1="">
        Very Oily Skin, large pores</font></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Oily" name="Question-2">
        Oily Skin</font></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Combination" name="Question-2">
        Combination Skin, oily in the T-zone, dry/normal cheeks</font></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Normal" name="Question-2">
        Normal Skin</font></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Dry" name="Question-2">
        Dry Skin, small pores</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>3.
            Does your skin break out?</b></font>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q3_error">Please enter the required information.</span></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Almost Always" name="Question-3" 1="">
        Almost Always &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Frequently" name="Question-3">
        Frequently &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Rarely" name="Question-3">
        Rarely &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Never" name="Question-3">
        Never</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>4.
            How would you describe your skin?</b></font>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q4_error">Please enter the required information.</span></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Sensitive" name="Question-4" 1="">
        Sensitive &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Resilient" name="Question-4">
        Resilient &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Not Sure" name="Question-4">
        Not Sure</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>5.
            Do you have small, red, broken blood vessels on your
            face?</b><i> </i></font>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q5_error">Please enter the required information.</span></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Yes" name="Question-5" 1="">
        Yes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="No" name="Question-5">
        No <br>
        <br>
        <b>6. Do you spend a lot of time outdoors?</b><i> </i>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q6_error">Please enter the required information.</span></font></p><p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Yes" name="Question-6" 1="">
        Yes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="No" name="Question-6">
        No</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>7.
            Do you wear sunscreen?</b>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q7_error">Please enter the required information.</span></font></p><p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Always" name="Question-7" 1="">
        Always &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Sometimes" name="Question-7">
        Sometimes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Never" name="Question-7">
        Never</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>8.
            Do you go to tanning booths?</b></font>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q8_error">Please enter the required information.</span></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Frequently" name="Question-8">
        Frequently &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Sometimes" name="Question-8">
        Sometimes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Never" name="Question-8">
        Never</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>9.
            Do you have any "age spots" or sun damage
            on your face?</b></font>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q9_error">Please enter the required information.</span></p>
<p><font color="#333333" size="-1" face="Arial"><b>
            <input type="radio" value="Yes" name="Question-9" 1="">
        </b>Yes&nbsp;&nbsp;&nbsp;<b>
            <input type="radio" value="No" name="Question-9">
        </b>No</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>10.
            Do you smoke?</b><i> </i>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q10_error">Please enter the required information.</span></font></p><p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Yes" name="Question-10" 1="">
        Yes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="No" name="Question-10">
        No</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>11.
            Are you currently using Retin-A or Renova? </b>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q11_error">Please enter the required information.</span></font></p><p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Yes" name="Question-11" 1="">
        Yes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="No" name="Question-11">
        No</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>12.
            If so, how long have you been using it?&nbsp;&nbsp;&nbsp;<span class="required_field" id="q12_error">Please enter the required information.</span><br>
            <br>
            <input type="radio" value="under 3 mos." name="Question-12">
        </b>under 3 months&nbsp;&nbsp;&nbsp;<b><i>
                <input type="radio" value="3 mos-1 yr" name="Question-12">
            </i></b>3 months-1 year&nbsp;&nbsp;&nbsp;<b><i>
                <input type="radio" value="1-3 yrs" name="Question-12">
            </i></b>1-3 years &nbsp;&nbsp;&nbsp;<b><i>
                <input type="radio" value="over 3 yrs" name="Question-12">
            </i></b>over 3 years</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>13.
            Do you experience any irritation, dryness or flakiness
            from Retin-A? </b></font>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q13_error">Please enter the required information.</span></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Yes" name="Question-13" 1="">
        Yes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="No" name="Question-13">
        No</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>14.
            Are you currently using the drug Accutane?</b> &nbsp;&nbsp;&nbsp;<span class="required_field" id="q14_error">Please enter the required information.</span></font></p><p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Yes" name="Question-14" 1="">
        Yes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="No" name="Question-14">
        No</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>15.
            Have you undergone laser skin resurfacing in the last
            3 months?</b></font>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q15_error">Please enter the required information.</span></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Yes" name="Question-15" 1="">
        Yes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="No" name="Question-15">
        No</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>16.
            Do you have allergies to any of the following?&nbsp;&nbsp;&nbsp;<span class="required_field" id="q16_error">Please enter the required information.</span><br>
            <br>
        </b>
        <input type="radio" value="AHA" name="Question-16" 1="">
        Alpha-hydroxy acids
        <input type="radio" value="Hydroquinone" name="Question-16">
        Hydroquinone
        <input type="radio" value="Preservatives" name="Question-16">
        Preservatives
        <input type="radio" value="Fragrances" name="Question-16">
        Fragrances</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>17.
            List any other known allergies: (optional)</b></font></p>
<p><font color="#333333" size="-1" face="Arial"><b><i>
                <input name="Question-17" type="text" size="48" maxlength="200" id="Qu17">
            </i></b></font></p>
<p><font color="#333333" size="-1" face="Arial"><b>18.
            Are you pregnant?</b>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q18_error">Please enter the required information.</span></font></p><p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Yes" name="Question-18" 1="">
        Yes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="No" name="Question-18">
        No &nbsp;&nbsp;&nbsp;
        <input type="radio" value="N/A" name="Question-18">
        N/A&nbsp;&nbsp;&nbsp;</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>19.
            Are you trying to become pregnant?<i> </i></b>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q19_error">Please enter the required information.</span></font></p><p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Yes" name="Question-19" 1="">
        Yes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="No" name="Question-19">
        No &nbsp;&nbsp;&nbsp;
        <input type="radio" value="N/A" name="Question-19">
        N/A&nbsp;&nbsp;</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>20.
            Are you taking oral contraceptives? </b>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q20_error">Please enter the required information.</span></font></p><p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Yes" name="Question-20" 1="">
        Yes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="No" name="Question-20">
        No &nbsp;&nbsp;&nbsp;
        <input type="radio" value="N/A" name="Question-20">
        N/A&nbsp;&nbsp;</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>21.
            Do you have a regular skin care routine now?</b>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q21_error">Please enter the required information.</span></font></p><p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Yes" name="Question-21" 1="">
        Yes &nbsp;&nbsp;&nbsp;
        <input type="radio" value="No" name="Question-21">
        No</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>22.
            What type of a cleanser are you using?</b></font>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q22_error">Please enter the required information.</span></p>
<p><font color="#333333" size="-1" face="Arial">
        <input type="radio" value="Soap" name="Question-22" 1="">
        soap &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Gel" name="Question-22">
        gel &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Lotion" name="Question-22">
        lotion &nbsp;&nbsp;&nbsp;
        <input type="radio" value="Cream" name="Question-22">
        cream</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>23.
            What line(s) of skin care products are you currently
            using? (optional)</b></font></p>
<p><font color="#333333" size="-1" face="Arial"><b><i>
                <input name="Question-23" type="text" size="56" maxlength="200" id="Qu23">
            </i></b></font></p>
<p><font color="#333333" size="-1" face="Arial"><b>24.
            Is there a specific product line(s) that you are interested
            in? (optional)</b></font></p>
<p><font color="#333333" size="-1" face="Arial"><b><i>
                <input name="Question-24" type="text" id="Question-24" size="56" maxlength="200">
            </i></b></font></p>
<p><font color="#333333" size="-1" face="Arial"><b>25.
            What kind(s) of results are you looking for? (Check
            all that apply)<br>
        </b></font></p>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tbody><tr>
        <td><font color="#333333" size="-1" face="Arial"><b><font color="#FFFFFF">
                        <input name="Question-25" type="checkbox" id="Question-25" value="Diminish fine lines and wrinkles">
                    </font></b>Diminish fine lines and wrinkles</font></td>
    </tr>
    <tr>
        <td><font color="#333333" size="-1" face="Arial"><b><font color="#FFFFFF">
                        <input name="Question-25" type="checkbox" id="Question-25" value="Improve texture of the skin">
                    </font></b>Improve texture of the skin</font></td>
    </tr>
    <tr>
        <td><font color="#333333" size="-1" face="Arial"><b><font color="#FFFFFF">
                        <input name="Question-25" type="checkbox" id="Question-25" value="Even out skin tone">
                    </font></b>Even out skin tone</font></td>
    </tr>
    <tr>
        <td><font color="#333333" size="-1" face="Arial"><b><font color="#FFFFFF">
                        <input name="Question-25" type="checkbox" id="Question-25" value="Hydrate the skin">
                    </font></b>Hydrate the skin</font></td>
    </tr>
    <tr>
        <td><font color="#333333" size="-1" face="Arial"><b><font color="#FFFFFF">
                        <input name="Question-25" type="checkbox" id="Question-25" value="Clear up acne breakouts">
                    </font></b>Clear up acne breakouts</font></td>
    </tr>
    <tr>
        <td><font color="#333333" size="-1" face="Arial"><b><font color="#FFFFFF">
                        <input name="Question-25" type="checkbox" id="Question-25" value="Decrease oiliness">
                    </font></b>Decrease oiliness</font></td>
    </tr>
    <tr>
        <td><font color="#333333" size="-1" face="Arial"><b><font color="#FFFFFF">
                        <input name="Question-25" type="checkbox" id="Question-25" value="Lessen number of blackheads">
                    </font></b>Lessen number of blackheads</font></td>
    </tr>
    <tr>
        <td><font color="#333333" size="-1" face="Arial"><b><font color="#FFFFFF">
                        <input name="Question-25" type="checkbox" id="Question-25" value="Lighten &quot;age&quot; spots">
                    </font></b>Lighten "age" spots</font></td>
    </tr>
    <tr>
        <td><font color="#333333" size="-1" face="Arial"><b><font color="#FFFFFF">
                        <input name="Question-25" type="checkbox" id="Question-25" value="Minimize size of pores">
                    </font></b>Minimize size of pores</font></td>
    </tr>
    </tbody></table>
<p>
</p><p><font color="#333333" size="-1" face="Arial"><b>26.
            Please list any additional concerns you would like for
            us to address:</b></font></p>
<p><font color="#333333" size="-1" face="Arial">
        <textarea name="Question-26" cols="54" rows="3" wrap="PHYSICAL" id="Question-26"></textarea>
    </font></p>
<p><font color="#333333" size="-1" face="Arial"><b>27.
            Please indicate the amount you would like to spend:
            (optional)</b></font></p>
<p><font size="-1" face="Arial" color="#333333">
        <input type="radio" value="under 40" name="Question-27" 1="">
        under #2000 &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" value="40 - 80" name="Question-27">
        #40,000 - #80,000 &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" value="80 - 120" name="Question-27">
        #80,000 - #120,000 &nbsp;&nbsp;&nbsp;&nbsp;
        </font></p>
<p><font color="#333333" size="-1" face="Arial"><b>28.
            Would you like to receive updates on special offers
            and promotions?</b></font>&nbsp;&nbsp;&nbsp;<span class="required_field" id="q28_error">Please enter the required information.</span></p>
<p><font color="#333333" size="-1" face="Arial"><b>
            <input type="radio" value="Yes" name="Question-28" 1="">
        </b> Yes &nbsp;<b>&nbsp;&nbsp;
            <input type="radio" value="No" name="Question-28">
        </b> No</font></p>
<p><font color="#333333" size="-1" face="Arial"><b>29.
            How did you find out about our website? (optional)</b> </font></p>
<p><font color="#333333" size="-1" face="Arial">
        <input name="Question-29" type="text" id="Question-29">
    </font></p><table width="100%" border="0" cellspacing="0" cellpadding="6">
    <tbody>

    <tr>
        <td width="133" valign="bottom"><font color="#333333" size="-1" face="Arial"><strong> Image Verification: </strong></font></td>
        <td width="407" valign="bottom">
            <img src="captcha1.php" alt="Click for new image" title="Click for new image" style="cursor:pointer;width:100px;height:38px;" onclick="this.src='captcha1.php?'+Math.random()"><br/>
            <input type="text" id="Captcha1Edit" name="captcha_code" value="" autocomplete="off" maxlength="100" size="19" style="width:150px;" id="capxa">

    </tr>


  <!--  <tr>
        <td valign="middle">&nbsp;</td>
        <td> <input type="text" name="Turing" value="" maxlength="100" size="19" style="width:150px;" id="capxa">
            <span class="required_field" id="captcha_error">Please enter the required information.</span><span class="required_field" id="capajax_error">Incorrect Entry</span>
            <br>
            <font face="Arial, Helvetica, sans-serif" size="2" color="#333333">Enter the characters you see above.</font></td>
    </tr>-->
    <tr>
        <td valign="middle" colspan="2"><font color="#333333" size="-1" face="Arial"><b>By
                    submitting this form, I acknowledge that I have read
                    and understand the following: This skin analysis questionnaire
                    cannot substitute for the completeness of an in-person
                    consultation with a trained skin care specialist. </b></font></td>

    </tr>
    <tr>
        <td valign="middle">&nbsp;</td>
        <td><a type="submit" href="javascript:$('.required_field').hide();document.questions.reset()"></a>&nbsp;
            <input type="submit" name="submit" value="Submit">
        </td>
    </tr>
    </tbody></table>


</td>
</tr>
</tbody></table>





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
        Monday – Sunday, 9am – 6pm<br><br>


        <h4>Treatment Hours</h4> <br>
        Monday – Sunday, 9am – 6pm<br><br>

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