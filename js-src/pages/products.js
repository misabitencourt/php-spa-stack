import icon from '../components/icon/index'
import grid from '../components/grid/index'
import productTypes from '../repos/productTypes'
import { price as priceFormat } from '../formatters/number'
import form from '../components/forms/products'
const { h } = window.hyperapp

export default (state, actions) => h('div', {className: 'page-products'}, [
    h('div', {className: 'row mb-3'}, [
        h('div', {className: 'col-md-8'}, [
            h('h1', {}, 'Produtos')
        ]),

        h('div', {className: 'col-md-4 text-md-right pt-3'}, [
            state.submenu === 'form' ? (
                h('a', {href: 'javascript:;', onclick: () => actions.submenu('list')}, [
                    icon({name: 'list', w: 32, h: 32})
                ])
            ) : (
                h('a', {href: 'javascript:;', onclick: () => actions.submenu('form')}, [
                    icon({name: 'add', w: 32, h: 32})
                ])
            )
        ])
    ]),

    state.submenu === 'form' ? (
        form(state, actions)
    ) : (
        grid({
            model: 'products',
            cols: [
                {id: 'name', name: 'Nome'},
                {id: 'type', name: 'Tipo', format(val) {
                    const type = productTypes.find(pt => pt.id === val)
                    return type ? type.name : 'Produto'
                }},
                {id: 'price', name: 'Valor', format: val => priceFormat(val)}
            ],
            state,
            actions
        })
    )
])