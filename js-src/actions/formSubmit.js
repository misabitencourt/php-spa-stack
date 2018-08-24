import genericSrv from '../services/generic'
import { formBind } from '../repos/form'

export default e => (state, actions) => {
    e.preventDefault()
    const model = e.target.dataset.model
    const obj = Object.assign({}, state.inEdition)

    if (obj.id) {
        genericSrv.update(model, obj, obj.id).then(() => {
            actions.submenu('list')
            actions.pushNotificationShow({
                type: 'success',
                msg: 'Atualizado com sucesso'
            })    
        }).catch(e => {
            actions.pushNotificationShow({
                type: 'danger',
                msg: e || 'Erro ao salvar registro'
            })
        }) 
    } else {
        const formData = new FormData()
        for (let i in state.inEdition) {
            if (typeof(state.inEdition[i]) === 'object') {
                formData.set(i, JSON.stringify(state.inEdition[i]))
                continue;
            }

            formData.set(i, state.inEdition[i])
        }

        genericSrv.save(model, formData).then(() => {
            actions.submenu('list')
            actions.pushNotificationShow({
                type: 'success',
                msg: 'Salvo com sucesso'
            })
        }).catch(e => {
            actions.pushNotificationShow({
                type: 'danger',
                msg: e || 'Erro ao salvar registro'
            })
        }) 
    }

    state.loading = true
    return Object.assign({}, state)
}