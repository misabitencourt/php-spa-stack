

export default ({model, item}) => (state, actions) => {
    actions.submenu('form')
    state.inEdition = Object.assign({}, item)
    
    return Object.assign({}, state)
}