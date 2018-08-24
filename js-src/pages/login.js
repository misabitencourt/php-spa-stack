const { h } = window.hyperapp

import card from '../components/card/index'

export default (state, actions) => h('div', {className: 'login'}, [
    card('Login', [
        h('form', {onsubmit: actions.loginSubmit}, [
            h('input', {className: 'form-control mb-2', required: true, placeholder: 'E-mail', type: 'text', name: 'email'}),
            h('input', {className: 'form-control mb-2', required: true, placeholder: 'Senha', type: 'password', name: 'password'}),
            h('div', {className: 'text-md-center'}, [
                h('button', {className: 'btn btn-primary', type: 'submit'}, 'Entrar')
            ])
        ])
    ])
])