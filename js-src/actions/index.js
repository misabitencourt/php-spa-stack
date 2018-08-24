import {submit as loginSubmit} from './login'
import {hide as pushNotificationHide, show as pushNotificationShow} from './notifications'
import fetchGrid from './fetchGrid'
import fillGrid from './fillGrid'
import submenu from './submenu'
import formSubmit from './formSubmit'
import gridSearch from './gridSearch'
import gridSelection from './gridSelection'
import editField from './editField'
import {confirm as deleteRegisterConfirm, deleteRegister} from './deleteRegister'
import {confirmOk, confirmCancel} from './triggerConfirm'
import {default as entityModelSearch, entitySearchFill} from './entityModelSearch'
import { addChildrenInEdition, removeChildrenInEdition } from './inEditionChildren'

export default {
    formSubmit,
    loginSubmit,
    pushNotificationShow,
    pushNotificationHide,
    fetchGrid,
    fillGrid,
    submenu,
    gridSearch,
    gridSelection,
    editField,
    deleteRegisterConfirm,
    deleteRegister,
    confirmOk,
    confirmCancel,
    entityModelSearch,
    entitySearchFill,
    addChildrenInEdition,
    removeChildrenInEdition
}