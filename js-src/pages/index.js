import home from './home'
import login from './login'
import users from './users'
import salesmen from './salesmen'
import products from './products'
import sales from './sales'

const pages = [
    {id: 'home', mount: home},
    {id: 'login', mount: login},
    {id: 'users', mount: users},
    {id: 'salesmen', mount: salesmen},
    {id: 'sales', mount: sales},
    {id: 'products', mount: products}
]

export default (state, actions) => {
    const page = pages.find(p => p.id === state.page)
    if (! page) {
        throw new Error('Page not found')
    }

    return page.mount(state, actions)
}
