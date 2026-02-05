import Plugin from 'src/plugin-system/plugin.class';

export default class NavigationFlyout extends Plugin {
    init() {
        this._registerInit();
    }

    _registerInit() {
        // Add selected class to first child by default
        document.querySelector(".navigation-flyout-categories.is-level-0 > li.navigation-flyout-col.child-level-0:first-child").classList.add('selected');

        // When hover to child category remove selected class form any another li and add class to that particular li
        let categories = document.getElementsByClassName("navigation-flyout-categories is-level-0");
        Array.from(categories).forEach((element) => {
            Array.from(element.children).forEach((li) => {
                if (li.classList.contains('child-level-0')) {
                    li.addEventListener("mouseover", onMouseOverLi, false);
                }
            })
        });

        function onMouseOverLi() {
            Array.from(this.parentNode.children).forEach((element) => {
                if (element.classList.contains('selected')) {
                    element.classList.remove('selected');
                }
            });
            this.classList.add('selected');
        }
    }
}
