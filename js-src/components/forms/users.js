
const { h } = window.hyperapp

export default (state, actions) => h('form', {onsubmit: e => actions.formSubmit(e), 
                                              'data-model': 'users'}, [
    h('div', {className: 'row'}, [
        h('div', {className: 'col-md-4 form-group'}, [
            h('label', {}, 'Nome'),
            h('input', {type: 'text', name: 'name', className: 'form-control', required: true, 
                        value: state.inEdition.name || '',
                        onchange: e => actions.editField(e)})
        ]),

        h('div', {className: 'col-md-4 form-group'}, [
            h('label', {}, 'E-mail'),
            h('input', {type: 'mail', name: 'email', className: 'form-control', required: true,
                        value: state.inEdition.email || '',
                        onchange: e => actions.editField(e)})
        ]),

        h('div', {className: 'col-md-4 form-group'}, [
            h('label', {}, 'Senha'),
            h('input', {type: 'password', name: 'password', className: 'form-control', required: true,
                        value: state.inEdition.password || '',
                        onchange: e => actions.editField(e)})
        ])
    ]),

    h('div', {className: 'text-md-right mt-3'}, [
        
        h('button', {className: 'btn btn-success mr-3', type: 'submit'}, 'Salvar'),

        state.inEdition.id ? (
            h('button', {className: 'btn btn-danger', type: 'button', onclick: () => {
                actions.deleteRegisterConfirm('users')
            }}, 'Excluir')
        ) : (
            h('span')
        )

    ])
])