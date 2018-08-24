const { h } = window.hyperapp

export default (state, actions) => h('div', {className: 'page-home'}, [
    h('div', {className: 'row'}, [
        h('div', {className: 'col-md-12'}, [
            h('h1', {}, 'Bem vindo')
        ])
    ])
])