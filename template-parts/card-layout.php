<!-- Horizontal Card Front Side -->
<div style="margin:20px 0;">
    <div>
         
        <h3 class="card-layout-heading"
            style="margin-bottom:10px;font-size:18px;color:#FEBC18; font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">
            Front Side
        </h3>
        <!-- Outer Wrapper (includes bleed area, invisible) -->
        <div  id="card-layout" style="
            position:relative;
            width:455px;   /* 425 + 15 + 15 (1/8 inch bleed each side) */
            height:300px;  /* 270 + 15 + 15 */
            background:#fff; /* ✅ White bleed area */
            /* border:2px dotted #000;   */
            display:flex;
            align-items:center;
            justify-content:center;
            overflow:hidden;
            box-sizing:border-box;
            ">

            <!-- Actual Card Area -->
            <div style="
                display:flex;
                width:425px;
                height:270px;
                background:#000;
                border-radius:10px;
                overflow:hidden;
                position:relative;
                box-sizing:border-box;
                padding-left:25px;
                padding-right:25px; ">

                <!-- Border Overlay (SVG) -->
                <img 
                src="https://locationmanagers.org/wp-content/uploads/2025/02/only-border-02-1.png"
                alt="Border Overlay"
                style="position:absolute; top:0; left:0; width:425px; height:270px; z-index:2; pointer-events:none;" 
                />

                <!-- Left Profile -->
                <div style="flex:1; display:flex; align-items:center; justify-content:center; position:relative; z-index:1;">
                <canvas id="profileCanvas" width="160" height="160"
                        style="width:160px; height:160px; border-radius:50%; border:3px solid #FEBC18; display:block; margin-left:5px;">
                </canvas>
                </div>

                <!-- Right Side -->
                <div style="flex:1; display:flex; flex-direction:column; justify-content:space-between; height:100%; padding:0px; color:#FEBC18; position:relative; z-index:1;">
                
                <!-- Logo -->
                <div style="text-align:center; height:50%; display:flex; width:100%; justify-content:flex-start; align-items:flex-end; padding-right:20px; align-self:flex-start; margin-bottom:5px;">
                    <div class="logo-area-back" style="position:absolute; top:0px; z-index:1;">
                    <img 
                        src="https://locationmanagers.org/wp-content/uploads/2025/02/LMGI-Logo-Update-Gold-LEFT-scaled-1.png"
                        alt="Logo"
                        style="
                        width:100%;
                        height:auto;
                        display:block;
                        margin:20px auto;
                        background:#000;
                        box-sizing:border-box;
                        object-fit:contain;
                        padding-top:10%;
                        "
                    />
                    </div>
                </div>

                <!-- Name -->
                <div id="card-layout-horizontal"
                    style="flex:1; height:40%; display:flex; align-items:center; color:#FEBC18; padding-left:8px;">
                </div>

                <!-- Job Title -->
                <div id="card-layout-job-horizontal"
                    style="flex:1; height:40%; display:flex; align-items:center; color:#FEBC18; padding-left:8px;">
                </div>
                </div>
            </div>
        </div>

        <button id="approveBtn" type="button"
                style="margin-top:15px; padding:8px 20px; background:black; border:2px solid #FEBC18; color:#FEBC18; cursor:pointer; font-weight:bold; border-radius:5px; transition:all 0.3s ease;">
                Click to Approve Front
        </button>
        <p class="info-text" style="color:black;font-size:14px; font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">Please allow a few moments for your upload to process and the confirmation pop-up to appear for each side</p>

    </div>
</div>


<!-- Horizontal Card Back Side -->

 

<div class="card-layout-container" style="margin:20px 0;">

    <div class="card-side">

        <h3 class="card-layout-heading"
            style="margin-bottom:10px;font-size:18px;color:#FEBC18; font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">
            Back Side
        </h3>

        <!-- Outer bleed wrapper -->
        <div id="card-bleed-back"
            style="position:relative;
                    width:450px;
                    height:295px;
                    background:#fff; /* ✅ White bleed area */
                    /* border:2px dotted #000;   */
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    box-sizing:border-box;">

            <!-- Actual card area (safe zone) -->
            <div class="card-layout" id="card-layout-back"
                style="position:relative;
                        width:425px;
                        height:270px;
                        background:#000;
                        border-radius:10px;
                        overflow:hidden;
                        box-sizing:border-box;
                        display:flex;">

                <!-- Border Overlay -->
                <img
                    src="https://locationmanagers.org/wp-content/uploads/2025/02/only-border-02-1.png"
                    alt="Border Overlay"
                    style="position:absolute;
                           top:0;
                           left:0;
                           width:100%;
                           height:100%;
                           z-index:2;
                           pointer-events:none;
                           border-radius:10px;" />

                <!-- Optional Canvas -->
                <canvas id="borderCanvasBack"
                        style="position:absolute;
                               top:0;
                               left:0;
                               width:100%;
                               height:100%;
                               z-index:0;
                               pointer-events:none;">
                </canvas>

                <!-- Logo -->
                <div class="logo-area-back"
                    style="position:absolute;
                           top:0px;
                           z-index:1;
                           width:100%;
                           display:flex;
                           justify-content:center;">
                    <img
                        src="https://locationmanagers.org/wp-content/uploads/2025/02/LMGI-Logo-Update-Gold-LEFT-scaled-1-1.png"
                        alt="Logo"
                        style="width:65%;
                               height:120px;
                               margin-top:15px;" />
                </div>

                <!-- QR Codes -->
                <div class="qr-area-back"
                    style="position:absolute;
                           top:110px;
                           left:50%;
                           transform:translateX(-50%);
                           display:flex;
                           gap:50px;
                           z-index:1;">
                    <div class="qr-block"
                        style="text-align:center;
                               display:flex;
                               flex-direction:column;
                               align-items:center;">
                        <img
                            src="https://locationmanagers.org/wp-content/uploads/2025/02/member-directory-link-qr.png"
                            alt="QR Code 1"
                            style="width:50px;
                                   height:50px;
                                   display:block;
                                   object-fit:contain;" />
                        <div style="color:#fff;
                                    font-size:10px;
                                    margin-top:5px;
                                    font-family: 'RefrigeratorDeluxe', 'Oswald' !important;
                                    white-space:nowrap;">
                            LMGI Member Directory
                        </div>
                    </div>

                    <div class="qr-block imdb-qr-area"
                        style="width:auto;
                               height:auto;
                               text-align:center;
                               padding:2px;
                               text-align:-webkit-center;
                               flex-direction:column;
                               align-items:center;
                               display:none;">
                        <div style="text-align:center;
                                    color:#fff;
                                    font-size:10px;
                                    margin-top:4px;
                                    font-family: 'RefrigeratorDeluxe', 'Oswald' !important;;
                                    white-space:nowrap;">
                            IMDb Credentials
                        </div>
                    </div>
                </div>

                <!-- Paragraph -->
                <div class="paragraph-area-back"
                    style="position:absolute;
                           bottom:10px;
                           left:0;
                           width:100%;
                           z-index:1;
                           padding-left:10%;
                           padding-right:5%;">
                    <div style="color:#fff;
                                font-size:9px;
                                line-height:1.1;
                                padding-bottom:5px;
                                font-family: 'RefrigeratorDeluxe', 'Oswald' !important;;
                                text-align:justify;">
                        <strong>Disclaimer:</strong><br>
                        <p style="color:#fff;
                                  font-size:10px;
                                  line-height:1.1;
                                  font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">
                            This ID is issued exclusively to active LMGI members who have been
                            nominated, vetted, and are current with their membership dues. Active
                            membership status can be verified in the official LMGI online directory
                            via the QR code above. The LMGI does not verify, endorse, or assume
                            responsibility for any additional affiliations, logos, or credentials
                            listed by the cardholder.
                        </p>
                    </div>
                </div>

            </div> <!-- end inner card -->
        </div> <!-- end bleed wrapper -->

        <button id="approveBtnBack" type="button"
            style="margin-top:15px;
                   padding:8px 20px;
                   background:black;
                   border:2px solid #FEBC18;
                   color:#FEBC18;
                   cursor:pointer;
                   font-weight:bold;
                   border-radius:5px;
                   transition:all 0.3s ease;
                   font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">
            Click to Approve Back
        </button>
        <p class="info-text" style="color:black;font-size:14px; font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">Please allow a few moments for your upload to process and the confirmation pop-up to appear for each side</p>

    </div>
</div>



 <!-- Vertical Card Front Side -->

<div class="card-layout-container" id="cardlayoutverticalcontainer">

    <div class="card-side">

        <h3 class="card-layout-heading" 
            style="margin-bottom:10px;font-size:18px;color:#FEBC18;font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">
            Vertical Card
        </h3>

        <!-- Bleed Wrapper -->
        <div id="card-bleed-vertical-front"
            style="position:relative;
                    width:290px;
                    height:410px;
                    background:#fff; /* ✅ White bleed area */
                    /* border:2px dotted #000;  */
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    box-sizing:border-box;">

            <!-- Actual Card Area -->
            <div class="card-layout-vertical" id="card-layout-vertical" 
                style="position:relative;
                        width:270px;       /* actual card area */
                        height:390px;
                        background:#000;
                        border-radius:10px;
                        overflow:hidden;
                        box-sizing:border-box;
                        display:flex;">

            <!-- Border Overlay Image -->
            <img 
                src="https://locationmanagers.org/wp-content/uploads/2025/02/4-transBG-1.png"
                alt="Vertical Border Overlay"
                style="position:absolute;
                    top:0;
                    left:0;
                    width:100%;
                    height:100%;
                    z-index:999;
                    pointer-events:none;" />

            <!-- Border Canvas -->
            <canvas id="borderCanvasVertical" 
                    style="position:absolute; top:0; left:0; width:100%; height:100%; z-index:0;">
            </canvas>

            <!-- Logo -->
            <div class="logo-area-back" 
                style="position:absolute; top:0px; z-index:3; width:100%;">
                <img 
                src="https://locationmanagers.org/wp-content/uploads/2025/02/LMGI-Logo-Update-Gold-LEFT-scaled-2.png"
                alt="Logo"
                style="width:220px;
                        height:135px;
                        display:block;
                        margin:0 auto;
                        padding:5px;
                        background:#000;
                        box-sizing:border-box;
                        object-fit:contain;
                        padding-top:5%;
                        padding-bottom:5%;
                        padding-left:10%;" />
            </div>

            <!-- Profile Photo -->
            <div class="profile-area-vertical" 
                style="position:absolute; top:110px; left:50%; transform:translateX(-43%); z-index:3;">
                <canvas id="profileCanvasVertical" width="170" height="170"
                        style="display:block; border-radius:50%; border:3px solid #FEBC18;">
                </canvas>
            </div>

            <!-- Name Area -->
            <div class="card-layout-vertical" id="card-layout-vertical1" 
                style="position:absolute; top:220px; z-index:3; text-align:center;">
                <!-- text overlay will append here -->
            </div>

            <!-- Job Title Area -->
            <div class="job-area-vertical" id="job-area-vertical" 
                style="position:absolute; top:280px; z-index:3; text-align:center;">
            </div>

            </div> <!-- end actual card -->

        </div> <!-- end bleed wrapper -->

        <!-- Approve Button -->
        <button id="approveBtnVertical" type="button"
                style="margin-top:15px;
                        padding:8px 20px;
                        background:black;
                        border:2px solid #FEBC18;
                        color:#FEBC18;
                        cursor:pointer;
                        font-weight:bold;
                        border-radius:5px;
                        transition:all 0.3s ease;
                        font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">
            Click to Approve Vertical Front
        </button>
        <p class="info-text" style="color:black;font-size:14px; font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">Please allow a few moments for your upload to process and the confirmation pop-up to appear for each side</p>
    </div>
</div>




<!-- Vertical Card Back Side -->

<div class="card-layout-container">
    <div class="card-side">
        <h3 class="card-layout-heading" 
            style="margin-bottom:10px;font-size:18px;color:#FEBC18;font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">
            Vertical Back Card
        </h3>

        <!-- Bleed Wrapper -->
        <div id="card-bleed-vertical-back"
            style="position:relative;
                    width:290px;
                    height:410px;
                    background:#fff; /* ✅ White bleed area */
                    /* border:2px dotted #000;   */
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    box-sizing:border-box;">

            <!-- Actual Card Area -->
            <div class="card-layout-vertical" id="card-layout-verticle-back"
                style="position:relative;
                        width:270px; /* actual card size inside bleed */
                        height:390px;
                        background:#000;
                        border-radius:10px;
                        overflow:hidden;
                        box-sizing:border-box;
                        display:flex;">

                <!-- Border Overlay -->
                <img
                    src="https://locationmanagers.org/wp-content/uploads/2025/02/4-transBG-3.png"
                    alt="Border Overlay"
                    style="position:absolute;
                            top:0;
                            left:0;
                            width:100%;
                            height:100%;
                            z-index:999;
                            pointer-events:none;" />
<!-- https://locationmanagers.org/wp-content/uploads/2025/02/URL-QR-Code-5b4c12.svg
https://locationmanagers.org/wp-content/uploads/2025/02/LMGI-Logo-Update-Gold-LEFT-scaled-4.png -->
                <!-- Logo -->
                <div class="logo-area-back"
                    style="position:absolute;top:0;z-index:3;width:100%;text-align:center;">
                    <img
                        src="https://locationmanagers.org/wp-content/uploads/2025/02/LMGI-Logo-Update-Gold-LEFT-scaled-4.png"
                        alt="Logo"
                        style="width:220px;
                                height:135px;
                                display:block;
                                margin:0 auto;
                                padding:5px;
                                background:#000;
                                box-sizing:border-box;
                                object-fit:contain;
                                padding-top:5%;
                                padding-bottom:5%;
                                padding-left:10%;" />
                </div>

                <!-- QR Codes -->
                <div class="qr-wrapper"
                    style="position:absolute;
                            bottom:55%;
                            left:0;
                            width:100%;
                            display:flex;
                            justify-content:center;
                            gap:20px;
                            z-index:3;
                            padding-left:6%;">
                    <div class="demo-qr-area9"
                        style="width:auto;height:50px;text-align:center;padding:2px;display: flex;flex-direction: column; align-content: center;align-items: center;">
                        <img src="https://locationmanagers.org/wp-content/uploads/2025/02/member-directory-link-qr.png"
                            alt="QR Code 1"
                            style="width:50px;height:50px;display:block;object-fit:contain;" />
                        <div style="text-align:center;color:#fff;font-size:8px;margin-top:4px;
                                    font-family: 'RefrigeratorDeluxe', 'Oswald' !important;white-space:nowrap;">
                            LMGI Member Directory
                        </div>
                    </div>
                    <div class="imdb-qr-area-horizontal"
                        style="width:60px;height:60px;text-align:center;display:flex;
                                flex-direction:column;align-content:stretch;justify-content:unset;
                                align-items:center;display:none;">
                        <div style="text-align:center;color:#fff;font-size:8px;margin-top:2px;
                                    font-family: 'RefrigeratorDeluxe', 'Oswald' !important;white-space:nowrap;">
                            IMDb Credentials
                        </div>
                    </div>
                </div>

                <!-- Affiliations -->
                <div class="affiliations-wrapper"
                    style="position:absolute;bottom:25%;left:18%;width:100%;text-align:left;
                            padding-left:5%;z-index:3;color:#FEBC18;font-size:10px;display:none;">
                    <div style="font-weight:bold;margin-bottom:5px;color:#fff;
                                font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">
                        Affiliations:
                    </div>
                    <div class="affiliation-list"></div>
                </div>

                <!-- Paragraph -->
                <div class="paragraph-area-back"
                    style="position:absolute;bottom:10px;left:0;width:100%;z-index:1;
                            padding-left:19%;padding-right:5%;">
                    <div style="color:#fff;font-size:9px;line-height:1.1;padding-bottom:5px;
                                font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">
                        <strong>Disclaimer:</strong><br>
                        <p style="color:#fff;font-size:10px;line-height:1.1;
                                font-family: 'RefrigeratorDeluxe', 'Oswald' !important;
                                margin-bottom:0;text-align:justify;">
                            This ID is issued exclusively to active LMGI members who have been
                            nominated, vetted, and are current with their membership dues. Active
                            membership status can be verified in the official LMGI online directory
                            via the QR code above. The LMGI does not verify, endorse, or assume
                            responsibility for any additional affiliations, logos, or credentials
                            listed by the cardholder.
                        </p>
                    </div>
                </div>

            </div> <!-- end actual card -->
        </div> <!-- end bleed wrapper -->

        <!-- Approve Button -->
        <button id="approveBtnVerticleBack" type="button"
            style="margin-top:15px;
                    padding:8px 20px;
                    background:black;
                    border:2px solid #FEBC18;
                    color:#FEBC18;
                    cursor:pointer;
                    font-weight:bold;
                    border-radius:5px;
                    transition:all 0.3s ease;
                    font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">
            
            Click to Approve Vertical Back
        </button>
        <p class="info-text" style="color:black;font-size:14px; font-family: 'RefrigeratorDeluxe', 'Oswald' !important;">Please allow a few moments for your upload to process and the confirmation pop-up to appear for each side</p>
    </div>
</div>
<!-- https://locationmanagers.org/wp-content/uploads/2025/02/frame-scaled.png -->

<style>

    .editable-text {

    min-width: 30px;

    min-height: 15px;

    padding: 2px;

    background: transparent !important;

    outline: 1px dashed transparent;

    white-space: nowrap; /* prevent wrapping */

    }

    .editable-text:focus {

    outline: 1px dashed #FEBC18; /* highlight when editing */

    }



    .card-locked {

    pointer-events: none !important;

    user-select: none !important;

    }

</style>