document.addEventListener("DOMContentLoaded", function() {



    const checkbox = document.querySelector(".imbd-logo-generation input[type='checkbox']");

    const qrBlockHorizontal = document.querySelector("#card-layout-back .qr-area-back .qr-block:nth-child(2)");

    const gfSubmitBtn = document.querySelector(".gform_wrapper .gform_button");

    // Initially keep the submit button disabled
    if (gfSubmitBtn) {
        gfSubmitBtn.setAttribute("disabled", "disabled");
        gfSubmitBtn.style.opacity = "0.5";
        gfSubmitBtn.style.pointerEvents = "none";
        // console.log("Disable");
    }

   
  

    function renderStaticQR(containerSelector, imageUrl, size = 60, padding = 6) {

        const container = document.querySelector(containerSelector);

        if (!container) return;

        // Purana canvas/image hatao

        container.querySelector("canvas")?.remove();
        container.querySelector("img")?.remove();

        // Naya <img> banao

        const img = document.createElement("img");

        img.src = imageUrl;

        img.style.width = size + "px";

        img.style.height = size + "px";

        img.style.display = "block";

        img.style.margin = "0 auto";

        img.style.padding = padding + "px";

        // img.style.background = "#fff";      // white box background like QR

        img.style.boxSizing = "border-box";

        img.style.objectFit = "contain";

    

        // Insert before label

        container.prepend(img);

    }

    

    // Example usage (replace URL if needed)

    renderStaticQR(".demo-qr-area", "https://locationmanagers.org/wp-content/uploads/2025/02/URL-QR-Code-1-28411e.svg", 50, 0);
    // renderStaticQR(".demo-qr-area", "https://locationmanagers.org/wp-content/uploads/2025/02/member-directory-9dee8a.svg", 50, 0);
 
     // Vertical back: imdb qr area

     const qrBlockVertical = document.querySelector("#card-layout-verticle-back .imdb-qr-area");

});







document.addEventListener("DOMContentLoaded", function () {



     

    // Fabric canvases

    const profileCanvas = new fabric.Canvas("profileCanvas", {

        // backgroundColor: "#000",

        selection: false

    });



    let profileImg = null;



    // Text rendering

    function renderText(firstName, lastName, jobTitle) {

        // nameCanvas.clear();



        const fullName = new fabric.Text(`${firstName} ${lastName}`, {

            left: 16,

            top: 20,

            fontSize: 20,

            fontWeight: "bold",

            fill: "#FEBC18",

            selectable: true,

            objectCaching: false  // ⬅ stop caching = sharper



        });



        const title = new fabric.Text(jobTitle, {

        left: 20,

        top: 60,

        fontSize: 12,

        fontWeight: "bold",

        fill: "#FEBC18",

        selectable: true,

        objectCaching: false  // ⬅ stop caching = sharper

        });



       

    }



    // Profile image set

    // function setProfileImage(file) {

    //     if (!file) return;

    

    //     const reader = new FileReader();

    //     reader.onload = function (e) {

    //         fabric.Image.fromURL(e.target.result, function (img) {

    //             // Calculate scale to fit canvas

    //             const canvasWidth = profileCanvas.width;

    //             const canvasHeight = profileCanvas.height;

    

    //             const scaleX = canvasWidth / img.width;

    //             const scaleY = canvasHeight / img.height;

    

    //             // Use the smaller scale to fit the whole image inside canvas

    //             const scale = Math.min(scaleX, scaleY);

    

    //             img.set({

    //                 left: canvasWidth / 2,

    //                 top: canvasHeight / 2,

    //                 originX: "center",

    //                 originY: "center",

    //                 scaleX: scale,

    //                 scaleY: scale,

    //                 hasBorders: true,

    //                 hasControls: true,

    //                 selectable: true

    //             });

    

    //             // Remove previous image if exists

    //             if (profileImg) profileCanvas.remove(profileImg);

    //             profileImg = img;

    

    //             profileCanvas.add(profileImg);

    //             profileCanvas.renderAll();

    //         });

    //     };

    //     reader.readAsDataURL(file);

    // }

    // function setProfileImage(file) {
    //     if (!file) return;
      
    //     console.log("Image Posted");
    //     const reader = new FileReader();
      
    //     reader.onload = function (e) {
    //       fabric.Image.fromURL(e.target.result, function (img) {
    //         const canvasWidth = profileCanvas.width;
    //         const canvasHeight = profileCanvas.height;
      
    //         // Maintain 1:1 aspect ratio (square)
    //         const squareSize = Math.min(canvasWidth, canvasHeight);
    //         const scaleX = squareSize / img.width;
    //         const scaleY = squareSize / img.height;
    //         const scale = Math.min(scaleX, scaleY);
      
    //         img.set({
    //           left: canvasWidth / 2,
    //           top: canvasHeight / 2,
    //           originX: "center",
    //           originY: "center",
    //           scaleX: scale,
    //           scaleY: scale,
    //           hasBorders: true,
    //           hasControls: false,
    //           selectable: true
    //         });
      
    //         // Remove previous image
    //         if (window.profileImg) profileCanvas.remove(window.profileImg);
    //         window.profileImg = img;
      
    //         profileCanvas.add(img);
    //         profileCanvas.renderAll();
      
    //         // ✅ Enable Zoom In/Out with Mouse Wheel
    //         profileCanvas.on('mouse:wheel', function (opt) {
    //           const delta = opt.e.deltaY;
    //           let zoom = profileCanvas.getZoom();
    //           zoom *= 0.999 ** delta; // smooth zoom
    //           if (zoom > 5) zoom = 5;
    //           if (zoom < 0.2) zoom = 0.2;
    //           profileCanvas.zoomToPoint({ x: opt.e.offsetX, y: opt.e.offsetY }, zoom);
    //           opt.e.preventDefault();
    //           opt.e.stopPropagation();
    //         });
      
    //         // ✅ Enable Pinch Zoom for Touch Devices
    //         let lastDistance = 0;
    //         profileCanvas.on('touch:gesture', function (opt) {
    //           if (opt.e.touches && opt.e.touches.length === 2) {
    //             const touches = opt.e.touches;
    //             const distance = Math.hypot(
    //               touches[0].clientX - touches[1].clientX,
    //               touches[0].clientY - touches[1].clientY
    //             );
      
    //             if (lastDistance) {
    //               let zoom = profileCanvas.getZoom() * (distance / lastDistance);
    //               if (zoom > 5) zoom = 5;
    //               if (zoom < 0.2) zoom = 0.2;
    //               profileCanvas.setZoom(zoom);
    //             }
      
    //             lastDistance = distance;
    //           }
    //         });
      
    //         profileCanvas.on('touch:gesture:end', () => {
    //           lastDistance = 0;
    //         });
    //       });
    //     };
      
    //     reader.readAsDataURL(file);
    // }
      


    function setProfileImagebk(file) {
        if (!file) return;
    
        const reader = new FileReader();
        reader.onload = function(e) {
            fabric.Image.fromURL(e.target.result, function(img) {
                const canvasWidth = profileCanvas.width;
                const canvasHeight = profileCanvas.height;
    
                const squareSize = Math.min(canvasWidth, canvasHeight);
                const scaleX = squareSize / img.width;
                const scaleY = squareSize / img.height;
                const scale = Math.min(scaleX, scaleY);
    
                img.set({
                    left: canvasWidth / 2,
                    top: canvasHeight / 2,
                    originX: 'center',
                    originY: 'center',
                    scaleX: scale,
                    scaleY: scale,
                    hasBorders: true,
                    hasControls: false,
                    selectable: true
                });
    
                if (window.profileImg) profileCanvas.remove(window.profileImg);
                window.profileImg = img;
    
                profileCanvas.add(img);
                profileCanvas.renderAll();
    
                // --- Desktop Zoom ---
                profileCanvas.on('mouse:wheel', function(opt) {
                    let delta = opt.e.deltaY;
                    let zoom = profileCanvas.getZoom();
                    zoom *= 0.999 ** delta;
                    zoom = Math.max(0.2, Math.min(5, zoom));
                    profileCanvas.zoomToPoint({ x: opt.e.offsetX, y: opt.e.offsetY }, zoom);
                    opt.e.preventDefault();
                    opt.e.stopPropagation();
                });
    
                // --- Mobile Pinch Zoom ---
                let lastDistance = null;
    
                const canvasEl = profileCanvas.upperCanvasEl;
    
                canvasEl.addEventListener('touchstart', function(e) {
                    if (e.touches.length === 2) {
                        lastDistance = Math.hypot(
                            e.touches[0].clientX - e.touches[1].clientX,
                            e.touches[0].clientY - e.touches[1].clientY
                        );
                    }
                });
    
                canvasEl.addEventListener('touchmove', function(e) {
                    if (e.touches.length === 2 && lastDistance) {
                        const newDistance = Math.hypot(
                            e.touches[0].clientX - e.touches[1].clientX,
                            e.touches[0].clientY - e.touches[1].clientY
                        );
    
                        let zoom = profileCanvas.getZoom() * (newDistance / lastDistance);
                        zoom = Math.max(0.2, Math.min(5, zoom));
    
                        // Midpoint for zooming
                        const midX = (e.touches[0].clientX + e.touches[1].clientX) / 2;
                        const midY = (e.touches[0].clientY + e.touches[1].clientY) / 2;
    
                        profileCanvas.zoomToPoint({ x: midX, y: midY }, zoom);
                        lastDistance = newDistance;
                        e.preventDefault(); // prevent page scroll
                    }
                }, { passive: false });
    
                canvasEl.addEventListener('touchend', function(e) {
                    if (e.touches.length < 2) lastDistance = null;
                });
            });
        };
        reader.readAsDataURL(file);
    }
    

    function setProfileImage(file) {
        if (!file) return;
    
        const reader = new FileReader();
        reader.onload = function(e) {
            fabric.Image.fromURL(e.target.result, function(img) {
                const canvasWidth = profileCanvas.width;
                const canvasHeight = profileCanvas.height;
    
                const squareSize = Math.min(canvasWidth, canvasHeight);
                const scaleX = squareSize / img.width;
                const scaleY = squareSize / img.height;
                const scale = Math.min(scaleX, scaleY);
    
                img.set({
                    left: canvasWidth / 2,
                    top: canvasHeight / 2,
                    originX: 'center',
                    originY: 'center',
                    scaleX: scale,
                    scaleY: scale,
                    hasBorders: false,
                    hasControls: false,
                    selectable: true,
                    evented: true
                });
    
                if (window.profileImg) profileCanvas.remove(window.profileImg);
                window.profileImg = img;
    
                profileCanvas.add(img);
                profileCanvas.renderAll();
    
                // disable group selection
                profileCanvas.selection = false;
    
                // enable drag
                img.on('mousedown', function() {
                    img.opacity = 0.8;
                });
                img.on('mouseup', function() {
                    img.opacity = 1;
                });
                img.on('moving', function() {
                    profileCanvas.renderAll();
                });
    
                // --- Desktop Zoom ---
                profileCanvas.on('mouse:wheel', function(opt) {
                    let delta = opt.e.deltaY;
                    let zoom = profileCanvas.getZoom();
                    zoom *= 0.999 ** delta;
                    zoom = Math.max(0.2, Math.min(5, zoom));
                    profileCanvas.zoomToPoint({ x: opt.e.offsetX, y: opt.e.offsetY }, zoom);
                    opt.e.preventDefault();
                    opt.e.stopPropagation();
                });
    
                // --- Mobile Pinch Zoom ---
                let lastDistance = null;
                const canvasEl = profileCanvas.upperCanvasEl;
    
                canvasEl.addEventListener('touchstart', function(e) {
                    if (e.touches.length === 2) {
                        lastDistance = Math.hypot(
                            e.touches[0].clientX - e.touches[1].clientX,
                            e.touches[0].clientY - e.touches[1].clientY
                        );
                    }
                });
    
                canvasEl.addEventListener('touchmove', function(e) {
                    if (e.touches.length === 2 && lastDistance) {
                        const newDistance = Math.hypot(
                            e.touches[0].clientX - e.touches[1].clientX,
                            e.touches[0].clientY - e.touches[1].clientY
                        );
    
                        let zoom = profileCanvas.getZoom() * (newDistance / lastDistance);
                        zoom = Math.max(0.2, Math.min(5, zoom));
    
                        const midX = (e.touches[0].clientX + e.touches[1].clientX) / 2;
                        const midY = (e.touches[0].clientY + e.touches[1].clientY) / 2;
    
                        profileCanvas.zoomToPoint({ x: midX, y: midY }, zoom);
                        lastDistance = newDistance;
                        e.preventDefault();
                    }
                }, { passive: false });
    
                canvasEl.addEventListener('touchend', function(e) {
                    if (e.touches.length < 2) lastDistance = null;
                });
            });
        };
        reader.readAsDataURL(file);
    }
    
    
    
    

    

    // Create Layout Button

    document.getElementById("createLayoutBtn").addEventListener("click", function () {

        const firstName = document.querySelector(".first-name input")?.value || "";
        const lastName  = document.querySelector(".last-name input")?.value || "";
        const jobTitle  = document.querySelector(".job-title input")?.value || "";

        // ==== Affiliation fields data ==== 

        const affiliation_first = document.querySelector(".affiliation-first input")?.value || "";
        const affiliation_two   = document.querySelector(".affiliation-two input")?.value || "";
        const affiliation_three = document.querySelector(".affiliation-three input")?.value || "";
        const affiliation_four  = document.querySelector(".affiliation-four input")?.value || "";
        document.querySelector(".affiliations-wrapper")?.style.setProperty("display", "none");
        const gfSubmitBtn = document.querySelector(".gform_wrapper .gform_button");

        // Initially keep the submit button disabled
        if (gfSubmitBtn) {
            gfSubmitBtn.setAttribute("disabled", "disabled");
            gfSubmitBtn.style.opacity = "0.5";
            gfSubmitBtn.style.pointerEvents = "none";
            // console.log("Disable");
        }

        //Unlock Card

        document.querySelectorAll(".card-locked").forEach(function (el) {

            el.classList.remove("card-locked");

        });

        // Collect in array

        const affiliations = [

            affiliation_first,

            affiliation_two,

            affiliation_three,

            affiliation_four

        ].filter(val => val.trim() !== "");

        const fileInput = document.querySelector("input[type='file']");
        const affContainer = document.querySelector(".affiliation-list");


        // Clear old

        affContainer.innerHTML = "";
        // Append text lines

        if (Array.isArray(affiliations) && affiliations.length > 0) {

            document.querySelector(".affiliations-wrapper")?.style.setProperty("display", "block");

            affiliations.forEach((line, i) => {

                if (line && line.trim() !== "") {   // null, undefined, ya empty string skip karega

                  const div = document.createElement("div");

                  div.textContent = `${i + 1}. ${line}`;

            

                  div.style.fontFamily = "'RefrigeratorDeluxe', Oswald";

                  div.style.color = "#fff";  // (optional)

                  div.style.fontSize = "10px";  // (optional)

                  div.style.lineHeight = "1.4";

            

                  affContainer.appendChild(div);

                }

            });

        }

        // renderText(firstName, lastName, jobTitle);

        if (fileInput && fileInput.files.length > 0) {

        setProfileImage(fileInput.files[0]);

        } else {

            // alert("Please select a profile image.");

          Swal.fire({

              position: 'center',

              icon: 'error',

              title: 'Please select a profile image!',

              toast: true,

              showConfirmButton: false,

              timer: 2500,

              background: '#D22B2B',

              color: '#000',

              customClass: {

                popup: 'swal2-toast'

              }

            });



        }

        const NameHorizontal = document.getElementById("card-layout-horizontal");

        const JobHorizontal = document.getElementById("card-layout-job-horizontal");

        const NameVerticle   = document.getElementById("card-layout-vertical1");

        const JobVerticle    = document.getElementById("job-area-vertical");

        const imdbInput = document.querySelector(".imdb-link input");

        

        const editableElements = document.querySelectorAll(".editable-text");

        document.querySelector(".imdb-qr-area-horizontal").style.display = "none";

        document.querySelector(".imdb-qr-area").style.display = "none";

        

        if(editableElements){

            // Loop aur remove

            editableElements.forEach(el => {

                el.remove();

            });

        }

        

        if (NameVerticle) {

            const oldJob = NameVerticle.querySelector(".editable-text");

            if (oldJob) {

                oldJob.remove();

            }

            const NameVerticleDiv = document.createElement("div");

            NameVerticleDiv.className = "editable-text";

            NameVerticleDiv.contentEditable = "true"; // allow inline editing

            NameVerticleDiv.innerText = `${firstName} ${lastName}`;

            

            // styles

            NameVerticleDiv.style.position = "absolute";

            NameVerticleDiv.style.left = "70px";

            NameVerticleDiv.style.top = "65px";

            NameVerticleDiv.style.color = "#fff";

            NameVerticleDiv.style.fontSize = "18px";

            NameVerticleDiv.style.fontFamily = "'RefrigeratorDeluxe', Oswald"; // ✅ apply custom font

            NameVerticleDiv.style.cursor = "move";

            NameVerticleDiv.style.background = "transparent";

            NameVerticleDiv.style.zIndex = "1";

        

            NameVerticle.appendChild(NameVerticleDiv);

        

            // Make draggable

            interact(NameVerticleDiv)

                .draggable({

                    listeners: {

                        move(event) {

                            const target = event.target;

                            const x = (parseFloat(target.getAttribute("data-x")) || 0) + event.dx;

                            const y = (parseFloat(target.getAttribute("data-y")) || 0) + event.dy;

        

                            target.style.transform = `translate(${x}px, ${y}px)`;

                            target.setAttribute("data-x", x);

                            target.setAttribute("data-y", y);

                        },

                    },

                })

                // font size resize instead of div resize

                .resizable({

                    edges: { right: true, bottom: true }, // only side/bottom drag for font-size

                })

                .on("resizemove", function (event) {

                    const target = event.target;

                    let currentSize = parseInt(window.getComputedStyle(target).fontSize);

                    if (!target.dataset.baseWidth) {

                        target.dataset.baseWidth = event.rect.width;

                        target.dataset.baseFont = currentSize;

                    }

                    const scale = event.rect.width / target.dataset.baseWidth;

                    const newSize = Math.max(8, Math.round(target.dataset.baseFont * scale)); // minimum 8px

                    target.style.fontSize = newSize + "px";

                });

        }

        if(JobVerticle){



            const oldJob = JobVerticle.querySelector(".editable-text");

            if (oldJob) {

                oldJob.remove();

            }



            const JobVerticleDiv = document.createElement("div");

            JobVerticleDiv.className = "editable-text";

            JobVerticleDiv.contentEditable = "true"; // allow inline editing

             

            JobVerticleDiv.innerText = jobTitle;



            // styles

            JobVerticleDiv.style.position = "absolute";

            JobVerticleDiv.style.left = "70px";

            JobVerticleDiv.style.top = "100px";

            JobVerticleDiv.style.color = "#fff";

            JobVerticleDiv.style.fontSize = "18px";

            // JobVerticleDiv.style.fontWeight = "bold";

            JobVerticleDiv.style.fontFamily = "'RefrigeratorDeluxe', Oswald"; // ✅ apply custom font



            JobVerticleDiv.style.cursor = "move";

            JobVerticleDiv.style.background = "transparent";

            JobVerticleDiv.style.zIndex = "1";



            NameVerticle.appendChild(JobVerticleDiv);



             // Make draggable

            interact(JobVerticleDiv)

            .draggable({

                listeners: {

                    move (event) {

                    const target = event.target;

                    const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;

                    const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;



                    target.style.transform = `translate(${x}px, ${y}px)`;

                    target.setAttribute('data-x', x);

                    target.setAttribute('data-y', y);

                    }

                }

            })

            // font size resize instead of div resize

            .resizable({

            edges: { right: true, bottom: true } // only side/bottom drag for font-size

            })

            .on('resizemove', function (event) {

                const target = event.target;

                let currentSize = parseInt(window.getComputedStyle(target).fontSize);

                if (!target.dataset.baseWidth) {

                    target.dataset.baseWidth = event.rect.width;

                    target.dataset.baseFont = currentSize;

                }

                const scale = event.rect.width / target.dataset.baseWidth;

                const newSize = Math.max(8, Math.round(target.dataset.baseFont * scale)); // minimum 8px

                target.style.fontSize = newSize + "px";

            });

        }

        if(NameHorizontal){

            // console.log("Hello");



            const oldJob = NameHorizontal.querySelector(".editable-text");

            if (oldJob) {

                oldJob.remove();

            }



            const NameHorizontalDiv = document.createElement("div");

            NameHorizontalDiv.className = "editable-text";

            NameHorizontalDiv.contentEditable = "true"; // allow inline editing

              

            NameHorizontalDiv.innerText = `${firstName} ${lastName}`;

            

            // styles

            NameHorizontalDiv.style.position = "absolute";

            // NameHorizontalDiv.style.left = "50px";

            NameHorizontalDiv.style.top = "50%";

            NameHorizontalDiv.style.color = "#fff";

            NameHorizontalDiv.style.fontSize = "18px";

            // NameHorizontalDiv.style.fontWeight = "bold";

            NameHorizontalDiv.style.fontFamily = "'RefrigeratorDeluxe', Oswald"; // ✅ apply custom font



            NameHorizontalDiv.style.cursor = "move";

            NameHorizontalDiv.style.background = "transparent";

            NameHorizontalDiv.style.zIndex = "1";



            NameHorizontal.appendChild(NameHorizontalDiv);



             // Make draggable

            interact(NameHorizontalDiv)

            .draggable({

                listeners: {

                    move (event) {

                    const target = event.target;

                    const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;

                    const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;



                    target.style.transform = `translate(${x}px, ${y}px)`;

                    target.setAttribute('data-x', x);

                    target.setAttribute('data-y', y);

                    }

                }

            })

            // font size resize instead of div resize

            .resizable({

            edges: { right: true, bottom: true } // only side/bottom drag for font-size

            })

            .on('resizemove', function (event) {

                const target = event.target;

                let currentSize = parseInt(window.getComputedStyle(target).fontSize);

                if (!target.dataset.baseWidth) {

                    target.dataset.baseWidth = event.rect.width;

                    target.dataset.baseFont = currentSize;

                }

                const scale = event.rect.width / target.dataset.baseWidth;

                const newSize = Math.max(8, Math.round(target.dataset.baseFont * scale)); // minimum 8px

                target.style.fontSize = newSize + "px";

            });





            

        }

        if(JobHorizontal){



            //===== Horizontal Job Info

            const oldJob = JobHorizontal.querySelector(".editable-text");

            if (oldJob) {

                oldJob.remove();

            }

            const JobHorizontalDiv = document.createElement("div");

            JobHorizontalDiv.className = "editable-text";

            JobHorizontalDiv.contentEditable = "true"; // allow inline editing

             

            JobHorizontalDiv.innerText =   jobTitle;



            // console.log("Jijiji");



            // styles

            JobHorizontalDiv.style.position = "absolute";

            // NameHorizontalDiv.style.left = "50px";

            JobHorizontalDiv.style.top = "60%";

            JobHorizontalDiv.style.color = "#fff";

            JobHorizontalDiv.style.fontSize = "18px";

            // JobHorizontalDiv.style.fontWeight = "bold";

            JobHorizontalDiv.style.fontFamily = "'RefrigeratorDeluxe', Oswald"; // ✅ apply custom font



            JobHorizontalDiv.style.cursor = "move";

            JobHorizontalDiv.style.background = "transparent";

            JobHorizontalDiv.style.zIndex = "1";



            JobHorizontal.appendChild(JobHorizontalDiv);



             // Make draggable

            interact(JobHorizontalDiv)

            .draggable({

                listeners: {

                    move (event) {

                    const target = event.target;

                    const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;

                    const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;



                    target.style.transform = `translate(${x}px, ${y}px)`;

                    target.setAttribute('data-x', x);

                    target.setAttribute('data-y', y);

                    }

                }

            })

            // font size resize instead of div resize

            .resizable({

            edges: { right: true, bottom: true } // only side/bottom drag for font-size

            })

            .on('resizemove', function (event) {

                const target = event.target;

                let currentSize = parseInt(window.getComputedStyle(target).fontSize);

                if (!target.dataset.baseWidth) {

                    target.dataset.baseWidth = event.rect.width;

                    target.dataset.baseFont = currentSize;

                }

                const scale = event.rect.width / target.dataset.baseWidth;

                const newSize = Math.max(8, Math.round(target.dataset.baseFont * scale)); // minimum 8px

                target.style.fontSize = newSize + "px";

            });

        }

        console.log("Upper Here");

        if(imdbInput && imdbInput.value.trim() !== "") {
            console.log("Here");

            const imdbLink = imdbInput.value.trim();
            const qrSize = 80; // QR code size
            // QRious se QR generate karo

            const imdbQR = new QRious({

                value: imdbLink,

                size: qrSize,

                padding: 1, // thoda white margin

                level: 'L'

            });



            // Target container lo



            function renderQR(containerSelector, value, size = 60) {

                // High resolution QR generate (size * 5 for sharpness)

                const qr = new QRious({

                    value: value,

                    size: size * 5,   // big image for clarity

                    // padding: 4,

                    level: "H"

                });

            

                const container = document.querySelector(containerSelector);

                if (!container) return;

            

                // Purana canvas/image hatao

                container.querySelector("canvas")?.remove();

                container.querySelector("img")?.remove();

            

                // Naya <img> banao

                const img = document.createElement("img");

                img.src = qr.toDataURL("image/png");

            

                // Container ke andar bilkul fit karao

                img.style.width = "50px";

                img.style.height = "50px";

                img.style.objectFit = "cover"; // scale like canvas cover

                img.style.display = "block";

                img.style.background = "#fff";

                img.style.padding = "2px";

                // img.style.marginLeft = "20%";

            

                // Append karein container ke upar (label se pehle)

                container.prepend(img);

                container.style.display = "flex";

            }

            

            // Example calls

            renderQR(".imdb-qr-area", imdbLink, 60);

            renderQR(".imdb-qr-area-horizontal", imdbLink, 50);

            // renderQR(".demo-qr-area", demoLink, 60);   

            

        }
    });

});





document.addEventListener("DOMContentLoaded", function () {



    const approveBtn = document.getElementById("approveBtn");

    const hiddenInput = document.querySelector(".card_image_front input");

    const cardElement = document.getElementById("card-layout");

    

    if (!approveBtn || !hiddenInput || !cardElement) return;



    approveBtn.addEventListener("click", async function () {

        try {

        // Hide Fabric controls for clean export

        [profileCanvas].forEach(canvas => {

            if (!canvas) return;

            canvas.discardActiveObject?.();

            canvas.forEachObject?.(obj => obj.set({ hasControls: false, hasBorders: false }));

            canvas.renderAll?.();

        });

    

        const fullWidth = cardElement.offsetWidth;

        const fullHeight = cardElement.offsetHeight;

        if (profileCanvas) {

            profileCanvas.discardActiveObject?.();

            profileCanvas.forEachObject?.(obj => {

                obj.set({

                    selectable: false,

                    evented: false,

                    hasControls: false,

                    hasBorders: false

                });

            });

            profileCanvas.selection = false;

            profileCanvas.renderAll?.();

            // console.log("Hide Lockers");

        }

        



        const canvas = await html2canvas(cardElement, {

            

            dpi: 700,

            scale: 3, 

            useCORS: true,             

            letterRendering: true,  

            backgroundColor: null // Keep transparent if needed

            

        });

        

    

        const imgData = canvas.toDataURL("image/png");

    

        // Save to Gravity Forms hidden input

        hiddenInput.value = imgData;

        hiddenInput.removeAttribute("disabled");

        hiddenInput.dispatchEvent(new Event("change", { bubbles: true }));



        cardElement.classList.add("card-locked");

        checkHiddenInputs();

        // console.log("CArd Lock");



        // alert("Card layout captured successfully!");
        // console.log("Card layout captured successfully!");
        // console.log(imgData);

        Swal.fire({

          position: 'center',

          icon: 'success',

          title: 'Card layout captured successfully!',

          toast: true,

          showConfirmButton: false,

          timer: 2500,

          background: '#FEBC18',

          color: '#000',

          customClass: {

            popup: 'swal2-toast'

          }

        });

        } catch (err) {

        console.error("Error capturing card layout:", err);

        } finally {

        // Restore Fabric controls

        [ profileCanvas].forEach(canvas => {

            if (!canvas) return;

 

            // canvas.forEachObject?.(obj => obj.set({ hasControls: true, hasBorders: true }));

            // canvas.renderAll?.();



            if (profileCanvas && typeof profileCanvas.forEachObject === "function") {

                profileCanvas.forEachObject(obj => {

                    obj.set({

                        selectable: false,

                        evented: false,

                        hasControls: false,

                        hasBorders: false

                    });

                });

                profileCanvas.selection = false;

                profileCanvas.renderAll?.();

            }

        });

        }

    });



    // ===== Approve Horizontal Back Side Button =====

    const approveBtnBack = document.getElementById("approveBtnBack");

    const hiddenInputBack = document.querySelector(".card_image_back input");

    // const cardBack = document.getElementById("card-layout-back");
    const cardBack = document.getElementById("card-bleed-back");

    

    if(approveBtnBack && hiddenInputBack && cardBack) {

        approveBtnBack.addEventListener("click", async function(){

        try {

            // Capture card div with html2canvas

            const canvas = await html2canvas(cardBack, { 

                dpi: 700,

                scale: 3, 
                useCORS: true, 
                backgroundColor: null });

            const imgData = canvas.toDataURL("image/png");

    

            // Save to Gravity Forms hidden input

            hiddenInputBack.value = imgData;

            hiddenInputBack.removeAttribute("disabled");

            hiddenInputBack.dispatchEvent(new Event("change", { bubbles: true }));

            cardBack.classList.add("card-locked");

            checkHiddenInputs();

            // alert("Back Side captured successfully!");

            // alert("BAck Card layout captured successfully!");
            // console.log("Back Card layout captured successfully!");
            // console.log(imgData);

            Swal.fire({

              position: 'center',

              icon: 'success',

              title: 'Back Side captured successfully!',

              toast: true,

              showConfirmButton: false,

              timer: 2500,

              background: '#FEBC18',

              color: '#000',

              customClass: {

                popup: 'swal2-toast'

              }

            });

        } catch (err) {

            console.error("Error capturing back side:", err);

        }

        });

    }

});





/**

 * Verticle Font Side of Card

 */

document.addEventListener("DOMContentLoaded", function () {

    let profileVerticleImg = null;



    // ✅ Canvas init (drag/resize allow karne k liye selection: true)

    const profileCanvasVertical = new fabric.Canvas("profileCanvasVertical", { 

        // backgroundColor: "#000", 

        selection: true 

    });



    // function setProfileImageBack(file) {

    //     if (!file) return;

    

    //     const reader = new FileReader();

    //     reader.onload = function (e) {

    //         fabric.Image.fromURL(e.target.result, function (img) {

    //             const canvasWidth = profileCanvasVertical.width;

    //             const canvasHeight = profileCanvasVertical.height;

    

    //             // Scale to fit

    //             const scaleX = canvasWidth / img.width;

    //             const scaleY = canvasHeight / img.height;

    //             const scale = Math.min(scaleX, scaleY);

    

    //             img.set({

    //                 left: canvasWidth / 2,

    //                 top: canvasHeight / 2,

    //                 originX: "center",

    //                 originY: "center",

    //                 scaleX: scale,

    //                 scaleY: scale,

    //                 hasBorders: true,

    //                 hasControls: true,

    //                 selectable: true,

    //                 evented: true

    //             });

    //             img.setCoords(); // ✅ important for drag/resize

    

    //             // remove old

    //             if (profileVerticleImg) {

    //                 profileCanvasVertical.remove(profileVerticleImg);

    //             }

    

    //             profileVerticleImg = img;

    

    //             profileCanvasVertical.add(profileVerticleImg);

    //             // profileCanvasVertical.setActiveObject(profileVerticleImg);

    //             profileCanvasVertical.renderAll();

    //         }, { crossOrigin: "anonymous" });

    //     };

    //     reader.readAsDataURL(file);

    // }



    // ===== Create Layout Button =====


    // function setProfileImageBack(file) {
    //     if (!file) return;
      
    //     const reader = new FileReader();
      
    //     reader.onload = function (e) {
    //       fabric.Image.fromURL(e.target.result, function (img) {
    //         const canvasWidth = profileCanvasVertical.width;
    //         const canvasHeight = profileCanvasVertical.height;
      
    //         // Maintain 1:1 aspect ratio (square contain)
    //         const squareSize = Math.min(canvasWidth, canvasHeight);
    //         const scaleX = squareSize / img.width;
    //         const scaleY = squareSize / img.height;
    //         const scale = Math.min(scaleX, scaleY);
      
    //         img.set({
    //           left: canvasWidth / 2,
    //           top: canvasHeight / 2,
    //           originX: "center",
    //           originY: "center",
    //           scaleX: scale,
    //           scaleY: scale,
    //           hasBorders: true,
    //           hasControls: false,
    //           selectable: true,
    //           evented: true
    //         });
      
    //         img.setCoords();
      
    //         // Remove old image if exists
    //         if (window.profileVerticleImg) {
    //           profileCanvasVertical.remove(window.profileVerticleImg);
    //         }
      
    //         window.profileVerticleImg = img;
      
    //         profileCanvasVertical.add(img);
    //         profileCanvasVertical.renderAll();
      
    //         // ✅ Zoom In/Out using Mouse Wheel
    //         profileCanvasVertical.on("mouse:wheel", function (opt) {
    //           const delta = opt.e.deltaY;
    //           let zoom = profileCanvasVertical.getZoom();
    //           zoom *= 0.999 ** delta; // smooth zoom
    //           if (zoom > 5) zoom = 5;
    //           if (zoom < 0.2) zoom = 0.2;
    //           profileCanvasVertical.zoomToPoint(
    //             { x: opt.e.offsetX, y: opt.e.offsetY },
    //             zoom
    //           );
    //           opt.e.preventDefault();
    //           opt.e.stopPropagation();
    //         });
      
    //         // ✅ Pinch Zoom (Touch Devices)
    //         let lastDistance = 0;
    //         profileCanvasVertical.on("touch:gesture", function (opt) {
    //           if (opt.e.touches && opt.e.touches.length === 2) {
    //             const touches = opt.e.touches;
    //             const distance = Math.hypot(
    //               touches[0].clientX - touches[1].clientX,
    //               touches[0].clientY - touches[1].clientY
    //             );
      
    //             if (lastDistance) {
    //               let zoom =
    //                 profileCanvasVertical.getZoom() * (distance / lastDistance);
    //               if (zoom > 5) zoom = 5;
    //               if (zoom < 0.2) zoom = 0.2;
    //               profileCanvasVertical.setZoom(zoom);
    //             }
      
    //             lastDistance = distance;
    //           }
    //         });
      
    //         profileCanvasVertical.on("touch:gesture:end", () => {
    //           lastDistance = 0;
    //         });
    //       });
    //     };
      
    //     reader.readAsDataURL(file);
    // }
      
    function setProfileImageBackbk(file) {
        if (!file) return;
    
        const reader = new FileReader();
    
        reader.onload = function(e) {
            fabric.Image.fromURL(e.target.result, function(img) {
                const canvasWidth = profileCanvasVertical.width;
                const canvasHeight = profileCanvasVertical.height;
    
                const squareSize = Math.min(canvasWidth, canvasHeight);
                const scaleX = squareSize / img.width;
                const scaleY = squareSize / img.height;
                const scale = Math.min(scaleX, scaleY);
    
                img.set({
                    left: canvasWidth / 2,
                    top: canvasHeight / 2,
                    originX: "center",
                    originY: "center",
                    scaleX: scale,
                    scaleY: scale,
                    hasBorders: true,
                    hasControls: false,
                    selectable: true,
                    evented: true
                });
    
                img.setCoords();
    
                if (window.profileVerticleImg) {
                    profileCanvasVertical.remove(window.profileVerticleImg);
                }
                window.profileVerticleImg = img;
    
                profileCanvasVertical.add(img);
                profileCanvasVertical.renderAll();
    
                // --- Desktop Zoom ---
                profileCanvasVertical.on("mouse:wheel", function(opt) {
                    const delta = opt.e.deltaY;
                    let zoom = profileCanvasVertical.getZoom();
                    zoom *= 0.999 ** delta;
                    zoom = Math.max(0.2, Math.min(5, zoom));
                    profileCanvasVertical.zoomToPoint(
                        { x: opt.e.offsetX, y: opt.e.offsetY },
                        zoom
                    );
                    opt.e.preventDefault();
                    opt.e.stopPropagation();
                });
    
                // --- Mobile Pinch Zoom ---
                let lastDistance = null;
                const canvasEl = profileCanvasVertical.upperCanvasEl;
    
                canvasEl.addEventListener('touchstart', function(e) {
                    if (e.touches.length === 2) {
                        lastDistance = Math.hypot(
                            e.touches[0].clientX - e.touches[1].clientX,
                            e.touches[0].clientY - e.touches[1].clientY
                        );
                    }
                });
    
                canvasEl.addEventListener('touchmove', function(e) {
                    if (e.touches.length === 2 && lastDistance) {
                        const newDistance = Math.hypot(
                            e.touches[0].clientX - e.touches[1].clientX,
                            e.touches[0].clientY - e.touches[1].clientY
                        );
    
                        let zoom = profileCanvasVertical.getZoom() * (newDistance / lastDistance);
                        zoom = Math.max(0.2, Math.min(5, zoom));
    
                        const midX = (e.touches[0].clientX + e.touches[1].clientX) / 2;
                        const midY = (e.touches[0].clientY + e.touches[1].clientY) / 2;
    
                        profileCanvasVertical.zoomToPoint({ x: midX, y: midY }, zoom);
                        lastDistance = newDistance;
                        e.preventDefault(); // prevent page scrolling
                    }
                }, { passive: false });
    
                canvasEl.addEventListener('touchend', function(e) {
                    if (e.touches.length < 2) lastDistance = null;
                });
            });
        };
    
        reader.readAsDataURL(file);
    }
    
    function setProfileImageBack(file) {
        if (!file) return;
    
        const reader = new FileReader();
        reader.onload = function (e) {
            fabric.Image.fromURL(e.target.result, function (img) {
                const canvasWidth = profileCanvasVertical.width;
                const canvasHeight = profileCanvasVertical.height;
    
                const squareSize = Math.min(canvasWidth, canvasHeight);
                const scaleX = squareSize / img.width;
                const scaleY = squareSize / img.height;
                const scale = Math.min(scaleX, scaleY);
    
                // --- Image setup ---
                img.set({
                    left: canvasWidth / 2,
                    top: canvasHeight / 2,
                    originX: "center",
                    originY: "center",
                    scaleX: scale,
                    scaleY: scale,
                    hasBorders: false,   // no blue border
                    hasControls: false,  // no resize/rotate
                    selectable: true,    // enable drag
                    evented: true
                });
    
                // --- Remove old image if exists ---
                if (window.profileVerticleImg) {
                    profileCanvasVertical.remove(window.profileVerticleImg);
                }
                window.profileVerticleImg = img;
                profileCanvasVertical.add(img);
                profileCanvasVertical.renderAll();
    
                // disable group selection
                profileCanvasVertical.selection = false;
    
                // --- Enable dragging ---
                img.on('mousedown', function () {
                    img.opacity = 0.8;
                });
                img.on('mouseup', function () {
                    img.opacity = 1;
                });
                img.on('moving', function () {
                    profileCanvasVertical.renderAll();
                });
    
                // --- Desktop Zoom ---
                profileCanvasVertical.on('mouse:wheel', function (opt) {
                    let delta = opt.e.deltaY;
                    let zoom = profileCanvasVertical.getZoom();
                    zoom *= 0.999 ** delta;
                    zoom = Math.max(0.2, Math.min(5, zoom));
                    profileCanvasVertical.zoomToPoint(
                        { x: opt.e.offsetX, y: opt.e.offsetY },
                        zoom
                    );
                    opt.e.preventDefault();
                    opt.e.stopPropagation();
                });
    
                // --- Mobile Pinch Zoom ---
                let lastDistance = null;
                const canvasEl = profileCanvasVertical.upperCanvasEl;
    
                canvasEl.addEventListener('touchstart', function (e) {
                    if (e.touches.length === 2) {
                        lastDistance = Math.hypot(
                            e.touches[0].clientX - e.touches[1].clientX,
                            e.touches[0].clientY - e.touches[1].clientY
                        );
                    }
                });
    
                canvasEl.addEventListener('touchmove', function (e) {
                    if (e.touches.length === 2 && lastDistance) {
                        const newDistance = Math.hypot(
                            e.touches[0].clientX - e.touches[1].clientX,
                            e.touches[0].clientY - e.touches[1].clientY
                        );
    
                        let zoom = profileCanvasVertical.getZoom() * (newDistance / lastDistance);
                        zoom = Math.max(0.2, Math.min(5, zoom));
    
                        const midX = (e.touches[0].clientX + e.touches[1].clientX) / 2;
                        const midY = (e.touches[0].clientY + e.touches[1].clientY) / 2;
    
                        profileCanvasVertical.zoomToPoint({ x: midX, y: midY }, zoom);
                        lastDistance = newDistance;
                        e.preventDefault(); // prevent page scroll
                    }
                }, { passive: false });
    
                canvasEl.addEventListener('touchend', function (e) {
                    if (e.touches.length < 2) lastDistance = null;
                });
            });
        };
        reader.readAsDataURL(file);
    }
    
    
    
    document.getElementById("createLayoutBtn")?.addEventListener("click", function(){

        const firstName = document.querySelector(".first-name input")?.value || "";

        const lastName = document.querySelector(".last-name input")?.value || "";

        const jobTitle = document.querySelector(".job-title input")?.value || "";

        const fileInput = document.querySelector("input[type='file']"); 



        document.querySelectorAll(".card-locked").forEach(function (el) {

            el.classList.remove("card-locked");

        });

        resetHiddenInputsAndDisable();

        if(fileInput && fileInput.files.length>0){

        setProfileImageBack(fileInput.files[0]);

        } else if(!profileImg){

            // alert("Please select a profile image.");

            

            Swal.fire({

              position: 'center',

              icon: 'error',

              title: 'Please select a profile image.',

              toast: true,

              showConfirmButton: false,

              timer: 2500,

              background: '#D22B2B',

              color: '#000',

              customClass: {

                popup: 'swal2-toast'

              }

            });

        }

    });



    // ===== Approve Button =====

    const approveBtn = document.getElementById("approveBtnVertical");

    // console.log("Hello World");

    approveBtn.addEventListener("click", async function(){

        // const card = document.getElementById("card-layout-vertical");card-bleed-vertical-front
        const card = document.getElementById("card-bleed-vertical-front");

        const hiddenInput = document.querySelector(".vertical_card_image_front input");

        if(!hiddenInput) return;

        const containerDiv = document.getElementById("cardlayoutverticalcontainer");

        if (!containerDiv) {

            

            return;

        }

         



        try {

        const canvas = await html2canvas(card, {

            dpi: 700,

            scale: 3,  

            useCORS: true,

            backgroundColor: null

        });

        const imgData = canvas.toDataURL("image/png");



        // console.log("Captured image data URL:", imgData);



        hiddenInput.value = canvas.toDataURL("image/png");

        hiddenInput.dispatchEvent(new Event("change", { bubbles: true }));

        card.classList.add("card-locked");

        checkHiddenInputs();

        // alert("Vertical card captured successfully!");

        // console.log("Vertical card captured successfully!");
        // console.log(canvas.toDataURL("image/png"));

        Swal.fire({

          position: 'center',

          icon: 'success',

          title: 'Vertical card captured successfully!',

          toast: true,

          showConfirmButton: false,

          timer: 2500,

          background: '#FEBC18',

          color: '#000',

          customClass: {

            popup: 'swal2-toast'

          }

        });

        } catch(err){

        // console.error("Error capturing vertical card:", err);

        }

    });   

});





/**

 * Vertical BAckside 

*/

 

document.addEventListener("DOMContentLoaded", function () {

    // ===== Approve Button for Vertical Back =====

    const approveBtnVerticleBack = document.getElementById("approveBtnVerticleBack");

    approveBtnVerticleBack.addEventListener("click", async function () {

        // const cardBack = document.getElementById("card-layout-verticle-back");
        const cardBack = document.getElementById("card-bleed-vertical-back");

        const hiddenInput = document.querySelector(".vertical_card_image_back input");

    

        if (!hiddenInput) return;

    

        try {

            const canvas = await html2canvas(cardBack, {

                dpi: 700,

                scale: 3,  

                letterRendering: true,           // Increase scale for HD capture (3x)

                useCORS: true,        // Allow cross-origin images

                backgroundColor: null // Keep transparent if needed

            });

    

            // Convert to PNG

            hiddenInput.value = canvas.toDataURL("image/png");

            hiddenInput.dispatchEvent(new Event("change", { bubbles: true }));

            cardBack.classList.add("card-locked");

            checkHiddenInputs();

            // alert("Vertical back card captured in HD successfully!");

            Swal.fire({

              position: 'center',

              icon: 'success',

              title: 'Vertical back card captured successfully!',

              toast: true,

              showConfirmButton: false,

              timer: 2500,

              background: '#FEBC18',

              color: '#000',

              customClass: {

                popup: 'swal2-toast'

              }

            });



        } catch (err) {

            console.error("Error capturing vertical back card:", err);

        }

    });

});



 

document.addEventListener("gform_stripe_payment_error", function(event) {

    alert("Payment Refused: " + event.detail.error.message);

});

 

 

document.addEventListener("DOMContentLoaded", function () {

    const couponField = document.querySelector("#input_1_42"); // Coupon field input

    const feeCard = document.querySelector(".fee-card");

    const priceInput = feeCard ? feeCard.querySelector(".ginput_product_price") : null;



    if (!couponField || !priceInput) {

        console.warn("Coupon field or product price field not found!");

        return;

    }



    // Default price

    const defaultPrice = parseFloat(priceInput.value.replace(/[^0-9.]/g, "")) || 0;

    couponField.addEventListener("input", function () {

        const coupon = couponField.value.trim();



        if (coupon === "LMGIMem26") {

            priceInput.value = "$0.00";

        } else {

            priceInput.value = "$" + defaultPrice.toFixed(2);

        }



        // Fire change event

        const event = new Event("change", { bubbles: true });

        priceInput.dispatchEvent(event);

    });

});

 
function checkHiddenInputs() {
    const hiddenInputs = [
      document.querySelector(".card_image_front input"),
      document.querySelector(".card_image_back input"),
      document.querySelector(".vertical_card_image_front input"),
      document.querySelector(".vertical_card_image_back input")
    ];
    const gfSubmitBtn = document.querySelector(".gform_wrapper .gform_button");

    if (!gfSubmitBtn) return;

    const allFilled = hiddenInputs.every(input => input && input.value.trim() !== "");

    if (allFilled) {
      gfSubmitBtn.removeAttribute("disabled");
      gfSubmitBtn.style.opacity = "1";
      gfSubmitBtn.style.pointerEvents = "auto";
    //   console.log("Turn to Active ");

    } else {
      gfSubmitBtn.setAttribute("disabled", "disabled");
      gfSubmitBtn.style.opacity = "0.5";
      gfSubmitBtn.style.pointerEvents = "none";
    //   console.log("Remain Disable ");
    }
    
}


function resetHiddenInputsAndDisable() {
    const hiddenInputs = [
      document.querySelector(".card_image_front input"),
      document.querySelector(".card_image_back input"),
      document.querySelector(".vertical_card_image_front input"),
      document.querySelector(".vertical_card_image_back input")
    ];
    const gfSubmitBtn = document.querySelector(".gform_wrapper .gform_button");
  
    // Empty all hidden input values
    hiddenInputs.forEach(input => {
      if (input) input.value = "";
    });
  
    // Disable submit button again
    if (gfSubmitBtn) {
      gfSubmitBtn.setAttribute("disabled", "disabled");
      gfSubmitBtn.style.opacity = "0.5";
      gfSubmitBtn.style.pointerEvents = "none";
    //   console.log("Hidden inputs cleared & submit button disabled");
    }
  }
