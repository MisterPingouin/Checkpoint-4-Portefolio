import './styles/presentation.scss';

document.addEventListener("DOMContentLoaded", () => {
    const articles = document.querySelectorAll('article');
    let windowHeight = window.innerHeight;

    const checkPosition = () => {
        articles.forEach((article) => {
            const positionFromBottom = article.getBoundingClientRect().bottom;

            if (positionFromBottom - windowHeight <= 0) {
                article.classList.add('current');
            } else {
                article.classList.remove('current');
            }
        });
    }

    window.addEventListener('scroll', checkPosition);
    window.addEventListener('resize', checkPosition);

    checkPosition();
});
