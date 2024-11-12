document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('a.nav-link').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            e.preventDefault()

            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollTo({
                    top: target.offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    window.addEventListener('scroll', function () {
        document.querySelectorAll('.content-section').forEach(function (section) {
            const sectionTop = section.offsetTop - window.innerHeight / 2; // 50% of the screen

            if (window.scrollY >= sectionTop) {
                section.querySelectorAll('h2, p').forEach(function (element) {
                    element.classList.add('animate__animated', 'animate__fadeInUp');
                });
            }
        });
    });

    window.dispatchEvent(new Event('scroll'));
}