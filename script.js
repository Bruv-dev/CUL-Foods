const nav = document.querySelector("nav");

// Navbar scroll effect
window.addEventListener("scroll", () =>{
    if(window.scrollY > 10){
        nav.classList.add("scrolled");
    } else{
        nav.classList.remove("scrolled")
    }
});

// Mobile dropdown menu toggle
nav.addEventListener('click', (e) => {
    // Only toggle if clicking on the hamburger area (nav::after)
    const navRect = nav.getBoundingClientRect();
    const clickX = e.clientX;
    
    // Check if click is on the right side where hamburger is
    if(clickX > navRect.width - 50) {
        nav.classList.toggle('menu-open');
    }
});

// Close menu when clicking on a link
const navLinks = document.querySelectorAll('nav ul li a');
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        nav.classList.remove('menu-open');
    });
});

// Close menu when clicking outside nav
document.addEventListener('click', (e) => {
    if(!e.target.closest('nav')) {
        nav.classList.remove('menu-open');
    }
});