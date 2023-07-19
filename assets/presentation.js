import './styles/presentation.scss';

document.addEventListener("DOMContentLoaded", function() {
    var articles = document.querySelectorAll('article');
    var windowHeight = window.innerHeight;

    function checkPosition() {
        for (var i = 0; i < articles.length; i++) {
            var article = articles[i];
            var positionFromBottom = articles[i].getBoundingClientRect().bottom;

            if (positionFromBottom - windowHeight <= 0) {
                article.classList.add('current');
            } else {
                article.classList.remove('current');
            }
        }
    }

    window.addEventListener('scroll', checkPosition);
    window.addEventListener('resize', checkPosition);
    // Exécutez la fonction une fois au chargement pour initialiser correctement les classes
    checkPosition();
});
