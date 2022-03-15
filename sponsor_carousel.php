<?php

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");
 
# register plugin
register_plugin(
	$thisfile, //Plugin id
	'sponsor_carousel', 	//Plugin name
	'1.1', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'http://www.multicolor.stargard.pl', //author website
	'this plugin create carousel with logos from folder', //Plugin description
	'pages', //page type - on which admin tab to display
	'carousel_sponsor_back'  //main function (administration)
);
 
# activate filter 
add_action('theme-footer','carousel_sponsor_front'); 

add_action('footer','addToEditMenu'); 

 
# add a link in the admin tab 'theme'
add_action('pages-sidebar','createSideMenu',array($thisfile,'carousel sponsor settings'));

# functions


function addToEditMenu(){

    echo <<< END
     <script>


console.log('now');


    if(document.querySelector('#edit')!==null){
    const liCarousel = document.createElement('li');
    const liCarouselbtn = document.createElement('a');
    liCarouselbtn.setAttribute('href','#');
    liCarouselbtn.classList.add('liCarouselBtn');
    liCarouselbtn.innerHTML = 'add sponsor_carousel';
    liCarousel.appendChild(liCarouselbtn);
document.querySelector('#edit .snav').appendChild(liCarousel);

document.querySelector('.liCarouselBtn').addEventListener('click',()=>{
event.preventDefault();
CKEDITOR.instances['post-content'].insertHtml("<div class='sponsors-container' ><div style='position:relative; width: 100%;display:flex;align-items:center;justify-content:center;border: solid 1px #000;background: black; height:100px;color:#fff;}.cke_editable .sponsors-container{position:relative; width: 100%;display:flex;align-items:center;justify-content:center;border: solid 1px #000;background: #ddd; height:100px;'>Sponsors Carousel</div></div><br>");
});
};    
</script>";
END;

}

function carousel_sponsor_front() {
    include('sponsor_carousel/carouselfront.php');
}
 
function carousel_sponsor_back() {
    echo"<h3>How use this plugin?</h3>
    Create new folder on uploads with name <b>gallery_carousel</b> and put your logos on this.<br>
    Go to edit page and click <b>add sponsor_carousel</b> when you wanna use it
    ";

    echo '
    <form action="#" method="post">
    <br>
<p><b>Width images from your carousel px </b></p>
<input type="text" id="widthCarousel" name="widthcarousel" value="';
echo file_get_contents('../data/other/carousel__sponsor/widthlogo.txt');
echo '" style="box-sizing:border-box;width:20%;padding:5px;"> px
<br><br>
<p><b>time how fast working carousel</b></p>

<input type="text" id="time" name="time" value="';
echo file_get_contents('../data/other/carousel__sponsor/time.txt');
echo '" style="box-sizing:border-box;width:20%;padding:5px;"> s

<br><input type="submit" name="submit" style="padding:5px 25px;color:#fff;margin-top:10px;background:#000;border:none;" value="save settings">
    </form>


<p style="margin:0;margin-top:20px;">    Created by <a href="mail:skrzypczak.design@gmail.com">Multic0lor</a>
</p>
    <hr style="margin-top:10px;border:none;border-bottom:solid 1px rgba(0,0,0,0.3)">

    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display:flex; width:100%;align-items:center;justify-content:space-between;">
        <p style="margin:0;padding:0;">If you want support my work  via paypal :) Thanks!</p>
        <input type="hidden" name="cmd" value="_s-xclick" />
        <input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL" />
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
        <img alt="" border="0" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" />
        </form>';
    $timecarousel = $_POST["time"];
$widthSponsorLogo = $_POST["widthcarousel"];
$folderCarouselSettings = GSDATAOTHERPATH .'/carousel__sponsor/';
$filenamecarousel      = $folderCarouselSettings . 'widthlogo.txt';
$filetimecarousel      = $folderCarouselSettings . 'time.txt';
$chmod_mode    = 0755;
$folder_exists = file_exists($folderCarouselSettings) || mkdir($folderCarouselSettings, $chmod_mode);


if (isset($_POST['submit'])) {
if ($folder_exists) {
  file_put_contents($filenamecarousel , $widthSponsorLogo);
  file_put_contents($filetimecarousel , $timecarousel);
  echo "<meta http-equiv='refresh' content='0'>";

}
};

}


register_style('carouselstyle', $SITEURL.'/plugins/sponsor_carousel/css/carouselstyle.css', GSVERSION, 'screen');
queue_style('carouselstyle',GSFRONT); 
?>