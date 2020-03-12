import actions from './actions'

(() => {
    const tag = document.body.getAttribute('data-page-id');

    const runActions = (tag) => {
        const _actions = actions[tag];
        if (typeof _actions !== "undefined") {
            _actions.forEach(action => action.call(window))
        }
    };

    runActions('general');
    runActions(tag);
})();
