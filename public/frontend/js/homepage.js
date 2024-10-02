document.addEventListener('DOMContentLoaded', () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');
    
    burger.addEventListener('click', () => {
        // Toggle Nav
        nav.classList.toggle('nav-active');
    
        // Animate Links
        navLinks.forEach((link, index) => {
            if (link.style.animation) {
                link.style.animation = '';
            } else {
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`;
            }
        });
    
        // Burger Animation
        burger.classList.toggle('toggle');
    });
});

const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

accordionItemHeaders.forEach(accordionItemHeader => {
  accordionItemHeader.addEventListener("click", () => {
    // Toggle active class
    accordionItemHeader.classList.toggle("active");
    
    // Get the associated accordion body
    const accordionItemBody = accordionItemHeader.nextElementSibling;
    
    // Toggle the max-height of the accordion body
    if (accordionItemHeader.classList.contains("active")) {
      accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
    } else {
      accordionItemBody.style.maxHeight = "0px";
    }
    
    // Close other open accordion items (optional)
    accordionItemHeaders.forEach(header => {
      if (header !== accordionItemHeader) {
        header.classList.remove("active");
        header.nextElementSibling.style.maxHeight = "0px";
      }
    });
  });
});