<!-- Subscription -->
<style>
    .subscription {
        width: 100vw;
        padding-top: 80px;
        padding-bottom: 80px;
        background-color: #ececec;
    }
    .subscription .sub-inner {
        width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 20px;
    }
    .subscription .text {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 15px; 
        text-align: center;
    }
    .subscription .text .sub-title h2 {
        font-size: 25px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        line-height: 1.5;
    }
    .subscription .text .sub-text p {
        font-size: 16px;
        width: 60%;
        margin: 0 auto;
    }
    .subscription .form-inner {
        display: flex;
        flex-flow: row nowrap;
        column-gap: 2%; 
    }
    .subscription #email {
        width: 80%;
    }
    .subscription input[type='submit'] {
        width: 18%;
    }
    input {
        outline: none;
        border: 0.5px solid rgba(69, 69, 69, 0.53);
        border-radius: 12px;
        font-size: 20px;
        padding: 15px 30px;
        font-family: OpenSansReg;
        background-color: #fff;
    }
    input[type="submit"] {
        font-size: 16px;
        background-color: transparent;
        border-radius: 8px;
        padding: 10px 0px;
        letter-spacing: .7px;
        cursor: pointer;
        text-align: center;
        text-transform: uppercase;
        outline: none;
        background-color: #0D2B45;
        color: #fff;
    }
    @media screen and (max-width: 1280px) {
        .subscription .sub-inner {
            width: 900px;
        }
        .subscription .text .sub-text p {
            width: 80%;
        }
    }
    @media screen and (max-width: 800px) {
        .subscription {
            padding-top: 50px;
        }
        .subscription .sub-inner {
            width: 600px;
        }
        .subscription .text .sub-text p {
            width: 100%;
        }
    }
    @media screen and (max-width: 414px) {
        .subscription .sub-inner {
            width: 350px;
        }
        .subscription #email {
            width: 70%;
        }
        .subscription input[type='submit'] {
            width: 28%;
        }
    }
</style>

<div class='subscription'>
    <div class='sub-inner'>
        <div class='text'>
            <div class='sub-title'>
                <h2>
                    Subscribe to our Newsletter
                </h2>
            </div>
            <div class='sub-text'>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                </p>
            </div>
        </div>
        <div class='form-wrapper'>
            <form action="">
                <div class='form-inner'>
                    <input type="text" id='email' name='email' placeholder='Email'>
                    <input type="submit" id='sub-btn' name='sub-btn' value='Send'>
                </div>
                <div class='sub-error'>

                </div>
            </form>
        </div>
    </div>
</div>