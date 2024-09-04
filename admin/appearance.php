<?php include '../partials/header.php'; ?>
 

<style>
    .banner-customization {
        margin: 20px 0;
        width: 820px;
    }
    .form-section-row {
        display: flex;
        flex-flow: row nowrap;
        column-gap: 20px;
    }
    .form-section-row .column {
        width: 400px;
        height: 200px;
        background-color: #fff;
        position: relative;
    }
    .form-section-row .column .oldImg {
        width: inherit;
        height: inherit;
        background-color: #fff;
        position: relative;
    }
    .form-section-row .column .oldImg img {
        width: inherit;
        height: inherit;
        position: absolute;
        z-index: 1; 
        object-fit: cover;
    }
    .form-section-row .column .overlay {
        width: 400px;
        height: 200px;
        position: absolute;
        z-index: 2;
        background-color: rgba(0, 0, 0, .3);
    }
    .banner-btn {
        position: absolute;
        bottom: 15%;
        left: 50%;
        margin-left: -70px;
        z-index: 3;
    }
    #pfpBtn {
        width: 140px;
        color: #000;
        background-color: rgb(255,238,222);
        padding: 10px 0;
        text-align: center;
        font-size: 14px;
        border-radius: 8px;
        
        cursor: pointer;
        margin-left: auto;
        border: 1px solid gray;
    }
    input[type="submit"]#submitBannersBtn {
        height: 45px;
        width: 100%;
        color: #fff;
        background-color: rgb(255,158,65);
        padding: 0;
        text-align: center;
        font-size: 18px;
        
        cursor: pointer;
        border: none;
        text-transform: capitalize;
    }
    #selected-img-1,
    #selected-img-2,
    #selected-img-3,
    #selected-img-4 {
        width: inherit;
        height: inherit;
        display: none;
        margin: 0 auto;
        border-radius: 20px;
        overflow: hidden;
        position: relative;
    }
    #selected-img-1 img,
    #selected-img-2 img,
    #selected-img-3 img,
    #selected-img-4 img {
        width: inherit;
        height: inherit;
        object-fit: cover;
        position: absolute;
    }
    @media screen and (max-width: 1560px) {
        .banner-customization {
            margin: 20px 0;
            width: 720px;
        }
        .form-section-row {
            column-gap: 20px;
        }
        .form-section-row .column {
            width: 350px;
            height: 175px;
            background-color: #fff;
            position: relative;
        }
        .form-section-row .column .overlay {
            width: 350px;
            height: 175px;
        }
        #pfpBtn {
            width: 120px;
            font-size: 13px;
        }
        .banner-btn {
            position: absolute;
            bottom: 12%;
            left: 50%;
            margin-left: -60px;
            z-index: 3;
        }
        input[type="submit"]#submitBannersBtn {
            height: 40px;
            width: 100%;
        }
    }
    @media screen and (max-width: 800px) {
        .banner-customization {
            margin: 20px 0;
            width: 400px;
        }
        .form-section-row {
            display: flex;
            flex-flow: column nowrap;
            row-gap: 20px;
        }
        .form-section-row .column {
            width: 400px;
            height: 200px;
            background-color: #fff;
            position: relative;
        }
    }
    @media screen and (max-width: 414px) {
        .banner-customization {
            margin: 0;
            width: 100%;
        }
        .form-section-row {
            display: flex;
            flex-flow: column nowrap;
            row-gap: 20px;
        }
        .form-section-row .column {
            width: 100%;
            height: 200px;
            background-color: #fff;
            position: relative;
        }
    }
</style>

<div id="loader"></div>

<div class="admin_page-wrapper">
    <?php include './admin-sidebar.php'; ?>
    <div class="admin-content">
        <div class='admin-page'>
            <div class='admin-page-header'>
                <div>Appearance</div>
                <div>Customize Your website</div>
            </div>
            <div class='admin-page-content'>
                <div class='admin-page-content-title'>
                    Slider Banner Pictures (Max 4)
                </div>
                <div class='banner-customization'>
                    <form runat="server" id="banner-customization_form" method='post' class='form' autocomplete='off' enctype="multipart/form-data">
                        <?php
                            include '../Classes/Banner.php';                        
                            
                            $banner = new Banner();
                            $banner_array = $banner->get_banners();   
                            
                            $banner1 = $banner_array['1'];
                            $banner2 = $banner_array['2'];
                            $banner3 = $banner_array['3'];
                            $banner4 = $banner_array['4'];
                        ?>
                        <div class='form-section-row'>
                            <div class='column'>
                                <?php if(!empty($banner1)) { ?>
                                    <div class='oldImg' id='oldImg1'>
                                        <img src="../img/<?= $banner1; ?>" alt="">
                                        <div class='overlay'></div>
                                    </div>
                                <?php } ?>
                                <div id='selected-img-1'>
                                    <img id="img-1-preview" src="#" alt="your image" />
                                </div>
                                <div class='banner-btn'>
                                    <button id='pfpBtn' onclick="return fireButton1(event);">Choose File</button>
                                    <input class="input" id="image_1" type="file" name="image_1" style="display: none;">                            
                                </div>

                            </div>
                            <div class='column'>
                                <?php if(!empty($banner2)) { ?>
                                    <div class='oldImg' id='oldImg2'>
                                        <img src="../img/<?= $banner2; ?>" alt="">
                                        <div class='overlay'></div>
                                    </div>
                                <?php } ?>
                                <div id='selected-img-2'>
                                    <img id="img-2-preview" src="#" alt="your image" />
                                </div>
                                <div class='banner-btn'>
                                    <button id='pfpBtn' onclick="return fireButton2(event);">Choose File</button>
                                    <input class="input" id="image_2" type="file" name="image_2" style="display: none;">                            
                                </div>
                            </div>
                        </div>
                        <div class='form-section-row'>
                            <div class='column'>
                                <?php if(!empty($banner3)) { ?>
                                    <div class='oldImg' id='oldImg3'>
                                        <img src="../img/<?= $banner3; ?>" alt="">
                                        <div class='overlay'></div>
                                    </div>
                                <?php } ?>
                                <div id='selected-img-3'>
                                    <img id="img-3-preview" src="#" alt="your image" />
                                </div>
                                <div class='banner-btn'>
                                    <button id='pfpBtn' onclick="return fireButton3(event);">Choose File</button>
                                    <input class="input" id="image_3" type="file" name="image_3" style="display: none;">                            
                                </div>
                            </div>
                            <div class='column'>
                                <?php if(!empty($banner4)) { ?>
                                    <div class='oldImg' id='oldImg4'>
                                        <img src="../img/<?= $banner4; ?>" alt="">
                                        <div class='overlay'></div>
                                    </div>
                                <?php } ?>
                                <div id='selected-img-4'>
                                    <img id="img-4-preview" src="#" alt="your image" />
                                </div>
                                <div class='banner-btn'>
                                    <button id='pfpBtn' onclick="return fireButton4(event);">Choose File</button>
                                    <input class="input" id="image_4" type="file" name="image_4" style="display: none;">                            
                                </div>
                            </div>
                        </div>
                        <input type='submit' name='submit_banners' id='submitBannersBtn' onclick="return submitBanners(event);" value='Update'>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function fireButton1(event) {
        event.preventDefault();
        document.getElementById('image_1').click()
    }
    function fireButton2(event) {
        event.preventDefault();
        document.getElementById('image_2').click()
    }
    function fireButton3(event) {
        event.preventDefault();
        document.getElementById('image_3').click()
    }
    function fireButton4(event) {
        event.preventDefault();
        document.getElementById('image_4').click()
    }
    // Preview Profile Photo
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-1-preview').attr('src', e.target.result);
                $('#oldImg1').css({"display":"none"});
                $('#selected-img-1').css({"display":"block"});
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-2-preview').attr('src', e.target.result);
                $('#oldImg2').css({"display":"none"});
                $('#selected-img-2').css({"display":"block"});
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-3-preview').attr('src', e.target.result);
                $('#oldImg3').css({"display":"none"});
                $('#selected-img-3').css({"display":"block"});
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-4-preview').attr('src', e.target.result);
                $('#oldImg4').css({"display":"none"});
                $('#selected-img-4').css({"display":"block"});
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image_1").change(function(){
        readURL1(this);
    });
    $("#image_2").change(function(){
        readURL2(this);
    });
    $("#image_3").change(function(){
        readURL3(this);
    });
    $("#image_4").change(function(){
        readURL4(this);
    });
</script>
<?php include './footer.php'; ?>