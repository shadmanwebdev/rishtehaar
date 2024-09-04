<?php
    if(isset($_SESSION['user'])) {
        $userdata = json_decode($_SESSION['user'], true);
    }
    
    include './Classes/Banner.php';                        
    
    
    
    $banner = new Banner();
    $banner_array = $banner->get_banners();   

    $banner_1 = $banner_array['1'];
    $banner_2 = $banner_array['2'];
    $banner_3 = $banner_array['3'];
    $banner_4 = $banner_array['4'];

    $slider_text = "<div class='subtitle'>Join Today</div>
    <h1>Find Your Partner</h1>
    <div class='subtitle'>View & Post Marriage Proposals</div>
    <div class='slider-text-content'>Contact families with educated backgrounds & respectful professions from all over Pakistan and abroad</div>";




    echo "<div class='slider-outer-wrapper' id='slider-outer-wrapper'>
    <div class='slider-wrapper'>

        <div class='slide hide-slide' id='slide-1'>
            <img src='./img/$banner_1'>
            <div class='text'>
                <div>
                    $slider_text
                </div>
            </div>
        </div>
        


        <div class='slide hide-slide' id='slide-2'>
            <img src='./img/$banner_2'>
            <div class='text'>
                <div>
                    $slider_text
                </div>
            </div>
        </div>

        <div class='slide hide-slide' id='slide-3'>
            <img src='./img/$banner_3'>
            <div class='text'>
                <div>
                    $slider_text
                </div>
            </div>
        </div>
        
        <div class='slide hide-slide' id='slide-4'>
            <img src='./img/$banner_4'>
            <div class='text'>
                <div>
                    $slider_text
                </div>
            </div>
        </div>
        



        
    </div>
    <div class='slider-dots'>

            <span class='dot' id='dot-1' onclick='showSlide(this.id);'></span>
            <span class='dot' id='dot-2' onclick='showSlide(this.id);'></span>
            <span class='dot' id='dot-3' onclick='showSlide(this.id);'></span>
            <span class='dot' id='dot-4' onclick='showSlide(this.id);'></span>
        
    </div>
</div>";
?>



