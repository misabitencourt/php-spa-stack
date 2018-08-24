import entitySelect from '../entitySelect/index'
import icon from '../icon/index'
const { h } = window.hyperapp

export default (state, actions) => {

    if (state.inEdition && state.inEdition.id) {
        return h('h3', {}, 'Em breve.... Funcionalidade de cancelar venda')
    }

    return h('form', {onsubmit: e => actions.formSubmit(e), 
                                              'data-model': 'sales'}, [
        h('div', {className: 'row'}, [
            h('div', {className: 'col-md-4 form-group'}, [
                h('label', {}, 'Vendedor'),
                entitySelect({state, actions, parent: 'sales', model: 'salesmen', descriptionProp: 'name'})
            ]),

            h('div', {className: 'col-md-4 form-group text-md-center'}, [
                h('label', {}, ' '),
                h('div', {className: 'pt-1'}),
                h('label', {className: 'chk-box'}, [
                    h('input', {type: 'checkbox', name: '_existed_client', onchange: e => {
                        actions.editField(e)
                    }}),
                    h('span', {className: 'ml-1'}, 'Cliente já cadastrado?')
                ])
            ]),


            (state.inEdition._existed_client) ? (
                h('div', {className: 'col-md-4 form-group'}, [
                    h('label', {}, 'Cliente'),
                    entitySelect({state, actions, parent: 'sales', model: 'customers', descriptionProp: 'name'})
                ])
            ) : (
                h('div', {className: 'col-md-4 form-group'}, [
                    h('label', {}, 'Nome do cliente'),
                    h('input', {type: 'text', name: 'customer_name', className: 'form-control', 
                                value: state.inEdition.customer_name || '', required: true,
                                onchange: e => actions.editField(e)})
                ])
            )
        ]),

        h('div', {className: 'row mt-2'}, [
            h('div', {className: 'col-md-12 form-group'}, [
                h('label', {}, 'Observações'),
                h('input', {type: 'text', name: 'obs', className: 'form-control', 
                            value: state.inEdition.obs || '', 
                            onchange: e => actions.editField(e)})
            ])
        ]),

        h('div', {className: 'row mt-4'}, [
            h('div', {className: 'col-md-9'}, [
                h('h4', {}, 'Produtos')
            ]),
            h('div', {className: 'col-md-3 text-md-right'}, [
                h('button', {className: 'btn btn-sm btn-primary', type: 'button', onclick: () => {
                    actions.addChildrenInEdition({children: 'items'})
                }}, [
                    icon({name: 'add', w: 24, he: 24})
                ])
            ])
        ]),

        (state.inEdition.items && state.inEdition.items.length) ? (
            h('div', {}, [
                h('div', {className: 'row'}, [
                    h('div', {className: 'col-md-4'}, [
                        h('h5', {}, 'Produto')
                    ]),
        
                    h('div', {className: 'col-md-4'}, [
                        h('h5', {}, 'Quantidade')
                    ])
                ]),
        
                state.inEdition.items.map((itemModel, index) => h('div', {className: 'row mt-3'}, [
                    h('div', {className: 'col-md-4'}, [
                        entitySelect({state, actions, parent: `sales_items_${index}`, 
                                    model: 'products', descriptionProp: 'name',
                                        childrenList: 'items', childIndex: index})
                    ]),

                    h('div', {className: 'col-md-4 form-group'}, [
                        h('input', {type: 'number', name: 'qt', className: 'form-control', 
                                    required: true, step: '1', min: 1, max: 999,
                                    value: (state.inEdition.items[index].qt ? (state.inEdition.items[index].qt) : ''),
                                    onchange: e => {
                                        e.childrenList = 'items'
                                        e.childIndex = index
                                        actions.editField(e)
                                    }})
                    ]),

                    h('div', {className: 'col-md-4 form-group'}, [
                        h('button', {className: 'btn btn-default btn-sm', type: 'button', onclick: () => {
                            actions.removeChildrenInEdition({index, children: 'items'})
                        }}, [
                            icon({name: 'delete', w:24, he:24})
                        ])
                    ])
                ]))
            ])
        ) : (
            h('div', {className: 'row'}, [
                h('div', {className: 'col-md-12'}, [
                    h('h4', {className: 'text-warning'}, 'Nenhum produto selecionado')    
                ])
            ])
        ),

        h('div', {className: 'text-md-right mt-5'}, [
            
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
}