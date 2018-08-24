

export default val => state => {
    state.submenu = val
    state.inEdition = {}

    return Object.assign({}, state)
}