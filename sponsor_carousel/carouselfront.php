
<style>
.sponsors li img {
 max-width: <?php echo file_get_contents('data/other/carousel__sponsor/widthlogo.txt');?>px;
 margin:0 auto;
 display:block;
}

.sponsors {
    animation: sponsorsslider <?php echo file_get_contents('data/other/carousel__sponsor/time.txt');?>s infinite linear;

}

</style>

<?php 

function listCarousel(){
    foreach(new DirectoryIterator('data/uploads/gallery_carousel/') as $file)
    if(!$file->isDot())
      echo "<li><img src='data/uploads/gallery_carousel/".$file->getFilename() ."'></li>";
    };


function showCarousel(){


    echo"<div class='sponsors-fog-left'></div><ul class='sponsors'>";
echo listCarousel();
    echo "</ul><div class='sponsors-fog-right'></div>";
}

    ;?>


<script>

if(document.querySelector('.sponsors-container')!==null){
document.querySelectorAll('.sponsors-container').forEach((container)=>{container.innerHTML = "<?php showCarousel();?>"});

document.querySelectorAll('.sponsors li img').forEach((e)=>{
let ImgSrc = e.getAttribute('src');
e.setAttribute('src', "<?php get_site_url();?>"+ ImgSrc );
});
};
</script>