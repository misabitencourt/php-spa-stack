import genericSrv from '../services/generic'

export default (model, search) => (state, actions) => {
    genericSrv.list(model, search).then(items => actions.fillGrid({model, items}))
}