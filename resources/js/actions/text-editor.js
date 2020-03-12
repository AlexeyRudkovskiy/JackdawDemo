import SimpleMDE from 'simplemde'

export default function textEditor() {
    const targets = document.querySelectorAll('[data-wysiwyg]');
    for (let i = 0; i < targets.length; i++) {
        const target = targets[i];
        // const editorInstance = new SimpleMDE({ element: target });
    }
};
