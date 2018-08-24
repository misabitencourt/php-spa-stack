import genericSrv from '../services/generic'

export default ({model, value}) => (state, actions) => {
    genericSrv.list(model, value).then(items => actions.fillGrid({model, items}))
}