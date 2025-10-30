# 🎨 Artwork Builder (Fabric.js + Interact.js + Gravity Forms Integration)

This project is a **custom interactive member card builder** developed using **Fabric.js**, **Interact.js**, and **Gravity Forms**.  
It allows users to dynamically create, design, and customize member cards in real time — directly from a WordPress front-end form.

---

## 🧾 Overview

| Feature | Description |
|----------|-------------|
| **Frontend Form Integration** | Built with Gravity Forms, capturing Name, Email, and Image input fields. |
| **Dynamic Layout Creation** | When the user clicks the **“Create Layout”** button, the form data (name, email, image) is dynamically rendered in the card layout section below. |
| **Image Area (Canvas)** | Uploaded image automatically fits within a circular frame, allowing drag, zoom-in, and zoom-out using Fabric.js. |
| **Text Controls** | The Name and Title fields appear dynamically and can be resized, repositioned, and styled in real time. |
| **Lock Layout Button** | Each layout includes a **“Lock Layout”** button. Once clicked, the layout becomes non-editable (disabled for further adjustments). |
| **Gravity Forms PDF Integration** | Upon form submission, a PDF of the generated card layouts is automatically created using the Gravity PDF add-on. |
| **Data Export** | Submitted data is also stored and exported in an Excel (.xlsx) file for administrative use. |
| **Stripe Payment (Optional)** | Initially integrated with Stripe Payments for paid submissions — currently disabled (client requested to make it free). |

---

## 🚀 Features

### 🖼 Image Manipulation
- Drag within a fixed circular boundary  
- Zoom in / Zoom out with smooth scaling  
- Maintain aspect ratio  

### ✏️ Text Editing
- Adjust font size, color, and position dynamically  
- Drag and align text with real-time updates  

### 🧭 Canvas Interactions
- Responsive drag, zoom, and resize behavior using Interact.js  
- Layered element management (text above, image below)  

### 📄 PDF & Data Output
- Auto-generates a **high-resolution PDF (300 DPI)** upon form submission  
- Stores all user data in **Excel (.xlsx)** for easy record-keeping  

---

## 🛠 Tech Stack

| Component | Description |
|------------|-------------|
| **Gravity Forms** | Form handling and data collection |
| **Fabric.js** | Canvas rendering and image manipulation |
| **Interact.js** | Drag, resize, and zoom interactions |
| **Gravity PDF Add-on** | PDF generation with custom templates |
| **Stripe Integration (Optional)** | Payment gateway for paid submissions |
| **JavaScript, HTML5, CSS3** | Core scripting and styling |
| **WordPress Child Theme** | Implementation and customization layer |

---

## 📂 Project Structure

```bash
/wp-content/themes/your-child-theme/
│
├── functions.php          # Enqueues all scripts and libraries
├── style.css              # Theme main styles
│
├── assets/
│   ├── js/
│   │   └── custom-card.js  # Main JS file with Fabric.js & Interact.js logic
│   └── images/
│
└── template-parts/
    └── card-layout.php     # Contains the HTML structure for card layouts


```

---

## 🎥 Visual Demo

A complete walkthrough showing:  
- Real-time layout creation  
- Image & text manipulation  
- Gravity Forms integration  
- Layout locking  

👉 **[Watch the Demo on Loom](https://www.loom.com/)**  

---

## 👨‍💻 Author

**Name:** Arslan Ejaz  
**Email:** [me.arslanejaz@gmail.com](mailto:me.arslanejaz@gmail.com)  
**Role:** Software Engineer / WordPress Developer  

---

## 🧩 License

This project is released under the **MIT License**.  
Feel free to use, modify, and distribute with attribution.

---

## ⭐ Support

If you found this project helpful, please give it a **⭐ on GitHub** to show your support!

