
const { h } = window.hyperapp

export default (state, actions) => h('form', {onsubmit: e => actions.formSubmit(e), 
                                              'data-model': 'salesmen'}, [
    h('div', {className: 'row'}, [
        h('div', {className: 'col-md-4 form-group'}, [
            h('label', {}, 'Nome'),
            h('input', {type: 'text', name: 'name', className: 'form-control', 
                        value: state.inEdition.name || '', required: true,
                        onchange: e => actions.editField(e)})
        ]),

        h('div', {className: 'col-md-4 form-group'}, [
            h('label', {}, 'E-mail'),
            h('input', {type: 'mail', name: 'email', className: 'form-control', 
                        value: state.inEdition.email || '', required: true,
                        onchange: e => actions.editField(e)})
        ]),

        h('div', {className: 'col-md-4 form-group'}, [
            h('label', {}, 'Telefone'),
            h('input', {type: 'tel', name: 'phone', className: 'form-control',
                        value: state.inEdition.phone || '', required: true,
                        onchange: e => actions.editField(e)})
        ])
    ]),

    h('div', {className: 'row'}, [
        h('div', {className: 'col-md-4 form-group'}, [
            h('label', {}, 'Data de admissão'),
            h('input', {type: 'text', name: 'hire_date', className: 'form-control date', 
                        placeholder: 'DD/MM/YYYY', required: true,
                        value: state.inEdition.hire_date ? dayjs(state.inEdition.hire_date).format('DD/MM/YYYY') : '',
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