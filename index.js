const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");

const themeToggler = document.querySelector(".theme-toggler");

//Change Theme 
themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');

    themeToggler.querySelector('span').classList.toggle('active');
})

 menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
 })

 closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
 })



