const { h } = window.hyperapp

export default (title, children) => h('div', {className: 'card'}, [
    title ? h('div', {className: 'card-header bg-primary text-white'}, [
        h('h5', {className: 'mb-0'}, title)
    ]) : h('span'),
    h('div', {className: 'card-body'}, children)
])