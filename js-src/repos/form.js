

export const formBind = form => {
    const obj = {}
    Array.from(form.querySelectorAll('[name]')).forEach(input => {
        obj[input.name] = input.value
    })

    return obj
}