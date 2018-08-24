import {groups as menuGroups, default as menus} from '../../repos/menus'
import icon from '../icon/index'
const { h } = window.hyperapp

export default ({title='Salesman', state, actions}) => h('div', {className: 'navbar nav-tabs navbar-light bg-primary text-white'}, [
    h('div', {className: 'navbar-brand text-white', title}, [
        icon({name: 'brand', w: 40, he: 40})
    ]),
    h('ul', {className: 'nav nav-tabs'}, menuGroups.map(group => {
        return h('li', {className: 'nav-item dropdown'}, [
            h('a', {href:'javascript:;', className: 'nav-link dropdown-toggle', title: group.description}, [
                h('span', {className: 'hidden-sm'}, group.name),
                h('span', {className: 'hidden-lg'}, [
                    icon({name: group.icon, w: 32, he: 32})
                ])
            ]),
            h('div', {className: 'dropdown-menu'}, menus.filter(m => m.group === group.id).map(menu => {
                return h('a', {href: menu.route, className: 'dropdown-item'}, menu.name)
            }))
        ])
    }))
])

