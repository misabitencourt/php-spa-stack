import genericSrv from '../services/generic'

export const confirm = model => (state, actions) => {
    state.confirm = {
        msg: 'Deseja mesmo excluir este registro?',
        ok() {
            actions.deleteRegister(model)
        }
    }

    return Object.assign({}, state)
}

export const deleteRegister = model => (state, actions) => {
   genericSrv.destroy(model, state.inEdition.id).then(() => {
       actions.submenu('list')
       actions.pushNotificationShow({
            type: 'success',
            msg: 'Registro deletado com sucesso'
       })
   })
}