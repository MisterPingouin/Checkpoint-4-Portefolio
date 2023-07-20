import './styles/home.scss';

const buttons = document.querySelectorAll('[role="tab"]');
const tabPanels = Array.from(document.querySelectorAll('[role="tabpanel"]'));

function toggleAttribute(elements, attribute, value) {
    elements.forEach((element) => {
        element.setAttribute(attribute, value);
    });
}

function showTabContent(e) {
    const id = this.id;

    const videos = document.querySelectorAll('video');
    videos.forEach(video => video.pause());

    toggleAttribute(tabPanels, "hidden", true);
    toggleAttribute(buttons, "aria-selected", false);
    toggleAttribute([this], "aria-selected", true);
    const tabPanel = tabPanels.find(
        (panel) => panel.getAttribute("aria-labelledby") === id
    );
    tabPanel.hidden = false;

    setTimeout(function() {
        const video = document.getElementById('video' + id);
        video.play();
    }, 1500);
}


buttons.forEach((button) => {
    button.addEventListener("click", showTabContent);
});

window.addEventListener('load', (event) => {
    buttons[2].click();
});
