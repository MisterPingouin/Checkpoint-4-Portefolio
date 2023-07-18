import './styles/presentation.scss';
document.addEventListener("DOMContentLoaded", function() {
    var articles = document.querySelectorAll('article');
    var windowHeight = window.innerHeight;
  
    function checkPosition() {
        for (var i = 0; i < articles.length; i++) {
            var article = articles[i];
            var positionFromTop = articles[i].getBoundingClientRect().top;
  
            if (positionFromTop - windowHeight <= 0) {
                article.classList.add('current');
            } else {
                article.classList.remove('current');
            }
        }
    }
  
    window.addEventListener('scroll', checkPosition);
    window.addEventListener('resize', checkPosition);
});
  