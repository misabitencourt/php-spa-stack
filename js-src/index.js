import template from './pages/template'
import actions from './actions/index'
import page from './pages/index'
import loginSrv from './services/login'
import initialState from './initialState'
import './actions/defaults'

const { app } = window.hyperapp
const isSignedIn = !! sessionStorage.user
const getLocation = () => (`${window.location.hash}`.split('#').join('') || 'home')

const state = initialState
state.page = isSignedIn ? getLocation() : 'login'

const view = (state, actions) => {
  console.log('Update!');
  
  return template(state, actions, [
    page(state, actions)
  ])
}

const renderApp = async () => {
  if (isSignedIn) {
    state.permissions = await loginSrv.getPermissions()
  }
  
  app(Object.assign(state), Object.assign(actions), view, document.body)
}

window.addEventListener('hashchange', () => {
  document.body.innerHTML = ''
  const location = getLocation()
  state.page = location
  renderApp()
});

export default renderApp
