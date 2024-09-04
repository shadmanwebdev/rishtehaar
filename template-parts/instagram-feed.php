<!-- Instagram feed -->
<style>
    #insta-section {
        width: 100vw;  
        margin: 0 auto 0 auto; 
        /* background-color: #000; */
        padding: 0 0 80px 0;
    }
    .instagram-inner {
        width: 1240px;  
        margin: 0 auto; 
        display: flex;
        flex-flow: column nowrap;
        row-gap: 50px;
    }
    .insta-text {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 20px;
        text-align: center;
    }
    .insta-text h3 {
        /* color: #FFFFFF; */
        color: #000;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 30px;
        letter-spacing: 4px;
    }
    .insta-text a {
        font-weight: 500;
        /* color: #FFFFFF; */
        color: #000;
        font-size: 16px;
        letter-spacing: 2px;
    }
    /* Insta feed */
    #instafeed-container {
        width: 100%;
        display: flex;
        flex-flow: row wrap;
        row-gap: 10px;
        column-gap: 10px;
    }
    #instafeed-container a {
        display: none !important;
    }
    #instafeed-container a:nth-child(1),
    #instafeed-container a:nth-child(2),
    #instafeed-container a:nth-child(3),
    #instafeed-container a:nth-child(4),
    #instafeed-container a:nth-child(5),
    #instafeed-container a:nth-child(6),
    #instafeed-container a:nth-child(7),
    #instafeed-container a:nth-child(8) {
        display: flex !important;
        width: 300px;
        height: auto;
    }
    @media screen and (max-width: 1280px) {
        .instagram-inner {
            width: 900px;  
            row-gap: 50px;
        }
        .insta-text {
            row-gap: 20px;
        }
        .insta-text h3 {
            font-size: 30px;
        }
        #instafeed-container {
            column-gap: 5px;
            row-gap: 5px;
        }
        #instafeed-container a:nth-child(1), 
        #instafeed-container a:nth-child(2), 
        #instafeed-container a:nth-child(3), 
        #instafeed-container a:nth-child(4), 
        #instafeed-container a:nth-child(5), 
        #instafeed-container a:nth-child(6), 
        #instafeed-container a:nth-child(7), 
        #instafeed-container a:nth-child(8) {
            width: 220px;
        }
    }
    @media screen and (max-width: 800px) {
        .instagram-inner {
            width: 600px;  
            row-gap: 50px;
        }
        .insta-text {
            row-gap: 20px;
        }
        .insta-text h3 {
            font-size: 30px;
            letter-spacing: 4px;
        }
        #instafeed-container a:nth-child(1), 
        #instafeed-container a:nth-child(2), 
        #instafeed-container a:nth-child(3), 
        #instafeed-container a:nth-child(4), 
        #instafeed-container a:nth-child(5), 
        #instafeed-container a:nth-child(6), 
        #instafeed-container a:nth-child(7), 
        #instafeed-container a:nth-child(8) {
            width: 195px;
        }
    }
    @media screen and (max-width: 414px) {
        .instagram-inner {
            width: 350px;  
            row-gap: 30px;
        }
        .insta-text {
            row-gap: 10px;
        }
        .insta-text h3 {
            font-size: 23px;
        }
        #instafeed-container a:nth-child(1), 
        #instafeed-container a:nth-child(2), 
        #instafeed-container a:nth-child(3), 
        #instafeed-container a:nth-child(4), 
        #instafeed-container a:nth-child(5), 
        #instafeed-container a:nth-child(6), 
        #instafeed-container a:nth-child(7), 
        #instafeed-container a:nth-child(8) {
            width: 170px;
        }
    }
</style>
<!-- primofan2 accessToken: 'IGQVJXZAnpmZAFdOaWJhM1V3M2RIRUhIbGQ2azVLQktCYVF1cjNuYlYzVFg4SGtkc0hjenFNT3NCN3lLNjNWajEzWmloZAWVydFlSQjhSc2hTdDZApVDVyTzhlcVVCdDRqLWNiNkZAiU0JCZA0wzMXBEYnZAtZAQZDZD' -->
<div class='section' id='insta-section'>
    <div class='instagram-inner'>
        <div class='insta-text'>
            <h3>TAG US ON INSTAGRAM</h3>
            <a target='_blank' href="https://www.instagram.com/freehealthsamplesus/">@freehealthsamplesus</a>
        </div>
        <div id="instafeed-container"></div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>
<script type="text/javascript">
    var userFeed = new Instafeed({
        get: 'freehealthsamplesus',
        target: "instafeed-container",
        resolution: 'low_resolution',
        accessToken: 'IGQVJXQUs2eDcxaGNJaUN4SG9QUGttUk0tc3lsbE1NdW41azRGNGsyZAlpRUjhVemVHT0xfZAkN0Yi16bXlXVXRDSE5nUkN3b3BNc01wV01UeEpIaS1Yb2FpR05VajdsbTBSQkczdkdEUTV4ZAGdDVmtxcgZDZD'
        // accessToken: 'IGQVJXZAnpmZAFdOaWJhM1V3M2RIRUhIbGQ2azVLQktCYVF1cjNuYlYzVFg4SGtkc0hjenFNT3NCN3lLNjNWajEzWmloZAWVydFlSQjhSc2hTdDZApVDVyTzhlcVVCdDRqLWNiNkZAiU0JCZA0wzMXBEYnZAtZAQZDZD'
    });
    userFeed.run();
</script>