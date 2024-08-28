document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('nav ul');
    const exploreBtn = document.getElementById('explore-btn');

    navToggle.addEventListener('click', function() {
        navMenu.classList.toggle('show');
    });

    exploreBtn.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('explore-subjects').scrollIntoView({ behavior: 'smooth' });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const exploreBtn = document.getElementById('explore-btn');
    
    exploreBtn.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('featured-resources').scrollIntoView({
            behavior: 'smooth'
        });
    });
});
