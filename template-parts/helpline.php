<style>   
    /* Helpline */
    #helpline {
        width: 100vw;
        padding: 15px 0;
        background-color: var(--bg-2);
        box-shadow: var(--box-shadow-1);
    }
    .helpline-row {
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: center;
        /* column-gap: 15px; */
    }
    .helpline-row > div:nth-child(1) {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;   
        font-size: 25px;
    }
    .helpline-row > div:nth-child(2) {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        font-size: 25px;
        color: var(--color5);
    }
    .helpline-title {
        color: var(--color1);
        
        margin-right: 10px;
    }
    #helpline i {
        font-size: 28px;
        color: rgb(32, 149, 86);
        margin-right: 10px;
    }
    @media screen and (max-width: 1560px) { 
        #helpline {
            width: 100vw;
            padding: 12px 0;
            background-color: var(--bg-2);
        }
        .helpline-row {
            width: 100%;
            column-gap: 12px;
        }
        .helpline-row > div:nth-child(1) {   
            font-size: 23px;
        }
        .helpline-row > div:nth-child(2) {
            font-size: 23px;
        }
    }
    @media screen and (max-width: 800px) {
        .helpline-row {
            column-gap: 10px;
        }
        .helpline-row > div:nth-child(1) {  
            column-gap: 5px;    
            font-size: 18px;
        }
        .helpline-row > div:nth-child(2) {
            font-size: 18px;
        }
    }
</style>
<div id='helpline'>
    <div class='helpline-row'>
        <div>
            <div class='helpline-icon'>
                <i class="ion-social-whatsapp-outline"></i>
            </div>
            <div class='helpline-title'>
                Helpline
            </div>
        </div>
        <div>
            +92 312 5259269
        </div>
    </div>
</div>