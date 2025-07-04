/*==========================================================================*

  File:        nav.js
  Purpose:     

  Project:     Snowy's personal site
  Author:      Snowy  –  snow2code@protonmail.com
  Copyright:   © 2025 Snow2Code. All rights reserved.
               This is personal hobby code. No warranty, no promises.
               Please don’t nick it without asking.

 *==========================================================================*/


const menuItems = [
    { name: "Home", url: "/" },
    { name: "The Furry Project", url: "/pages/the-furry-project.html" },
    { name: "About Snowy", url: "/pages/snowy" },
    // { name: "About Lolie", url: "file:///I:/new%20silly%20site/pages/about_lolie" }, // Fuck you Lynn/lolie. you crazy nigga trying to break my relationship and me.
    // { name: "About Glowy", url: "/pages/about_snowglow" },
    { name: "Inquiries", url: "/pages/inquiries.html"}
];

function generateNavItems(navId)
{
    const navUl = document.getElementById(navId);

    menuItems.forEach(item => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = item.url;
        a.textContent = item.name;
        li.appendChild(a);
        navUl.appendChild(li);
    });
}

generateNavItems('header-nav');
generateNavItems('footer-nav');

// const navLinks = document.querySelectorAll('header nav ul li a, footer nav ul li a');

// navLinks.forEach(link => {
//     let colorInterval;

//     link.addEventListener('mouseenter', () => {
//         let colorIndex = 0;
//         const colors = [
//             'rgba(0, 255, 149)',  // Mint
//             'rgba(132, 0, 255)'  // Purple
//         ];

//         colorInterval = setInterval(() => {
//             link.style.boxShadow = `0 0 15px 5px ${colors[colorIndex]}, 0 0 15px 5px ${colors[1 - colorIndex]}`;
//             colorIndex = 1 - colorIndex; // Toggle between 0 and 1
//         }, 1000); // Change color every second
//     });

//     link.addEventListener('mouseleave', () => {
//         clearInterval(colorInterval);
//         link.style.boxShadow = 'none'; // Remove the glow when the cursor leaves
//     });
// });
