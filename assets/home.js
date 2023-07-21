import './styles/home.scss';

const buttons = document.querySelectorAll('[role="tab"]');
const tabPanels = Array.from(document.querySelectorAll('[role="tabpanel"]'));

const toggleAttribute = (elements, attribute, value) => {
    elements.forEach((element) => {
        element.setAttribute(attribute, value);
    });
};

const showTabContent = (e) => {
    const { id } = e.currentTarget;
    const videos = document.querySelectorAll('video');

    videos.forEach(video => video.pause());
    toggleAttribute(tabPanels, "hidden", true);
    toggleAttribute(buttons, "aria-selected", false);
    toggleAttribute([e.currentTarget], "aria-selected", true);

    const tabPanel = tabPanels.find(
        (panel) => panel.getAttribute("aria-labelledby") === id
    );

    tabPanel.hidden = false;

    setTimeout(() => {
        const video = document.getElementById('video' + id);
        video.play();
    }, 1500);
};

buttons.forEach((button) => {
    button.addEventListener("click", showTabContent);
});

window.addEventListener('load', () => {
    buttons[2]?.click();
});
