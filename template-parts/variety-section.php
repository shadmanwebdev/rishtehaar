<style>
    .variety-section {
        padding: 80px 0;
        background-color: #fff;
    }
    .variety-section .section-head {
        text-align: center;
        margin-bottom: 50px;
    }
    .variety-section .section-body {
        width: 65%;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        column-gap: 40px;
    }
    .variety-section .section-head .title {
        font-size: 25px;
        margin-bottom: 10px;
    }
    .variety-column {
        border-radius: 12px;
        overflow: hidden;
    }
    .variety-column .column-head {
        padding: 20px;
        text-align: center;
        color: #fff;
        font-weight: bold;
    }
    .variety-column:nth-child(1) .column-head {
        background-color: rgb(27, 104, 255);
    }
    .variety-column:nth-child(2) .column-head {
        background-color: rgb(195, 139, 0);
    }
    .variety-column:nth-child(3) .column-head {
        background-color: rgb(195, 139, 0);
    }
    .variety-column:nth-child(4) .column-head {
        background-color: rgb(228, 70, 35);
    }
    .variety-column .column-body {
        padding: 20px;
    }
    .variety-column:nth-child(1) .column-body {
        background-color: rgb(198, 217, 255);
    }
    .variety-column:nth-child(2) .column-body {
        background-color: rgb(240, 226, 191);
    }
    .variety-column:nth-child(3) .column-body {
        background-color: rgb(191, 225, 207);
    }
    .variety-column:nth-child(4) .column-body {
        background-color: rgb(248, 209, 200);
    }
    .variety-column .column-body p {
        font-size: 16px;
        margin-bottom: 20px;
        text-align: center;
    }
    .variety-column .column-body .cta {
        width: 160px;
        margin: 0 auto;
        background-color: #fff;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        border: none;
        border-radius: 4px;
    }
    .variety-column:nth-child(1) .cta {
        color: rgb(27, 104, 255);
    }
    .variety-column:nth-child(2) .cta {
        color: rgb(195, 139, 0);
    }
    .variety-column:nth-child(3) .cta {
        color: rgb(195, 139, 0);
    }
    .variety-column:nth-child(4) .cta {
        color: rgb(228, 70, 35);
    }
    @media screen and (max-width: 1200px) {  
        .variety-section .section-body {
            row-gap: 40px;
            grid-template-columns: 1fr 1fr;
        }
    }
    @media screen and (max-width: 800px) {  
        .variety-section .section-body {       
            width: 55%;
            grid-template-columns: 1fr;
        }
        .variety-section .section-head .title {
            font-size: 20px;
        }
    }
    @media screen and (max-width: 576px) {  
        .variety-section .section-body {
            width: 70%;
        }
    }
</style>

<div class='variety-section'>
    <div class='section-head'>
        <div class='title'>
            <h2>Variety of Marriage Proposals</h2>
        </div>
        <div class='subtitle'>
            <p>From all Occupations and Areas of Field</p>
        </div>
    </div>
    <div class='section-body'>
        <div class='variety-column'>
            <div class='column-head'>
                Doctor Rishta
            </div>
            <div class='column-body'>
                <p>MBBS, BDS, Surgeon, Physio Therapist, Optician</p>
                <a href="./index?occupation=doctor&page=1" class='cta'>See Proposals</a>
            </div>
        </div>
        <div class='variety-column'>
            <div class='column-head'>
                Businessman Rishta
            </div>
            <div class='column-body'>
                <p>Import and export manufacturing industry</p>
                <a href="./index?occupation=business&page=1" class='cta'>See Proposals</a>
            </div>
        </div>
        <div class='variety-column'>
            <div class='column-head'>
                Army Proposals
            </div>
            <div class='column-body'>
                <p>Pak Army, Navy, Captain, Major, Pakistan Air Force jobs</p>
                <a href="./index?occupation=army&page=1" class='cta'>See Proposals</a>
            </div>
        </div>
        <div class='variety-column'>
            <div class='column-head'>
                Foreign Rishtay
            </div>
            <div class='column-body'>
                <p>Canada, USA, Dubai, Australia</p>
                <a href="./index?occupation=foreign&page=1" class='cta'>See Proposals</a>
            </div>
        </div>
    </div>
</div>