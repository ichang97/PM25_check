<! DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#FFA200">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <meta property="og:url"                content="https://dekcom-chamnong.com/pm/" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="ตรวจสอบคุณภาพอากาศ (AQI) :: pm 2.5" />
    <meta property="og:description"        content="จัดทำโดยฝ่ายเทคโนโลยีสารสนเทศ โรงเรียนจำนงค์วิทยา" />
    <meta property="og:image"         content="https://scout.dekcom-chamnong.com/fb.jpg" />

    <link rel="stylesheet" type="text/css" href="maintheme.css">
    <title>ตรวจสอบคุณภาพอากาศ :: PM 2.5</title>

    <style>
      .tcenter{text-align: center;}

      .txt_head{
        font-size: 50px;
      }

      .show_result{
        padding: 20px;
        font-size: 80px;
        border: 10px solid #fff; border-radius: 10px;
        box-shadow: 10px 5px 30px #000;
      }

      .msg{
        padding: 10px;
        font-size: 30px; text-align: center;
        border: 3px dashed #fff; border-radius: 10px;
        background-color: #BFE6FF;
      }

      @media only screen and (max-width: 600px) {
        .show_result{font-size: 30px;} .txt_head{font-size: 20px;} .msg{font-size: 20px;}
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
  .show_result{font-size: 40px;} .txt_head{font-size: 30px;} .msg{font-size: 20px;}
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  .show_result{font-size: 50px;} .txt_head{font-size: 40px;} .msg{font-size: 20px;}
} 

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
  .show_result{font-size: 60px;} .txt_head{font-size: 50px;} .msg{font-size: 20px;}
} 

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
  .show_result{font-size: 60px;} .txt_head{font-size: 50px;} .msg{font-size: 20px;}
}

    </style>
  </head>
  <body>
   <div class="container">
      <div style="text-align: center;" class="txt_head">ตรวจสอบคุณภาพอากาศ :: PM 2.5</div><br>

      <div id="result" class="show_result tcenter"></div>
      <div id="msg_result" class="msg"></div>

      <h4 id="result_time" class="tcenter"></h4>
      <h4 class="tcenter">จัดทำโดย :: ฝ่ายเทคโนโลยีสารสนเทศ โรงเรียนจำนงค์วิทยา</h4>

      <div id="fb-root"></div>
        <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=789504348196219";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
      <center><div class="fb-share-button tcenter" 
        data-href="https://dekcom-chamnong.com/pm/" 
        data-layout="button_count"
        data-size="large">
      </div></center>

   </div>
    
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="moment.min.js"></script>
  <script src="moment-with-locales.js"></script>

  <script>
    
            $(document).ready(function() {
              $("#result").attr("style");
    setInterval(get_pm, 500);
});

  var url = "https://api.waqi.info/feed/@1861/?token=6a8e46930acf4cdc490d6ce18c397c07ade19068"; //ระบุ URL + token จาก waqi
  var msg; var detail_msg;
  
function get_pm() {
           $.ajax({
 url: "get_data.php",
 type: "post",
 data: {d_url: url},
 success: function (data) {
  var obj = jQuery.parseJSON(data);
  var pmno = obj.aqi_data; var time_update = obj.time_data;
 
 if(pmno <= 50){$("#result").attr('style',  'background-color:#009966');
  msg = "คุณภาพดี"; detail_msg = "ไม่มีผลกระทบต่อสุขภาพ"; $("#msg_result").html(detail_msg);
 }else if(pmno >= 51 && pmno <= 100){$("#result").attr('style',  'background-color:#ffde33'); 
  msg = "คุณภาพปานกลาง"; detail_msg = "ไม่มีผลกระทบต่อสุขภาพ"; $("#msg_result").html(detail_msg);
 }else if(pmno >= 101 && pmno <= 150){$("#result").attr('style',  'background-color:#ff9933'); 
  msg = "มีผลกระทบต่อสุขภาพ"; detail_msg = "ผู้ป่วยโรคระบบทางเดินหายใจ ควรหลีกเลี่ยงการออกกำลังภายนอกอาคาร บุคคลทั่วไป โดยเฉพาะเด็กและผู้สูงอายุ ไม่ควรทำกิจกรรมภายนอกอาคารเป็นเวลานาน"; $("#msg_result").html(detail_msg);
 }else if(pmno >= 151 && pmno <= 200){$("#result").attr('style',  'background-color:#cc0033');
  msg = "มีผลกระทบต่อสุขภาพมาก"; detail_msg = "ผู้ป่วยโรคระบบทางเดินหายใจ ควรหลีกเลี่ยงกิจกรรมภายนอกอาคาร บุคคลทั่วไป โดยเฉพาะเด็กและผู้สูงอายุ ควรจำกัดการออกกำลังภายนอกอาคาร"; $("#msg_result").html(detail_msg);
 }else if(pmno >= 201 && pmno <= 300){$("#result").attr('style',  'background-color:#660099');
 }else{$("#result").attr('style',  'background-color:#7e0023'); msg = "อันตราย"; detail_msg = "บุคคลทั่วไป ควรหลีกเลี่ยงการออกกำลังภายนอกอาคาร สำหรับผู้ป่วยโรคระบบทางเดินหายใจ ควรอยู่ภายในอาคาร"; $("#msg_result").html(detail_msg);
 }

 moment.locale('th');
 $('#result').html("AQI : " + pmno + "<br>" + msg);
 $('#result_time').html("ปรับปรุงข้อมูลล่าสุดเมื่อ " + moment(time_update).format('LLL') + "<br>ที่มา : <a href='http://aqmthai.com/' target='_blank'>กรมควบคุมมลพิษ</a> :: <a href='https://aqicn.org/city/@1861'" + 
  " target='_blank'>WAQI</a>");
 
 }
 });
}
       
          </script>  
  </body>
</html>