/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

const buttons = document.querySelectorAll('[role="tab"]');
const tabPanels = Array.from(document.querySelectorAll('[role="tabpanel"]'));

function toggleAttribute(elements, attribute, value) {
    elements.forEach((element) => {
        element.setAttribute(attribute, value);
    });
}

function showTabContent(e) {
    const id = this.id;

    toggleAttribute(tabPanels, "hidden", true);
    toggleAttribute(buttons, "aria-selected", false);
    toggleAttribute([this], "aria-selected", true);
    const tabPanel = tabPanels.find(
        (panel) => panel.getAttribute("aria-labelledby") === id
    );
    tabPanel.hidden = false;
}

buttons.forEach((button) => {
    button.addEventListener("click", showTabContent);
});
