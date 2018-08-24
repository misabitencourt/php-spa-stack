import navbar from '../components/navbar/index'
import alert from '../components/alert/index'
import confirm from '../components/confirm/index'

const { h } = window.hyperapp

export default (state, actions, children) => h('div', {id: 'app'}, [
    state.page === 'login' ? h('span') : navbar({title: 'Salesman', state, actions}),
    
    h('div', {className: 'container pt-4 pb-5'}, children),
    
    state.pushNotifications.length ? (
        state.pushNotifications.map(notice => alert(notice.type, notice.msg))
    ) : h('span'),

    state.confirm ? confirm(state, actions) : h('span')
])

