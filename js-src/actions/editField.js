
function setValue(obj, input) {
    if (input.type === 'checkbox') {
        obj[input.name] = input.checked
        
        return;
    }

    if (input.classList && input.classList.contains('date')) {
        if (! input.value) {
            obj[input.name] = ''
            return;
        }

        const dateSplit = input.value.split('/').map(val => val*1)
        if (dateSplit.length !== 3) {
            obj[input.name] = ''
            return;
        }

        const date = new Date(dateSplit[2], dateSplit[1]-1, dateSplit[0])
        obj[input.name] = dayjs(date).format('YYYY-DD-MM')

        return;
    }

    obj[input.name] = input.value
}


export default e => (state, actions) => {
    const input = e.target

    if (e.childrenList && `${e.childIndex}`) {
        setValue(state.inEdition[e.childrenList][e.childIndex], input)
    } else {
        setValue(state.inEdition, input)
    }

    return Object.assign({}, state)
}