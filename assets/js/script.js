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

// Contact Form Handler
const contactForm = document.getElementById('contactForm');
const formMessage = document.getElementById('formMessage');

if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();
        
        // Validate form
        if (!name || !email || !subject || !message) {
            showFormMessage('Please fill in all fields.', 'error');
            return;
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showFormMessage('Please enter a valid email address.', 'error');
            return;
        }
        
        // Success message (in production, you would send this to a backend)
        showFormMessage('Thank you! Your message has been sent successfully. We\'ll get back to you soon!', 'success');
        
        // Clear form
        contactForm.reset();
        
        // Optional: Log form data (for testing)
        console.log('Contact Form Submitted:', {
            name: name,
            email: email,
            subject: subject,
            message: message,
            timestamp: new Date().toISOString()
        });
    });
}

// Function to show form message
function showFormMessage(text, type) {
    formMessage.textContent = text;
    formMessage.className = `form-message ${type}`;
    
    // Auto-hide success message after 5 seconds
    if (type === 'success') {
        setTimeout(() => {
            formMessage.className = '';
        }, 5000);
    }
}