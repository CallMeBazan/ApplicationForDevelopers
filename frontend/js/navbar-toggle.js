function toggleNav() {
    var navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('active');
}

document.getElementById('link2').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('features').scrollIntoView({ behavior: 'smooth' });
});