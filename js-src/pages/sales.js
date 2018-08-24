import icon from '../components/icon/index'
import grid from '../components/grid/index'
import form from '../components/forms/sales'
import { price } from '../formatters/number';
const { h } = window.hyperapp

export default (state, actions) => h('div', {className: 'page-products'}, [
    h('div', {className: 'row mb-3'}, [
        h('div', {className: 'col-md-8'}, [
            h('h1', {}, 'Vendas')
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
            model: 'sales',
            searchMethod: 'date-range',
            cols: [
                {id: 'salesman', name: 'Vendedor', format(val) {
                    return val ? val.name : ''
                }},
                {id: 'created_at', name: 'Data', format(val) {
                    return dayjs(val).format('DD/MM/YYYY')
                }},
                {id: 'total_price', name: 'Valor total', format: val => price(val) },
                {id: 'total_comission', name: 'Comissão', format: val => price(val) }
            ],
            state,
            actions
        })
    )
])