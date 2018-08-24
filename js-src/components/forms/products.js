import productTypes from '../../repos/productTypes'
const { h } = window.hyperapp

const typeOptions = productTypes.map(pt => h('option', {value: pt.id}, pt.name))

export default (state, actions) => h('form', {onsubmit: e => actions.formSubmit(e), 
                                              'data-model': 'products'}, [
    h('div', {className: 'row'}, [
        h('div', {className: 'col-md-4 form-group'}, [
            h('label', {}, 'Nome'),
            h('input', {type: 'text', name: 'name', className: 'form-control', 
                        value: state.inEdition.name || '', required: true,
                        onchange: e => actions.editField(e)})
        ]),

        h('div', {className: 'col-md-4 form-group'}, [
            h('label', {}, 'Descrição'),
            h('input', {type: 'text', name: 'description', className: 'form-control', 
                        value: state.inEdition.description || '', required: true,
                        onchange: e => actions.editField(e)})
        ]),

        h('div', {className: 'col-md-4 form-group'}, [
            h('label', {}, 'Tipo'),
            h('select', {name: 'type', className: 'form-control',
                        value: `${state.inEdition.type}` || '', required: true,
                        onchange: e => actions.editField(e)}, typeOptions)
        ])
    ]),

    h('div', {className: 'row'}, [
        h('div', {className: 'col-md-4 form-group'}, [
            h('label', {}, 'Valor'),
            h('input', {type: 'number', name: 'price', className: 'form-control', 
                        required: true, step: '0.01',
                        value: state.inEdition.price || '',
                        onchange: e => actions.editField(e)})
        ])
    ]),

    h('div', {className: 'text-md-right mt-3'}, [
        
        h('button', {className: 'btn btn-success mr-3', type: 'submit'}, 'Salvar'),

        state.inEdition.id ? (
            h('button', {className: 'btn btn-danger', type: 'button', onclick: () => {
                actions.deleteRegisterConfirm('products')
            }}, 'Excluir')
        ) : (
            h('span')
        )

    ])
])