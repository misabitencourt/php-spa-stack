import icon from '../components/icon/index'
import grid from '../components/grid/index'
import form from '../components/forms/salesmen'
const { h } = window.hyperapp

export default (state, actions) => h('div', {className: 'page-salesman'}, [
    h('div', {className: 'row mb-3'}, [
        h('div', {className: 'col-md-8'}, [
            h('h1', {}, 'Vendedores')
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
            model: 'salesmen',
            cols: [
                {id: 'name', name: 'Nome'},
                {id: 'email', name: 'E-mail'},
                {id: 'phone', name: 'Telfone'},
                {id: 'hire_date', name: 'Data de admissão', format(val) {
                    return dayjs(val).format('DD/MM/YYYY')
                }}
            ],
            state,
            actions
        })
    )
])